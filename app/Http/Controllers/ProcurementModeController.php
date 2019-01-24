<?php

namespace App\Http\Controllers;

use App\ProcurementMode;
use App\Http\Requests\ProcurementMethodRequest;
use Illuminate\Http\Request;

class ProcurementModeController extends Controller
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
        $pm_dt = ProcurementMode::all();
        return view('procurement_method.addpm', compact('pm_dt'));
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
    public function store(ProcurementMethodRequest $request)
    {
        $input = $request->all();
        $pm_add = ProcurementMode::create([
            'method_name' => strtolower($input['method_name']),
            'method_code' => strtolower($input['method_code']),
        ]);

        return redirect()->back()->with('success', 'A new procurement method has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProcurementMode  $procurementMode
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementMode $procurementMode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pm_dt = ProcurementMode::all();
        $pm_data = ProcurementMode::findorFail($id);
        return view('procurement_method.updatepm', compact('pm_data','pm_dt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProcurementMethodRequest $request, $id)
    {
        $input = $request->all();
        $pm = ProcurementMode::findorFail($id);
        $pm->update([
            'method_name' => strtolower($input['method_name']),
            'method_code' => strtolower($input['method_code']),
        ]);

        return redirect()->route('view.modes')->with('success','Procurement method updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pm = ProcurementMode::destroy($id);
        return redirect()->route('view.modes')->with('error','Procurement method deleted.');
    }
}
