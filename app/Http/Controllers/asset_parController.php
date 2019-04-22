<?php

namespace App\Http\Controllers;

use App\asset;
use App\asset_par;

use Illuminate\Http\Request;

class asset_parController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $id)
    {
        $asset_parData = asset_par::get()->count();
        // dd($id->all());
        $parData = asset::where('purchase_order_id', $id->id)->where('isPAR', 1)->get();
        // dd($parData);
        return view('assets.par.index', compact('parData', 'asset_parData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPARCount()
    {
        $asset_parData = asset_par::get()->count();
        return ($asset_parData);
    }
    
    public function create()
    {
        // dd('tang ina mo');
        
        // dd($id->all());
        $parData = asset::where('purchase_order_id', 2)->where('isPAR', 1)->get();
        // dd($parData);
        return view('assets.par.create', compact('parData', 'asset_parData'));
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
        asset_par::create([
            // 'par_id' => $items[0],
            'name' => $items[1],
            'quantity' => $items[2],
            'unitCost' => $items[3],
            'description' => $items[4],
            'assignedTo' => $items[5],
            'position' => $items[6]
            // 'amount' => $items[7]
        ]);


        if ($request->isMethod('post')) {
            // return response()->json(['response' => 'This is post method', 'error' => false]);
            return response()->json(['response' => 'Save Success', 'error' => false]);
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
