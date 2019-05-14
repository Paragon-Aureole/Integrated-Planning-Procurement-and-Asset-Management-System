<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
   	  	  <thead class="thead-dark">
   	  	  	<tr>
   	  	  	  <th>Code</th>
   	  	  	  <th>Office Name</th>
   	  	  	  <th>Action</th>
   	  	  	</tr>
   	  	  </thead>
   	  	  <tbody>
   	  	  	@foreach($officeDT as $dept)
   	  	  	<tr>
   	  	  	  <td>{{$dept->office_code}}</td>
   	  	  	  <td>{{$dept->office_name}}</td>
   	  	  	  <td>
   	  	  	  	<a href="{{route('edit.office', $dept->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
								 <a href="{{route('delete.office', $dept->id)}}" class="btn btn-sm btn-danger"
										data-popout="true"
										data-toggle="confirmation" data-title="Are you sure?" 
										data-btn-ok-label="Continue" data-btn-ok-class="btn-success"
										data-btn-cancel-label="Cancel" data-btn-cancel-class="btn-danger"
										data-content="Delete Office" data-placement="top"
									><i class="fas fa-minus"></i></a>
   	  	  	  </td>
   	  	  	</tr>
   	  	  	@endforeach
   	  	  </tbody>
   	  	</table>