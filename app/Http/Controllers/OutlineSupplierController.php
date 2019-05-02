<?php

namespace App\Http\Controllers;

use App\OutlineSupplier;
use App\OutlineOfQuotation;
use App\OutlineItemPrice;
use App\Office;
use Illuminate\Http\Request;
use Auth;

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
        // $count = sizeof($input['pr_item_id']);

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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($supplier)
    {
        $supplier_data = OutlineSupplier::find($supplier);
        $items = $supplier_data->outlinePrice()->with('prItem.ppmpItem.measurementUnit')->get();

        // dd([$supplier, $gso]);
        return response()->json([$supplier_data, $items]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $supplier)
    {
        $input = $request->all();
        // dd($input);

        $supplier = OutlineSupplier::findorFail($supplier);

        $add_supplier = $supplier->update([
            'supplier_name' => $input['supplier_name2'],
            'supplier_address' => $input['supplier_address2'],
            'canvasser_name' => $input['canvasser_name2'],
            'canvasser_office' => $input['canvasser_dept2']
        ]);
        
        foreach ($input['item_id'] as $key => $id) {
            $price = OutlineItemPrice::find($input['item_id'][$key]);
            $update_price = $price->update([
                'final_cpu' => $input['unit_price2'][$key],
                'final_cpi' => $input['item_price2'][$key]
            ]);
        }

        activity('Abstract of Quotation - Suppliers')
        ->performedOn($supplier)
        ->withProperties(['Reason' => $input['s_reason']])
        ->causedBy(Auth::user())
        ->log('Updated Supplier '. $input['supplier_name2']);

        return redirect()->back()->with('success', 'Supplier Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $outlineSupplier
     * @return \Illuminate\Http\Response
     */
    public function destroySupplier($supplier)
    {
        $supplier_log = OutlineSupplier::find($supplier);
        $supplier_log->delete();

        activity('Abstract of Quotation - Suppliers')
        ->performedOn($supplier_log)
        ->causedBy(Auth::user())
        ->log('Deleted Supplier ');

        return redirect()->back()->with('info', 'Supplier Deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OutlineSupplier  $outlineSupplier
     * @return \Illuminate\Http\Response
     */
    public function deleteSupplier(Request $request, $supplier)
    {
        $input = $request->all();
        $supplier_log = OutlineSupplier::find($supplier);
        $supplier_log->delete();


        activity('Abstract of Quotation - Suppliers')
        ->performedOn($supplier_log)
        ->withProperties(['Reason' => $input['del_reason']])
        ->causedBy(Auth::user())
        ->log('Deleted Supplier '. $input['sName']);

        return redirect()->back()->with('info', 'Supplier Deleted');
    }
}
