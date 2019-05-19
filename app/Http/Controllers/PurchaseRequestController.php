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

    //status 0-pending, 1-approved, 2-cancel

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $user = Auth::user();
        $pr_count = PurchaseRequest::where('office_id' , $user->office_id)->count();

        if ($user->can('full control')) {
            $prDT = PurchaseRequest::whereYear('created_at', date('Y'))
              ->whereMonth('created_at', date('m'))
              ->where('is_supplemental', 0)
            //   ->orWhere('pr_status', 0)
              ->get();
            // $prDT = PurchaseRequest::all();
        } else {
            $prDT = PurchaseRequest::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->where('is_supplemental', 0)
            ->where('office_id' , $user->office_id)
            // ->where('pr_status', 0)
            ->get();
        }

        return view('pr.addpr',compact('prDT','user','pr_count'));
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
        
        activity('Purchase Request')
        ->performedOn($add_pr)
        ->causedBy(Auth::user())
        ->log('Generated '. $input['pr_code']);

       return redirect()->back()->with('success', 'PR Form generated, please add items for printing.');
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
        if ($user->can('full control')) {
            $prDT = PurchaseRequest::whereYear('created_at', date('Y'))
              ->whereMonth('created_at', date('m'))
              ->where('is_supplemental', 0)
              ->orWhere('pr_status', 0)
              ->get();
        } else {
            $prDT = PurchaseRequest::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->where('is_supplemental', 0)
            ->orWhere('pr_status', 0)
            ->where('office_id' , $user->office_id)
            ->get();
        }

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

        activity('Purchase Request')
        ->performedOn($pr)
        ->causedBy(Auth::user())
        ->withProperties(['Reason' => $input['edit_reason']])
        ->log('Updated '. $input['pr_code']);

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
        $pr->update(['pr_status' => 2]);
        return redirect()->route('pr.index')->with('info', 'PR Cancelled');
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

        activity('Purchase Request')
        ->performedOn($pr)
        ->causedBy(Auth::user())
        ->log('Print RFQ Form '. $pr->code);

        return $pdf->stream($pr->pr_code.'.pdf');
    }


    public function prView()
    {
        // $prDT = PurchaseRequest::where('pr_status', 0)->whereHas('prItem')->get();      
        $prDT = PurchaseRequest::whereYear('created_at', date('Y'))
        ->whereMonth('created_at', date('m'))
        ->whereHas('prItem')
        ->get();     

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

       if($pr->supplier_type == 2){


            $create_abstract = $pr->outlineQuotation()->create([
                'user_id' => Auth::user()->id,
                "outline_comment" => "Sole Distributor(Government Agency)",
                "outline_detail" => "Items"
            ]);

            $add_supplier = $create_abstract->outlineSupplier()->create([
                'supplier_name' => $pr->agency_name,
                'supplier_address' => "-",
                'canvasser_name' => $pr->user->wholename,
                'canvasser_office' => $pr->office_id,
            ]);

            $items = $pr->prItem()->get();
            
            foreach ($items as $key => $price) {
                $add_prices = $add_supplier->outlinePrice()->create([
                    'pr_item_id' => $price->id,
                    'final_cpu' =>  0,
                    'final_cpi' => 0
                ]);
            }
             
            
            $update_pr = $pr->update([
                'pr_status' => 1,
                'created_rfq' => 1,
                'created_abstract' => 1,
            ]);

        
       }else{
        $pr->update(['pr_status' => 1]);
       }
       

       activity('Purchase Request')
        ->performedOn($pr)
        ->causedBy(Auth::user())
        ->log('Closed Purchase Request '. $pr->pr_code);
       
       return redirect()->back()->with('success', 'Purchase Request Closed');
    }

    /**
     * Display all closed Purchase Request that are not government suppliers.
     *
     * @return \Illuminate\Http\Response
     */

    public function viewSupplemental()
    {
        $user = Auth::user();
        if ($user->hasPermissionTo('full control')) {
            $pr = PurchaseRequest::where('pr_status', 1)
                ->where('is_supplemental', 0)
                ->where('created_supplemental', 0)
                ->get();
            $supplemental = PurchaseRequest::where('is_supplemental', 1)->get();

        } else {
            $pr = PurchaseRequest::where('office_id', $user->office_id)
                ->where('pr_status', 1)
                ->where('created_supplemental', 0)
                ->get();

            $supplemental = PurchaseRequest::where('office_id', $user->office_id)->where('is_supplemental', 1)->get();
        }
        
        

        // $rfq = RequestForQuotation::whereHas('purchaseRequest', function ($query){
        //     $query->where('office_id',  Auth::user()->office_id );
        // })->get(); 

        // dd($rfq);
 
        return view('pr.supplementalPr', compact('pr','supplemental'));
    }


    /**
     * Add Supplemental Purchase Request.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function addSupplemental($id)
    {
        $pr = PurchaseRequest::findorFail($id);
        $pr->update(['created_supplemental' => 1]);

        $supplemental  = PurchaseRequest::create([
            'signatory_id' => $pr->signatory_id,
            'user_id' => Auth::id(),
            'office_id' => $pr->office_id,
            'pr_code' => $pr->pr_code . "-01",
            'pr_purpose' => $pr->pr_purpose,
            'pr_budget' => 0.00,
            'supplier_type' => $pr->supplier_type,
            'agency_name' => $pr->agency_name,
            'supplier_id' => $pr->supplier_id,
            'is_supplemental' => 1,
            'former_pr_id' => $pr->id,
        ]);

       activity('Purchase Request')
        ->performedOn($supplemental)
        ->causedBy(Auth::user())
        ->log('Created Supplemental Purchase Request '. $supplemental->pr_code);
       
       return redirect()->back()->with('success', 'Supplemental Purchase Request Added.');
    }



}
