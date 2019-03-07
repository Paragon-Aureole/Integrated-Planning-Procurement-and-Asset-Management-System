<?php

namespace App\Http\Controllers;

use App\PurchaseRequestItem;
use App\PurchaseRequest;
use Auth;
use Illuminate\Http\Request;

class PurchaseRequestItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $pr = PurchaseRequest::find($id);
        $ppmp_item = $pr->ppmp->ppmpItem()->whereHas('ppmpItemCode', function ($query){
                $query->where('code_type', '=' ,  1 );
            })->get();
        // dd($ppmp_item);
        return view('pr.pr_item.addpritem', compact('pr', 'ppmp_item'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getItemData($id)
    {
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequestItem $purchaseRequestItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequestItem $purchaseRequestItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequestItem $purchaseRequestItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequestItem $purchaseRequestItem)
    {
        //
    }
}
