<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ppmp;
use App\Office;
use Auth;
use App\Http\Requests\PpmpRequest;

class PpmpController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
    	$user = Auth::user();

    	if ($user->hasRole('Admin')) {
    		$ppmp_DT = Ppmp::all();
    	}else{
    		$ppmp_DT = Ppmp::where('office_id', '=', $user->office_id);
    	}
    	$offices = Office::all();
        return view('ppmp.addppmp', compact('ppmp_DT','offices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PpmpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PpmpRequest $request)
    {   
        
    	$input = $request->all();

    	$user = Auth::user();

		$add_ppmp = $user->ppmp()->create([
		    "ppmp_year" => $input['ppmp_year'],
            "office_id" => $input['office_id'],
		]);

       return redirect()->route('add.ppmp.budget', $add_ppmp->id);
    }

    /**
     * Store a newly created budget in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addPpmpBudget($id)
    {   
        
    	$ppmp = Ppmp::findorFail($id);

		$add_ppmp_budget = $ppmp->ppmpBudget()->create([
		    'ppmp_est_budget' => 0,
		    'ppmp_rem_budget' => 0,
		]);
		
        return redirect()->route('view.ppmp')->with('success', 'A new PPMP has been added.'); 

    }
}
