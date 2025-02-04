<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ppmp;
use App\PpmpItem;
use App\PpmpItemCode;
use App\MeasurementUnit;
use App\ProcurementMode;
use App\Office;
use Auth;
use App\Http\Requests\PpmpItemRequest;

class PpmpItemController extends Controller
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
    	$ppmp = Ppmp::findorFail($id);
        $ppmp_itemDT = $ppmp->ppmpItem()->get()->groupBy('ppmp_item_code_id');
        $office = Office::findorFail($ppmp->office_id);
        $ppmp_codeDT = $office->ppmpItemCode()->get();
        $total = $ppmp->ppmpBudget;
        $units = MeasurementUnit::all();
        $modes = ProcurementMode::all();
    	return view('ppmp.ppmp_item.addppmpitm', compact('ppmp_itemDT','ppmp', 'units', 'modes','total','ppmp_codeDT'));  
    }
    
    public function dataTable(Request $request)
    {
        $ppmp_id = $request->input('ppmp_id');
        $ppmpfile = Ppmp::find($ppmp_id);
        $ppmp = PpmpItemCode::where('office_id', $ppmpfile->office_id)->get();
        
        return response()->json(['tableContent'=>$ppmp]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\OfficeRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function store(PpmpItemRequest $request, $id)
    {   
        
               
        $input = $request->all();
        // dd($input);
        $ppmp = Ppmp::findorFail($id);
        $schedule = implode(",", $input['item_schedule']);
        $ppmp_item = $ppmp->ppmpItem()->create([
            'measurement_unit_id' => $input['item_unit'],
            'procurement_mode_id' => $input['item_mode'],
            'ppmp_item_code_id' => $input['item_code'],
            'item_description' => $input['item_description'],
            'item_quantity' => str_replace(",", "", $input['item_quantity']),
            'item_budget' => str_replace(",", "", $input['item_budget']),
            'item_schedule' => $schedule,
            'item_cost' => str_replace(",", "", $input['item_cost']),
            'item_stock' => str_replace(",", "", $input['item_quantity']),
            'item_rem_budget' => str_replace(",", "", $input['item_budget']),
        ]);

        if($ppmp_item == true){

            $query_items = $ppmp->ppmpItem()->whereHas('ppmpItemCode', function ($query){
                $query->where('code_type', '!=' ,  3 );
            })->get();

            $total_budget = $query_items->sum('item_budget');
            $remaining_budget = $query_items->sum('item_rem_budget');
            $ppmp_budget = $ppmp->ppmpBudget()->update([
                'ppmp_est_budget' => $total_budget,
                'ppmp_rem_budget' => $remaining_budget
            ]);
            return redirect()->route('view.ppmpitm', $id)->with('success', 'A new item has been added.'); 
        }
        return redirect()->back()->with('danger', 'PPMP Item Failed to add');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $ppmp_id
     * @param  int  $item_id
     * @return \Illuminate\Http\Response
     */
    public function edit($ppmp_id, $item_id)
    {
        $ppmp = Ppmp::findorFail($ppmp_id);
        $ppmp_itemDT = $ppmp->ppmpItem()->get()->groupBy('ppmp_item_code_id');
        $office = Office::findorFail($ppmp->office_id);
        $ppmp_codeDT = $office->ppmpItemCode()->get();
        // $ppmp_codeDT = $office->with('ppmpItemCode');
        $total = $ppmp->ppmpBudget;
        $units = MeasurementUnit::all();
        $modes = ProcurementMode::all();

        $ppmp_item = PpmpItem::findorFail($item_id);

       return view('ppmp.ppmp_item.editppmpitm', compact('ppmp_codeDT', 'ppmp_itemDT','ppmp', 'units', 'modes','total', 'ppmp_item'));  

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\OfficeRequest  $request
     * @param  int  $ppmp_id
     * @param  int  $item_id
     * @return \Illuminate\Http\Response
     */
    public function update(PpmpItemRequest $request, $ppmp_id, $item_id)
    {
        $ppmp = Ppmp::findorFail($ppmp_id);

        $input = $request->all();
        $schedule = implode(",", $input['item_schedule']);
        $ppmp_item = PpmpItem::findorFail($item_id);
        $update_item = $ppmp_item->update([

            'measurement_unit_id' => $input['item_unit'],
            'procurement_mode_id' => $input['item_mode'],
            'ppmp_item_code_id' => $input['item_code'],
            'item_description' => $input['item_description'],
            'item_quantity' => str_replace(",", "", $input['item_quantity']),
            'item_budget' => str_replace(",", "", $input['item_budget']),
            'item_schedule' => $schedule,

            'item_cost' => str_replace(",", "", $input['item_cost']),
            'item_stock' => str_replace(",", "", $input['item_quantity']),
            'item_rem_budget' => str_replace(",", "", $input['item_budget']),
        ]);

        if($update_item == true){
            $query_items = $ppmp->ppmpItem()->whereHas('ppmpItemCode', function ($query){
                $query->where('code_type', '!=' ,  3 );
            })->get();
            
            $total_budget = $query_items->sum('item_budget');
            $remaining_budget = $query_items->sum('item_rem_budget');
            $ppmp_budget = $ppmp->ppmpBudget()->update([
                'ppmp_est_budget' => $total_budget,
                'ppmp_rem_budget' => $remaining_budget
            ]);
            return redirect()->route('view.ppmpitm', $ppmp_id)->with('success', 'PPMP Item updated.'); 
        }
        return redirect()->back()->with('danger', 'PPMP Item Failed to update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ppmp_id
     * @param  int  $item_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ppmp_id, $item_id)
    {
        $ppmp = Ppmp::findorFail($ppmp_id);
        $ppmp_item = PpmpItem::findorFail($item_id);
        $delete_item = $ppmp_item->delete();

        if($delete_item == true){
            $query_items = $ppmp->ppmpItem()->whereHas('ppmpItemCode', function ($query){
                $query->where('code_type', '!=' ,  3 );
            })->get();

            $total_budget = $query_items->sum('item_budget');
            $remaining_budget = $query_items->sum('item_rem_budget');
            $ppmp_budget = $ppmp->ppmpBudget()->update([
                'ppmp_est_budget' => $total_budget,
                'ppmp_rem_budget' => $remaining_budget
            ]);
            return redirect()->route('view.ppmpitm', $ppmp_id)->with('info', 'PPMP Item deleted.'); 
        }
        return redirect()->back()->with('danger', 'PPMP Item Failed to update.');
    }
}
