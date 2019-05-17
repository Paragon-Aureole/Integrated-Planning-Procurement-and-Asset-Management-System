@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item"><a href="{{route('view.units')}}">Units of Measurement</a></li>
  <li class="breadcrumb-item active" aria-current="page">Update</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Units of Measurement</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-4">
   	<h6 class="card-title">Add Unit</h6>
	  <form autocomplete="off" action="{{route('update.units', $unit_data->id)}}" method="post" id="needs-validation" novalidate>
	  	{{csrf_field()}}
      {{method_field('put')}}
	  	<div class="row">
        <div class="form-group col-md-12">
          <label for="unit_code" class="small">Unit Code:</label>
          <input class="form-control form-control-sm {{ $errors->has('unit_code') ? 'is-invalid' : '' }}"
          value="{{ old('unit_code', $unit_data->unit_code) }}" type="text" name="unit_code" required="">
          <div class="invalid-feedback"> 
          @if ($errors->has('unit_code'))
            {{$errors->first('unit_code')}}
          @else
            Unit code is required.
          @endif   
          </div>
        </div>
		  	<div class="form-group col-md-12">
		  	  <label for="unit_description" class="small">Unit Description:</label>
		  	  <input class="form-control form-control-sm {{ $errors->has('unit_description') ? 'is-invalid' : '' }}"
		  	  value="{{old('unit_description', $unit_data->unit_description)}}" type="text" name="unit_description" required="">
		  	  <div class="invalid-feedback"> 
	    		@if ($errors->has('unit_description'))
            {{$errors->first('unit_description')}}
          @else
            Unit description is required.
          @endif   
          </div>
		  	</div>

		  	<div class="form-group col">
		  		<button type="submit" class="btn btn-warning btn-sm">Update Unit</button>
		  	</div>

	  	</div>
	  </form>
   	</div>

   	<!-- table -->
   	<div class="col-md-8">
   	  <h6 class="card-title">Registered Units</h6>
   	  <div class="table-responsive">
   	  	@include('units.unitdatatable')
   	  </div>	
   	</div>
   </div>
 </div>
</div>

</div>	
@endsection

@section('script')

@endsection