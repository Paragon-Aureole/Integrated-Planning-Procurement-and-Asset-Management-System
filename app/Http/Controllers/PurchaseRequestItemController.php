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
        $pr = PurchaseRequest::findorFail($id);
        $ppmp_item = $pr->ppmp->ppmpItem()->whereHas('ppmpItemCode', function ($query){
                $query->where('code_type', '=' ,  1 );
            })->get();
        // dd($ppmp_item);
        // return view('pr.pr_item.addpritem', compact('pr', 'ppmp_item'));
        return response()->json(['prItemContent'=>$ppmp_item]);
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
        $route_fail = redirect()->back()->with('danger', 'Failed to Add PR Item');
        $input = $request->all();
        
        $pr = PurchaseRequest::findorFail($id);
        $pr_Itm = $pr->prItem()->create([
            'ppmp_item_id' => $input['item_description'],
            'item_quantity' => $input['item_quantity'],
            'item_cost' => $input['item_cpu'],
            'item_budget' => $input['item_cpi'],
        ]);
       if ($pr_Itm == true) {
            $query1 = $pr_Itm->ppmpItem->firstorFail();
            $stock = $query1->item_stock;
            $update_stock = $query1->update(['item_stock' => $stock - $pr_Itm->item_quantity]);

            if ($update_stock == true) {
                $query2 = $pr->ppmp->ppmpBudget->firstorFail();
                $current_budget = $query2->ppmp_rem_budget;
                $pr_total = $input['item_cpi'];
                $rem_budget = $current_budget - $pr_total;

                $update_budget = $query2->update([
                    'ppmp_rem_budget' => $rem_budget
                ]);

                return redirect()->back()->with('success', 'Added PR Item');
            }

            return $route_fail; 
        }
        return $route_fail;


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $pr_id
     * @param  int $item_id
     * @return \Illuminate\Http\Response
     */
    public function edit($pr_id, $item_id)
    {   

        $pr = PurchaseRequest::findorFail($pr_id);
        $pr_item = PurchaseRequestItem::findorFail($item_id);
        $ppmp_item = $pr->ppmp->ppmpItem()->whereHas('ppmpItemCode', function ($query){
                $query->where('code_type', '=' ,  1 );
            })->get();
        // dd($ppmp_item);
        return view('pr.pr_item.edititem', compact('pr', 'ppmp_item', 'pr_item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $pr_id
     * @param  int $item_id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequestItemRequest $request, $pr_id, $item_id)
    {
        $route_fail = redirect()->back()->with('danger', 'Item failed to update');
        $input = $request->all();
        // dd($input);
        $pr_item = PurchaseRequestItem::findorFail($item_id); 
        $ppmpitm = $pr_item->ppmpItem->firstorFail();
            $stock = $pr_item->item_quantity + $ppmpitm->item_stock;
            $balance = $pr_item->item_budget + $ppmpitm->ppmp->ppmpBudget->ppmp_rem_budget;

        $revert_ppmp = $ppmpitm->update(['item_stock' => $stock]);
        $revert_budget = $ppmpitm->ppmp->ppmpBudget()->update(['ppmp_rem_budget' => $balance]);

        if ($revert_ppmp == true && $revert_budget == true) {
           $update_item = $pr_item->update([
                'item_quantity' => $input['item_quantity'],
                'item_cost' =>$input['item_cpu'],
                'item_budget' => $input['item_cpi'],
           ]);
           if ($update_item == true) {
               $update_ppmpitem = $ppmpitm->update(['item_stock' => $ppmpitm->item_stock - $input['item_quantity']]);
               if ($update_ppmpitem = true) {
                   $new_bal = $balance - $input['item_cpi'];
                   $update_budget = $ppmpitm->ppmp->ppmpBudget()->update([
                    'ppmp_rem_budget' => $new_bal
                ]);
                   
                return redirect()->back()->with('success', 'Item Updated');
               }
            return $route_fail;
           }
           return $route_fail;
         }
         return $route_fail; 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($pr_id, $item_id)
    {
        $pr_item = PurchaseRequestItem::findorFail($item_id); 
        $ppmpitm = $pr_item->ppmpItem->firstorFail();
            $stock = $pr_item->item_quantity + $ppmpitm->item_stock;
            $balance = $pr_item->item_budget + $ppmpitm->ppmp->ppmpBudget->ppmp_rem_budget;
        $revert_ppmp = $ppmpitm->update(['item_stock' => $stock]);
        $revert_budget = $ppmpitm->ppmp->ppmpBudget()->update(['ppmp_rem_budget' => $balance]);
        if ($revert_ppmp == true && $revert_budget == true) {
            $pr_item->delete();
            // return redirect()->back()->with('info','Item Deleted');
            return response()->json(['prItemContent'=>'Item Deleted']);
        }
        // return redirect()->route('view.pritm', $pr_id)->with('danger', 'failed to delete Item');
        return response()->json(['prItemContent'=>'Item not deleted']);
    }
}
