<?php

namespace App\Http\Controllers;

use App\OutlineSupplier;
use App\OutlineOfQuotation;
use Illuminate\Http\Request;

class OutlineSupplierController extends Controller
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
        $input = $request->all();
        dd($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $abstract = OutlineofQuotation::findorFail($id);
        $pr_items = $abstract->purchaseRequest->prItem->all();
        // dd($pr_items);
        return view('abstract.addSupplier', compact('abstract','pr_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OutlineSupplier  $outlineSupplier
     * @return \Illuminate\Http\Response
     */
    public function edit(OutlineSupplier $outlineSupplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OutlineSupplier  $outlineSupplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutlineSupplier $outlineSupplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OutlineSupplier  $outlineSupplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutlineSupplier $outlineSupplier)
    {
        //
    }
}
