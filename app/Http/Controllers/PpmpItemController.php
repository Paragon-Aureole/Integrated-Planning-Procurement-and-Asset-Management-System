<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ppmp;
use App\PpmpItem;
use App\PpmpItemCode;
use App\MeasurementUnit;
use App\ProcurementMode;
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
    	$ppmp_itemDT = $ppmp->ppmpItem()->get();
        $units = MeasurementUnit::all();
        $modes = ProcurementMode::all();
    	return view('ppmp.ppmp_item.addppmpitm', compact('ppmp_itemDT','ppmp', 'units', 'modes')) ;  
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
        $ppmp = Ppmp::find($id);
        $schedule = implode(",", $input['item_schedule']);

        $ppmp_item = $ppmp->ppmpItem()->create([
            'measurement_unit_id' => $input['item_unit'],
            'procurement_mode_id' => $input['item_mode'],
            'ppmp_item_code_id' => $input['item_code'],
            'item_description' => $input['item_description'],
            'item_quantity' => $input['item_quantity'],
            'item_budget' => $input['item_budget'],
            'item_schedule' => $schedule,

            'item_cost' => $input['item_cost'],
            'item_stock' => $input['item_quantity'],
            'item_rem_budget' => $input['item_budget'],
        ]);

        if($ppmp_item == true){

            $query_items = $ppmp->ppmpItem()->where('ppmp_item_code_id', '<>', 3)->get();
            $total_budget = $query_items->sum('item_budget');
            $remaining_budget = $query_items->sum('item_rem_budget');
            $ppmp_budget = $ppmp->ppmpBudget()->update([
                'ppmp_est_budget' => $total_budget,
                'ppmp_rem_budget' => $remaining_budget
            ]);
            return redirect()->back()->with('success', 'A new item has been added.'); 
        }
        return redirect()->back()->with('danger', 'PPMP Item Failed to add');
    }
}
