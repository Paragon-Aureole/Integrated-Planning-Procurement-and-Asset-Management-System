<?php

namespace App\Http\Controllers;

use App\InspectionReport;
use App\PurchaseRequest;
use App\PurchaseOrder;
use App\OutlineSupplier;
use App\Signatory;
use App\Office;
use Carbon\Carbon;
use PDF;
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
        if (Auth::user()->hasRole('Admin')) {
            $pr = PurchaseRequest::where('pr_status', 1)
            ->where('created_rfq', 1)
            ->where('created_abstract', 1)
            ->where('created_po', 1)
            ->get();

            $ir = InspectionReport::all();

        }else{
            $pr = PurchaseRequest::where('office_id', Auth::user()->office_id)
            ->where('pr_status', 1)
            ->where('created_rfq', 1)
            ->where('created_abstract', 1)
            ->where('created_po', 1)
            ->get();

            $ir = InspectionReport::whereHas('purchaseRequest', function ($query){
                $query->where('office_id',  Auth::user()->office_id );
            })->get();
        }

        

        $signatory = Signatory::all();

       

        return view('inspection_report.addIr', compact('pr','signatory','ir'));
    }

    public function getModalPoData(Request $request)
    {
        $pr_id = $request->input('pr_id');
        $pr = PurchaseRequest::find($pr_id);
        $po = $pr->purchaseOrder;
        $user_id = Auth::user()->id;
        return response()->json(['pr' => $pr ,'user_id'=>$user_id,'pr_id'=>$pr_id,'po'=>$po->id, 'supplier_name'=>$po->outlineSupplier->supplier_name, 'office'=>$pr->office->office_name]);
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
            'inspection_officer' => $input['inspection_officer']
        ]);
        // $ir->save();

        $pr = PurchaseRequest::findorFail($input['purchase_request_id']);
        $pr->created_inspection = 1;
        $pr->save();

        activity('AIR/RIS')
        ->performedOn($ir)
        // ->withProperties(['Reason' => $input['s_reason']])
        ->causedBy(Auth::user())
        ->log('Add AIR/RIS '. $pr->pr_code);

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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasRole('Admin')) {
            $ir = InspectionReport::all();
        }else{
            $ir = InspectionReport::whereHas('purchaseRequest', function ($query){
                $query->where('office_id',  Auth::user()->office_id );
            })->get();
        }

        

        $signatory = Signatory::all();
        $air = InspectionReport::findorFail($id);

        return view('inspection_report.editIr', compact('air', 'signatory', 'ir'));
    }

    /**
     * Print the AIR/RIS in PDF Form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printAIR($id)
    {
        $ir = InspectionReport::findorFail($id);
        $date   = Carbon::parse($ir->created_at);
        $created_code = Auth::user()->office->office_code."/".Auth::user()->wholename."/".$date->Format('F j, Y')."/".$date->format("g:i:s A")."/"."BAC"."/".$ir->purchaseRequest->pr_code;
        $options = [
            "footer-right" => "Page [page] of [topage]",
            "footer-font-size" => 6,
            'margin-top'    => 10,
            'margin-right'  => 15,
            'margin-bottom' => 15,
            'margin-left'   => 15,
            'page-size' => 'A4',
            'orientation' => 'portrait',
            "footer-left" => $created_code
        ];

        $pdf = PDF::loadView('inspection_report.printAIR', compact('ir','date','created_code'));

        foreach ($options as $margin => $value) {
            $pdf->setOption($margin, $value);
        }

        activity('AIR/RIS')
        ->performedOn($ir)
        // ->withProperties(['Reason' => $input['s_reason']])
        ->causedBy(Auth::user())
        ->log('Print AIR/RIS '. $ir->purchaseRequest->pr_code);

        return $pdf->stream('AIR-'.$ir->purchaseRequest->pr_code.'.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  \App\InspectionReport  $inspectionReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $air = InspectionReport::findorFail($id);
        $update_air = $air->update([
            'invoice_number' => $input['invoice_number'],
            'property_officer' => $input['property_officer'],
            'inspection_officer' => $input['inspection_officer']
        ]);

        activity('AIR/RIS')
        ->performedOn($air)
        ->withProperties(['Reason' => $input['edit_reason']])
        ->causedBy(Auth::user())
        ->log('Update AIR/RIS '. $air->purchaseRequest->pr_code);

        return redirect()->route('ir.index')->with('success', 'AIR/RIS Details Updated!');
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
