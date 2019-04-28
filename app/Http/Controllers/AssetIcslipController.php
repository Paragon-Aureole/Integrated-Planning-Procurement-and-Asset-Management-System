<?php

namespace App\Http\Controllers;

use App\asset;
use App\assetIcslip;
use Illuminate\Http\Request;

class AssetIcslipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $id)
    {
        $assetIcslipData = assetIcslip::all();
        
        // dd($assetIcslipRemainingQuantity);

        // $assetIcslipData = assetIcslip::select('asset_id')->groupBy('asset_id')->get();
        // $assetIcslipData = assetIcslip::where('asset_id', 3)->sum('quantity');
        $IcslipData = asset::where('purchase_order_id', $id->id)->where('isICS', 1)->where('isAssigned', 0)->get();
        $purchase_order_id = $id->id;

        // dd($IcslipData[0]->item_quantity);

        // return view('assets.Icslip.index', compact('IcslipData', 'assetIcslipData', 'purchase_order_id', 'assetTypes'));
        return view('assets.ics.index', compact('IcslipData', 'assetIcslipData', 'purchase_order_id'));

    }

        public function getICSCount()
    {
        $assetIcslipCount = assetIcslip::get()->count();
        return ($assetIcslipCount);
    }

    // public function getPARData()
    // {
    //     $assetParData = assetPar::All();
    //     return ($assetParData);
    // }

    public function setIsAssigned(Request $request)
    {
        asset::whereId($request->asset_id)->update([
                'isAssigned' => 1
            ]);

        return response()->json(['response' => 'Assigning Successful. You may now print.', 'error' => false]);
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
        $items = $request->input('data');
        // dd($items);

        assetIcslip::create([
            'asset_id' => $items[0],
            'quantity' => $items[1],
            'description' => $items[2],
            'assignedTo' => $items[3],
            'position' => $items[4],
            'useful_life' => $items[5]
        ]);

        asset::find($items[0])->decrement('item_stock', $items[1]);


        if ($request->isMethod('post')) {
            // return response()->json(['response' => 'This is post method', 'error' => false]);
            return response()->json(['response' => 'Save Success', 'error' => false, 'data' => $items]);
        } else {
            return response()->json(['response' => 'failure']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\assetIcslip  $assetIcslip
     * @return \Illuminate\Http\Response
     */
    public function show(assetIcslip $assetIcslip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\assetIcslip  $assetIcslip
     * @return \Illuminate\Http\Response
     */
    public function edit(assetIcslip $assetIcslip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\assetIcslip  $assetIcslip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, assetIcslip $assetIcslip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\assetIcslip  $assetIcslip
     * @return \Illuminate\Http\Response
     */
    public function destroy(assetIcslip $assetIcslip)
    {
        //
    }
}
