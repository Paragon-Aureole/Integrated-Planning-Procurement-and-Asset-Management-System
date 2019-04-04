<?php

namespace App\Http\Controllers;

use App\RequestForQuotation;
use App\PurchaseRequest;
use Auth;
use Illuminate\Http\Request;

class RequestForQuotationController extends Controller
{
    /**
     * Display all closed Purchase Request that are not government suppliers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pr = PurchaseRequest::where('office_id', Auth::user()->office_id)
        ->where('pr_status', 1)
        ->where('created_rfq', 0)
        ->get();

        $rfq = RequestForQuotation::whereHas('purchaseRequest', function ($query){
            $query->where('office_id',  Auth::user()->office_id );
        })->get(); 

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

        return redirect()->back()->with('success', 'RFQ Created');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $rfq_id
     * @return \Illuminate\Http\Response
     */
    public function show($rfq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestForQuotation  $requestForQuotation
     * @return \Illuminate\Http\Response
     */
    public function edit($rfq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $rfq_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rfq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $rfq_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rfq)
    {
        //
    }
}
