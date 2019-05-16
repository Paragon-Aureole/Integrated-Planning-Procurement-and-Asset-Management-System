<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
  <thead class="thead-dark">
    <tr>
      <th>ID</th>
      <th>Method of Procurement</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($pm_dt as $key => $modes)      
    <tr>
      <td>{{$modes->id}}</td>
      <td>{{ucwords($modes->method_name)}}</td>
      <td>
        <a href="{{route('edit.modes', $modes->id)}}" title="Edit Mode of Procurement" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
        <a href="{{route('delete.modes', $modes->id)}}" title="Delete Mode of Procurement" data-toggle="confirmation" data-content="{{ucwords($modes->method_name)}}" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>