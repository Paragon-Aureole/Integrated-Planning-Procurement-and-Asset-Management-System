<?php

namespace App\Http\Controllers;

use App\asset;
use App\PurchaseOrder;
use App\PurchaseRequest;
use App\Office;
use App\assetTurnover;
use App\AssetTurnoverItem;
use App\assetPar;
use App\AssetParItem;
use App\assetIcslip;
use Carbon\Carbon;
use Auth;

use Illuminate\Http\Request;

class AssetTurnoverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->can('Asset Management', 'Supervisor')) {
            $to = assetPar::All();
            $approvalAssets = assetTurnover::All();
        } else {
            $to = assetPar::whereHas('asset.purchaseOrder.purchaseRequest', function ($query) {
                $query->where('office_id', Auth::user()->office_id);
            })->get();

            $approvalAssets = assetTurnover::whereHas('assetParItem.assetPar.asset.purchaseOrder.purchaseRequest', function ($query) {
                $query->where('office_id', Auth::user()->office_id);
            })->get();
        }
        // dd($approvalAssets->first()->assetTurnoverItem);

        return view('assets.turnover.index', compact('to', 'approvalAssets'));
    }

    

    public function parSearchTurnover(Request $request)
    {
        $par_id = $request->input('par_id');

        $assetPar = [];

        if (Auth::user()->hasRole('Admin')) {
            $assetPar[] = assetPar::where('id', $par_id)
            ->get();
            $assetPars = assetPar::find($par_id);
            $assetPar[] = $assetPars->asset->purchaseOrder->purchaseRequest->office->where('id', Auth::user()->office_id)->get();
        } else {
            $assetPars = assetPar::find($par_id);
            
            $assetPar = $assetPars->asset->purchaseOrder->purchaseRequest->office->where('id', Auth::user()->office_id)->get();
        }
 
        return response()->json(['assetPar'=>$assetPar]);
    }

    public function getParAssignedItems(Request $request)
    {
        $par_id = $request->input('par_id');
        $beach = assetPar::with('assetParItem')->where('id', $par_id)->get();
        $assetPar[] = $beach->first()->asset->details;
        $assetPar[] = $beach->first()->assetParItem;

        return response()->json(['assetParItems'=> $assetPar]);
    }

    public function getCurrentTurnoverId()
    {
        $currentTurnoverId = assetTurnover::count();
        return response()->json(['currentTurnoverId'=> $currentTurnoverId]);
    }
    
    public function getParTurnoverItems(Request $request)
    {
        // dd($request->all());
        $par_id = $request->input('id');

        $assetTurnoverData = assetTurnoverItem::with('assetParItem')->where('asset_turnover_id', $par_id)->get();
    
        return response()->json(['assetParTurnoverItems'=> $assetTurnoverData]);
    }

    public function nameSearchTurnover(Request $request)
    {
        // CONTROLLER FOR NAME AND OFFICE SEARCHING
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $par_id = $request->input('turnoverParId');
        $turnover_id = $request->input('currentTurnoverId');

        $toTurnoverData = $request->input('toTurnover');
        // dd(count($toTurnoverData));

        if (count($toTurnoverData) != 0) {
            $filteredTurnoverData = [];
            // dd(unserialize($toTurnoverData));
            foreach ($toTurnoverData as $key => $value) {
                if ($value != 0) {
                    $filteredTurnoverData[$key] = $value;
                }
            }

            // dd(count($filteredTurnoverData));
            if (count($filteredTurnoverData) != 0) {
                assetTurnover::create([
                   'asset_par_id' => $par_id,
                   'isApproved' => 0
               ]);
       
                foreach ($filteredTurnoverData as $key => $value) {
                    AssetTurnoverItem::create([
                       'asset_turnover_id' => $turnover_id,
                       'asset_par_item_id' => $key
                   ]);
       
                    AssetParItem::where('id', $key)->update([
                   'itemStatus' => $value
               ]);
               
       
                    return redirect()->back()->with('success', 'Request for Turnover Submitted.');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid Request. Check the items.');

            }
        } else {
            return redirect()->back()->with('error', 'Invalid Request. Check the items.');
        }
    }

    public function approveParTurnover(Request $request)
    {
        // dd($request->all());

        $par_id = $request->input('par_id');

        $assetTurnover = assetTurnover::where('isApproved', 0)->where('id', $par_id)->get();
        $assetTurnoverItems = AssetTurnoverItem::where('asset_turnover_id', $par_id)->get();

        // dd($assetTurnover[0]->isApproved);

        $assetTurnover[0]->isApproved = 1;
        $assetTurnover[0]->save();

        foreach ($assetTurnoverItems as $key => $value) {
            // dd($value->assetParItem->itemStatus);
            $value->assetParItem->itemStatus = 2;
            $value->assetParItem->save();
        }

        
        // $assetTurnoverData[0]->isApproved = 1;
        // $assetTurnoverData[0]->save();
        
        // $assetParItems[0]->itemStatus = 2;
        // $assetParItems[0]->save();

        return response()->json(['response' => 'Save Success', 'error' => false]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\assetTurnover  $assetTurnover
     * @return \Illuminate\Http\Response
     */
    public function show(assetTurnover $assetTurnover)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\assetTurnover  $assetTurnover
     * @return \Illuminate\Http\Response
     */
    public function edit(assetTurnover $assetTurnover)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\assetTurnover  $assetTurnover
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, assetTurnover $assetTurnover)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\assetTurnover  $assetTurnover
     * @return \Illuminate\Http\Response
     */
    public function destroy(assetTurnover $assetTurnover)
    {
        //
    }
}
