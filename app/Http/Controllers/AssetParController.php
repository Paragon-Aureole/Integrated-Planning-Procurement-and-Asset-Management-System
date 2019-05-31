<?php

namespace App\Http\Controllers;

use App\asset;
use App\assetPar;
use App\AssetParItem;

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

        $assetPar = asset::select('purchase_order_id')->distinct()->where('isPAR', 1)->where('item_stock', '<>', 0)->get();
        // dd($assetPar);
        $distributedAssetPar = assetPar::all();
        // dd($assetPar);

        // $asset = asset::where('isPAR', 1)->where('isAssigned', 0)->get();
        // $assetPar = assetPar::All();
        // dd($asset);
        // return view('assets.par.index', compact('asset', 'assetPar'));
        return view('assets.par.index', compact('assetPar', 'distributedAssetPar'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function getPARData()
    // {
    //     $assetParData = assetPar::All();
    //     return ($assetParData);
    // }
    
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
        $items = $request->all();
        // dd($items);

        $newAssetPar = assetPar::create([
            'purchase_order_id' => $items['po_number'],
            'assignedTo' => $items['signatory'],
            'position' => $items['position']
        ]);

        // dd($newAssetPar);

        $filteredData = [];

        
        foreach ($items['itemQuantity'] as $key => $value) {
            if ($value != 0) {
                for ($i=0; $i < $value; $i++) {
                    $filteredData[$key][] = [
                        'itemPropertyNo' => $items['itemPropertyNo'][$key][$i],
                        'itemDateAcquired' => $items['itemDateAcquired'][$key],
                        'itemExtraDescription' => $items['itemExtraDescription'][$key][$i],
                        'itemStatus' => 0,
                        'quantity' => 1,
                        'asset_par_id' => $newAssetPar->id
                        // 'asset_id' => $key
                        ];
                }
            }
        }
        
        // dd($filteredData);
        if (count($filteredData) > 0) {
            foreach ($filteredData as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    AssetParItem::create([
                         'asset_par_id' => $value2['asset_par_id'],
                         'asset_id' => $key,
                         'description' => $value2['itemExtraDescription'],
                         'date_acquired' => $value2['itemDateAcquired'],
                         'itemStatus' => 0,
                         'quantity' => 1,
                         'property_no' => $value2['itemPropertyNo']
                     ]);
    
                    // echo $key;
                    // print_r($value2['asset_par_id']);
                    // echo "<br>";
                }
            }
            
            foreach ($items['itemQuantity'] as $key => $value) {
                if ($value != 0) {
                    asset::find($key)->decrement('item_stock', $value);
                }
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Transaction!');
        }

        // die();


        return redirect()->route('parDistribution.index')->with('success', 'PAR Distribution Complete. Proceed to Printing');

        // if ($request->isMethod('post')) {
        //     // return response()->json(['response' => 'This is post method', 'error' => false]);
        //     return response()->json(['response' => 'Save Success', 'error' => false, 'data' => $items]);
        // } else {
        //     return response()->json(['response' => 'failure']);
        // }
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
            return redirect()->route('parDistribution.index')->with('error', 'No PAR items left in this PO!');
        }

        // dd($signatoryData);
        
        return view('assets.par.parTransaction', compact('assetParItems', 'id', 'parCount'));
    }

    
}
