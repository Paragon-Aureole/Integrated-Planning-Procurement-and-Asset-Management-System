<?php

namespace App\Http\Controllers;

use App\OutlineOfQuotation;
use App\PurchaseRequest;
use Auth;
use Illuminate\Http\Request;

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OutlineOfQuotation  $outlineOfQuotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OutlineOfQuotation $outlineOfQuotation)
    {
        //
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
