@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2 mb-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Register</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
	<div class="card">
		<div class="card-header pt-2 pb-2"><i class="fas fa-users-cog"></i> User Management</div>
		<div class="card-body">
		  <div class="row">
		  	<div class="col-md-4">
		  	  <h6 class="card-title">
		  	  	<i class="fas fa-user-plus"></i> Register User
		  	  </h6>
			  <form method="POST" action="{{ route('register') }}" id="needs-validation" novalidate>
			  	{{csrf_field()}}
				<div class="row">
					<div class="col-md-12 form-group">
					  <label for="username" class="small">Username:</label>
		    		  <input type="text" class="form-control form-control-sm {{ $errors->has('username') ? 'is-invalid' : '' }}"
		    		  name="username" id="username" value="{{old('username')}}" required>
		    		  <div class="invalid-feedback"> 
		    		  @if ($errors->has('username'))
	                  	{{$errors->first('username')}}
	                  @else
	                    Username is required.
	                  @endif   
	                  </div>
					</div>
					<div class="col form-group">

					  <label for="password" class="small">Password:</label>
		    		  <input type="password" class="form-control form-control-sm {{ $errors->has('password') ? 'is-invalid' : '' }}" 
		    		  name="password" id="password" value="{{old('password')}}" required>
		    		  <div class="invalid-feedback">  
	                  @if ($errors->has('password'))
	                  	{{$errors->first('password')}}
	                  @else
	                    Password is required.
	                  @endif  
	                  </div>
					</div>

					<div class="col form-group">
					  <label for="confirm" class="small">Confirm Password:</label>
		    		  <input type="password" class="form-control form-control-sm {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="confirm" name="password_confirmation" required>
		    		  <div class="invalid-feedback">  
	                  @if ($errors->has('password_confirmation'))
	                  	{{$errors->first('password_confirmation')}}
	                  @else
	                    Password is required.
	                  @endif  
	                  </div>
					</div>

					<div class=" col-md-12 form-group">
				  	  <label for="wholename" class="small">Wholeame:</label>
		    	  	  <input type="text" class="form-control form-control-sm {{ $errors->has('wholename') ? 'is-invalid' : '' }}"
		    	  	  name="wholename" id="wholename" value="{{old('wholename')}}" required>
		    	  	  <div class="invalid-feedback">  
	                  @if ($errors->has('wholename'))
	                  	{{$errors->first('wholename')}}
	                  @else
	                    Name is required.
	                  @endif  
	                  </div>
				  	</div>

					<div class="col-md-12 form-group">
				  	  <label for="officeInput" class="small">Office:</label>
		    	  	  <select id="officeInput" class="custom-select custom-select-sm {{ $errors->has('office') ? 'is-invalid' : '' }}" name="office" required>
		    	  	  	<option value = "">-Select One-</option>
		    			@foreach($offices as $department)
			    	  		<option value = "{{$department->id}}">{{$department->office_name}}</option>
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

					<div class="col-md-7 form-group">
					  <label for="contacts" class="small">Contact Number:</label>
			    	  <input type="text" class="form-control form-control-sm {{ $errors->has('contacts') ? 'is-invalid' : '' }}"
			    	   id="contacts" name="contacts" required>
			    	  <div class="invalid-feedback">
		    	  	  @if ($errors->has('contacts'))
	                  	{{$errors->first('contacts')}}
	                  @else
	                    Contact detail is required.
	                  @endif
		    	  	  </div>
					</div>

					<div class="col-md-5 form-group">
					  <label for="userRole" class="small">User Type:</label>
			    	  <select id="userRole" class="custom-select custom-select-sm" name="user_role" required>
			    	  	<option value = "">-Select One-</option>
			    	  	@foreach($roles as $role)
			    	  		<option value = "{{$role->name}}">{{Ucfirst($role->name)}}</option>
			    	  	@endforeach
			    	  </select>
			    	  <div class="invalid-feedback">
		    	  	  @if ($errors->has('user_role'))
	                  	{{$errors->first('user_role')}}
	                  @else
	                    Select a valid user role.
	                  @endif
		    	  	  </div>
					</div>
					<div class="col-md-12 form-group">
					  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
					</div>
				</div>
		  	  </form>
		  	</div>
		  	<div class="col-md-8">
		  	  	<h6 class="card-title"><i class="fas fa-users"></i> Registered Users</h6>
		  	  	<div class="table-responsive">
		  	  		@include('auth.userdatatable')
		  		</div>
		  	</div>
		  </div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('js/registration-script.js')}}"></script>
@endsection