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
   	<div class="col-md-5">
   	  <h6 class="card-title">
  		Available Abstract
  	  </h6>
      <div class="table-responsive">
        <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>PR Code</th>
              <th>Date Cerated</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($pr as $pr)
              <tr>
                <td style="display: none;">{{$pr->id}}</td>
                <td>{{$pr->pr_code}}</td>
                <td>{{Carbon\Carbon::parse($pr->created_at)->format('m-d-y')}}</td>
              <td>
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal" name="abstractContent" id="abstractContent">
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
   	<div class="col-md-7">
   	  <h6 class="card-title">Registered Abstract of Quotation</h6>
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
          @foreach ($aoq as $aoq)
              <tr>
                <td>{{$aoq->id}}</td>
                <td>{{$aoq->purchaseRequest->pr_code}}</td>
                <td>{{Carbon\Carbon::parse($aoq->created_at)->format('m-d-y')}}</td>
              <td>
              <a href="{{route('supplier.show', $aoq->id)}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-th-list"></i>
              </a>
              <a href="#" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
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
            <form action="{{route('abstract.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                  <input type="hidden" name="pr_id" value="">
                  <label>Procurement Of:</label>
                  <input name="outline_detail" class="form-control" type="text" required>
                <div><br/>
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Submit</button>
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

      table.on('click', 'button#abstractContent', function () {
        var data = table.row( $(this).parents('tr') ).data();
        $('[name=pr_id]').val(data[0]);
        console.log(data[0]);
        
      })
  });
</script>
@endsection
