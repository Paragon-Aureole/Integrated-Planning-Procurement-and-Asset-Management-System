<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
  <thead class="thead-light">
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
        @if($pr->pr_status == 0)
          Pending
        @elseif($pr->pr_status == 1)
          Approved
        @else 
          Cancelled
        @endif
      </td>
      <td>{{Carbon\Carbon::parse($pr->created_at)->format('m-d-y')}}</td>
      <td>
        @if($pr->pr_status != 2)
          <a href="{{route('view.pritm', $pr->id)}}" class="btn btn-sm btn-info" title="Add PR Items"><i class="fas fa-th-list"></i></a>
          @can('full control')
            <a href="{{route('pr.edit', $pr->id)}}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i>
            </a>
            @if ($pr->prItem->count() > 0)
              <a href="{{route('print.pr', $pr->id)}}" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-print"></i></a>
            @endif
            @if($pr->pr_status == 0)
              @if($pr->created_rfq == 0 || $pr->created_abstract == 0 || $pr->created_po == 0 || $pr->created_inspection == 0)
              <a href="{{route('destroy.pr', $pr->id)}}" class="btn btn-sm btn-danger" data-toggle="confirmation" data-content="Cancel Purchase Request # {{$pr->pr_code}}">
                  <i class="fas fa-minus"></i>
              </a>
              @endif
            @endif
          @endcan
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>