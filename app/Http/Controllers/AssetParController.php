<?php

namespace App\Http\Controllers;

use App\asset;
use App\assetPar;

use Illuminate\Http\Request;

class AssetParController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $id)
    {

        // $assetParData = assetPar::all();
        
        // dd($assetParRemainingQuantity);

        // $assetParData = assetPar::select('asset_id')->groupBy('asset_id')->get();
        // $assetParData = assetPar::where('asset_id', 3)->sum('quantity');
        // $parData = asset::where('purchase_order_id', $id->id)->where('isPAR', 1)->where('isAssigned', 0)->get();
        // $purchase_order_id = $id->id;

        // dd($parData[0]->item_quantity);

        // return view('assets.par.index', compact('parData', 'assetParData', 'purchase_order_id', 'assetTypes'));
        // return view('assets.par.index', compact('parData', 'assetParData', 'purchase_order_id'));
        return view('assets.par.index', compact('assetPar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPARCount()
    {
        $assetParCount = assetPar::get()->count();
        return ($assetParCount);
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
    
    public function create()
    {

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

        assetPar::create([
            'asset_id' => $items[0],
            'quantity' => $items[1],
            'description' => $items[2],
            'assignedTo' => $items[3],
            'position' => $items[4]
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // NEW FUNCTIONS

    public function parTransaction($id)
    {
        // dd('wew');
        $parCount = (int) assetPar::count() + 1;
        // dd($parCount);
        $assetParItems = asset::where('isPAR', 1)->where('item_stock', "<>", 0)->where('purchase_order_id', $id)->get();
        // dd($assetParItems);
        if ($assetParItems->isEmpty()) {
            return redirect()->route('assets.index')->with('error', 'No PAR items left in this PO!');
        }

        // dd($signatoryData);
        
        return view('assets.par.parTransaction', compact('assetParItems', 'id', 'parCount'));
    }

    public function displayParTransactions($id)
    {
        // dd($id);
        // $assetIcsItem = assetIcslipItem::where('asset_icslip_id', $id)->get();
        // // dd($assetIcs->first()->AssetIcslipItem);
        
        // return view('assets.ics.index', compact('assetIcsItem', 'id'));
    }
}
