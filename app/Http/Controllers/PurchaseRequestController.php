<?php

namespace App\Http\Controllers;

use App\PurchaseRequest;
use App\Ppmp;
use App\Distributor;
use App\Signatory;
use App\Http\Requests\PurchaseRequestRequest;
use Auth;
use PDF;
use Carbon\Carbon;

class PurchaseRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $user = Auth::user();
        $prDT = PurchaseRequest::where('office_id' , $user->office_id)->get();
        // $ppmp = Ppmp::where('is_active', '=', 1)->where('office_id' , $user->office_id)->get();
        
        return view('pr.addpr',compact('prDT','user'));
    }


   

    /**
     * Display a specific resource.
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function getDistributorData()
    {   
        $distributor = Distributor::all();
        return json_encode($distributor);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PurchaseRequestRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequestRequest $request)
    {
        $input = $request->all();
        $add_pr = PurchaseRequest::create([
            'signatory_id' => $input['pr_requestor'],
            'user_id' => Auth::id(),
            'office_id' => $input['pr_office'],
            'pr_code' => $input['pr_code'],
            'pr_purpose' => $input['pr_purpose'],
            'pr_budget' => 0.00,
            'supplier_type' => $input['supplier_type'],
            'agency_name' => $input['agency_name'],
            'supplier_id' => $input['supplier_id'],
        ]);

       return redirect()->back()->with('success', 'PR Form succesfully generated, please add items for printing.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $prDT = PurchaseRequest::where('pr_status', '=', 0)->where('office_id' , $user->office_id)->get();
        $pr = PurchaseRequest::findorFail($id);
        return view('pr.editpr',compact('pr', 'prDT', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PurchaseRequestRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequestRequest $request, $id)
    {
        $input = $request->all();
        $pr = PurchaseRequest::findorFail($id);
        $update_pr = $pr->update([
            'signatory_id' => $input['pr_requestor'],
            'user_id' => Auth::id(),
            'office_id' => $input['pr_office'],
            'pr_code' => $input['pr_code'],
            'pr_purpose' => $input['pr_purpose'],
            'pr_budget' => 0.00,
            'supplier_type' => $input['supplier_type'],
            'agency_name' => $input['agency_name'],
            'supplier_id' => $input['supplier_id'],
        ]);

       return redirect()->route('pr.index')->with('success', 'PR Form succesfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pr = PurchaseRequest::findorFail($id);
        $pr->delete();
        return redirect()->route('view.pr')->with('info', 'PR Cancelled');
    }
    /**
     * Print the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function printPurchaseRequest($id)
    {

        $pr = PurchaseRequest::findorFail($id);
        $date   = Carbon::parse($pr->created_at);
        $created_code = Auth::user()->office->office_code."/".Auth::user()->wholename."/".$date->Format('F j, Y')."/".$date->format("g:i:s A")."/"."BAC"."/".$pr->pr_code;
        
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

        $pdf = PDF::loadView('pr.printpr', compact('pr','date'));

        foreach ($options as $margin => $value) {
            $pdf->setOption($margin, $value);
        }
        return $pdf->stream($pr->pr_code.'.pdf');
    }


    public function prView()
    {
        $prDT = PurchaseRequest::where('pr_status', 0)->whereHas('prItem')->get();      

        return view('pr.closepr', compact('prDT'));
    }

    /**
     * Display archives.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {   

        $user = Auth::user();
        if ($user->hasRole('Admin')) {
            $prDT = PurchaseRequest::where('pr_status', '=', 1)->get();
            // $ppmp = Ppmp::where('is_active', '=', 1)->get();
        }else{
            $prDT = PurchaseRequest::where('pr_status', '=', 1)->where('office_id' , $user->office_id)->get();
            // $ppmp = Ppmp::where('is_active', '=', 1)->where('office_id' , $user->office_id)->get();
        }
        
        return view('pr.archivepr',compact('prDT'));
    }

    /**
     * Close Purchae Request.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function closePurchaseRequest($id)
    {
       $pr = PurchaseRequest::findorFail($id);
       $pr->update(['pr_status' => 1]);
       return redirect()->back()->with('success', 'PR Approved');
    }

}
