@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Abstract</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Abstract of Quotation</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-6">
   	  <h6 class="card-title">
  		Available Purchase Requests
  	  </h6>
      <div class="table-responsive">
        <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-dark">
            <tr>
              {{-- <th>ID</th> --}}
              <th>PR Code</th>
              <th>Purpose</th>
              <th>Date Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($pr as $pr)
              <tr>
                {{-- <td style="display: none;">{{$pr->id}}</td> --}}
                <td>{{$pr->pr_code}}</td>
                <td>{{$pr->pr_purpose}}</td>
                <td>{{Carbon\Carbon::parse($pr->created_at)->format('m-d-y')}}</td>
              <td>
              <button type="button" class="btn btn-sm btn-primary" data-prcode="{{$pr->pr_code}}" data-prid="{{$pr->id}}" data-prpurpose="{{$pr->pr_purpose}}" data-toggle="modal" data-target="#myModal" name="abstractContent">
                    <i class="fas fa-plus"></i>
                </button>
              </td>
              </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>

   	<!-- table -->
   	<div class="col-md-6">
   	  <h6 class="card-title">Registered Abstract of Quotation</h6>
   	  <div class="table-responsive">
   	  	<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-dark">
            <tr>
              {{-- <th>ID</th> --}}
              <th>Code</th>
              <th>Purpose</th>
              <th>Date Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($aoq as $aoq)
              <tr>
                <td>{{$aoq->purchaseRequest->pr_code}}</td>
                <td>{{$aoq->purchaseRequest->pr_purpose}}</td>
                <td>{{Carbon\Carbon::parse($aoq->created_at)->format('m-d-y')}}</td>
              <td>
              <a href="{{route('supplier.show', $aoq->id)}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-th-list"></i>
              </a>

              @if($aoq->outlineSupplier()->count() > 0)
              <a href="{{route('abstract.print', $aoq->id)}}" target="_blank" class="btn btn-sm btn-success">
                  <i class="fas fa-print"></i>
              </a>
              @endif
              @can('full control')
              <a href="#" class="btn btn-sm btn-danger">
                    <i class="fas fa-minus"></i>
              </a>
              @endcan
              </td>
              </tr>
          @endforeach
          </tbody>
        </table>
   	  </div>
     </div>
     
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h5>Add Abstract of Quotation</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
            <form action="{{route('abstract.store')}}" method="POST" class="needs-validation" novalidate>
                {{ csrf_field() }}
                <input type="hidden" name="pr_id" value="">
                <div class="form-group">
                    <label>PR Code:</label>
                    <input id="prCode" class="form-control" type="text" disabled>
                <div>
                <div class="form-group">
                    <label>PR Purpose:</label>
                    <input id="prPurpose" class="form-control" type="text" disabled>
                <div>
                <div class="form-group">
                    <span class="text-danger">*</span><label>Procurement Of:</label>
                  <textarea name="outline_detail" class="form-control" required></textarea>
                <div><br/>
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Create Abstract of Quotation</button>
                </div>
              </form>
            </div>
          </div>
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
      var table =  $('#prDatatable').DataTable({
              responsive: true,
              "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
      });

      // table.on('click', 'button#abstractContent', function () {
      //   var data = table.row( $(this).parents('tr') ).data();
      //   $('[name=pr_id]').val(data[0]);
      //   console.log(data[0]);
        
      // })

      $("button[name='abstractContent']").click(function() {
        var pr_id = $(this).attr('data-prid');
        var pr_code = $(this).attr('data-prcode');
        var pr_purpose = $(this).attr('data-prpurpose');

        console.log(pr_id);

        

        $("input[name='pr_id']").val(pr_id);
        $("#prCode").val(pr_code);
        $("#prPurpose").val(pr_purpose);
        
      });
  });
</script>
@endsection
