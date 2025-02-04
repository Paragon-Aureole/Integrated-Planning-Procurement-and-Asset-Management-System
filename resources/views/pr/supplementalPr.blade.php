@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Supplemental Purchase Request</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Supplemental Purchase Request</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-6">
   	  <h6 class="card-title">
  		Available Purchase Request
  	  </h6>
      <div class="table-responsive">
        <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-light">
            <tr>
              <th>PR Code</th>
              <th>Purpose</th>
              <th>Date Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pr as $pr)
                <tr>
                  <td>{{$pr->pr_code}}</td>
                  <td>{{$pr->pr_purpose}}</td>
                  <td>{{Carbon\Carbon::parse($pr->created_at)->format('m-d-y')}}</td>
                <td>
                  <a href="{{route('pr.addSupplemental', $pr->id)}}" class="btn btn-sm btn-primary" data-toggle="confirmation" data-content="Create Supplemental PR under {{$pr->pr_code}}">
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
   	<div class="col-md-6">
   	  <h6 class="card-title">Registered Supplemental Purchase Requests</h6>
   	  <div class="table-responsive">
   	  	<table id="suppdatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-light">
            <tr>
              <th>Supplemental PR Code</th>
              <th>Supplemented Items</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($supplemental as $sup_pr)
              <tr>
                  @php
                      $firstTwo = $sup_pr->prItem->take(2);
                  @endphp
                <td>{{$sup_pr->pr_code}}</td>
                <td>
                    @foreach ($firstTwo as $item)
                        {{$item->ppmpItem->item_description}} @if ($firstTwo->count() > 1) , @endif 
                    @endforeach
                    {{-- Item 1, Item 2 --}}
                </td>
                <td>
                    <a href="{{route('view.pritm', $sup_pr->id)}}" class="btn btn-sm btn-info" title="Add PR Items"><i class="fas fa-th-list"></i></a>
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
        $('#suppdatatable').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
        });
    } );
</script>
@endsection



