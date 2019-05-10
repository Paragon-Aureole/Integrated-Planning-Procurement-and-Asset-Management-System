@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Methods of Procurement</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2"><i class="fas fa-container-storage"></i> Methods of Procurement</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-4">
   	  <h6 class="card-title">
		Add Method
	  </h6>
	  <form action="{{route('add.modes')}}" method="post" id="needs-validation" novalidate>
	  	{{csrf_field()}}
	  	<div class="row">
        <div class="form-group col-md-12">
          <label for="method_code" class="small">Method Code:</label>
          <input class="form-control form-control-sm {{ $errors->has('method_code') ? 'is-invalid' : '' }}"
          value="{{ old('method_code') }}" type="text" name="method_code" required="">
          <div class="invalid-feedback"> 
          @if ($errors->has('method_code'))
            {{$errors->first('method_code')}}
          @else
            Method name is required.
          @endif   
          </div>
        </div>
		  	<div class="form-group col-md-12">
		  	  <label for="method_name" class="small">Method Name:</label>
		  	  <input class="form-control form-control-sm {{ $errors->has('method_name') ? 'is-invalid' : '' }}"
		  	  value="{{old('method_name')}}" type="text" name="method_name" required="">
		  	  <div class="invalid-feedback"> 
	    		@if ($errors->has('method_name'))
            {{$errors->first('method_name')}}
          @else
            Method name is required.
          @endif   
          </div>
		  	</div>

		  	<div class="form-group col">
		  		<button type="submit" class="btn btn-primary btn-sm">Add Method</button>
		  	</div>

	  	</div>
	  </form>
   	</div>

   	<!-- table -->
   	<div class="col-md-8">
   	  <h6 class="card-title">Registered Methods</h6>
   	  <div class="table-responsive">
   	  	@include('procurement_method.pmdatatable')
   	  </div>	
   	</div>
   </div>
 </div>
</div>

</div>
@endsection

