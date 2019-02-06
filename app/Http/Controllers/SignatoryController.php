<?php

namespace App\Http\Controllers;

use App\Signatory;
use App\Office;
use App\Http\Requests\SignatoryRequest;

class SignatoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $signatories = Signatory::all();
        $offices = Office::all();
        return view('signatories.addsignatory', compact('offices','signatories'));
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
     * @param  App\Http\Requests\SignatoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SignatoryRequest $request)
    {
        $input = $request->all();
        $aignatory = Signatory::create([
            "signatory_name" => $input['signatory_name'],
            "signatory_position" => $input['signatory_position'],
            "office_id" => $input['office'],
            "category" => $input['category'],
        ]);
        return redirect()->back()->with('success', 'A Signatory has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Http\Requests\SignatoryRequest  $signatory
     * @return \Illuminate\Http\Response
     */
    public function show(Signatory $signatory)
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
        $signatories = Signatory::all();
        $offices = Office::all();
        $edit_signatory = Signatory::findorFail($id);
        return view('signatories.updatesignatory', compact('signatories', 'offices', 'edit_signatory'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\SignatoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SignatoryRequest $request, $id)
    {
        $input = $request->all();
        $signatory = Signatory::findorFail($id);
        $signatory->update([
            "signatory_name" => $input['signatory_name'],
            "signatory_position" => $input['signatory_position'],
            "office_id" => $input['office'],
            "category" => $input['category'],
        ]);

        return redirect()->route('view.signatories')->with('success', 'The Signatory has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Signatory::destroy($id);
        return redirect()->back()->with('info', 'A signatory has been deleted.');
    }
}
