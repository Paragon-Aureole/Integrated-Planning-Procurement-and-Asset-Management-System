<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ppmp;
use App\PpmpItemCode;
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

    	$ppmp = Ppmp::findorFail($input['ppmp_select']);
        $add_code = $ppmp->ppmpItemCode()->create([
            "code_description" => $input['code_description'],
            "code_type" => $input['code_type'],
        ]);

        return redirect()->back()->with('success', 'PPMP Item Code successfully added');

    }
}
