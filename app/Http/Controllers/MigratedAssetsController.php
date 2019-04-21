<?php

namespace App\Http\Controllers;

use App\migratedAssets;
use Illuminate\Http\Request;

class MigratedAssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $migratedAssets = migratedAssets::all();
        return view('assets.data_capturing.officeAssets.index', compact('migratedAssets'));
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
        $input = $request->all();

        // dd($input['signatoryName']);
        $inputMigration = migratedAssets::create([
            'item'=>$input['item'],
            'quantity'=>$input['itemQty'],
            'unit_cost'=>$input['unitCost'],
            'classification_no'=>$input['classificationNo'],
            'date_assigned'=>$input['dateAssigned'],
            'total_amount'=>$input['totalAmount'],
            'asset_type_id'=>$input['assetType'],
            'signatory_name'=>$input['signatoryName'],
            'position'=>$input['position']
        ]);

        return redirect()->back()->with('success', 'Item Successfully Migrated');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\migratedAssets  $migratedAssets
     * @return \Illuminate\Http\Response
     */
    public function show(migratedAssets $migratedAssets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\migratedAssets  $migratedAssets
     * @return \Illuminate\Http\Response
     */
    public function edit(migratedAssets $migratedAssets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\migratedAssets  $migratedAssets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, migratedAssets $migratedAssets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\migratedAssets  $migratedAssets
     * @return \Illuminate\Http\Response
     */
    public function destroy(migratedAssets $migratedAssets)
    {
        //
    }
}
