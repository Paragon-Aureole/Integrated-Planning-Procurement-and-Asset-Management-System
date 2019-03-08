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
        if ($user->hasRole('Admin')) {
            $prDT = PurchaseRequest::where('pr_status', '=', 0)->get();
            $ppmp = Ppmp::where('is_active', '=', 1)->get();
        }else{
            $prDT = PurchaseRequest::where('pr_status', '=', 0)->where('office_id' , $user->office_id)->get();
            $ppmp = Ppmp::where('is_active', '=', 1)->where('office_id' , $user->office_id)->get();
        }
        
        return view('pr.addpr',compact('ppmp', 'prDT'));
    }

    /**
     * Display a specific resource.
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function getPpmpData($id)
    {   
        $ppmp = Ppmp::find($id);
        $budget = $ppmp->ppmpBudget->ppmp_rem_budget;
        $requestor = Signatory::where('is_activated', 1)->where('office_id', $ppmp->office_id)->first();
        if ($ppmp->office->office_code == 'ICT') {
            $department = 'ADM';
            $section = 'ICT';
        }else{
            $department = $ppmp->office->office_code;
            $section = "";
        }
        return json_encode([$department, $section, $budget, $requestor ]);
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

        $ppmp = Ppmp::findorFail($input['pr_code']);
        $code = "PR-".$ppmp->office->office_code.'-'.$ppmp->ppmp_year.'-'.sprintf('%02d', Auth::id()).'-'.sprintf('%04d', $ppmp->purchaseRequest->count());

        $add_pr = $ppmp->purchaseRequest()->create([
            'signatory_id' => $input['pr_requestor'],
            'user_id' => Auth::id(),
            'office_id' => $ppmp->office_id,
            'pr_code' => $code,
            'pr_purpose' => $input['pr_purpose'],
            'pr_budget' => str_replace(',', '', $input['pr_budget']),
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
        if ($user->hasRole('Admin')) {
            $prDT = PurchaseRequest::where('pr_status', '=', 0)->get();
           
        }else{
            $prDT = PurchaseRequest::where('pr_status', '=', 0)->where('office_id' , $user->office_id)->get();
        }
        $pr = PurchaseRequest::findorFail($id);
        
        return view('pr.editpr',compact('pr', 'prDT'));
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
        // dd($input);
        $pr = PurchaseRequest::findorFail($id);
        $update_pr = $pr->update([
            'signatory_id' => $input['pr_requestor'],
            'user_id' => Auth::id(),
            'pr_code' =>  $input['pr_code'],
            'pr_purpose' => $input['pr_purpose'],
            'pr_budget' => str_replace(',', '', $input['pr_budget']),
            'supplier_type' => $input['supplier_type'],
            'agency_name' => $input['agency_name'],
            'supplier_id' => $input['supplier_id'],
        ]);

       return redirect()->route('view.pr')->with('success', 'PR Form succesfully updated!');
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewAll()
    {   

        $user = Auth::user();
        $prDT = PurchaseRequest::where('pr_status', '=', 0)->get();
        return view('pr.closepr',compact('prDT'));
    }
    /**
     * Display a listing of the resource.
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
     * Remove the specified resource from storage.
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
