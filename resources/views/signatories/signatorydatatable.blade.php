<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
  <thead class="thead-dark">
    <tr>
      <th data-priority="1">Name</th>
      <th data-priority="3">Position</th>
      <th data-priority="1">Office</th>
      <th data-priority="2">Category</th>
      <th data-priority="1" style="width: 100px;">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($signatories as $key => $signatory)      
    <tr>
      <td>{{$signatory->signatory_name}}</td>
      <td>{{$signatory->signatory_position}}</td>
      <td>{{$signatory->office->office_code}}</td>
      <td>{{$signatory->category}}</td>
      <td>
        <a href="{{route('edit.signatories', $signatory->id)}}" class="btn btn-sm btn-warning">
          <i class="fas fa-edit"></i>
        </a>
        <a href="{{route('delete.signatories', $signatory->id)}}" class="btn btn-sm btn-danger">
          <i class="fas fa-minus"></i>
        </a>
      @if($signatory->is_activated == 1)
        <a href="{{route('deactivate.signatories', $signatory->id)}}" title="Deactivate Signatory" class="btn btn-sm btn-success">
          <i class="fas fa-check-circle"></i>
        </a>
      @else
        <a href="{{route('activate.signatories', $signatory->id)}}" title="Activate Signatory" class="btn btn-sm btn-secondary">
          <i class="far fa-check-circle"></i>
        </a>
      @endif

      </td>
    </tr>
  @endforeach
  </tbody>
</table>