<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ppmp;
use App\PpmpItemCode;
use App\Office;
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
        $office = Office::findorFail($id);
        $ppmp_codeDT = $office->ppmpItemCode()->get();
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
        $office = Office::findorFail($ppmp->office_id);

        $add_code = $office->ppmpItemCode()->create([
          "code_description" => $input['code_description'],
          "code_type" => $input['code_type'],
        ]);
        // dd($add_code);
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
        $office = Office::findorFail($ppmp->office_id);
        $ppmp_codeDT = $office->ppmpItemCode()->get();

        $ppmp_key = PpmpItemCode::findorFail($ppmpcode_id);

        return view('ppmp.ppmp_item_codes.editppmpcodes', compact('ppmp_codeDT','ppmp', 'ppmp_key'));


    }


    public function updateData(Request $request) 
    {
        $code_description = $request->input('code_description');
        $optionValue = $request->input('optionValue');
        $codeId = $request->input('codeId');

        $updateData = PpmpItemCode::findorFail($codeId)->update(['code_description' => $code_description, 'code_type' => $optionValue]);

        return response()->json(['UpdateData'=>$updateData]);

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
