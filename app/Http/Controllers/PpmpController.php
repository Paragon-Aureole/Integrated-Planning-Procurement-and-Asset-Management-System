<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ppmp;
use App\PpmpItemCode;
use App\Office;
use Auth;
use App\Http\Requests\PpmpRequest;
use PDF;
use App;

class PpmpController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();

    	if ($user->hasRole('Admin')) {
    		$ppmp_DT = Ppmp::get()->where('is_supplemental', 0);
    	}else{
    		$ppmp_DT = Ppmp::get()->where('office_id', '=', $user->office_id)->where('is_supplemental', 0);
    	}
    	$offices = Office::all();
        return view('ppmp.addppmp', compact('ppmp_DT','offices'));
    }

    public function ppmpData()
    {
        $user = Ppmp::all();

        return response()->json(['ppmpData'=>$user]);
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
        
        activity('PPMP')
        ->performedOn($add_ppmp)
        ->causedBy($user)
        ->log('New PPMP added for the year '. $input['ppmp_year']."-".$add_ppmp->office->office_code);

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
        

        if ($ppmp->is_supplemental == 1) {
            return redirect()->route('supplemental.ppmp')->with('success', 'Supplemental PPMP Created');
        }else{
            return redirect()->route('view.ppmp')->with('success', 'PPMP Created');
        }

        

    }

    /**
     * Activate the PPMP Form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activatePpmp($id)
    {
    	$ppmp = Ppmp::findorFail($id);

    	$deactivate = Ppmp::where('office_id', $ppmp->office_id)->update(['is_active' => 0]);
        $ppmp->update(['is_active' => 1]);

        $message = "";
        if ($ppmp->is_supplemental == 1) {
            $message = "-S";
        }

        activity('PPMP')
        ->performedOn($ppmp)
        ->causedBy(Auth::user())
        ->log('Activate PPMP '. $ppmp->ppmp_year . $message."-".$ppmp->office->office_code);


        return redirect()->back()->with('success','PPMP Form Activated');

    }

    /**
     * Deactivate the PPMP Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function deactivatePpmp($id)
    {
        $ppmp = Ppmp::findorFail($id);
        $ppmp->update(['is_active' => 0]);

        $message = "";
        if ($ppmp->is_supplemental == 1) {
            $message = "-S";
        }

        activity('PPMP')
        ->performedOn($ppmp)
        ->causedBy(Auth::user())
        ->log('Deactivated PPMP '. $ppmp->ppmp_year . $message."-".$ppmp->office->office_code);

        return redirect()->back()->with('info','PPMP Form Deactivated');
    }

     /**
     * Print the PPMP Form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printPpmp($id)
    {
        // dd('WE FUCKING NEED YOU MASTER LARA');
        $ppmp = Ppmp::findorFail($id);

        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        $pdf = PDF::loadView('ppmp.printppmp', compact('ppmp'))->setPaper('Folio', 'landscape');

        foreach ($options as $margin => $value) {
            $pdf->setOption($margin, $value);
        }

        $message = "";
        if ($ppmp->is_supplemental == 1) {
            $message = "-S";
        }

        activity('PPMP')
        ->performedOn($ppmp)
        ->causedBy(Auth::user())
        ->log('Print PPMP '. $ppmp->ppmp_year . $message."-".$ppmp->office->office_code);

        return $pdf->stream('PPMP'.$ppmp->ppmp_year.'.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ppmp = Ppmp::findorFail($id);

        $ppmp->update(['is_active' => 0]);
        $ppmp->delete();

        $message = "";
        if ($ppmp->is_supplemental == 1) {
            $message = "-S";
        }

        activity('PPMP')
        ->performedOn($ppmp)
        ->causedBy(Auth::user())
        ->log('Delete PPMP '. $ppmp->ppmp_year . $message."-".$ppmp->office->office_code);

        return redirect()->back()->with('info', 'PPMP deleted');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewSupplemental()
    {
        $user = Auth::user();

    	if ($user->hasRole('Admin')) {
            $created_ppmp = Ppmp::get()->where('is_supplemental', 0)->where('is_active', 1);
    		$ppmp_DT = Ppmp::get()->where('is_supplemental', 1);
    	}else{
            $created_ppmp = Ppmp::get()->where('is_supplemental', 0)->where('is_active', 1)->where('office_id', '=', $user->office_id);
    		$ppmp_DT = Ppmp::get()->where('office_id', '=', $user->office_id)->where('is_supplemental', 1);
    	}
    	$offices = Office::all();
        return view('ppmp.supplementalppmp', compact('ppmp_DT','offices', 'created_ppmp'));
    }

    /**
     * Create the Supplemental PPMP Form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createSupplemental($id)
    {
        $ppmp = Ppmp::findorFail($id);

    	$user = Auth::user();

		$add_ppmp = $user->ppmp()->create([
		    "ppmp_year" => $ppmp->ppmp_year,
            "office_id" => $ppmp->office_id,
            "is_supplemental" => 1,
            "former_ppmp_id" => $ppmp->id,
            "is_active" => 1
        ]);
        
        activity('PPMP')
        ->performedOn($add_ppmp)
        ->causedBy($user)
        ->log('Supplemental PPMP added for the year'. $add_ppmp->ppmp_year ."-". $add_ppmp->office->office_code);

       return redirect()->route('add.ppmp.budget', $add_ppmp->id);

    }


}
