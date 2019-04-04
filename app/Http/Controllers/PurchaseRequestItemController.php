<?php

namespace App\Http\Controllers;

use App\PurchaseRequestItem;
use App\PurchaseRequest;
use App\PpmpItem;
use App\Ppmp;
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
<<<<<<< HEAD
        $pr_code = explode("-", $pr->pr_code);
        
        $ppmp= Ppmp::where('office_id', $pr->office_id)->where('ppmp_year', $pr_code[2])->first();
        $ppmp_item = $ppmp->ppmpItem->all();
        return view('pr.pr_item.addpritem', compact('pr', 'ppmp_item'));
=======
        $ppmp_item = $pr->ppmp->ppmpItem()->whereHas('ppmpItemCode', function ($query){
                $query->where('code_type', '=' ,  1 );
            })->get();
        // dd($ppmp_item);
        // return view('pr.pr_item.addpritem', compact('pr', 'ppmp_item'));
        return response()->json(['prItemContent'=>$ppmp_item]);
>>>>>>> 9a6d3bb836127d4bb2f6f69a3e3a2f1386a7c892
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
        $pr->pr_budget = $pr->pr_budget + $input['item_cpi'];
        $pr->save();

        $ppmp_item = PpmpItem::findorFail($input['item_description']);
        $ppmp_item->item_stock = $ppmp_item->item_stock - $input['item_quantity'];
        $ppmp_item->save();
        
        $pr_item = PurchaseRequestItem::create([
            'ppmp_item_id' => $input['item_description'],
            'item_quantity' => $input['item_quantity'],
            'item_cost' => $input['item_cpu'],
            'item_budget' => $input['item_cpi']
        ]);

        $pr->prItem()->save($pr_item);

        return redirect()->back()->with('success', 'PR Item Added');
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
        $pr_code = explode("-", $pr->pr_code);
        $ppmp= Ppmp::where('office_id', $pr->office_id)->where('ppmp_year', $pr_code[2])->first();
        $ppmp_item = $ppmp->ppmpItem->all();
     
        return view('pr.pr_item.editpritem', compact('pr', 'ppmp_item', 'pr_item'));
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
      
        $input = $request->all();
        $pr_item = PurchaseRequestItem::findorFail($item_id);
       
        $pr = PurchaseRequest::findorFail($pr_id);
        $pr->pr_budget = ($pr->pr_budget - $pr_item->item_budget) + $input['item_cpi'];
        $pr->save();

        $ppmp_item = PpmpItem::findorFail($input['item_description']);
        $ppmp_item->item_stock = ($ppmp_item->item_stock + $pr_item->item_quantity) - $input['item_quantity'];
        $ppmp_item->save();

        $pr_item->update([
            'ppmp_item_id' => $input['item_description'],
            'item_quantity' => $input['item_quantity'],
            'item_cost' => $input['item_cpu'],
            'item_budget' => $input['item_cpi']
        ]);

        $pr->prItem()->save($pr_item);

        return redirect()->back()->with('success', 'I have successfully shit this');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseRequestItem  $purchaseRequestItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($pr_id, $item_id)
    {
<<<<<<< HEAD
       
         
=======
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
>>>>>>> 9a6d3bb836127d4bb2f6f69a3e3a2f1386a7c892
    }
}
