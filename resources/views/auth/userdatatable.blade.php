<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
	  	  		  <thead class="thead-light">
	  	  		  	<tr>
	  	  		  		<th>ID</th>
	  	  		  		<th>Username</th>
		  	  		  	<th>Office</th>
		  	  		  	<th>Role</th>
		  	  		  	<th style="width: 100px;">Action</th>
	  	  		  	</tr>
	  	  		  </thead>
	  	  		  <tbody>
	  	  		  	@foreach($user_DT as $indexKey => $user)
	  	  		  	<tr>
	  	  		  		<td data-priority="5">{{$user->id}}</td>
	  	  		  		<td data-priority="1">{{$user->username}}</td>
	  	  		  		<td data-priority="3">{{$user->office->office_code}}</td>
	  	  		  		<td data-priority="4">
	  	  		  			@foreach($user->getRoleNames() as $role)
	  	  		  				<span class="badge 
	  	  		  				@if($role == 'Admin')badge-primary
	  	  		  				@elseif($role == 'Secretariat')badge-info
	  	  		  				@else badge-secondary @endif
	  	  		  				">{{$role}}</span>
	  	  		  			@endforeach
	  	  		  		</td data-priority="2">
	  	  		  		<td>
	  	  		  			@if (is_null($user->deleted_at))
	  	  		  			<a href="{{route('edit.user',$user->id)}}" class="btn btn-sm btn-warning">
	  	  		  				<i class="fas fa-user-edit"></i>
	  	  		  			</a>
								@if($user->id != 1)
									<button type="button" name="delete_user" class="btn btn-danger btn-sm" data-useroffice="{{$user->office->office_code}}" data-userid="{{$user->id}}" data-toggle="modal" data-target="#reasonModal">
										<i class="fas fa-minus"></i>
									</button>	  
								@endif
	  	  		  			@else
	  	  		  			<button class="btn btn-sm btn-warning" disabled>
		  	  		  			<i class="fas fa-user-edit"></i>
		  	  		  		</button>
	  	  		  			<a href="{{route('restore.user',$user->id)}}" class="btn btn-sm btn-secondary">
	  	  		  				<i class="fas fa-redo"></i>
	  	  		  			</a>
							@endif
	  	  		  		</td>
	  	  		  	</tr>
	  	  		  	@endforeach
	  	  		  </tbody>
	  	  		</table>