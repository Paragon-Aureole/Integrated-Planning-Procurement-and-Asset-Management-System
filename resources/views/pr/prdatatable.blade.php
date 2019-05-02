<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
  <thead class="thead-dark">
    <tr>
      <th data-priority="1">PR Code</th>
      <th data-priority="3">Purpose</th>
      <th data-priority="1">Status</th>
      <th data-priority="2">Date</th>
      <th data-priority="1" style="width: 100px;">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($prDT as $key => $pr)      
    <tr>
      <td>{{$pr->pr_code}}</td>
      <td>{{$pr->pr_purpose}}</td>
      <td>
        @if($pr->pr_status == 1)
          Approved
        @else
          Pending
        @endif
      </td>
      <td>{{Carbon\Carbon::parse($pr->created_at)->format('m-d-y')}}</td>
      <td>
        <a href="{{route('view.pritm', $pr->id)}}" class="btn btn-sm btn-info" title="Add PR Items"><i class="fas fa-th-list"></i></a>
        @can('full control')
          <a href="{{route('pr.edit', $pr->id)}}" class="btn btn-sm btn-warning">
              <i class="fas fa-edit"></i>
          </a>
        @endcan
        @if ($pr->prItem->count() > 0)
          <a href="{{route('print.pr', $pr->id)}}" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-print"></i></a>
        @endif
        @can(['full control', 'close'])
        {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reasonModal">
            <i class="fas fa-minus"></i>
        </button> --}}
        <a href="{{route('pr.destroy', $pr->id)}}" class="btn btn-sm btn-danger">
          <i class="fas fa-minus"></i>
        </a>
        @endcan
      </td>
    </tr>
  @endforeach
  </tbody>
</table>