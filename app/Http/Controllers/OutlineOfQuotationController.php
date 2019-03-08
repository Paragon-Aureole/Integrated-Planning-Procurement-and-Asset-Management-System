<?php

namespace App\Http\Controllers;

use App\OutlineOfQuotation;
use Illuminate\Http\Request;

class OutlineOfQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('abstract.addAbstract');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OutlineOfQuotation  $outlineOfQuotation
     * @return \Illuminate\Http\Response
     */
    public function show(OutlineOfQuotation $outlineOfQuotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OutlineOfQuotation  $outlineOfQuotation
     * @return \Illuminate\Http\Response
     */
    public function edit(OutlineOfQuotation $outlineOfQuotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OutlineOfQuotation  $outlineOfQuotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutlineOfQuotation $outlineOfQuotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OutlineOfQuotation  $outlineOfQuotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutlineOfQuotation $outlineOfQuotation)
    {
        //
    }
}
