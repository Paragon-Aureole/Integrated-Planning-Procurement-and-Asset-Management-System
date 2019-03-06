<?php

namespace App\Http\Controllers;

use App\PurchaseRequest;
use App\Ppmp;
use App\Distributor;
use App\Signatory;
use App\Http\Requests\PurchaseRequestRequest;
use Auth;
use PDF;

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
