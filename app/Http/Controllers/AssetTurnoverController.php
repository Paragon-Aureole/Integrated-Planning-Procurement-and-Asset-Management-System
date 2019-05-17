<?php

namespace App\Http\Controllers;

use App\asset;
use App\PurchaseOrder;
use App\PurchaseRequest;
use App\Office;
use App\assetTurnover;
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

        // dd(assetPar::with('assetParItem')->where('id', 1)->get());
        // dd(assetPar::with('assetParItem')->where('id', 3)->get());
        // $sampledata = assetPar::with('assetParItem')->where('id', 1)->get();
        // $sampledata = assetTurnover::with('asset_par')->where('isApproved', 0)->where('id', 1)->get();

        // $sampledata = assetPar::with('assetParItem')->get();

        // dd(unserialize($sampledata->first()->turnoverData));
        

        $to = assetPar::with('assetParItem')->get();
        $office = Office::all();
        $currentOfficeId = Auth::user()->office_id;
        $approvalAssets = assetTurnover::all();

        // dd($to);

        return view('assets.turnover.index', compact('to', 'office', 'currentOfficeId', 'approvalAssets'));
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
    
    public function getParTurnoverItems(Request $request)
    {
        // dd($request->all());
        $par_id = $request->input('par_id');

        $assetTurnoverData = assetTurnover::with('asset_par')->where('isApproved', 0)->where('par_id', $par_id)->get();

        // $assetTurnoverData = assetTurnover::with('asset_par')->where('par_id', $par_id)->get();

        if (!$assetTurnoverData->isEmpty()) {
            $unserializedTurnoverData = unserialize($assetTurnoverData->first()->turnoverData);
        } else {
            $unserializedTurnoverData = [];
        }

        // $unserializedTurnoverData = unserialize($assetTurnoverData->first()->turnoverData);
    
        return response()->json(['assetParTurnoverItems'=> $unserializedTurnoverData]);
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

        $toTurnoverData = serialize($request->input('toTurnover'));

        // dd(unserialize($toTurnoverData));
        // $schedule = implode(",", $input['item_schedule']);

        assetTurnover::create([
            'par_id' => $par_id,
            'isApproved' => 0,
            'turnoverData' => $toTurnoverData
        ]);

        return redirect()->back()->with('success', 'Request for Turnover Submitted.');

    }

    public function approveParTurnover(Request $request)
    {
        // dd($request->all());
        $par_id = $request->input('par_id');

        $assetTurnoverData = assetTurnover::with('asset_par')->where('isApproved', 0)->where('par_id', $par_id)->get();
        $assetParItems = AssetParItem::where('asset_par_id', $par_id)->get();

        $unserializedTurnoverData = unserialize($assetTurnoverData->first()->turnoverData);

        $assetTurnoverData[0]->isApproved = 1;
        $assetTurnoverData[0]->save();
        
        foreach ($unserializedTurnoverData as $key => $value) {
            for ($i=0; $i < count($assetParItems); $i++) {
                if ($key == $assetParItems[$i]->id) {
                    $assetParItems[$i]->itemStatus = $value;
                    $assetParItems[$i]->save();
                }
            }
        }

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
