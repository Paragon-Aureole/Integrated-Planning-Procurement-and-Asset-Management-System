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
use App\AssetIcslipItem;
use App\assetTurnover;
use App\assetTurnoverItem;

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
        // $assetData = asset::where('id', 4)->get();
        // dd($assetData->first()->purchaseOrder->purchaseRequest->office->id);

        // $assetIcsItems = asset::where('isICS', 1)->where('item_stock', "<>", 0)->where('purchase_order_id', 1)->get();
        // dd($assetIcsItems);
        
        // dd($icsSignatory);
        
        // $asset = purchaseRequest::where('created_inspection', 1)->get();
        // $assetPar = assetPar::All();
        $asset = asset::All();
        $assetIcs = asset::select('purchase_order_id')->where('isICS', 1)->groupBy('purchase_order_id')->get();
        // dd($assetIcs);

        // $prOfficeId = $asset->first()->purchaseOrder->purchaseRequest->office->id;
        // // dd($prOfficeId);
        // $icsSignatory = App\Signatory::where(['office_id' => 1, 'is_activated' => 1])->first();
        // dd($asset);
        // $pr = PurchaseRequest::findorFail(1);
        // $pr_code = explode("-", $pr->pr_code);
        
        // $ppmp= Ppmp::where('office_id', $pr->office_id)->where('ppmp_year', $pr_code[2])->first();
        // $ppmp_item = $ppmp->ppmpItem->all();

        // dd($ppmp_item);
        // dd($data);
        return view('assets.index', compact('asset', 'assetIcs'));
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
        } else {
            $asset = asset::whereHas('purchaseOrder.purchaseRequest', function ($query) {
                $query->where('office_id', Auth::user()->office_id);
            })->get();

            $assetPar = assetPar::whereHas('purchaseOrder.purchaseRequest', function ($query) {
                $query->where('office_id', Auth::user()->office_id);
            })->get();

            $assetIcs = assetIcslip::whereHas('purchaseOrder.purchaseRequest', function ($query) {
                $query->where('office_id', Auth::user()->office_id);
            })->get();
        }
        

        return view('assets.viewDistributed', compact('asset', 'assetPar', 'assetIcs'));
    }

    public function getClassificationModalData(Request $request)
    {
        $input = $request->all();

        $ClassificationModalContent = asset::where('purchase_order_id', $input['po_id'])
        ->where('isICS', 0)
        ->where('isPAR', 0)
        ->where('isEditable', 0)
        ->get();

        return response()->json(['ClassificationModalContent'=>$ClassificationModalContent]);
    }

    public function getAssetData(Request $request)
    {
        $input = $request->all();

        $assetData = asset::where('id', $input['asset_id'])->get();
        $office_id = $assetData->first()->purchaseOrder->purchaseRequest->office->id;
        $icsSignatory = App\Signatory::where(['office_id' => $office_id, 'is_activated' => 1])->first();
        $icsSignatoryName = $icsSignatory->signatory_name;
        $icsSignatoryPosition = $icsSignatory->signatory_position;

        return response()->json(['assetData' => $assetData, 'signatoryName' => $icsSignatoryName, 'signatoryPosition' => $icsSignatoryPosition]);
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
        // $input = $request->except(['_token','_method']);
        // dd($input);

        // dd($request->all());
        
        if (count(DisbursementVoucher::where('disbursementNo', $request->voucherNo)->get()) > 0) {
            return redirect()->back()->with('error', 'Disbursement Voucher Exists!');
        }
        DisbursementVoucher::create([
            'purchase_order_id' => $request->po_id,
            'disbursementNo' => $request->voucherNo
        ]);
        

        $sortedArray = [];
        $PAR = [];
        $ICS = [];
        $assetCount = asset::where('purchase_order_id', $request->po_id)
        ->where('isICS', 0)
        ->where('isPAR', 0)
        ->where('isEditable', 0)
        ->get()->count() - 1;

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
        $items = $request->all();
        // dd($items);

        $newAssetPar = assetPar::create([
            'purchase_order_id' => $items['po_number'],
            'assignedTo' => $items['signatory'],
            'position' => $items['position']
        ]);

        // dd($newAssetPar);

        $filteredData = [];

        
        foreach ($items['itemQuantity'] as $key => $value) {
            for ($i=0; $i < $value; $i++) {
                $filteredData[$key][] = [
                    'itemPropertyNo' => $items['itemPropertyNo'][$key],
                    'itemDateAcquired' => $items['itemDateAcquired'][$key],
                    'itemExtraDescription' => $items['itemExtraDescription'][$key][$i],
                    'itemStatus' => 0,
                    'quantity' => 1,
                    'asset_par_id' => $newAssetPar->id
                    // 'asset_id' => $key
                    ];
            }
        }
        
        // dd($filteredData);

        foreach ($filteredData as $key => $value) {
            foreach ($value as $key2 => $value2) {

                AssetParItem::create([
                     'asset_par_id' => $value2['asset_par_id'],
                     'asset_id' => $key,
                     'description' => $value2['itemExtraDescription'],
                     'date_acquired' => $value2['itemDateAcquired'],
                     'itemStatus' => 0,
                     'quantity' => 1,
                     'property_no' => $value2['itemPropertyNo']
                 ]);

                // echo $key;
                // print_r($value2['asset_par_id']);
                // echo "<br>";
            }
        }
        // die();

        foreach ($items['itemQuantity'] as $key => $value) {
            asset::find($key)->decrement('item_stock', $value);
        }

        return redirect()->route('parDistribution.index')->with('success', 'PAR Distribution Complete. Proceed to Printing');

        // if ($request->isMethod('post')) {
        //     // return response()->json(['response' => 'This is post method', 'error' => false]);
        //     return response()->json(['response' => 'Save Success', 'error' => false, 'data' => $items]);
        // } else {
        //     return response()->json(['response' => 'failure']);
        // }
    }
    public function saveNewIcs(Request $request)
    {
        $items = $request->all();
        // dd($items);

        $newAssetIcslip = assetIcslip::create([
            'purchase_order_id' => $items['poNum']
        ]);

        // dd($newAssetIcslip);

        $filteredData = [];

        foreach ($items['itemQuantity'] as $key => $value) {
            $filteredData[$key][] = $value;
        }

        foreach ($items['itemExtraDescription'] as $key => $value) {
            $filteredData[$key][] = $value;
        }

        foreach ($items['itemInventoryNo'] as $key => $value) {
            $filteredData[$key][] = $value;
        }

        foreach ($items['itemEstimatedUsefulLife'] as $key => $value) {
            $filteredData[$key][] = $value;
        }

        

        // dd($filteredData);

        foreach ($filteredData as $key => $value) {
            assetIcslipItem::create([
                'asset_icslip_id' => $newAssetIcslip->id,
                'asset_id' => $key,
                'quantity' => $value[0],
                'description' => $value[1],
                'assignedTo' => $items['itemSignatoryName'],
                'position' => $items['itemSignatoryPosition'],
                'inventory_name_no' => $value[2],
                'useful_life' => $value[3]
            ]);

            asset::find($key)->decrement('item_stock', $value[0]);
        }

        // dd(print_r($items));

        // $bekkel = [];
        // for ($i=0; $i < count($items[2]); $i++) {
        //     // $bekkel[] = ['id' => $items[0], 'description' => $items[2][$i]];
            
        //     AssetIcslipItem::create([
        //             'asset_icslip_id' => $items[6],
        //             'description' => $items[2][$i]
        //         ]);
        // }

        // dd($bekkel);

        // if ($request->isMethod('post')) {
        //     // return response()->json(['response' => 'This is post method', 'error' => false]);
        //     return response()->json(['response' => 'Save Success', 'error' => false, 'data' => $items]);
        // } else {
        //     return response()->json(['response' => 'failure']);
        // }

        return redirect()->route('assets.index')->with('success', 'ICS Assigned. Proceed to Printing');
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

    // public function displayRegisteredPOItems($id)
    // {
    //     $fetchedData = asset::Where('PO_id', $id)->get();
    //     // $fetchedData = asset::all();
    //     // dd($fetchedData);

    //     return view('assets.listRegisteredPOItems',compact('fetchedData'));

    // }

    public function printPar($id)
    {
        // $parData = assetParItem::with('assetParItem')->findorFail($id);
        $parData = assetParItem::where('asset_par_id', $id)->get();
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
        // $ics = asset::find($id);
        $IcslipData = assetIcslipItem::where('asset_icslip_id', $id)->get();

        // dd($IcslipData);
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
        $assetData = asset::where('asset_type_id', 1)->get();
        // dd($assetData);
        // return view('assets.par.printPAR');
        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        $pdf = PDF::loadView('assets.data_capturing.vehicle.printvehicle', compact('assetData'))->setPaper('Folio', 'landscape');
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
        $turnoverData = assetTurnoverItem::where('asset_turnover_id', $id)->get();
        // dd($turnoverData);
        // dd($turnoverData->first()->assetTurnoverItem->first()->assetParItem);

        $options = [
            'margin-top'    => 10,
            'margin-right'  => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
        ];

        $pdf = PDF::loadView('assets.turnover.printTurnover', compact('turnoverData'))->setPaper('Folio', 'portrait');
        return $pdf->stream('TURNOVER.pdf');
    }

    public function requestEdit(Request $request)
    {
        $input = $request->all();
        $user = asset::findorFail($input['itemId']);
        // dd($input['classificationNo']);
        
        $editRequest = asset::where('id', $input['itemId'])->update([
            'isRequested' => 1,
            'isEditable' => 0
        ]);

        if ($input['classificationNo'] == 0) {
            activity('ICS Edit Request')
            ->performedOn($user)
            ->withProperties(['Reason' => $input['reason']])
            ->log('Request to Edit an Item');
        } elseif ($input['classificationNo'] == 1) {
            activity('PAR Edit Request')
            ->performedOn($user)
            ->withProperties(['Reason' => $input['reason']])
            ->log('Request to Edit an Item');
        }

        return redirect()->back()->with('succes', 'Requested, Pls Wait for the GSO Supervisor to Approved your Request');
    }

    public function acceptEdit($id)
    {
        // $input = $request->all();
        
        $editRequest = asset::where('id', $id)->update([
            'isICS' => 0,
            'isPAR' => 0,
            'asset_type_id' => null,
            'isEditable' => 0,
        ]);
        return redirect()->back()->with('succes', 'Item Approved to edit');
    }

    public function cancelEdit($id)
    {
        // dd($id);
        
        $editRequest = asset::where('id', $id)->update([
            'isRequested' => 0,
        ]);

        return redirect()->back()->with('succes', 'Item Approved to edit');
    }

    public function printIcsData(Request $request)
    {
        $input = $request->all();
        $icsData = assetIcslip::where('asset_id', $input['item_ics'])->get();

        return response()->json(['icsData'=>$icsData]);
    }


    // NEW LIST OF FUNCTIONS

    public function icsTransaction($id)
    {
        $assetIcsItems = asset::where('isICS', 1)->where('item_stock', "<>", 0)->where('purchase_order_id', $id)->get();
        // dd($assetIcsItems);
        if ($assetIcsItems->isEmpty()) {
            return redirect()->route('assets.index')->with('error', 'No ICS items left in this PO!');
        }
        $signatoryData = $assetIcsItems->first()->purchaseOrder->purchaseRequest->office->signatory()->where('is_activated', 1)->first();
        // dd($signatoryData);
        
        return view('assets.icsTransaction', compact('assetIcsItems', 'id', 'signatoryData'));
    }

    public function displayIcsTransactions($id)
    {
        // dd($id);
        $assetIcsItem = assetIcslipItem::where('asset_icslip_id', $id)->get();
        // dd($assetIcs->first()->AssetIcslipItem);
        
        return view('assets.ics.index', compact('assetIcsItem', 'id'));
    }

    public function parTransaction($id)
    {
        // dd('wew');
        $parCount = (int) assetPar::count() + 1;
        // dd($parCount);
        $assetParItems = asset::where('isPAR', 1)->where('item_stock', "<>", 0)->where('purchase_order_id', $id)->get();
        // dd($assetParItems);
        if ($assetParItems->isEmpty()) {
            return redirect()->route('assets.index')->with('error', 'No PAR items left in this PO!');
        }

        // dd($signatoryData);
        
        return view('assets.par.parTransaction', compact('assetParItems', 'id', 'parCount'));
    }
}
