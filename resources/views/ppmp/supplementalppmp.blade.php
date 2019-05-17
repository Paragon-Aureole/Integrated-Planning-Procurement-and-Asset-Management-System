@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Supplemental PPMP</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header pt-2 pb-2">Supplemental PPMP</div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-5">
          <h6 class="card-title">
            Available PPMP Forms
          </h6>
          <div class="table-responsive">
            <table id="ppmpDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-light">
                <tr>
                  <th data-priority="1">PPMP Year</th>
                  <th data-priority="3">Department</th>
                  <th data-priority="2">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($created_ppmp as $orig_ppmp)
                <tr>
                  <td>{{$orig_ppmp->ppmp_year}}</td>
                  <td>{{$orig_ppmp->office->office_code}}</td>
                  <td>
                    <a href="{{route('createsupplemental.ppmp', $orig_ppmp->id)}}" data-toggle="confirmation"
                      class="btn btn-primary btn-sm">
                      <i class="fas fa-plus"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- table -->
        <div class="col-md-7">
          <h6 class="card-title">Registered Supplemental PPMP Forms</h6>
          <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-light">
                <tr>
                  <th data-priority="1">Supplemental PPMP Year</th>
                  <th data-priority="3">Office</th>
                  <th data-priority="3">Est. Budget</th>
                  <th data-priority="4">Rem. Budget</th>
                  <th data-priority="2">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($ppmp_DT as $indexKey => $supplementals)
                @php
                $firstTwo = $supplementals->ppmpItem->take(2);
                @endphp
                <td>{{$supplementals->ppmp_year}}-{{$supplementals->id}}</td>
                <td>{{$supplementals->office->office_code}}</td>
                <td>{{number_format($supplementals->ppmpBudget->ppmp_est_budget, 2)}}</td>
                <td>{{number_format($supplementals->ppmpBudget->ppmp_rem_budget, 2)}}</td>
                <td>
                  <a href="{{route('view.ppmpitm', $supplementals->id)}}" class="btn btn-sm btn-info"
                    title="Add PPMP Items"><i class="fas fa-th-list"></i></a>
                  @if($supplementals->ppmpItem()->count() > 0)
                  <a href="{{route('print.ppmp', $supplementals->id)}}" target="_blank"
                    class="btn btn-sm btn-success"><i class="fas fa-print"></i></a>
                  @endif
                  @can('full control')
                  <button type="submit" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reasonModal"
                    data-ppmpId="{{$supplementals->ppmp_year}}-{{$supplementals->id}}"
                    data-department="{{$supplementals->office->office_name}}">
                    <i class="fas fa-minus"></i>
                  </button>
                  @endcan

                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- The Modal -->
  <div class="modal" id="reasonModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cancel PPMP</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form autocomplete="off" name="deactivation_reason">
            {{ csrf_field() }}
            {{method_field('GET')}}
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="small">PPMP Year:</label>
                <input id="userId" class="form-control form-control-sm" value="" readonly>
              </div>
              <div class="form-group col-md-6">
                <label class="small">PPMP Office:</label>
                <input id="userDept" class="form-control form-control-sm" value="" readonly>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label class="small">Reason for Deactivation</label>
                <textarea class="form-control form-control-sm" name="reason" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <button class="btn btn-danger" type="submit" data-toggle="confirmation">Cancel PPMP</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function () {
    $('#ppmpDatatable').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    });

    $("button[name='delete_user']").click(function () {
      var user_id = $(this).attr('data-userid');
      var office = $(this).attr('data-useroffice');
      $("#userId").val(user_id);
      $("#userDept").val(office);
      $("form[name='deactivation_reason']").attr('action', 'http://ipams.test/register/delete/' + user_id);
    });


  });
</script>
@endsection