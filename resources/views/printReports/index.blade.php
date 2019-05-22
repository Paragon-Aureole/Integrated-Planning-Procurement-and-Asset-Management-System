@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Print Reports</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Print Reports</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-7">
   	  <h6 class="card-title">
  		Available Existing Assets per Signatory
        </h6>
      <div class="table-responsive">
        <table id="phyisicalReportsDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-light">
            <tr>
              <th>Signatory Name</th>
              <th>Position</th>
              <th>Office</th>
              <th data-priority = "4">Items</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($assetPar as $assetParItem)
                <tr>
                    <td>{{$assetParItem->assignedTo}}</td>
                    <td>{{$assetParItem->position}}</td>
                    <td>{{$assetParItem->purchaseOrder->purchaseRequest->office->office_code}}</td>
                    <td>
                        <a class="btn btn-sm btn-success" href="/printPhysicalForm/{{$assetParItem->assignedTo}}/{{$assetParItem->position}}/{{$assetParItem->purchaseOrder->purchaseRequest->office->id}}" target="_blank"><i class="fas fa-print"></i></a>
                    </td>
                </tr>
            @endforeach

            {{-- checking of captured assets --}}
            @foreach ($capturedAsset as $capturedAssetItem)
              <tr>
                  <td>{{$capturedAssetItem->receiver_name}}</td>
                  <td>{{$capturedAssetItem->receiver_position}}</td>
                  <td>{{$capturedAssetItem->Office->office_code}}</td>
                  <td>    
                      <a class="btn btn-sm btn-success" href="/printPhysicalFormCaptured/{{$capturedAssetItem->receiver_name}}/{{$capturedAssetItem->receiver_position}}/{{$capturedAssetItem->Office->id}}" target="_blank"><i class="fas fa-print"></i></a>                   
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div> 
    </div>

    {{-- Table of vehicle --}}
   	<div class="col-md-5">
         <h6 class="card-title">Available Existing Motor Vehicle</h6>
   	  <div class="table-responsive">
   	  	<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-light">
            <tr>
              <th>Acquisition Date</th>
              <th>Acquisition Cost</th>
              <th>Office </th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($asset as $assetItem)
            <tr>
              <td>{{$assetItem->asset_par->first()->created_at}}</td>
              <td>{{$assetItem->amount}}</td>
              <td>{</td>
              <td>{{$assetItem->asset_type->type_name}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
         </div>
         <div class="col-md-12">&nbsp;</div>
         <div class="row">
                <div class="col-md-12">
                  <a href="/printVehicle" target="_blank"  id="SubmitPrintPhysicalVehicle" name="btn_assignItem" class="btn btn-success float-right">Print Updated Inventory/Accounting of All Existing Motor Vehicles</a> 
                </div>
            </div>
            {{-- <hr style="height:5px; background-color:grey">	 --}}
   	</div>
   </div>
 </div>
</div>

</div>
@endsection

@section('script')
    <script src="{{asset('js/printReports.js')}}"></script>
@endsection



