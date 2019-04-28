<?php

namespace App\Http\Controllers;

use App\Signatory;
use App\Office;
use App\Http\Requests\SignatoryRequest;

class SignatoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:Admin','permission:full control']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $signatories = Signatory::all();
        $offices = Office::all();
        return view('signatories.addsignatory', compact('offices','signatories'));
    }

    /**
     * Show the form for activating a signatory.
     *
     * @return \Illuminate\Http\Response
     */
    public function activateSignatory($id)
    {
        $signatory = Signatory::findorFail($id);
        if($signatory->category == 2 || $signatory->category == 3 || $signatory->category == 4){
            $deactivate = Signatory::where('category', $signatory->category)
                        ->update(['is_activated' => 0]);
        }elseif ($signatory->category == 5) {
            //count activated under what group
            if($signatory->signatory_position == "Goods & Supplies"){
                $count = Signatory::where('signatory_position', 'Goods & Supplies')
                        ->where('is_activated', '=', 1)
                        ->count();
                if ($count >= 2) {
                  return redirect()->back()->with('warning','The Technical Working Group is full, deactivate a member to add another.');  
                }
            }elseif($signatory->signatory_position == "Construction & Supplies"){
                $count = Signatory::where('signatory_position', 'Construction & Supplies')
                        ->where('is_activated', '=', 1)
                        ->count();
                if ($count >= 2) {
                  return redirect()->back()->with('warning','The Technical Working Group is full, deactivate a member to add another.');   
                }
            }elseif($signatory->signatory_position == "Auto Repair & Supplies" || $signatory->signatory_position == "IT & Supplies"){
                $deactivate = Signatory::where('category', $signatory->category)
                        ->where('signatory_position', $signatory->signatory_position)
                        ->update(['is_activated' => 0]);
            }else{
                return redirect()->back()->with('error','The Position is not included in the Technical Working Group!');
            }
        }elseif($signatory->category == 6 || $signatory->category == 7){
            // deactivate none
        }else{
            $deactivate = Signatory::where('category', $signatory->category)
                        ->where('office_id', $signatory->office_id)
                        ->update(['is_activated' => 0]);
        }

        $signatory->update(['is_activated' => 1]);
        return redirect()->back()->with('success','Signatory Activated');
    }

    /**
     * Show the form for deactivating a signatory.
     *
     * @return \Illuminate\Http\Response
     */
    public function deactivateSignatory($id)
    {
        $signatory = Signatory::findorFail($id);
        $signatory->update(['is_activated' => 0]);
        return redirect()->back()->with('info','Signatory Deactivated');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\SignatoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SignatoryRequest $request)
    {
        $input = $request->all();
        $signatory = Signatory::create([
            "signatory_name" => $input['signatory_name'],
            "signatory_position" => $input['signatory_position'],
            "office_id" => $input['office'],
            "category" => $input['category'],
        ]);
        return redirect()->back()->with('success', 'A Signatory has been added.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $signatories = Signatory::all();
        $offices = Office::all();
        $edit_signatory = Signatory::findorFail($id);
        return view('signatories.updatesignatory', compact('signatories', 'offices', 'edit_signatory'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\SignatoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SignatoryRequest $request, $id)
    {
        $input = $request->all();
        $signatory = Signatory::findorFail($id);
        $signatory->update([
            "signatory_name" => $input['signatory_name'],
            "signatory_position" => $input['signatory_position'],
            "office_id" => $input['office'],
            "category" => $input['category'],
        ]);

        return redirect()->route('view.signatories')->with('success', 'The Signatory has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Signatory::destroy($id);
        return redirect()->back()->with('info', 'A signatory has been deleted.');
    }
}
