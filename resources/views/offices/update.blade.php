@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item"><a href="{{route('view.office')}}">Offices</a></li>
  <li class="breadcrumb-item active" aria-current="page">Update Office</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2"><i class="fas fa-building"></i> City Offices</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-4">
   	<h6 class="card-title">Edit Office</h6>
	  <form action="{{route('update.office', $office_data->id)}}" method="post">
	  	{{csrf_field()}}
      {{ method_field('put') }}
	  	<div class="row">
		  	<div class="form-group col-md-12">
		  	  <label for="office_name" class="small">Office Name:</label>
		  	  <input class="form-control form-control-sm {{ $errors->has('office_name') ? 'is-invalid' : '' }}" type="text" name="office_name" value="{{ old('office_name', $office_data->office_name) }}">
          <div class="invalid-feedback">  
            @if ($errors->has('office_name'))
              {{$errors->first('office_name')}}
            @else
              Office name is required.
            @endif  
          </div>
		  	</div>

		  	<div class="form-group col-md-6">
		  	  <label for="office_code" class="small">Office Code:</label>
		  	  <input class="form-control form-control-sm {{ $errors->has('office_code') ? 'is-invalid' : '' }}" type="text" name="office_code" value="{{ old('office_code', $office_data->office_code) }}">
          <div class="invalid-feedback">  
            @if ($errors->has('office_code'))
              {{$errors->first('office_code')}}
            @else
              Office code is required.
            @endif  
          </div>
		  	</div>
		  	<div class="form-group col-md-6">
		  	  <label for="category" class="small">Category:</label>
		  	  <select class="custom-select custom-select-sm {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category">
		  	  	<option value='1' @if($office_data->category == 1) selected @endif>Department</option>
		  	  	<option value='2' @if($office_data->category == 2) selected @endif>Section</option>
            <option value='3' @if($office_data->category == 3) selected @endif>Group/Committee</option>
		  	  </select>
          <div class="invalid-feedback">  
            @if ($errors->has('category'))
              {{$errors->first('category')}}
            @else
              Category is required.
            @endif  
          </div>
		  	</div>
		  	<div class="form-group col">
		  		<button type="submit" class="btn btn-warning btn-sm">Update Office</button>
		  	</div>
	  	</div>
	  </form>
   	</div>
   	<div class="col-md-8">
   	  <h6 class="card-title">Registered Offices</h6>
   	  <div class="table-responsive">
   	  	@include('offices.officedatatable')
   	  </div>	
   	</div>
   </div>
 </div>
</div>
</div>
@endsection


