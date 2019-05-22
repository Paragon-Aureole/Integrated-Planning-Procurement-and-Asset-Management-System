<?php

namespace App\Http\Controllers;

use App\MigratedIcsAssets;
use App\migratedAssets;
use App\Office;
use App\assetType;
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
                'office_id' => $input['office_id'][$i],
                'amount' => $input['amount_ics'][$i],
            ];
            
            // dd($data);
            MigratedIcsAssets::create($data);
        }

        return redirect()->route('migrateAssets.index')->with('success', 'Item Successfully Migrated');
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
    public function edit($id)
    {
        $data = migratedIcsAssets::findorFail($id);
        $migratedAssets = migratedAssets::all();
        $migratedIcsAssets = migratedIcsAssets::all();
        $office = Office::all();
        $assetType = assetType::all();

        // dd($data->id);

        return view('assets.data_capturing.officeAssets.editCapturedIcsAssets', compact('data', 'migratedAssets', 'migratedIcsAssets', 'office', 'assetType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MigratedIcsAssets  $migratedIcsAssets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //    dd($request->all());
        $input = $request->all();
        // dd($input);
    // dd($input);
    // for($i=0; $i < count($input['amount']); $i++) {
        $update = migratedIcsAssets::findorFail($id);
        
       $update_all =  $update->update([ 
            'classification' => $input['classification_ics'],
            'asset_type_id' => $input['asset_type_id_ics'],
            'receiver_name' => $input['receiver_name'],
            'receiver_position' => $input['receiver_position'],
            'issuer_name' => $input['issuer_name'],
            'issuer_position' => $input['issuer_position'],
            'item_quantity' => $input['item_quantity'],
            'item_unit' => $input['item_unit'],
            'inventory_item_number' => $input['inventory_item_number'],
            'estimated_useful_life' => $input['estimated_useful_life'],
            'ics_number' => $input['ics_number'],
            'description' => $input['description'],
            'office_id' => $input['office_id'],
            'amount' => $input['amount_ics'],
        ]);
    // };

     return redirect()->back()->with('success', 'Item Successfully Updated');
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
        return redirect()->back()->with('error','A Captured item from ICS has been removed.');
    }

    public function print($ics_number, $office, $name ,$position)
    {
        $IcsData = migratedIcsAssets::where('ics_number', $ics_number)->where('office_id', $office)->where('receiver_name', $name)->where('receiver_position', $position)->get();
        // dd($IcsData);

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

    // NEW
    public function viewCapturedIcs($ics_number, $office, $name ,$position)
    {
        $data = migratedIcsAssets::where('ics_number', $ics_number)->where('office_id', $office)->where('receiver_name', $name)->where('receiver_position', $position)->get();
        // dd($data);

        return view('assets.data_capturing.officeAssets.viewCapturedIcs', compact('data'));
    }

    public function destroyIcs($ics_number, $office, $name, $position)
    {
        $data = migratedIcsAssets::where('ics_number', $ics_number)->where('office_id', $office)->where('receiver_name', $name)->where('receiver_position', $position)->get();

        foreach ($data as $key => $value) {
            $capturedIcs = MigratedIcsAssets::destroy($value->id);
        }

        return redirect()->back()->with('error','A Captured ICS has been removed.');
    }
}
