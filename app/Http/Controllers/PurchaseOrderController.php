<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\PurchaseRequest;
use App\OutlineSupplier;
use App\OutlineOfQuotation;
use App\ProcurementMode;
use App\asset;
use Auth;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pr = PurchaseRequest::where('office_id', Auth::user()->office_id)
        ->where('pr_status', 1)
        ->where('created_rfq', 1)
        ->where('created_abstract', 1)
        ->get();

        // foreach ($pr as $prKey => $prValue) {
            // $oq = OutlineOfQuotation::where('purchase_request_id', $prValue->id)->get();
        // }
            // $oq = OutlineOfQuotation::all();
        
        // foreach ($oq as $oqKey => $oqValue) {
        //     $os = OutlineSupplier::where('outline_of_quotation_id', $oqValue->id)->get();
        // }     
        // $os = OutlineSupplier::all();
        
        $prMode = ProcurementMode::all();

        $po = PurchaseOrder::whereHas('purchaseRequest', function ($query){
            $query->where('office_id',  Auth::user()->office_id );
        })->get(); 

        // return $pr;
        return view('purchase_order.addPo', compact('pr','po','prMode'));
    }

    public function getModalData(Request $request) 
    {
        $pr_id = $request->input('pr_id');

        $pr = PurchaseRequest::find($pr_id);
        $abstract = $pr->outlineQuotation->outlineSupplier->where('supplier_status', TRUE)->first();
        return response()->json(['abstract'=>$abstract, 'pr'=>$pr]);
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
        
        $pr = PurchaseRequest::findorFail($input['pr_id']);
        $pr->created_po = 1;
        $pr->save();

        $po = PurchaseOrder::create([
            'purchase_request_id' => $input['pr_id'],
            'user_id' => Auth::user()->id,
            'outline_supplier_id' => $input['outline_supplier_id'],
            'supplier_tin' => $input['tinNumber'],
            'procurement_mode_id' => $input['modeOfProcurement'],
            'delivery_place' => $input['placeOfDelivery'],
            'delivery_date' => $input['dateOfDelivery'],
            'delivery_term' => $input['deliveryTerm'],
            'payment_term' => $input['paymentTerm'],
        ]);

        $items = $po->outlineSupplier->outlinePrice()->get();
        foreach ($items as $key => $poItems) {
            $asset = asset::create([
            'details' => $poItems->prItem->ppmpItem->item_description,
            'amount' => $poItems->final_cpi,
            'item_quantity'=>$poItems->prItem->item_quantity,
            ]);
            $po->asset()->save($asset);
        }
        

        // 
        // $pr->purchaseOrder()->save($po);

        
        return redirect()->back()->with('success', 'Purchase Order Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }
}
