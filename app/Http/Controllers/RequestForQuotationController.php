<?php

namespace App\Http\Controllers;

use App\RequestForQuotation;
use Illuminate\Http\Request;

class RequestForQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rfq.addrfq');
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
     * @param  int $rfq_id
     * @return \Illuminate\Http\Response
     */
    public function show($rfq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestForQuotation  $requestForQuotation
     * @return \Illuminate\Http\Response
     */
    public function edit($rfq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $rfq_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rfq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $rfq_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rfq)
    {
        //
    }
}
