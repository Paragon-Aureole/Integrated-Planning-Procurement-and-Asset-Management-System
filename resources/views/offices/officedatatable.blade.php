<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
   	  	  <thead class="thead-light">
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
								 {{-- <a href="{{route('delete.office', $dept->id)}}" class="btn btn-sm btn-danger" title="Delete Office/Department" data-content="{{$dept->office_name}}" data-toggle="confirmation"><i class="fas fa-minus"></i></a> --}}
   	  	  	  </td>
   	  	  	</tr>
   	  	  	@endforeach
   	  	  </tbody>
   	  	</table>