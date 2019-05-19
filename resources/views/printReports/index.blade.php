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
   	<div class="col-md-6">
   	  <h6 class="card-title">
  		Available Existing Assets per Signatory
        </h6>
      <div class="table-responsive">
        <table id="phyisicalReportsDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-light">
            <tr>
              <th>ID</th>
              <th>Signatory Name</th>
              <th>Position</th>
              <th data-priority = "4">Items</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($assetPar as $assetParItem)
                <tr>
                    <td>{{$assetParItem->id}}</td>
                    <td>{{$assetParItem->assignedTo}}</td>
                    <td>{{$assetParItem->position}}</td>
                    <td>
                        <button type="button" id="printPhysicalBtn" name="btn_assignItem"
                        class="btn btn-info btn-xs" data-toggle="modal"
                        data-target="#printReportsModal">View Items</button>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div> 
    </div>

   	<!-- table -->
   	<div class="col-md-6">
         <h6 class="card-title">Available Existing Motor Vehicles</h6>
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
          {{-- @foreach ($rfq as $rfq) --}}
          {{-- @endforeach --}}
          </tbody>
        </table>
         </div>
         <div class="col-md-12">&nbsp;</div>
         <div class="row">
                <div class="col-md-12">
                        <button id="searchName" class="btn btn-success float-right">Print Updated Inventory/Accounting of All Existing Motor Vehicles</button> 
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
                </div>
                <div class="form-group">
                    <hr style="height:5px; background-color:grey;">

                    <table id="modalTurnoverDatatable"
                        class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-light">
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
                        <select class="form-control form-control-sm float-right" id="asset_type_id">
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



