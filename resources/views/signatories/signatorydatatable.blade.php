<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
  <thead class="thead-dark">
    <tr>
      <th>Name</th>
      <th>Office</th>
      <th>Category</th>
      <th style="width: 90px;">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($signatories as $key => $signatory)      
    <tr>
      <td>{{$signatory->signatory_name}}</td>
      <td>{{$signatory->office_id}}</td>
      <td>{{$signatory->category}}</td>
      <td>
        <a href="{{route('edit.signatories', $signatory->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
        <a href="{{route('delete.signatories', $signatory->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>