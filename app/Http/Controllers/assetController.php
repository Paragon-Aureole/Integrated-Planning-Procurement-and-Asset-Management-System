<?php

namespace App\Http\Controllers;

use App\PurchaseRequestItem;
use App\PurchaseRequest;
use App\PpmpItem;
use App\Ppmp;
use Auth;
use App\Http\Requests\PurchaseRequestItemRequest;
use Illuminate\Http\Request;
use App\asset;
use PDF;
use App;

class assetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $pr = PurchaseRequest::findorFail(1);
        // $pr_code = explode("-", $pr->pr_code);
        
        // $ppmp= Ppmp::where('office_id', $pr->office_id)->where('ppmp_year', $pr_code[2])->first();
        // $ppmp_item = $ppmp->ppmpItem->all();

        // dd($ppmp_item);
        // dd($dummyData);
        return view('assets.index');
        // return $dummyData;
    }

    public function showDetails()
    {

        return view('assets.am_details');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $id)
    {
     
    if ($id->searchPO == '1') {
        $dummyData = [
            ['sticker(barcode)', '1000'], 
            ['external hdd', '3500'], 
            ['printer', '15000']
    ];   
    } else {
            $dummyData = [
                    ['stapler', '200'],
                    ['guitar', '9600'],
                    ['laptop', '69999']
        ];
    }
        // dd($dummyData);
        // dd($id->searchPO);
        return view('assets.create',compact('id', 'dummyData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $sortedArray = [];

        $recordDetails = $request->get('recordDetails');
        $recordAmount = $request->get('recordAmount');
        $Supply = $request->get('Supply');
        $ICS = $request->get('ICS');
        $PAR = $request->get('PAR');

        for ($i=0; $i <= 2; $i++) { 
            $sortedArray[$i] = [$recordDetails[$i], $recordAmount[$i], $Supply[$i], $ICS[$i], $PAR[$i]];
        }

        foreach ($sortedArray as $key => $value) {
            asset::create([
                'PO_id' => $request->PO_id,
                'details' => $value[0],
                'amount' => $value[1],
                'isSup' => $value[2],
                'isICS' => $value[3],
                'isPAR' => $value[4]
            ]);
        }

        return redirect()->back()->with('success', 'PO Items have been Registered, Go to Distribute Asset Module to Distribute Items');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show(asset $asset)
    {
        // dd($asset);

        // $POitem = asset::where('PO_id', $asset->id)->get();
        // dd($POitem);
        
        return view('assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, asset $asset)
    {
            // asset::whereId($asset->id)->update(
            //     [
            //     'PO_id' => $asset->PO_id,
            //     'details' => $request->details,
            //     'amount' => $request->amount,
            //     'isSup' => $request->isSup,
            //     'isICS' => $request->isICS,
            //     'isPAR' => $request->isPAR
            // ]);
            
            asset::whereId($asset->id)->update($request->except(['_method','_token']));
            return redirect()->back()->with('success', 'Update Success.');
            
            
        // dd($request->all());
        // dd($request->details);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(asset $asset)
    {
        //
    }

    //custom functions below here

    //listing function for specific PO ID

    public function displayRegisteredPOItems($id)
    {
        $fetchedData = asset::Where('PO_id', $id)->get();
        // $fetchedData = asset::all();
        // dd($fetchedData);

        return view('assets.listRegisteredPOItems',compact('fetchedData'));

    }
    // public function displayRegisteredPOItems($id)
    // {
    //     $fetchedData = asset::Where('PO_id', $id)->get();
    //     // $fetchedData = asset::all();
    //     // dd($fetchedData);

    //     return view('assets.listRegisteredPOItems',compact('fetchedData'));

    // }

    public function printPar()
    {
        // return view('assets.par.printPAR');
        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        $pdf = PDF::loadView('assets.par.printPAR')->setPaper('Folio', 'landscape');
        return $pdf->stream('PAR.pdf');
    }

    public function printIcs()
    {
        // return view('assets.par.printPAR');
        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        $pdf = PDF::loadView('assets.ics.printICS')->setPaper('Folio', 'landscape');
        return $pdf->stream('ICS.pdf');
    }

    public function printVehicle()
    {
        // return view('assets.par.printPAR');
        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        $pdf = PDF::loadView('assets.data_capturing.vehicle.printvehicle')->setPaper('Folio', 'landscape');
        return $pdf->stream('VEHICLE.pdf');
    }

    public function printOfficeAssets()
    {
        // return view('assets.par.printPAR');
        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        $pdf = PDF::loadView('assets.data_capturing.officeAssets.printAssets')->setPaper('Folio', 'landscape');
        return $pdf->stream('VEHICLE.pdf');
    }
}
