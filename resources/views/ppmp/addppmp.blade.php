@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">PPMP</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2"><i class="fas fa-table"></i> Project Procurement Management Plan</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-4">
   	  <h6 class="card-title">
  		Add PPMP
  	  </h6>
	  
   	</div>

   	<!-- table -->
   	<div class="col-md-8">
   	  <h6 class="card-title">Registered PPMP</h6>
   	  <div class="table-responsive">
   	  	@include('ppmp.ppmpdatatable')
   	  </div>	
   	</div>
   </div>
 </div>
</div>

</div>
	
@endsection


