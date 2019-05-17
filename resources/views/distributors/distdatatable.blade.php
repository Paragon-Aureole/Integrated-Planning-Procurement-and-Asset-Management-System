<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
  <thead class="thead-light">
    <tr>
      <th>ID</th>
      <th>Distributor Name</th>
      <th>Distributor Address</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($dist_DT as $key => $dist)
    <tr>
      <td>{{$dist->id}}</td>
      <td>{{$dist->distributor_name}}</td>
      <td>{{$dist->distributor_address}}</td>
      <td>
        <a href="{{ route('show.dist', $dist->id) }}" target="_blank" class="btn btn-sm btn-secondary" title="View Certificate"><i class="far fa-file-pdf"></i></a>
        <a href="{{route('edit.dist', $dist->id)}}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
        {{-- <a href="{{route('delete.dist', $dist->id)}}" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-minus"
          data-toggle="confirmation"
        ></i></a> --}}
      </td>
    </tr>
  @endforeach
  </tbody>
</table>