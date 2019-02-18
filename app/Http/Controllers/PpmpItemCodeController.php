<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ppmp;
use App\Office;
use Auth;
use App\Http\Requests\PpmpItemCodeRequest;

class PpmpItemCodeController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PpmpItemCodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PpmpItemCodeRequest $request)
    {   
        
    	$input = $request->all();

    	$user = Auth::user();

		$add_ppmp = $user->ppmp()->create([
		    "ppmp_year" => $input['ppmp_year'],
            "office_id" => $input['office_id'],
		]);

       return redirect()->route('add.ppmp.budget', $add_ppmp->id);
    }
}
