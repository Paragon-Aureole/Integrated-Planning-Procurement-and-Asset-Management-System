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
        // dd($input);
        $abstract = OutlineofQuotation::findorFail($input['abstract_id']);
        $count = sizeof($input['pr_item_id']);

        $add_supplier = $abstract->outlineSupplier()->create([
            'supplier_name' => $input['supplier_name'],
            'supplier_address' => $input['supplier_address'],
            'canvasser_name' => $input['canvasser_name'],
            'canvasser_office' => $input['canvasser_dept']
        ]);
        // dd($add_supplier->id);
        $supplier = OutlineSupplier::findorFail($add_supplier->id);
        foreach ($input['pr_item_id'] as $key => $prid) {
            $add_price = $supplier->outlinePrice()->create([
                'pr_item_id' => $input['pr_item_id'][$key],
                'final_cpu' => $input['unit_price'][$key],
                'final_cpi' => $input['item_price'][$key]
            ]);
        }

        return redirect()->back()->with('success', 'Supplier Added');

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        dd($input);
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
