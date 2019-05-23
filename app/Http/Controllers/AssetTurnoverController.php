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
            $office = Office::All();
        } else {

            // $to = assetPar::All();
            // $approvalAssets = assetTurnover::All();

            $to = assetPar::whereHas('purchaseOrder.purchaseRequest', function ($query) {
                $query->where('office_id', Auth::user()->office_id);
            })->get();

            // $approvalAssets = assetTurnover::All();


            $approvalAssets = assetTurnover::whereHas('assetTurnoverItem.AssetParItem.asset.PurchaseOrder.PurchaseRequest', function ($query) {
                $query->where('office_id', Auth::user()->office_id);
            })->get();
            // dd($approvalAssets);

            $office = Office::where('id', $user->office_id)->get();
        }
        $turnoverCount = (int) assetTurnover::count() + 1;

        
        // dd($to);

        return view('assets.turnover.index', compact('to', 'approvalAssets', 'office', 'turnoverCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $id)
    {
        // dd($id->all());
        // $par_id = $id->id;
        // $parData = assetPar::with('AssetParItem')->findorFail($par_id);
        // $turnoverCount = (int) assetTurnover::count() + 1;
        // dd($turnoverCount);
        return view('assets.turnover.create');
    }

    // public function createNewTurnover()
    // {
    //     // dd($request->all());

    //     // $requestData = $request->input('item_id');

    //     // $forReturn = $request->input('forReturn');
        
    //     // $turnoverCount = $request->input('turnover_number');

    //     // $turnoverData = [];

    //     // foreach ($requestData as $key => $value) {
    //     //     $turnoverData[] = assetParItem::findorFail($value);
    //     // }
        
    //     // dd($turnoverData);

    //     // return view('assets.turnover.create', compact('turnoverData', 'forReturn', 'turnoverCount'));
    //     return view('assets.turnover.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // $par_id = $request->input('par_id');
        // $turnover_id = $request->input('currentTurnoverId');

        $toTurnoverData = $request->input('item_id');
        $forReturn = $request->input('forReturn');

        // dd($forReturn);

        // dd(count($toTurnoverData));

        if ($toTurnoverData == null) {
            return redirect()->back()->with('error', 'No Available Items to be Turned over');
        } else {
            if (count($toTurnoverData) != 0) {
                $filteredTurnoverData = [];
                // dd(unserialize($toTurnoverData));
                foreach ($toTurnoverData as $key => $value) {
                    if ($value != 0) {
                        $filteredTurnoverData[$key] = $value;
                    }
                }
    
                // dd($filteredTurnoverData);
    
                // dd(count($filteredTurnoverData));
            } else {
                return redirect()->back()->with('error', 'Invalid Request. Check the items.');
            }
        }

        // dd($filteredTurnoverData);


        if (count($filteredTurnoverData) != 0) {
            if ($forReturn == 1) {
                $newAssetTurnover = assetTurnover::create([
                    //    'asset_par_id' => $par_id,
                       'isApproved' => 0,
                       'isReturn' => 1
                       
                   ]);

                foreach ($filteredTurnoverData as $key => $value) {
                    AssetTurnoverItem::create([
                       'asset_turnover_id' => $newAssetTurnover->id,
                       'asset_par_item_id' => $key
                   ]);
       
                    AssetParItem::where('id', $key)->update([
                   'itemStatus' => 1
               ]);
                }
            } elseif ($forReturn == 0) {
                $newAssetTurnover = assetTurnover::create([
                        //    'asset_par_id' => $par_id,
                           'isApproved' => 0,
                           'isReturn' => 0
                           
                       ]);

                foreach ($filteredTurnoverData as $key => $value) {
                    AssetTurnoverItem::create([
                       'asset_turnover_id' => $newAssetTurnover->id,
                       'asset_par_item_id' => $key
                   ]);
       
                    AssetParItem::where('id', $key)->update([
                   'itemStatus' => 1
               ]);
                }
            } else {
                return redirect()->back()->with('error', 'Invalid Request: Unable to create Turnover.');
            }
       
            return redirect()->back()->with('success', 'Request for Turnover Submitted. Verify and Print Here.');
        } else {
            return redirect()->back()->with('error', 'Invalid Request. Check the items.');
        }
    }

    public function approveParTurnover($id, $type)
    {
        // dd($request->all());
        // echo $id;
        // echo "<br>";
        // echo $type;
        // die();

        $assetTurnover = assetTurnover::where('isApproved', 0)->where('id', $id)->get();
        $assetTurnoverItems = AssetTurnoverItem::where('asset_turnover_id', $id)->get();

        // dd($assetTurnover);

        // dd($assetTurnover[0]->isApproved);
        if (count($assetTurnover) > 0) {
            $assetTurnover[0]->isApproved = 1;
            $assetTurnover[0]->save();
        } else {
            return redirect()->back()->with('error', 'Invalid Request: Unable to Approve Turnover.');
        }

        if ($type == 0) {
            foreach ($assetTurnoverItems as $key => $value) {
                // dd($value->assetParItem->itemStatus);
                $value->assetParItem->itemStatus = 2;
                $value->assetParItem->save();
            }
            return redirect()->back()->with('success', 'Turnover Approved.');
        } elseif ($type == 1) {
            foreach ($assetTurnoverItems as $key => $value) {
                // dd($value->assetParItem->itemStatus);
                $value->assetParItem->itemStatus = 3;
                $value->assetParItem->save();
            }
            return redirect()->back()->with('success', 'Turnover Approved.');
        } else {
            return redirect()->back()->with('error', 'Invalid Request: Unable to Approve Turnover.');
        }

        // $assetTurnoverData[0]->isApproved = 1;
        // $assetTurnoverData[0]->save();
        
        // $assetParItems[0]->itemStatus = 2;
        // $assetParItems[0]->save();
        
        // return response()->json(['response' => 'Save Success', 'error' => false]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\assetTurnover  $assetTurnover
     * @return \Illuminate\Http\Response
     */
    // public function show(assetTurnover $assetTurnover)
    // {
    //     dd($assetTurnover);
    // }
    public function show($id)
    {
        $assetTurnoverData = assetTurnoverItem::where('asset_turnover_id', $id)->get();
        $turnover_id = $id;
        // dd($assetTurnoverData);

        return view('assets.turnover.show', compact('assetTurnoverData', 'turnover_id'));
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
    public function update(Request $request, $id)
    {
        // print_r($request->all());
        // print_r(assetTurnover::findorFail($id));
        // die();

        $turnover_id = $request->input('turnover_id');

        $assetTurnover = assetTurnover::where('id', $turnover_id)->get();
        $assetTurnoverItems = AssetTurnoverItem::where('asset_turnover_id', $turnover_id)->get();

        // dd($assetTurnover[0]->isApproved);

        $assetTurnover[0]->isApproved = 1;
        $assetTurnover[0]->save();

        foreach ($assetTurnoverItems as $key => $value) {
            // dd($value->assetParItem->itemStatus);
            $value->assetParItem->itemStatus = 2;
            $value->assetParItem->save();
        }

        return redirect()->route('AssetTurnover.index')->with('success', 'Request for Turnover Approved.');
    }

    public function ViewTurnedover()
    {
        $user = Auth::user();
        // dd('asdasd');
        if ($user->can('Asset Management', 'Supervisor')) {
            # code...
            $pendingTurnoverData = assetTurnover::All();

        } else {
            $pendingTurnoverData = assetTurnover::whereHas('assetTurnoverItem.AssetParItem.asset.PurchaseOrder.PurchaseRequest', function ($query) {
                $query->where('office_id', Auth::user()->office_id);
            })->get();

            // $pendingTurnoverData = assetTurnover::All();

        }
        
        
        return view('assets.turnover.viewTurnedOver', compact('pendingTurnoverData'));
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
