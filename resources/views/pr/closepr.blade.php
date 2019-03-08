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
   	  	@include('pr.prdatatable')
   	  </div>	
   	</div>
   </div>
 </div>
</div>

</div>
	
@endsection

@section('script')
<script src="{{asset('js/function-script.js')}}"></script>
<script src="{{asset('js/pr-script.js')}}"></script>
@endsection


