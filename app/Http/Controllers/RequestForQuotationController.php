<?php

namespace App\Http\Controllers;

use App\RequestForQuotation;
use App\PurchaseRequest;
use App\Distributor;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class RequestForQuotationController extends Controller
{
    /**
     * Display all closed Purchase Request that are not government suppliers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $pr = PurchaseRequest::where('pr_status', 1)
            ->where('created_rfq', 0)
            ->get();
            
            $rfq = RequestForQuotation::all();

        }else{
            $pr = PurchaseRequest::where('office_id', Auth::user()->office_id)
                ->where('pr_status', 1)
                ->where('created_rfq', 0)
                ->get();

            $rfq = RequestForQuotation::whereHas('purchaseRequest', function ($query){
                    $query->where('office_id',  Auth::user()->office_id );
            })->get();
        }
        
         

        // dd($rfq);
 
        return view('rfq.addrfq', compact('pr','rfq'));
    }

    /**
     * Create RFQ.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createRFQ($id)
    {
        $pr = PurchaseRequest::findorFail($id);
        $pr->created_rfq = 1;
        $pr->save();

        $rfq = RequestForQuotation::create([
            'user_id' => Auth::user()->id,
        ]);

        $pr->rfq()->save($rfq);

        activity('RFQ')
        ->performedOn($rfq)
        ->causedBy(Auth::user())
        ->log('Create RFQ Form '. $pr->pr_code);

        return redirect()->back()->with('success', 'RFQ Created');
    }

    /**
     * Print RFQ Form in PDF Format.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printRFQ($id)
    {
        // dd($id);
        $rfq = RequestForQuotation::findorFail($id);
        // dd($rfq->purchaseRequest->distributor);
        $date   = Carbon::parse($rfq->created_at);
        $created_code = Auth::user()->office->office_code."/".Auth::user()->wholename."/".$date->Format('F j, Y')."/".$date->format("g:i:s A")."/"."BAC"."/".$rfq->purchaseRequest->pr_code;
        // dd($rfq.$date.$created_code);
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

        $pdf = PDF::loadView('rfq.printrfq', compact('rfq','date'));

        foreach ($options as $margin => $value) {
            $pdf->setOption($margin, $value);
        }

        activity('RFQ')
        ->performedOn($rfq)
        ->causedBy(Auth::user())
        ->log('Print RFQ Form '. $rfq->code);


        return $pdf->stream('RFQ-'.$rfq->purchaseRequest->pr_code.'.pdf');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $rfq_id
     * @return \Illuminate\Http\Response
     */
    public function cancelRfq($rfq)
    {
        $rfq = RequestForQuotation::findorFail($rfq);
        $update_pr = $rfq->purchaseRequest->update(['created_rfq' => 0]);
        $rfq->delete();

        activity('RFQ')
        ->performedOn($rfq)
        ->causedBy(Auth::user())
        ->log('Delete RFQ Form '. $rfq->purchaseRequest->code);

        return redirect()->route('rfq.index')->with('info', 'Request for Quotation form cancelled');
        // $delete_rfq = RequestForQuotation::destroy($id);
    }
}
