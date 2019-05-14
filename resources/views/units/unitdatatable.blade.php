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
				<a href="{{route('delete.units', $unit->id)}}" class="btn btn-sm btn-danger"
						data-popout="true"
						data-toggle="confirmation" data-title="Are you sure?" 
						data-btn-ok-label="Continue" data-btn-ok-class="btn-success"
						data-btn-cancel-label="Cancel" data-btn-cancel-class="btn-danger"
						data-content="Delete Unit of Measurement" data-placement="top"
				><i class="fas fa-minus"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>