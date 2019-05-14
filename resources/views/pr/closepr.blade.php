@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Close Purchase Request</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Close Purchase Request</div>
 <div class="card-body">
   <div class="row">
   	<!-- table -->
   	<div class="col-md-12">
   	  <h6 class="card-title">Registered Purchase Request</h6>
   	  <div class="table-responsive">
   	  	<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-dark">
            <tr>
              <th data-priority="1">PR Code</th>
              <th data-priority="3">Purpose</th>
              <th data-priority="1">Status</th>
              <th data-priority="2">Date</th>
              <th data-priority="1" style="width: 100px;">Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach($prDT as $key => $pr)      
            <tr>
              <td>{{$pr->pr_code}}</td>
              <td>{{$pr->pr_purpose}}</td>
              <td>
                @if($pr->pr_status == 1)
                  Approved
                @else
                  Pending
                @endif
              </td>
              <td>{{Carbon\Carbon::parse($pr->created_at)->format('m-d-y')}}</td>
              <td>
                
                <a href="{{route('print.pr', $pr->id)}}" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-print"></i></a>

                @if ($pr->pr_status == 0 && $pr->prItem()->count() > 0)
                <a href="{{route('close.pr', $pr->id)}}" class="btn btn-sm btn-success"
                  data-popout="true"
                  data-toggle="confirmation" data-title="Are you sure?" 
                  data-btn-ok-label="Continue" data-btn-ok-class="btn-success"
                  data-btn-cancel-label="Cancel" data-btn-cancel-class="btn-danger"
                  data-content="Close PR # {{$pr->pr_code}}" data-placement="top"
                >
                  <i class="fas fa-check"></i>
                </a> 
                @endif
                <a href="{{route('pr.destroy', $pr->id)}}" class="btn btn-sm btn-danger">
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



