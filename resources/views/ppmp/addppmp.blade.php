@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">PPMP</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header pt-2 pb-2"><i class="fas fa-table"></i> Project Procurement Management Plan</div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <h6 class="card-title">
            Add PPMP
          </h6>
          <form autocomplete="off" action="{{route('add.ppmp')}}" method="post" class="needs-validation" novalidate>
            {{csrf_field()}}
            <div class="row">
              <div class="form-group col-md-12">
                <span class="text-danger">*</span><label for="ppmpYear" class="small">PPMP Year:</label>
                <input class="form-control form-control-sm {{ $errors->has('ppmp_year') ? 'is-invalid' : '' }}"
                  type="text" name="ppmp_year" value="{{ old('ppmp_year') }}" required>
                <div id="feedback" class="invalid-feedback">
                  @if ($errors->has('ppmp_year'))
                  {{$errors->first('ppmp_year')}}
                  @else
                  PPMP Year is required.
                  @endif
                </div>
              </div>

              @role('Admin')
              <div class="col-md-12 form-group">
                <span class="text-danger">*</span><label for="ppmpOffice" class="small">Office:</label>
                <select id="ppmpOffice"
                  class="custom-select custom-select-sm {{ $errors->has('office_id') ? 'is-invalid' : '' }}"
                  name="office_id" required>
                  <option value="">-Select One-</option>
                  @foreach($offices as $department)
                  <option value="{{$department->id}}">{{$department->office_name}}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  @if ($errors->has('office_id'))
                  {{$errors->first('office_id')}}
                  @else
                  Select a valid office.
                  @endif
                </div>
              </div>
              @else
              <input type="hidden" name="office_id" value="{{Auth::user()->office_id}}">
              @endrole

              <div class="form-group col">
                <button type="submit" id="submitPpmp" class="btn btn-primary btn-sm">Submit</button>
              </div>
            </div>
          </form>
        </div>

        <!-- table -->
        <div class="col-md-8">
          <h6 class="card-title">Registered PPMP</h6>
          <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100 responsive">
              <thead class="thead-light">
                <tr>
                  @role('Admin')
                  <th data-priority="2">Office</th>
                  @endrole
                  <th data-priority="1">PPMP Year</th>
                  <th data-priority="5">Est. Budget</th>
                  <th data-priority="4">Rem. Budget</th>
                  <th data-priority="3">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($ppmp_DT as $ppmp)
                <tr>
                  @role('Admin')
                  <td>{{$ppmp->office->office_code}}</td>
                  @endrole
                  <td>{{$ppmp->ppmp_year}}</td>
                  <td>&#8369; {{number_format($ppmp->ppmpBudget->ppmp_est_budget, 2)}}</td>
                  <td>&#8369; {{number_format($ppmp->ppmpBudget->ppmp_rem_budget, 2)}}</td>
                  <td>
                    <a href="{{route('view.ppmpitm', $ppmp->id)}}" class="btn btn-sm btn-primary"
                      title="Add PPMP Items"><i class="fas fa-th-list"></i></a>
                    @if($ppmp->is_active == 1)
                    <a href="{{route('deactivate.ppmp', $ppmp->id)}}" title="Deactivate PPMP"
                      data-content="PPMP Form {{$ppmp->ppmp_year}}" data-placement="top" class="btn btn-sm btn-success"
                      data-toggle="confirmation">
                      <i class="fas fa-check-circle"></i>
                    </a>
                    @else
                    <a href="{{route('activate.ppmp', $ppmp->id)}}" class="btn btn-sm btn-secondary"
                      data-toggle="confirmation" title="Activate PPMP" data-content="PPMP Form {{$ppmp->ppmp_year}}">
                      <i class="far fa-check-circle"></i>
                    </a>
                    @endif

                    @if($ppmp->ppmpItem()->count() > 0)
                    <a href="{{route('print.ppmp', $ppmp->id)}}" target="_blank" class="btn btn-sm btn-secondary"><i
                        class="fas fa-print"></i></a>
                    @endif
                    @can('full control')
                    <button type="submit" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reasonModal">
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

<script src="{{asset('js/numeric-validation.js')}}"></script>
<script>
  $(document).ready(function () {

    $('input[name="ppmp_year"]').inputFilter(function (value) {
      var test_val = /^\d*$/.test(value);
      // console.log(test_val);

      if (test_val == false) {
        $('input[name="ppmp_year"]').addClass('is-invalid');
        $('#feedback').html("Not a valid year");
      }
      return test_val;

    });


    $("#submitPpmp").on('click', function (e) {

      var ppmp_year = $('input[name="ppmp_year"]').val();
      var current_year = new Date().getFullYear();

      if (ppmp_year < current_year) {
        e.preventDefault();
        $('input[name="ppmp_year"]').addClass('is-invalid');
        $('#feedback').html("Invalid PPMP Year.");
      }
    });

  });
</script>

@endsection