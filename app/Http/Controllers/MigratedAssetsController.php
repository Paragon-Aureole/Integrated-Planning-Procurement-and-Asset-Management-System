<?php

namespace App\Http\Controllers;

use App\migratedAssets;
use App\migratedVehicles;
use App\Office;
use App\assetType;
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
        $office = Office::all();
        $assetType = assetType::all();
        return view('assets.data_capturing.officeAssets.index', compact('migratedAssets', 'office', 'assetType'));
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

        // dd($input);
        $inputMigration = migratedAssets::create([
            'name_of_accountable'=>$input['name_of_accountable'],
            'official_designation'=>$input['official_designation'],
            'lgu'=>$input['lgu'],
            'article'=>$input['article'],
            'office_id'=>$input['office_id'],
            'description'=>$input['description'],
            'property_number'=>$input['property_number'],
            'unit_of_measure'=>$input['unit_of_measure'],
            'unit_value'=>$input['unit_value'],
            'balance_per_card'=>$input['balance_per_card'],
            'on_hand_per_count'=>$input['on_hand_per_count'],
            'shortage_overage'=>$input['shortage_overage'],
            'date_purchase'=>$input['date_purchase'],
            'status'=>$input['status'],
            'remarks'=>$input['remarks'],
            'asset_type_id'=>$input['asset_type_officeAsset'],
        ]);

        return redirect()->back()->with('success', 'Item Successfully Migrated');
    }

    public function migrationDatatable(Request $request) 
    {
        $migratedAssets = migratedAssets::where('office_id', $request->all())->get();
        $migratedVehicles = migratedVehicles::where('office_id', $request->all())->get();
        // $migratedAssets = migratedAssets::all();
        return response()->json(['migratedAssets'=>$migratedAssets, 'migratedVehicles'=>$migratedVehicles]);
    }

    public function validateAssetType(Request $request) 
    {
        $migratedAssets = migratedAssets::where('asset_type_id', $request->asset_type_id)
        ->where('office_id', $request->office_id)
        ->get();
        $office = Office::all();
        return response()->json(['migratedAssets'=>$migratedAssets, 'office'=>$office]);
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
