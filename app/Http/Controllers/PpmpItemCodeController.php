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
        $ppmp_codeDT = $ppmp->ppmpItemCode()->get();
        return view('ppmp.ppmp_item_codes.viewppmpcodes', compact('ppmp_codeDT','ppmp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PpmpItemCodeRequest  $request
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function store(PpmpItemCodeRequest $request, $id)
    {   
        $input = $request->all();
        $ppmp = Ppmp::findorFail($id);
        $add_code = $ppmp->ppmpItemCode()->create([
            "code_description" => $input['code_description'],
            "code_type" => $input['code_type'],
        ]);
        return redirect()->back()->with('success', 'PPMP Item Code successfully added');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $ppmp_id
     * @param  int  $ppmpcode_id
     * @return \Illuminate\Http\Response
     */
    public function edit($ppmp_id, $ppmpcode_id)
    {
        $ppmp = Ppmp::findorFail($ppmp_id);
        $ppmp_codeDT = $ppmp->ppmpItemCode()->get();

        $ppmp_key = PpmpItemCode::findorFail($ppmpcode_id);

        return view('ppmp.ppmp_item_codes.editppmpcodes', compact('ppmp_codeDT','ppmp', 'ppmp_key'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\OfficeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PpmpItemCodeRequest $request, $id)
    {
        $input = $request->all();
        $ppmp_code = PpmpItemCode::findorFail($id);
        $update_code = $ppmp_code->update([
            "code_description" => $input['code_description'],
            "code_type" => $input['code_type'],
        ]);
        return redirect()->back()->with('success', 'PPMP Item Code successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ppmp_code = PpmpItemCode::findorFail($id);
        $ppmp_code->delete();
        return redirect()->back()->with('info', 'PPMP Item Code deleted');
    }

    
}
