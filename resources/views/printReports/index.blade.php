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
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" id="signatory_name" placeholder="Signatory Name" class="form-control">
                    <input type="text" id="signatory_name" placeholder="Position" class="form-control">
                    <div class="input-group-prepend">
                        <button id="searchName" class="input-group-text">Search Signatory and Position</button>
                    </div>
                </div>
            </div>
        </div>
        <hr style="height:5px; background-color:grey">
      <div class="table-responsive">
        <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-dark">
            <tr>
              <th>Signatory Name</th>
              <th>Position</th>
              <th>Items</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {{-- @foreach ($pr as $pr) --}}
                <tr>
                    <td>Ramon Pacleb</td>
                    <td>Admin Aide XIVII</td>
                    <td>
                        <button type="button" id="turnoverButton" name="btn_assignItem"
                        class="btn btn-info btn-xs" data-toggle="modal"
                        data-target="#printReportsModal">View Items</button>
                    </td>
                    <td>
                    <a href="#" class="btn btn-sm btn-success"><i class="fas fa-print"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>Tedd Mamuyac</td>
                    <td>Admin Aide XIVIXXI</td>
                    <td>
                        <button type="button" id="turnoverButton" name="btn_assignItem"
                        class="btn btn-info btn-xs" data-toggle="modal"
                        data-target="#printReportsModal">View Items</button>
                    </td>
                    <td>
                    <a href="#" class="btn btn-sm btn-success"><i class="fas fa-print"></i></a>
                    </td>
                </tr>
            {{-- @endforeach --}}
          </tbody>
        </table>
      </div> 
    </div>

   	<!-- table -->
   	<div class="col-md-6">
         <h6 class="card-title">Available Existing Motor Vehicle</h6>
         <div class="row">
            <div class="col-md-12">
                    <button id="searchName" class="btn btn-success container-fluid">Print Updated Inventory/Accounting of All Existing Motor Vehicles</button> 
            </div>
        </div>
        <hr style="height:5px; background-color:grey">
   	  <div class="table-responsive">
   	  	<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-dark">
            <tr>
              <th>Acquisition Date</th>
              <th>Acquisition Cost</th>
              <th>Office </th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          {{-- @foreach ($rfq as $rfq) --}}
              <tr>
                <td>08-26-2010</td>
                <td>5,000,000.00</td>
                <td>ADM</td>
                <td>Active</td>
              </tr>
          {{-- @endforeach --}}
          </tbody>
        </table>
   	  </div>	
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
                    <input id="prCode" class="form-control" type="text" disabled>
                </div>
                <div class="form-group">
                    <hr style="height:5px; background-color:grey;">

                    <table id="modalTurnoverDatatable"
                        class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-dark">
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Laptop</td>
                                <td><textarea style="border:none;" name="" id="" cols="90" rows="2"
                                        readonly>A</textarea></td>
                                <td>
                                    Active
                                </td>
                            </tr>
                            <tr>
                                <td>Laptop</td>
                                <td><textarea style="border:none;" name="" id="" cols="90" rows="2"
                                        readonly>B</textarea></td>
                                <td>
                                    Unserviceable
                                </td>
                            </tr>
                            <tr>
                                <td>Laptop</td>
                                <td><textarea style="border:none;" name="" id="" cols="90" rows="2"
                                        readonly>C</textarea></td>
                                <td>
                                    Unserviceable
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-12">&nbsp</div>
                    <button type="button" id="SubmitTurnover" name="btn_assignItem"
                        class="btn btn-success btn-xs float-right">Print Report of the Phyisacal Count of Property, Plant and Equipment</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
        $('#prDatatable').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
        });
    } );
</script>
@endsection



