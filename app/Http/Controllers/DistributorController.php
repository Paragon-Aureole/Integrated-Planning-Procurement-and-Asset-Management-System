<?php

namespace App\Http\Controllers;

use App\Distributor;
use App\Http\Requests\DistributorRequest;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class DistributorController extends Controller
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
       $dist_DT = Distributor::all();
       return view('distributors.adddist', compact('dist_DT'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistributorRequest $request)
    {
        $Record=new Distributor;
        $Record->distributor_name = $request->get('distributor_name');
        $Record->distributor_address = $request->get('distributor_address');
        $path = $request->file('distributor_certificate')->store('dist_cert');
        $Record->distributor_certificate = $path;
        $Record->save();
        return redirect()->back()->with('success', 'A new distributor has been added.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dist_DT = Distributor::all();
        $edit_dist = Distributor::findorFail($id);
        return view('distributors.updatedist', compact('dist_DT','edit_dist'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DistributorRequest $request, $id)
    {
        Storage::delete($request->get('cert_old'));
        $Record=Distributor::findorFail($id);
        $Record->distributor_name = $request->get('distributor_name');
        $Record->distributor_address = $request->get('distributor_address');
        $path = $request->file('distributor_certificate')->store('dist_cert');
        $Record->distributor_certificate = $path;
        $Record->save();
        return redirect()->back()->with('success', 'The distributor has been updated.'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distributor = Distributor::findorFail($id);
        $delete_file = Storage::delete($distributor->distributor_certificate);
        $distributor->delete();
        return redirect()->route('view.dist')->with('info', 'The distributor has been deleted.'); 
    }
}
