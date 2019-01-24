<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
  	<thead class="thead-dark">
		<tr>
			<th>Unit Code</th>
			<th>Unit Description</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($units_DT as $key => $unit)
		<tr>
			<td>{{$unit->unit_code}}</td>
			<td>{{$unit->unit_description}}</td>
			<td>
				<a href="{{route('edit.units', $unit->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
        		<a href="{{route('delete.units', $unit->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>