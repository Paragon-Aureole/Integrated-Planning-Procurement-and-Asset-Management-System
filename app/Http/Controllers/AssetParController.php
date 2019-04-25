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
        // dd($id->purchase_order_id);
        $assetParData = assetPar::all();
        // dd($id->all());
        $parData = asset::where('purchase_order_id', $id->id)->where('isPAR', 1)->where('isAssigned', 0)->get();
        // dd($parData);
        $purchase_order_id = $id->id;
        // $assetTypes = assetType::All();
        // return view('assets.par.index', compact('parData', 'assetParData', 'purchase_order_id', 'assetTypes'));
        return view('assets.par.index', compact('parData', 'assetParData', 'purchase_order_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPARCount()
    {
        $assetParData = assetPar::get()->count();
        return ($assetParData);
    }

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
            // 'par_id' => $items[0],
            'name' => $items[1],
            'quantity' => $items[2],
            'unitCost' => $items[3],
            'description' => $items[4],
            'assignedTo' => $items[5],
            'position' => $items[6],
            'asset_id' => $items[7],
            'purchase_order_id' => $items[8]
        ]);


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
}
