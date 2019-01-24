<?php

namespace App\Http\Controllers;

use App\Signatory;
use App\Office;
use Illuminate\Http\Request;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Signatory  $signatory
     * @return \Illuminate\Http\Response
     */
    public function show(Signatory $signatory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Signatory  $signatory
     * @return \Illuminate\Http\Response
     */
    public function edit(Signatory $signatory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Signatory  $signatory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Signatory $signatory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Signatory  $signatory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signatory $signatory)
    {
        //
    }
}
