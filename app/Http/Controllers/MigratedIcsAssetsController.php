<?php

namespace App\Http\Controllers;

use App\MigratedIcsAssets;
use Illuminate\Http\Request;
use PDF;

class MigratedIcsAssetsController extends Controller
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
        for($i=0; $i < count($input['estimated_useful_life']); $i++) {
            
            $data = [ 
                'classification' => $input['classification_ics'][$i],
                'asset_type_id' => $input['asset_type_id_ics'][$i],
                'receiver_name' => $input['receiver_name'][$i],
                'receiver_position' => $input['receiver_position'][$i],
                'issuer_name' => $input['issuer_name'][$i],
                'issuer_position' => $input['issuer_position'][$i],
                'item_quantity' => $input['item_quantity'][$i],
                'item_unit' => $input['item_unit'][$i],
                'inventory_item_number' => $input['inventory_item_number'][$i],
                'estimated_useful_life' => $input['estimated_useful_life'][$i],
                'description' => $input['description'][$i],
                'ics_number' => $input['ics_number'][$i],
            ];
            
            // dd($data);
            MigratedIcsAssets::create($data);
        }

        return redirect()->back()->with('success', 'Item Successfully Migrated');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MigratedIcsAssets  $migratedIcsAssets
     * @return \Illuminate\Http\Response
     */
    public function show(MigratedIcsAssets $migratedIcsAssets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MigratedIcsAssets  $migratedIcsAssets
     * @return \Illuminate\Http\Response
     */
    public function edit(MigratedIcsAssets $migratedIcsAssets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MigratedIcsAssets  $migratedIcsAssets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MigratedIcsAssets $migratedIcsAssets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MigratedIcsAssets  $migratedIcsAssets
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $capturedIcs = MigratedIcsAssets::destroy($id);
        return redirect()->back()->with('error','A Captured ICS has been removed.');
    }

    public function print($id)
    {
        $IcsData = MigratedIcsAssets::findorFail($id);
        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];
        // dd($IcslipData);
        $pdf = PDF::loadView('assets.data_capturing.officeAssets.printIcsAssets', compact('IcsData'))->setPaper('A4', 'portrait');
        return $pdf->stream('ICS-Migrated.pdf');
    }
}
