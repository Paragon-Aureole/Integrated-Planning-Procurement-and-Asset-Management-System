<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
  <thead class="thead-light">
    <tr>
      <th>Code Description</th>
      <th>Action</th>
    </tr>
  </thead>
  {{-- <tbody>
    @foreach($ppmp_codeDT as $codes)
    <tr>
      <td>{{$codes->code_description}}</td>
      <td>
      <input type="hidden" value="{{$codes->id}}">
        @if($codes->code_type == 1)
          Department & Office Supplies
        @elseif($codes->code_type == 2)
          Departmental Projects
        @elseif($codes->code_type == 3)
          Projects Chargeable to Other Offices
        @endif
      </td>
      <td>
        <a href="{{route('edit.ppmpitemcode', [$ppmp->id, $codes->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
        <button id="btnUpdate" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
        <a href="{{route('delete.ppmpitemcode', $codes->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></a>
      </td>
    </tr>
    @endforeach         
  </tbody> --}}
</table>