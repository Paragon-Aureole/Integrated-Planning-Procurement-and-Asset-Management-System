<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
        <thead class="thead-dark">
          <tr>
            <th>Code</th>
            <th>Purpose</th>
            <th>Date </th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($po as $po)
              <tr>
                  <td>{{$po->purchaseRequest->pr_code}}</td>
                <td>{{$po->purchaseRequest->pr_purpose}}</td>
                <td>{{Carbon\Carbon::parse($po->created_at)->format('m-d-y')}}</td>
                <td>
                    <a href="{{route('po.print', $po->id)}}" target="_blank" class="btn btn-sm btn-success">
                      <i class="fas fa-print"></i>
                    </a>
                    <a href="{{route('po.edit', $po->id)}}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    @can('full control')
                     
                      <a href="#" class="btn btn-sm btn-danger">
                        <i class="fas fa-minus"></i>
                      </a>
                    
                    @endcan
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>