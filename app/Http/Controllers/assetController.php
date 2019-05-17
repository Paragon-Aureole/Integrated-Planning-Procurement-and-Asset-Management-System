<?php

namespace App\Http\Controllers;

use App\PurchaseRequestItem;
use App\PurchaseOrder;
use App\PurchaseRequest;
use App\PpmpItem;
use App\Ppmp;
use Auth;
use App\Http\Requests\PurchaseRequestItemRequest;
use Illuminate\Http\Request;
use App\asset;
use App\DisbursementVoucher;
use App\assetType;
use App\assetPar;
use App\assetIcslip;
use App\assetTurnover;

use App\AssetIcslipItem;
use App\AssetParItem;
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
        
        // $asset = purchaseRequest::where('created_inspection', 1)->get();
        $asset = asset::All();
        $assetPar = assetPar::All();
        $assetIcs = assetIcslip::All();
        // dd($asset);
        // $pr = PurchaseRequest::findorFail(1);
        // $pr_code = explode("-", $pr->pr_code);
        
        // $ppmp= Ppmp::where('office_id', $pr->office_id)->where('ppmp_year', $pr_code[2])->first();
        // $ppmp_item = $ppmp->ppmpItem->all();

        // dd($ppmp_item);
        // dd($data);
        return view('assets.index', compact('asset', 'assetPar', 'assetIcs'));
        // return $dummyData;
    }

    /**
     * View All Distributed Assets.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewAll()
    {
        $user = Auth::user();
        
        if ($user->can('Asset Management', 'Supervisor')) {

            $asset = asset::All();
            $assetPar = assetPar::All();
            $assetIcs = assetIcslip::All();
            
        }else{
            $asset = asset::whereHas('purchaseOrder', function ($query){

                $query->where('office_id',  Auth::user()->office_id );

            })->get();

            $assetPar = assetPar::whereHas('asset.purchaseOrder', function ($query){

                $query->where('office_id',  Auth::user()->office_id );

            })->get();

            $assetIcs = assetIcslip::whereHas('asset.purchaseOrder', function ($query){

                $query->where('office_id',  Auth::user()->office_id );

            })->get();
        }
        

        return view('assets.viewDistributed', compact('asset', 'assetPar', 'assetIcs'));
    }

    public function getClassificationModalData(Request $request)
    {
        $input = $request->all();

        $ClassificationModalContent = asset::where('purchase_order_id', $input['po_id'])->get();

        return response()->json(['ClassificationModalContent'=>$ClassificationModalContent]);
    }

    public function getAssetData(Request $request)
    {
        $input = $request->all();

        $assetData = asset::where('id', $input['asset_id'])->get();

        return response()->json(['assetData'=>$assetData]);
    }

    public function getPARCount()
    {
        $assetParCount = assetPar::get()->count();
        return ($assetParCount);
    }

    public function getICSCount()
    {
        $assetIcsCount = assetIcslip::get()->count();
        return ($assetIcsCount);
    }

    public function getClassifiedItemQtyNo($id)
    {
        // dd($id);
        $assetClassifiedItemQtyNo = asset::select('item_stock')->where('id', $id)->get();
        return ($assetClassifiedItemQtyNo->first()->item_stock);
    }

    public function setAssetIsAssigned(Request $request)
    {
        asset::whereId($request->asset_id)->update([
                'isAssigned' => 1
            ]);

        return response()->json(['response' => 'Assigning Successful. You may now print.', 'error' => false]);
    }
    // public function getVoucherNo(Request $request)
    // {
    //     $poID = $request->get('searchPO');
    //     // return($poID);
    //     return view('assets.getVoucherNo', compact('poID'));
    // }

    // public function saveVoucherNo(Request $request)
    // {
    //     $purchase_order_no = $request->get('purchase_order_no');
    //     $voucherNo = $request->get('voucherNo');

    //     DisbursementVoucher::create([
    //             'purchase_order_id' => $purchase_order_no,
    //             'disbursementNo' => $voucherNo
    //         ]);
        
    //     return redirect()->route('assets.assetClassification', compact('purchase_order_no'))->with('success', 'PO Disbursement Number has been Registered.');

        
    //     // dd($purchase_order_no, $voucherNo);
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function assetClassification(Request $id)
    {
        //  dd($id->All());

        // $data = asset::findorFail($id->purchase_order_id);
        $assetData = asset::where('purchase_order_id', $id->purchase_order_id)->get();
        $assetTypeData = assetType::All();
        // dd($assetData);
    
        return view('assets.assetClassification', compact('assetData', 'assetTypeData'));
        // return view('assets.create');
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
        DisbursementVoucher::create([
                'purchase_order_id' => $request->po_id,
                'disbursementNo' => $request->voucherNo
            ]);


        // dd($request->all());
        $sortedArray = [];
        $PAR = [];
        $ICS = [];
        $assetCount = asset::where('purchase_order_id', $request->po_id)->get()->count() - 1;
        // dd($assetCount);
        $recordID = $request->get('id');
        $PARorICS = $request->get('PARorICS');
        foreach ($PARorICS as $key => $value) {
            if ($value == "ICS") {
                $ICS[$key] = '1';
                $PAR[$key] = '0';
            } elseif ($value == "PAR") {
                $ICS[$key] = '0';
                $PAR[$key] = '1';
            }
        }
        // $PAR = $request->get('PAR');
        $asset_type_id = $request->get('asset_type');

        for ($i=0; $i <= $assetCount; $i++) {
            $sortedArray[$i] = [$recordID[$i], $ICS[$i], $PAR[$i], $asset_type_id[$i]];
        }
        // dd($sortedArray);
        foreach ($sortedArray as $key => $value) {
            asset::whereId($value[0])->update([
                'isICS' => $value[1],
                'isPAR' => $value[2],
                'asset_type_id' => $value[3],
                'isEditable' => 1
            ]);
        }

        return redirect()->back()->with('success', 'PO Items have been Registered, Go to Distribute Asset Module to Distribute Items');
    }

    public function saveNewPar(Request $request)
    {
        $items = $request->input('data');
        // dd($items);

        assetPar::create([
            'asset_id' => $items[0],
            'quantity' => $items[1],
            'assignedTo' => $items[3],
            'position' => $items[4]
        ]);

        for ($i=0; $i < count($items[2]); $i++) {
            // $bekkel[] = ['id' => $items[0], 'description' => $items[2][$i]];
            
            AssetParItem::create([
                    'asset_par_id' => $items[5],
                    'description' => $items[2][$i],
                    'itemStatus' => 0
                ]);
        }


        asset::find($items[0])->decrement('item_stock', $items[1]);


        if ($request->isMethod('post')) {
            // return response()->json(['response' => 'This is post method', 'error' => false]);
            return response()->json(['response' => 'Save Success', 'error' => false, 'data' => $items]);
        } else {
            return response()->json(['response' => 'failure']);
        }
    }
    public function saveNewIcs(Request $request)
    {
        $items = $request->input('data');
        // dd($items);

        assetIcslip::create([
            'asset_id' => $items[0],
            'quantity' => $items[1],
            'assignedTo' => $items[3],
            'position' => $items[4],
            'useful_life' => $items[5]
        ]);

        // dd(print_r($items));

        // $bekkel = [];
        for ($i=0; $i < count($items[2]); $i++) {
            // $bekkel[] = ['id' => $items[0], 'description' => $items[2][$i]];
            
            AssetIcslipItem::create([
                    'asset_icslip_id' => $items[6],
                    'description' => $items[2][$i]
                ]);
        }

        // dd($bekkel);

        asset::find($items[0])->decrement('item_stock', $items[1]);


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
        $fetchedData = asset::Where('purchase_order_id', $id)->get();
        // $fetchedData = asset::all();
        // dd($fetchedData);

        return view('assets.listRegisteredPOItems', compact('fetchedData'));
    }
    // public function displayRegisteredPOItems($id)
    // {
    //     $fetchedData = asset::Where('PO_id', $id)->get();
    //     // $fetchedData = asset::all();
    //     // dd($fetchedData);

    //     return view('assets.listRegisteredPOItems',compact('fetchedData'));

    // }

    public function printPar($id)
    {
        $parData = assetPar::with('assetParItem')->findorFail($id);
        // dd($parData);
        // return view('assets.par.printPAR');
        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        // dd($parData);

        $pdf = PDF::loadView('assets.par.printPAR', compact('parData'))->setPaper('Folio', 'portrait');
        return $pdf->stream('PAR.pdf');
    }

    public function printIcs($id)
    {
        // return view('assets.par.printPAR');
        $IcslipData = assetIcslip::with('assetIcslipItem')->findorFail($id);
        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];
        // dd($IcslipData);
        $pdf = PDF::loadView('assets.ics.printICS', compact('IcslipData'))->setPaper('Folio', 'portrait');
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

        $pdf = PDF::loadView('assets.data_capturing.vehicle.printvehicle')->setPaper('Folio', 'portrait');
        return $pdf->stream('VEHICLE.pdf');
    }

    public function printOfficeAssets()
    {
        $parData = assetPar::All();
        $IcslipData = assetIcslip::All();
   
        // dd($parData);
        // dd($IcslipData);

        // return view('assets.par.printPAR');
        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        $pdf = PDF::loadView('assets.data_capturing.officeAssets.printAssets', compact('parData', 'IcslipData'))->setPaper('Folio', 'portrait');
        return $pdf->stream('OFFICEASSETS.pdf');
    }

    public function printTurnover($id)
    {
        // dd($id);
        // $turnoverData = assetTurnover::whereId($id)->get();
        // $turnoverData = assetPar::with('assetParItem')->where('id', $id)->get();
        $turnoverData = assetParItem::with('assetPar')->where('asset_par_id', $id)->where('itemStatus', 1)->get();
        
        // $turnoverData->assetParItem->where('itemStatus', $id)->get();
        // if ($turnoverData->assetParItem->itemStatus == 1) {
        //     $parItem = 
        // } elseif ($turnoverData->ics_id != null) {
            
        // }
        // dd($turnoverData->first()->assetPar);
        // dd($dsa);

        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        $pdf = PDF::loadView('assets.turnover.printTurnover', compact('turnoverData'))->setPaper('Folio', 'portrait');
        return $pdf->stream('TURNOVER.pdf');
    }
}
