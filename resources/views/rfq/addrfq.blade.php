@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">RFQ</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Reqeust for Quotation</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-5">
   	  <h6 class="card-title">
  		Available Purchase Request
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
                <tr>
                  <td>{{$pr->pr_code}}</td>
                  <td>{{Carbon\Carbon::parse($pr->created_at)->format('m-d-y')}}</td>
                <td>
                  <a href="{{route('rfq.createone', $pr->id)}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i>
                  </a>
                </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div> 
    </div>

   	<!-- table -->
   	<div class="col-md-7">
   	  <h6 class="card-title">Registered Request for Quotation</h6>
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
          @foreach ($rfq as $rfq)
              <tr>
                <td>{{$rfq->id}}</td>
                <td>{{$rfq->purchaseRequest->pr_code}}
                <td>{{Carbon\Carbon::parse($rfq->created_at)->format('m-d-y')}}</td>
                <td>
                    <a href="{{route('rfq.print', $rfq->id)}}" target="_blank" class="btn btn-sm btn-secondary">
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



