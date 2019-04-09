@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Inspection Report</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Inspection Report</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-5">
   	  <h6 class="card-title">
  		Available Inspection Reports
  	  </h6>
      <div class="table-responsive">
        <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-dark">
            <tr>
              <th>PR Code</th>
              <th>Date Cerated</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pr as $pr)
                @if ($pr->created_inspection == 0)
                <tr>
                    <td>{{$pr->pr_code}}</td>
                    <td>{{Carbon\Carbon::parse($pr->created_at)->format('m-d-y')}}</td>
                    <td>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">
                          <i class="fas fa-plus"></i>
                    </button>
                    </td>
                </tr>

                @else

                @endif
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

   	<!-- table -->
   	<div class="col-md-7">
   	  <h6 class="card-title">Registered Inpection Reports</h6>
   	  <div class="table-responsive">
   	  	<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>Code</th>
              <th>Date </th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($ir as $ir)
                <tr>
                  <td>{{$ir->id}}</td>
                  <td>{{$pr->pr_code}}</td>
                  <td>{{Carbon\Carbon::parse($ir->created_at)->format('m-d-y')}}</td>
                  <td>
                      <a href="#" class="btn btn-sm btn-secondary">
                        <i class="fas fa-print"></i>
                      </a>
                      <a href="#" class="btn btn-sm btn-danger">
                        <i class="fas fa-minus"></i>
                      </a>
                  </td>
                </tr>
            @endforeach
          </tbody>
        </table>
   	  </div>
   	</div>
   </div>
 </div>
</div>

</div>

{{-- MODAL --}}
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h5>Purchase Order Form Details</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
  
          <div class="modal-body">
              <form action="{{route('ir.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-6">

                    @foreach ($po as $po)
                        @if ($pr->id == $po->purchase_request_id)
                            @foreach ($os as $os)
                                @if ($po->outline_supplier_id == $os->id)
                                    
                                @endif
                            @endforeach
                            {{-- {{$po->purchase_request_id}} --}}
                        @endif
                        
                    @endforeach 

                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Supplier</span>
                        </div>
                        <input type="text" name="purchase_request_id" value="{{$pr->id}}" hidden>
                        <input type="text" name="user_id" value="{{$pr->user_id}}" hidden>
                            <input type="text" value="{{$os->supplier_name}}" name="supplierName" class="form-control" disabled>
                    </div>
                    <br>  
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">PO No.</span>
                        </div>
                        <input type="text" value="{{$po->id}}" name="poNumber" class="form-control" disabled>
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Requisioning Office/Dpt</span>
                        </div>

                        @foreach ($office as $office)
                        @if ($pr->office_id == $office->id)
                        <input type="text" value="{{$office->office_code}}" name="tinNumber" class="form-control" disabled>
                            
                        @endif
                            
                        @endforeach

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Invoice No.</span>
                        </div>
                        <input type="text" name="invoiceNo" class="form-control" required>
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Property Officer</span>
                        </div>
                          <select class="custom-select" name="property_officer">
                            @foreach ($signatory as $signatory)
                              @if ($signatory->category == 6 || $signatory->category == 7)
                                @if ($signatory->is_activated == 1)
                                <option value="{{$signatory->id}}">{{$signatory->signatory_name}}</option>
                                @endif
                                  
                              @endif
                            @endforeach
                          </select>
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Inspection Officer</span>
                        </div>
                        <input type="text" name="inspection_officer" class="form-control" required>
                    </div>
                  </div>
                </div>
                <br>
                <input type="submit" value="Submit">
              </form>
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
