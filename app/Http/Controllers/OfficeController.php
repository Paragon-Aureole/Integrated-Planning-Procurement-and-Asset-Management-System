<?php

namespace App\Http\Controllers;

use App\Office;
use App\Http\Requests\OfficeRequest;

class OfficeController extends Controller
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
        $officeDT = Office::all();
        return view('offices.add',compact('officeDT'));
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
     * @param  App\Http\Requests\OfficeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficeRequest $request)
    {   
        $input = $request->all();
        $office = Office::create([
            "office_code" => $input['office_code'],
            "office_name" => $input['office_name'],
            "category" => $input['category'],
        ]);

        return redirect()->back()->with('success', 'A new office has been added.'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
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
        $officeDT = Office::all();
        $office_data = Office::findOrFail($id);
        return view('offices.update', compact('officeDT', 'office_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\OfficeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfficeRequest $request, $id)
    {
        $input = $request->all();
        $office = Office::findorFail($id);
        $office->update([
            'office_name' => $input['office_name'],
            'office_code' => $input['office_code'],
            'category' => $input['category'],
        ]);

        return redirect()->back()->with('success','Office details updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $office = Office::destroy($id);
        return redirect()->route('view.office')->with('error','An Office has been removed.');
    }
}
