<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\PurchaseRequest;
use App\OutlineSupplier;
use App\OutlineOfQuotation;
use App\ProcurementMode;
use App\Signatory;
use App\asset;
use App\Ppmp;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

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
            'user_id' => Auth::user()->id,
            'outline_supplier_id' => $input['outline_supplier_id'],
            'supplier_tin' => $input['tinNumber'],
            'procurement_mode_id' => $input['modeOfProcurement'],
            'delivery_place' => $input['placeOfDelivery'],
            'delivery_date' => $input['dateOfDelivery'],
            'delivery_term' => $input['deliveryTerm'],
            'payment_term' => $input['paymentTerm'],
        ]);

        $ppmp = Ppmp::where('ppmp_year', Carbon::parse($po->created_at)->Format('Y'))->first();
        $budget = $ppmp->ppmpBudget->ppmp_est_budget - $po->outlineSupplier->outlinePrice()->sum('final_cpi');
        $update_budget = $ppmp->ppmpBudget->update([
            'ppmp_rem_budget' => $budget
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
        
        $pr->purchaseOrder()->save($po);

        
        return redirect()->back()->with('success', 'Purchase Order Created!');
    }

    /**
     * Print Purchase order Form in PDF Format.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printPO($id)
    {
        $signatory = Signatory::where(['category' => 4, 'is_activated'=>TRUE])->firstorFail();
        $purchase_order = PurchaseOrder::findorFail($id);
        if ($purchase_order->purchaseRequest->supplier_type == 2) {
            $query = $purchase_order->purchaseRequest->prItem()->chunk(15);
            $grand_total = 0;
        }else {
            $query = $purchase_order->outlineSupplier->outlinePrice->chunk(15);
            $grand_total = $purchase_order->outlineSupplier->outlinePrice()->sum('final_cpi');
        }
        $date   = Carbon::parse($purchase_order->created_at);
        $created_code = Auth::user()->office->office_code."/".Auth::user()->wholename."/".$date->Format('F j, Y')."/".$date->format("g:i:s A")."/"."BAC"."/".$purchase_order->purchaseRequest->pr_code;
        $options = [
            "footer-right" => "Page [page] of [topage]",
            "footer-font-size" => 6,
            'margin-top'    => 5,
            'margin-right'  => 10,
            'margin-bottom' => 6,
            'margin-left'   => 10,
            'page-size' => 'A4',
            'orientation' => 'landscape',
            "footer-left" => $created_code
        ];

        $pdf = PDF::loadView('purchase_order.printPo',compact('purchase_order', 'date', 'query', 'grand_total', 'signatory'));

        foreach ($options as $margin => $value) {
            $pdf->setOption($margin, $value);
        }

        return $pdf->stream('PO-'.$purchase_order->purchaseRequest->pr_code.'.pdf');
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
