<?php

namespace App\Http\Controllers;

use App\InspectionReport;
use App\PurchaseRequest;
use App\PurchaseOrder;
use App\OutlineSupplier;
use App\Signatory;
use App\Office;
use Auth;
use Illuminate\Http\Request;

class InspectionReportController extends Controller
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
        ->where('created_po', 1)
        ->get();

        // $oq = OutlineOfQuotation::all();
        $os = OutlineSupplier::all();
        $office = Office::all();
        $po = purchaseOrder::all();
        $signatory = Signatory::all();

        $ir = InspectionReport::whereHas('purchaseRequest', function ($query){
            $query->where('office_id',  Auth::user()->office_id );
        })->get();

        return view('inspection_report.addIr', compact('pr','os','office','po','signatory','ir'));
    }

    public function getModalPoData(Request $request)
    {
        $pr_id = $request->input('pr_id');
        $po = purchaseOrder::where('purchase_request_id', $pr_id)->get();
        $pr = PurchaseRequest::where('id', $pr_id)->get();

        foreach ($po as $poKey => $poValue) {
            $os = OutlineSupplier::where('id', $poValue->outline_supplier_id)->get();
        };

        foreach ($pr as $prKey => $prValue) {
            $office = Office::where('id', $prValue->office_id)->get();
        };

        return response()->json(['prId'=>$pr_id, 'po'=>$po, 'os'=>$os, 'office'=>$office]);
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

        $ir = InspectionReport::create([
            'purchase_request_id' => $input['purchase_request_id'],
            'user_id' => Auth::user()->id,
            'invoice_number' => $input['invoiceNo'],
            'property_officer' => $input['property_officer'],
            'inspection_officer' => $input['inspection_officer'],
        ]);
        $ir->save();

        $pr = PurchaseRequest::findorFail($input['purchase_request_id']);
        $pr->created_inspection = 1;
        $pr->save();

        return redirect()->back()->with('success', 'Inspection Report Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InspectionReport  $inspectionReport
     * @return \Illuminate\Http\Response
     */
    public function show(InspectionReport $inspectionReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InspectionReport  $inspectionReport
     * @return \Illuminate\Http\Response
     */
    public function edit(InspectionReport $inspectionReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InspectionReport  $inspectionReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InspectionReport $inspectionReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InspectionReport  $inspectionReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(InspectionReport $inspectionReport)
    {
        //
    }
}
