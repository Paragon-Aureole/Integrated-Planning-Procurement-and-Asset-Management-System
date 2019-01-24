@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2 mb-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item"><a href="{{route('register')}}">Register User</a></li>
	<li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
		  	  	<i class="fas fa-user-plus"></i> Edit User
		  	  </h6>
			  <form method="post" action="{{ route('update.user', $user_data->id) }}" id="needs-validation" novalidate>
			  	{{csrf_field()}}
			  	{{ method_field('put') }}
				<div class="row">
					<div class="col-md-12 form-group">
					  <label for="username" class="small">Username:</label>
		    		  <input type="text" class="form-control form-control-sm
		    		  name="username" id="username" value="{{ $user_data->username }}" disabled>
					</div>
					<div class="col form-group">

					  <label for="password" class="small">Password:</label>
		    		  <input type="password" class="form-control form-control-sm" id="password" disabled>
					</div>

					<div class="col form-group">
					  <label for="confirm" class="small">Confirm Password:</label>
		    		  <input type="password" class="form-control form-control-sm" id="confirm" disabled>
					</div>

					<div class=" col-md-12 form-group">
				  	  <label for="wholename" class="small">Wholeame:</label>
		    	  	  <input type="text" class="form-control form-control-sm {{ $errors->has('wholename') ? 'is-invalid' : '' }}"
		    	  	  name="wholename" id="wholename" aria-describedby="inputGroupPrepend" value="{{ old('wholename', $user_data->wholename) }}" required>
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
		    	  	  <select class="custom-select custom-select-sm {{ $errors->has('office') ? 'is-invalid' : '' }}" name="office" id="officeInput" required>
		    	  	  	<option value = "">-Select One-</option>
		    			@foreach($offices as $department)
			    	  		<option value = "{{$department->id}}"

			    	  			@if ($department->id == old('office', $user_data->office_id))
							        selected="selected"
							    @endif

			    	  		>{{$department->office_name}}</option>
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
			    	   id="contacts" name="contacts" value="{{ old('contacts', $user_data->contact_number) }}"  required>
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
					  @if($user_data->id == '1')
					  <input type="hidden" value='3' name="user_role">
					  <h6><span class="badge badge-primary">Admin</span></h6>
					  @else

					  	@foreach($user_data->getRoleNames() as $userrole)@endforeach

					  <select id="userRole" class="custom-select custom-select-sm" name="user_role" required>
			    	  	<option value = "">-Select One-</option>
			    	  	@foreach($roles as $role)
			    	  		<option value = "{{$role->id}}"
			    	  			@if($role->name == $userrole)
			    	  				selected
			    	  			@endif
			    	  		>{{Ucfirst($role->name)}}</option>
			    	  	@endforeach
			    	  </select>

					  @endif

			    	  <div class="invalid-feedback">
		    	  	  @if ($errors->has('user_role'))
	                  	{{$errors->first('user_role')}}
	                  @else
	                    Select a valid user role.
	                  @endif
		    	  	  </div>
					</div>
					<div class="col-md-12 form-group">
					  <button type="submit" class="btn btn-warning btn-sm">Update</button>
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

