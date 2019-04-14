<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\asset;
use App\assetDistributionFormCreator;

class assetDistributionFormCreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('assetDistributionFormCreator.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $countPAR = count(asset::Where('isPAR', '1'));
        $fetchedDataPAR = asset::Where('isPAR', '1');
        // dd($countPAR);
        // dd($fetchedData);
        // dd($request->selectedOption);
        $selectedOption = $request->selectedOption;
        if ($selectedOption == "Supply") {
            // echo 'Supply found';
            $fetchedData = asset::Where('isSup', '1')->get();
        } elseif ($selectedOption == "ICS") {
            // echo 'ICS found';
            $fetchedData = asset::Where('isICS', '1')->get();
        } else {
            // echo 'PAR found';
            $fetchedData = asset::Where('isPAR', '1')->get();
        }
        return view('assetDistributionFormCreator.create', compact('fetchedData', 'countPAR', 'fetchedDataPAR'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd( count( $request->get('id') ) );

        
        $sortedArray = [];

        $PAR_id = $request->get('countPAR');
        $assets_id = $request->get('id');
        $isProvisioned = $request->get('isProvisioned');
        $inputSignatory = $request->get('inputSignatory');

        for ($i=0; $i < count($request->get('id')); $i++) { 
            $sortedArray[$i] = [$PAR_id, $assets_id[$i], $inputSignatory, $isProvisioned[$i]];
        }
        // dd($sortedArray);
        foreach ($sortedArray as $key => $value) {
            // dd($value[2]);
            assetDistributionFormCreator::create([
                'PAR_id' => $value[0],
                'assets_id' => $value[1],
                'inputSignatory' => $value[2],
                'isProvisioned' => $value[3]
            ]);
        }

        return redirect()->back()->with('success', 'Provisions Taken');
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
