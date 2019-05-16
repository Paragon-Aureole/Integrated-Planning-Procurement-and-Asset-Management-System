@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item"><a href="{{route('view.modes')}}">Methods of Procurement</a></li>
  <li class="breadcrumb-item active" aria-current="page">Edit</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Methods of Procurement</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-4">
   	  <h6 class="card-title">
		Edit Method
	  </h6>
	  <form action="{{route('update.modes', $pm_data->id)}}" method="post" id="needs-validation" novalidate>
	  	{{csrf_field()}}
      {{ method_field('put') }}
	  	<div class="row">
		  	<div class="form-group col-md-12">
		  	  <label for="method_name" class="small">Method Name:</label>
		  	  <input class="form-control form-control-sm {{ $errors->has('method_name') ? 'is-invalid' : '' }}"
		  	  value="{{ old('method_name', $pm_data->method_name) }}" type="text" name="method_name" required="">
		  	  <div class="invalid-feedback"> 
	    		@if ($errors->has('method_name'))
            {{$errors->first('method_name')}}
          @else
            Method name is required.
          @endif   
          </div>
		  	</div>

		  	<div class="form-group col">
		  		<button type="submit" data-toggle="confirmation" class="btn btn-warning btn-sm">Update Method</button>
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

