@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{route('view.dist')}}">Sole Distributors</a></li>
	<li class="breadcrumb-item active" aria-current="page">Update Sole Distributor</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Sole Distributors</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-4">
   	  <h6 class="card-title">
		Add Sole Distributor
	  </h6>
	  <form action="{{route('update.dist', $edit_dist->id)}}" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
	  	{{csrf_field()}}
      {{ method_field('put') }}
      <input type="hidden" name="cert_old" value="{{$edit_dist->distributor_certificate}}">
	  	<div class="row">
        <div class="form-group col-md-12">
          <label for="distributorName" class="small">Sole Distributor Name:</label>
          <input class="form-control form-control-sm {{ $errors->has('distributor_name') ? 'is-invalid' : '' }}"
          value="{{old('distributor_name', $edit_dist->distributor_name)}}" type="text" name="distributor_name" id="distributorName" required>
          <div class="invalid-feedback"> 
          @if ($errors->has('distributor_name'))
            {{$errors->first('distributor_name')}}
          @else
            Sole Distributor name is required.
          @endif   
          </div>
        </div>
		  	<div class="form-group col-md-12">
          <label for="distributorAddress" class="small">Sole Distributor Address:</label>
          <input class="form-control form-control-sm {{ $errors->has('distributor_address') ? 'is-invalid' : '' }}"
          value="{{old('distributor_address', $edit_dist->distributor_address)}}" type="text" name="distributor_address" id="distributorAddress" required>
          <div class="invalid-feedback"> 
          @if ($errors->has('distributor_address'))
            {{$errors->first('distributor_address')}}
          @else
            Sole Distributor address is required.
          @endif   
          </div>
        </div>

        <div class="form-group col-md-12">
          <label for="distributorCert" class="small">Sole Distributor Certificate:</label><br>
          <input id="distributorCert" type="file" class="form-control-file border rounded {{ $errors->has('distributor_certificate') ? 'is-invalid' : '' }}" name="distributor_certificate"  accept="application/pdf" required>
          <div class="invalid-feedback"> 
          @if ($errors->has('distributor_certificate'))
            {{$errors->first('distributor_certificate')}}
          @else
            Sole Distributor certificate is required.
          @endif   
          </div>
        </div>
         
		  	<div class="form-group col">
		  		<button type="submit" class="btn btn-warning btn-sm">Update</button>
		  	</div>

	  	</div>
	  </form>
   	</div>

   	<!-- table -->
   	<div class="col-md-8">
   	  <h6 class="card-title">Registered Methods</h6>
   	  <div class="table-responsive">
   	  	@include('distributors.distdatatable')
   	  </div>	
   	</div>
   </div>
 </div>
</div>

</div>
@endsection

@section('script')
<script src="{{asset('js/validation-form.js')}}"></script>
@endsection

