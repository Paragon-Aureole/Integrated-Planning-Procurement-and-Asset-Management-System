<?php

namespace App\Http\Controllers;

use App\asset;
use App\assetTurnover;
use App\assetPar;
use App\assetIcslip;
use Carbon\Carbon;

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
        $assetTurnoverParData = assetTurnover::where('par_id', '!=', null);
        $assetTurnoverIcsData = assetTurnover::where('ics_id', '!=', null);
        // dd($assetTurnoverParData);
        $assetParData = assetPar::where('id', '!=', array($assetTurnoverParData->pluck('par_id')))->get();
        // $assetParData = assetPar::whereId(1)->get();
        $assetIcslipData = assetIcslip::where('id', '!=', array($assetTurnoverIcsData->pluck('ics_id')))->get();
        // dd($assetParData);
        // dd($assetIcslipData);

        return view('assets.turnover.index', compact('assetParData', 'assetIcslipData', 'assetTurnoverParData', 'assetTurnoverIcsData'));
        // dd('you are now in Asset Turnover Section. Welcome~!');
    }

    public function getParData(Request $id)
    {
        $finalParData = [];
        // dd($id->par_id);
        $rawParData = assetPar::findorFail($id->par_id);
        // dd($rawParData->asset);

        $unitCost = (float) $rawParData->asset->amount / (int) $rawParData->asset->item_quantity;
        $quantity = $rawParData->quantity;

        $finalParData['id'] = $rawParData->id;
        $finalParData['name'] = $rawParData->asset->details;
        $finalParData['quantity'] = $quantity;
        $finalParData['assignedTo'] = $rawParData->assignedTo;
        $finalParData['position'] = $rawParData->position;
        $finalParData['unitCost'] = $unitCost;
        $finalParData['dateAssigned'] = $rawParData->created_at->toDateString();
        $finalParData['totalAmount'] = $unitCost * $quantity;
        return $finalParData;
    }

    public function getIcsData(Request $id)
    {
        $finalIcsData = [];
        // dd($id->Ics_id);
        $rawIcsData = assetIcslip::findorFail($id->ics_id);
        // dd($rawIcsData->asset);

        $unitCost = (float) $rawIcsData->asset->amount / (int) $rawIcsData->asset->item_quantity;
        $quantity = $rawIcsData->quantity;

        $finalIcsData['id'] = $rawIcsData->id;
        $finalIcsData['name'] = $rawIcsData->asset->details;
        $finalIcsData['quantity'] = $quantity;
        $finalIcsData['assignedTo'] = $rawIcsData->assignedTo;
        $finalIcsData['position'] = $rawIcsData->position;
        $finalIcsData['unitCost'] = $unitCost;
        $finalIcsData['dateAssigned'] = $rawIcsData->created_at->toDateString();
        $finalIcsData['totalAmount'] = $unitCost * $quantity;
        return $finalIcsData;
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
