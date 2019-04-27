<?php

namespace App\Http\Controllers;

use App\migratedVehicles;
use App\Office;
use App\assetType;
use Illuminate\Http\Request;

class MigratedVehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function validateAssetTypeVehicle(Request $request) 
    {
        $migratedVehicles = migratedVehicles::where('asset_type_id', $request->asset_type_id)
        ->where('office_id', $request->office_id_vehicle)
        ->get();
        $office = Office::all();
        return response()->json(['migratedVehicles'=>$migratedVehicles, 'office'=>$office]);
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
        $inputMigration = migratedVehicles::create([
            'number'=>$input['number'],
            'asset_type_id'=>$input['asset_type_vehicle'],
            'type_of_vehicle'=>$input['type_of_vehicle'],
            'make'=>$input['make'],
            'plate_number'=>$input['plate_number'],
            'acquisition_date'=>$input['acquisition_date'],
            'acquisition_cost'=>$input['acquisition_cost'],
            'office_id'=>$input['office'],
            'accountable_officer'=>$input['accountable_officer'],
            'status'=>$input['status']
        ]);

        return redirect()->back()->with('success', 'Item Successfully Migrated');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\migratedVehicles  $migratedVehicles
     * @return \Illuminate\Http\Response
     */
    public function show(migratedVehicles $migratedVehicles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\migratedVehicles  $migratedVehicles
     * @return \Illuminate\Http\Response
     */
    public function edit(migratedVehicles $migratedVehicles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\migratedVehicles  $migratedVehicles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, migratedVehicles $migratedVehicles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\migratedVehicles  $migratedVehicles
     * @return \Illuminate\Http\Response
     */
    public function destroy(migratedVehicles $migratedVehicles)
    {
        //
    }
}
