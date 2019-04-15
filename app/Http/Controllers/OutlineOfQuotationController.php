<?php

namespace App\Http\Controllers;

use App\OutlineOfQuotation;
use App\OutlineSupplier;
use App\PurchaseRequest;
use App\Signatory;
use Auth;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class OutlineOfQuotationController extends Controller
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
        ->where('created_abstract', 0)
        ->get();

        $aoq = OutlineOfQuotation::whereHas('purchaseRequest', function ($query){
            $query->where('office_id',  Auth::user()->office_id );
        })->get(); 

        // dd($pr);

        return view('abstract.addAbstract', compact('pr', 'aoq'));
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
        $pr = PurchaseRequest::findorFail($input['pr_id']);
        $pr->created_abstract = 1;
        $pr->save();

        $abstract = OutlineOfQuotation::create([
            'user_id' => Auth::user()->id,
            'outline_detail' => $input['outline_detail'],
        ]);

        $pr->outlineQuotation()->save($abstract);
        
        return redirect()->back()->with('success', 'Abstract of Quotation Created, add suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OutlineOfQuotation  $outlineOfQuotation
     * @return \Illuminate\Http\Response
     */
    public function show(OutlineOfQuotation $outlineOfQuotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OutlineOfQuotation  $outlineOfQuotation
     * @return \Illuminate\Http\Response
     */
    public function edit(OutlineOfQuotation $outlineOfQuotation)
    {
        //
    }

    /**
     * Print Abstract of Quotation Form in PDF Format
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function printOutline($id)
    {
        $twg = Signatory::where(['category' => 5, 'is_activated' => true])->get();
        // dd($twg);
        $abstract = OutlineOfQuotation::findorFail($id);
        $date   = Carbon::parse($abstract->created_at);
        $created_code = Auth::user()->office->office_code."/".Auth::user()->wholename."/".$date->Format('F j, Y')."/".$date->format("g:i:s A")."/"."BAC"."/".$abstract->purchaseRequest->pr_code;
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

        $pdf = PDF::loadView('abstract.printAbstract',compact('abstract', 'date', 'twg'));

        foreach ($options as $margin => $value) {
            $pdf->setOption($margin, $value);
        }

        return $pdf->stream('AOQ-'.$abstract->purchaseRequest->pr_code.'.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        // dd($input);
        
        $outlineOfQuotation = OutlineOfQuotation::findorFail($id);
        $update = $outlineOfQuotation->update([
            "outline_comment" => $input['supplier_comments'],
        //     "code_type" => $input['code_type'],
        ]);  

        $outlineSupplierId = OutlineSupplier::Where('outline_of_quotation_id', $id)->update(['supplier_status' => '0', 'status_reason' => '0']);

        $outlineSuppliers = OutlineSupplier::findorFail($input['bid_winner']);
        $updateSupplierWinner = $outlineSuppliers->update([
            "supplier_status" => '1',
            "status_reason" => $input['status_reason'],
        ]);

        // return "SUCCESS";
        return redirect()->back()->with('success', 'PPMP Item Code successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OutlineOfQuotation  $outlineOfQuotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutlineOfQuotation $outlineOfQuotation)
    {
        //
    }
}
