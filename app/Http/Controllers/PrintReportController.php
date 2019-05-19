<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\assetPar;
use App\assetIcslip;
use App\asset;
use App\AssetIcslipItem;
use App\AssetParItem;
use App\assetType;
use PDF;

class PrintReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $getName = $findName->asset->all();

        // $reportData = AssetParItem::where('asset_par_id', 1)->get();

        // dd($findName);

        $assetPar = assetPar::all();
        $asset = asset::where('asset_type_id', 1)->get();
        return view('printReports.index', compact('assetPar','asset'));
    }
    public function getPrintPhysicalData(Request $request)
    {
        $input = $request->all();

        $findName = assetPar::with('AssetParItem')->with('asset')->find($input['asset_par_id']);
        // dd($findName);
        // $findName = assetPar::with('AssetParItem')->find(1);

        // $getName = $findName->asset->all();

        // $reportData = AssetParItem::where('asset_par_id', $input['asset_par_id'])->get();

        // return response()->json(['reportData'=>$reportData, 'getName'=>$getName, 'findName'=>$findName]);
        return response()->json(['findName'=>$findName]);
    }

    public function printPhysicalForm($id,$asset_type_id)
    {
        $asset_type = assetType::find($asset_type_id);
        $parData = AssetParItem::where('asset_par_id', $id)->get();
        // $parData = $parItem->assetPar->asset->where('asset_type_id', $asset_type_id)->get();
        // dd($asset_type);
        // dd($parData->first()->assetParItem);
        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        $pdf = PDF::loadView('assets.data_capturing.officeAssets.printAssets', compact('parData', 'asset_type'))->setPaper('folio', 'landscape');
        return $pdf->stream('Print Report of the Physical Count of Property, Plant and Equipment.pdf');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
