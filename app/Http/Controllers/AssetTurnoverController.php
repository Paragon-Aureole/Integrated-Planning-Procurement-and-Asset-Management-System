<?php

namespace App\Http\Controllers;

use App\asset;
use App\PurchaseOrder;
use App\PurchaseRequest;
use App\Office;
use App\assetTurnover;
use App\assetPar;
use App\assetIcslip;
use Carbon\Carbon;
use Auth;

use Illuminate\Http\Request;

class AssetTurnoverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $office = Office::all();
            $to = assetPar::all();

        }else{
            $to = assetPar::where('id', Auth::user()->id)->get();

        }

        return view('assets.turnover.index', compact('to', 'office'));
    }

    public function parSearchTurnover(Request $request)
    {
        $par_id = $request->input('par_id');

        if (Auth::user()->hasRole('Admin')) {
            $assetPar = assetPar::where('id', $par_id)
            ->get();

        }else{
            $assetPars = assetPar::find($par_id);
            
            $assetPar = $assetPars->asset->purchaseOrder->purchaseRequest->office->where('id', Auth::user()->office_id)->get();
        }
 
        return response()->json(['assetPar'=>$assetPar]);
    }

    public function nameSearchTurnover(Request $request)
    {
        // CONTROLLER FOR NAME AND OFFICE SEARCHING
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $items = $request->input('data');
        // dd($items);
        $par_id = null;
        $ics_id = null;
        if ($items[1] == "PAR") {
            $par_id = $items[0];
        } elseif ($items[1] == "ICS") {
            $ics_id = $items[0];
        }
        assetTurnover::create([
            'par_id' => $par_id,
            'ics_id' => $ics_id,
            'remarks' => $items[4],
            'assignedTo' => $items[2],
            'position' => $items[3]
        ]);

        if ($request->isMethod('post')) {
            // return response()->json(['response' => 'This is post method', 'error' => false]);
            return response()->json(['response' => 'Save Success', 'error' => false, 'data' => $items]);
        } else {
            return response()->json(['response' => 'failure']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\assetTurnover  $assetTurnover
     * @return \Illuminate\Http\Response
     */
    public function show(assetTurnover $assetTurnover)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\assetTurnover  $assetTurnover
     * @return \Illuminate\Http\Response
     */
    public function edit(assetTurnover $assetTurnover)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\assetTurnover  $assetTurnover
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, assetTurnover $assetTurnover)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\assetTurnover  $assetTurnover
     * @return \Illuminate\Http\Response
     */
    public function destroy(assetTurnover $assetTurnover)
    {
        //
    }
}
