@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Signatories</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
	<div class="card">
	 <div class="card-header pt-2 pb-2"><i class="fas fa-file-signature"></i> Signatories</div>
	 <div class="card-body">
	  <ul class="nav nav-tabs" role="tablist">
	    <li class="nav-item">
	      <a class="nav-link active" data-toggle="tab" id="sig1" href="">Requestor by Department</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" data-toggle="tab" id="sig2" href="">Appropriations</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" data-toggle="tab" id="sig3" href="">Cash Availability</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" data-toggle="tab" id="sig4" href="">Approval</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" data-toggle="tab" id="sig5" href="">TWG</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" data-toggle="tab" id="sig6" href="">Property Officer</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" data-toggle="tab" id="sig7" href="">Inspection Officer</a>
	    </li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
	    <div class="container tab-pane active">
	      <div class="row mt-3">
		   	<div class="col-md-4">
		   	<h6 class="card-title">Add Signatory</h6>
				<form action="{{route('add.signatories')}}" method="post" id="needs-validation" novalidate>
				  {{csrf_field()}}
				  <input type="hidden" name="category" value="1">
				  <div class="row">
			        <div class="form-group col-md-12">
			          <label for="" class="small">Name:</label>
			          <input class="form-control form-control-sm {{ $errors->has('signatory_name') ? 'is-invalid' : '' }}"
			          value="{{ old('signatory_name') }}" type="text" name="signatory_name" required autofocus>
			          <div class="invalid-feedback"> 
			          @if ($errors->has('signatory_name'))
			            {{$errors->first('signatory_name')}}
			          @else
			            Name is required.
			          @endif   
			          </div>
			        </div>
			        <div class="form-group col-md-12">
			          <label for="signatoryPosition" class="small">Position:</label>
			          <input id="signatoryPosition" class="form-control form-control-sm {{ $errors->has('signatory_position') ? 'is-invalid' : '' }}"
			          value="{{ old('signatory_position') }}" type="text" name="signatory_position" required autofocus>
			          <div class="invalid-feedback"> 
			          @if ($errors->has('signatory_position'))
			            {{$errors->first('signatory_position')}}
			          @else
			            Unit code is required.
			          @endif   
			          </div>
			        </div>
			        <div class="col-md-12 form-group">
				  	  <label for="officeInput" class="small">Office:</label>
		    	  	  <select id="officeInput" class="custom-select custom-select-sm {{ $errors->has('office') ? 'is-invalid' : '' }}" name="office" required autofocus>
		    	  	  	<option value = "">-Select One-</option>
		    			@foreach($offices as $department)
			    	  		<option value = "{{$department->id}}" title="{{$department->office_code}}">{{$department->office_name}}</option>
			    	  	@endforeach
		    	  	  </select>
		    	  	  <div class="invalid-feedback">
		    	  	  @if ($errors->has('office'))
	                  	{{$errors->first('office')}}
	                  @else
	                    Select a valid office.
	                  @endif
		    	  	  </div>
					</div>
					<div class="form-group col">
				  		<button type="submit" class="btn btn-primary btn-sm">Submit</button>
				  	</div>
			      </div>
			    </form>
		   	</div>

		   	<!-- table -->
		   	<div class="col-md-8">
		   	  <h6 class="card-title">Registered Signatories</h6>
		   	  <div class="table-responsive">
		   	  	@include('signatories.signatorydatatable')
		   	  </div>	
		   	</div>
		   </div>
	    </div>

	  </div>
	 </div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('js/signatory-script.js')}}"></script>
@endsection