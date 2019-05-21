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
              <th>Transaction Details</th>
              <th>Office</th>
              <th data-priority = "4">Items</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($assetPar as $assetParItem)
                <tr>
                    <td>{{$assetParItem->assignedTo}}</td>
                    <td>{{$assetParItem->position}}</td>
                    <td>
                      @foreach ($assetParItem->assetParItem->take(2) as $itemDescription)
                      ||{{$itemDescription->description}}||
                      @endforeach
                    </td>
                    <td>{{$assetParItem->purchaseOrder->purchaseRequest->office->office_code}}</td>
                    <td>
                      <div class="float-right">
                        <a class="btn btn-sm btn-success" href="/printPhysicalForm/{{$assetParItem->assignedTo}}/{{$assetParItem->position}}/2" target="_blank">Office Supplies</a>
                        <a class="btn btn-sm btn-success" href="/printPhysicalForm/{{$assetParItem->assignedTo}}/{{$assetParItem->position}}/3" target="_blank">Furniture and Fixtures</a>
                        <a class="btn btn-sm btn-success" href="/printPhysicalForm/{{$assetParItem->assignedTo}}/{{$assetParItem->position}}/4" target="_blank">IT Equipmets</a>
                      </div>
                    </td>
                </tr>
            @endforeach

            @foreach ($assetPar as $assetParItem)
              @foreach ($capturedAsset as $capturedAssetItem)
                @if (($assetParItem->assignedTo) == ($capturedAssetItem->receiver_name))

                @elseif (($assetParItem->assignedTo) != ($capturedAssetItem->receiver_name))
                  <tr>
                      <td>{{$capturedAssetItem->receiver_name}}</td>
                      <td>{{$capturedAssetItem->receiver_position}}</td>
                      <td>{{$capturedAssetItem->receiver_position}}</td>
                      <td>{{$capturedAssetItem->Office}}</td>
                      <td>    
                          <div class="float-right">
                            <a class="btn btn-sm btn-success" href="/printPhysicalForm/{{$assetParItem->assignedTo}}/{{$assetParItem->position}}/2" target="_blank">Office Supplies</a>
                            <a class="btn btn-sm btn-success" href="/printPhysicalForm/{{$assetParItem->assignedTo}}/{{$assetParItem->position}}/3" target="_blank">Furniture and Fixtures</a>
                            <a class="btn btn-sm btn-success" href="/printPhysicalForm/{{$assetParItem->assignedTo}}/{{$assetParItem->position}}/4" target="_blank">IT Equipmets</a>
                          </div>
                          {{--  <a href="{{route('assets.printPar', $assetParItem->id)}}" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-print"></i></a>   --}}
                      
                    </td>
                  </tr>
                @endif
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div> 
    </div>

   	<!-- table -->
   	<div class="col-md-5">
         <h6 class="card-title">Available Existing Motor Vehicle</h6>
        <hr style="height:5px; background-color:grey">
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
          {{-- {{$assetItem->asset_par->first()->created_at}} --}}
            <tr>
              <td>{{$assetItem->asset_par->first()->created_at}}</td>
              <td>{{$assetItem->amount}}</td>
              <td>{{$assetItem->purchaseOrder->purchaseRequest->office->office_code}}</td>
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

<!-- The Modal -->
<div class="modal" id="printReportsModal">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5>Available Assets per Signatory</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label>Signatory Name:</label>
                    <input id="signatoryName" class="form-control" type="text" disabled>
                    <input id="position" class="form-control" type="text" disabled>
                    <input id="signatoryId" class="form-control" type="text" hidden>
                </div>
                <div class="form-group">
                    <hr style="height:5px; background-color:grey;">

                    <table id="modalTurnoverDatatable"
                        class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-light">
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="col-md-12">&nbsp</div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control form-control-sm float-right" >
                            <option value="">Select Type to Print</option>
                            <option value="2">Office Supplies   </option>
                            <option value="3">Furniture and Fixtures</option>
                            <option value="4">IT Equipmets</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button type="button" id="SubmitPrintPhysical" name="btn_assignItem"
                        class="btn btn-success btn-sm">Print Report of the Physical Count of Property, Plant and Equipment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('js/printReports.js')}}"></script>
@endsection



