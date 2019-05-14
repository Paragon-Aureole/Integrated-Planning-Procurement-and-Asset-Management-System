@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Offices</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2"><i class="fas fa-building"></i> City Offices</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-4">
   	  <h6 class="card-title">
		Add Office
	  </h6>
	  <form action="{{route('add.office')}}" method="post" id="needs-validation" novalidate>
	  	{{csrf_field()}}
	  	<div class="row">
        <div class="form-group col-md-12">
          <span class="text-danger">*</span><label for="office_name" class="small">Office Name:</label>
          <input class="form-control form-control-sm {{ $errors->has('office_name') ? 'is-invalid' : '' }}" type="text" name="office_name" value="{{ old('office_name') }}" required>
          <div class="invalid-feedback">  
            @if ($errors->has('office_name'))
              {{$errors->first('office_name')}}
            @else
              Office name is required.
            @endif  
          </div>
        </div>

        <div class="form-group col-md-6">
            <span class="text-danger">*</span><label for="office_code" class="small">Office Code:</label>
          <input class="form-control form-control-sm {{ $errors->has('office_code') ? 'is-invalid' : '' }}" type="text" name="office_code" value="{{ old('office_code') }}" required>
          <div class="invalid-feedback">  
            @if ($errors->has('office_code'))
              {{$errors->first('office_code')}}
            @else
              Office code is required.
            @endif  
          </div>
        </div>
        <div class="form-group col-md-6">
            <span class="text-danger">*</span><label for="category" class="small">Category:</label>
          <select class="custom-select custom-select-sm {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" required>
            <option value='1'>Department</option>
            <option value='2'>Section</option>
            <option value='3'>Group/Committee</option>
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
          <button type="submit" class="btn btn-primary btn-sm">Add Office</button>
        </div>
      </div>
	  </form>
   	</div>

   	<!-- table -->
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


