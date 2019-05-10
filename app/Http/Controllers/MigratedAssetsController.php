<?php

namespace App\Http\Controllers;

use App\migratedAssets;
use App\migratedIcsAssets;
use App\Office;
use App\assetType;
use Illuminate\Http\Request;
use PDF;

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
        $migratedIcsAssets = migratedIcsAssets::all();
        $office = Office::all();
        $assetType = assetType::all();
        return view('assets.data_capturing.officeAssets.index', compact('migratedAssets', 'migratedIcsAssets', 'office', 'assetType'));
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
        $input = $request->except(['_token','_method']);
        // dd($input);
        for($i=0; $i < count($input['amount']); $i++) {
            
            $data = [ 
                'asset_type_id' => $input['asset_type_id'][$i],
                'classification' => $input['classification'][$i],
                'entity_name' => $input['entity_name'][$i],
                'fund_cluster' => $input['fund_cluster'][$i],
                'receiver_name' => $input['receiver_name'][$i],
                'receiver_position' => $input['receiver_position'][$i],
                'issuer_name' => $input['issuer_name'][$i],
                'issuer_position' => $input['issuer_position'][$i],
                'item_quantity' => $input['item_quantity'][$i],
                'item_unit' => $input['item_unit'][$i],
                'property_number' => $input['property_number'][$i],
                'date_acquired' => $input['date_acquired'][$i],
                'unit_cost' => $input['unit_cost'][$i],
                'amount' => $input['amount'][$i],
                'description' => $input['description'][$i],
                'par_number' => $input['par_number'][$i],
            ];
            
            // dd($data);
        migratedAssets::create($data);
        }

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
    public function destroy($id)
    {
        $capturedPar = migratedAssets::destroy($id);
        return redirect()->back()->with('error','A Captured PAR has been removed.');
    }

    public function printMigratedAssets($office_id, $asset_type_id) 
    {
        $migratedAssetsFirst = migratedAssets::where('asset_type_id', $asset_type_id)
        ->where('office_id', $office_id)
        ->take(1)->get();

        $migratedAssets = migratedAssets::where('asset_type_id', $asset_type_id)
        ->where('office_id', $office_id)
        ->get();
        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        $pdf = PDF::loadView('assets.data_capturing.officeAssets.printMigratedAssets', compact('migratedAssets', 'migratedAssetsFirst'))->setPaper('Folio', 'landscape');
        return $pdf->stream('migrated_assets.pdf');
    }
}
