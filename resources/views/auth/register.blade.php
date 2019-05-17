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
				<form autocomplete="off" method="POST" id="myForm" action="{{ route('register') }}" class="needs-validation" novalidate>
			  	{{csrf_field()}}
				<div class="row">
					<div class="col-md-12 form-group">
							<span class="text-danger">*</span><label for="username" class="small">Username:</label>
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

							<span class="text-danger">*</span><label for="password" class="small">Password:</label>
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
							<span class="text-danger">*</span><label for="confirm" class="small">Confirm Password:</label>
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
				  	  <span class="text-danger">*</span><label for="wholename" class="small">Whole Name:</label>
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
				  	  <span class="text-danger">*</span> <label for="officeInput" class="small">Office:</label>
		    	  	  {{-- <select id="officeInput" class="custom-select custom-select-sm {{ $errors->has('office') ? 'is-invalid' : '' }}" name="office" required> --}}
						<input list="offices" id="office" class="form-control form-control-sm {{ $errors->has('office') ? 'is-invalid' : '' }}" required>
							<datalist id="offices">
								@foreach($offices as $department)
									<option data-value = "{{$department->id}}" value ="{{$department->office_code}}">{{$department->office_name}}</option>
								@endforeach
							</datalist>
		    	  	  	{{-- </select> --}}
						<div class="invalid-feedback">
						@if ($errors->has('office'))
							{{$errors->first('office')}}
						@else
							Select a valid office.
						@endif
						</div>
								
						<input name="office" id="office-hidden" type="hidden" required>
					</div>

					<pre id="result"></pre>

					<div id="supervisorCheck" class="col-md-12 form-group">
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input" name="check_supervisor"> <span class="text-danger">*</span> Is GSO Supervisor?
								</label>
								<input type="hidden" name="is_supervisor" value="0">
							</div>
					</div>

					<div class="col-md-7 form-group">
							<span class="text-danger">*</span><label for="contacts" class="small">Contact Number:</label>
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
							<span class="text-danger">*</span><label for="userRole" class="small">User Type:</label>
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
					  <button type="submit" class="btn btn-primary btn-sm">Add User</button>
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
				
				<!-- The Modal -->
				<div class="modal" id="reasonModal">
						<div class="modal-dialog">
							<div class="modal-content">
								
								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">Deactivate User Account </h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
									
								<!-- Modal body -->
								<div class="modal-body">
										<form autocomplete="off" name="deactivation_reason">
										 {{ csrf_field() }}
										 {{method_field('GET')}}
											<div class="form-row">
												<div class="form-group col-md-6">
													<label class="small">User ID:</label>
													<input id="userId" class="form-control form-control-sm" value="" readonly>
												</div>
												<div class="form-group col-md-6">
														<label class="small">Department:</label>
														<input id="userDept" class="form-control form-control-sm" value="" readonly>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-12">
													<label class="small">Reason for Deactivation</label>
													<textarea class="form-control form-control-sm" name="reason" required></textarea>
												</div>
											</div>
											<div class="form-group">
												<button class="btn btn-danger" type="submit"  data-popout="true"
												data-toggle="confirmation" data-title="Are you sure?" 
												data-btn-ok-label="Continue" data-btn-ok-class="btn-success"
												data-btn-cancel-label="Cancel" data-btn-cancel-class="btn-danger"
												data-content="Delete User" data-placement="top">Deactivate User</button>
											</div>
										</form>
									</div>
										
									{{-- <!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div> --}}
									
							</div>
						</div>
					</div>
		

		  </div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('js/registration-script.js')}}"></script>
<script src="{{asset('js/numeric-validation.js')}}"></script>
@endsection