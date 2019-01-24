<?php

namespace App\Http\Controllers;

use App\MeasurementUnit;
use App\Http\Requests\MeasurementUnitRequest;
use Illuminate\Http\Request;

class MeasurementUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:Admin','permission:full control']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $units_DT = MeasurementUnit::all();
       return view('units.addunit', compact('units_DT'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeasurementUnitRequest $request)
    {   
        $input = $request->all();
        $units = MeasurementUnit::create([
            "unit_code" => $input['unit_code'],
            "unit_description" => $input['unit_description'],
        ]);

        return redirect()->back()->with('success', 'A new unit of measurement has been added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $units_DT = MeasurementUnit::all();
        $unit_data = MeasurementUnit::findorFail($id);
        return view('units.updateunit', compact('units_DT', 'unit_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MeasurementUnitRequest $request, $id)
    {

        $input = $request->all();
        $unit = MeasurementUnit::findorFail($id);
        $unit->update([
            "unit_code" => $input['unit_code'],
            "unit_description" => $input['unit_description'],
        ]);

        return redirect()->back()->with('success', 'A unit of measurement has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = MeasurementUnit::destroy($id);
        return redirect()->route('view.units')->with('info', 'Unit of measurement deleted.');  
    }
}
