<?php

namespace App\Http\Controllers;

use App\AssetParItem;
use App\assetPar;
use App\asset;
use Illuminate\Http\Request;

class AssetParItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asset = asset::where('isPAR', 1)->where('isAssigned', 0)->get();
        $assetPar = assetPar::All();
        // dd($asset);
        return view('assets.par.index', compact('asset', 'assetPar'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssetParItem  $assetParItem
     * @return \Illuminate\Http\Response
     */
    public function show(AssetParItem $assetParItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssetParItem  $assetParItem
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetParItem $assetParItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssetParItem  $assetParItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetParItem $assetParItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssetParItem  $assetParItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetParItem $assetParItem)
    {
        //
    }

        public function getPARCount()
    {
        $assetParCount = assetPar::get()->count();
        return ($assetParCount);
    }
   public function getClassifiedItemQtyNo($id)
    {
        // dd($id);
        $assetClassifiedItemQtyNo = asset::select('item_stock')->where('id', $id)->get();
        return ($assetClassifiedItemQtyNo->first()->item_stock);
    }
    public function setAssetIsAssigned(Request $request)
    {
        asset::whereId($request->asset_id)->update([
                'isAssigned' => 1
            ]);

        return response()->json(['response' => 'Assigning Successful. You may now print.', 'error' => false]);
    }
    public function saveNewPar(Request $request)
    {
        $items = $request->input('data');
        // dd($items);

        assetPar::create([
            'asset_id' => $items[0],
            'quantity' => $items[1],
            'assignedTo' => $items[3],
            'position' => $items[4]
        ]);

        for ($i=0; $i < count($items[2]); $i++) {
            // $bekkel[] = ['id' => $items[0], 'description' => $items[2][$i]];
            
            AssetParItem::create([
                    'asset_par_id' => $items[5],
                    'description' => $items[2][$i],
                    'itemStatus' => 0
                ]);
        }


        asset::find($items[0])->decrement('item_stock', $items[1]);


        if ($request->isMethod('post')) {
            // return response()->json(['response' => 'This is post method', 'error' => false]);
            return response()->json(['response' => 'Save Success', 'error' => false, 'data' => $items]);
        } else {
            return response()->json(['response' => 'failure']);
        }
    }
}
