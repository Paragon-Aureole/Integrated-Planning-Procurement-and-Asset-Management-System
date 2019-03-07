<?php

namespace App\Http\Controllers;

use App\PurchaseRequestItem;
use App\PurchaseRequest;
use App\PpmpItem;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequestItemRequest;

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
        $ppmp_item = PpmpItem::findorFail($id);
        $unit = $ppmp_item->measurementUnit->unit_code;
        return json_encode([$ppmp_item, $unit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequestItemRequest $request, $id)
    {
        $input = $request->all();
        
        $pr = PurchaseRequest::findorFail($id);
        $pr_Itm = $pr->prItem()->create([
            'ppmp_item_id' => $input['item_description'],
            'item_quantity' => $input['item_quantity'],
            'item_cost' => $input['item_cpu'],
            'item_budget' => $input['item_cpi'],
        ]);
       if ($pr_Itm == true) {
            $query1 = $pr_Itm->ppmpItem->first();
            $stock = $query1->item_stock;
            $update_stock = $query1->update(['item_stock' => $stock - $pr_Itm->item_quantity]);

            if ($update_stock == true) {
                $query2 = $pr->ppmp->ppmpBudget->first();
                $current_budget = $query2->ppmp_rem_budget;
                $pr_total = $input['item_cpi'];
                $rem_budget = $current_budget - $pr_total;

                $update_budget = $query2->update([
                    'ppmp_rem_budget' => $rem_budget
                ]);

                return redirect()->back()->with('success', 'Added PR Item');
            }
            
            return redirect()->back()->with('danger', 'Failed to Add PR Item');  
        }
        return redirect()->back()->with('danger', 'Failed to Add PR Item');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(PurchaseRequestItemRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequestItem $id)
    {
        //
    }
}
