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
 <div class="card-header pt-2 pb-2">Purchase Request</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-4">
   	  <h6 class="card-title">
  		Add Purchase Request
  	  </h6>
	  <form action="#" method="post" id="needs-validation" novalidate>
	  	{{csrf_field()}}
	  	<div class="row">
        <div class="form-group col-md-12">
          <label for="prCode" class="small">PR Code:</label>
          <select class="custom-select custom-select-sm {{ $errors->has('pr_code') ? 'is-invalid' : '' }}" name="pr_code" required="required" @role('Department') readonly="readonly" @endrole>
            @foreach($ppmp as $plans)
            <option value="{{$plans->id}}">PR-{{$plans->office->office_code}}-{{$plans->ppmp_year}}-{{sprintf('%02d', $plans->user_id)}}-{{sprintf('%04d', $plans->count())}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">  
            @if ($errors->has('pr_code'))
              {{$errors->first('pr_code')}}
            @else
              PR Code is required.
            @endif  
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="prCode" class="small">Department:</label>
          <input class="form-control form-control-sm " type="text"  value="" disabled>
        </div>
        <div class="form-group col-md-6">
          <label for="prCode" class="small">Section:</label>
          <input class="form-control form-control-sm " type="text"  value="" disabled>
        </div> 
        <div class="form-group col-md-6">
          <label for="prCode" class="small">Supplier Type</label>
          <input class="form-control form-control-sm {{ $errors->has('pr_code') ? 'is-invalid' : '' }}" type="text" name="pr_code" value="" required="required">
          <div class="invalid-feedback">  
            @if ($errors->has('pr_code'))
              {{$errors->first('pr_code')}}
            @else
              PR Code is required.
            @endif  
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="prCode" class="small">Supplier</label>
          <input class="form-control form-control-sm {{ $errors->has('pr_code') ? 'is-invalid' : '' }}" type="text" name="pr_code" value="" required="required">
          <div class="invalid-feedback">  
            @if ($errors->has('pr_code'))
              {{$errors->first('pr_code')}}
            @else
              PR Code is required.
            @endif  
          </div>
        </div>
        <div class="form-group col-md-12">
          <label for="prCode" class="small">Requestor:</label>
          <input class="form-control form-control-sm " type="text"  value="" disabled>
        </div> 
        <div class="form-group col-md-12">
          <label for="prCode" class="small">Budget:</label>
          <input class="form-control form-control-sm " type="text"  value="" disabled>
        </div> 
        <div class="form-group col">
          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </div>
      </div>
	  </form>
   	</div>

   	<!-- table -->
   	<div class="col-md-8">
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


