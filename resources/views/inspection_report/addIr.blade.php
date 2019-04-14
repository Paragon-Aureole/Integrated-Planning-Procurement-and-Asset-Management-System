@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Inspection Report</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header pt-2 pb-2">Inspection Report</div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-5">
          <h6 class="card-title">
            Available Inspection Reports
          </h6>
          <div class="table-responsive">
            <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
                  <th>PR Code</th>
                  <th>Date Cerated</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pr as $pr)
                @if ($pr->created_inspection == 0)
                <tr>
                  <td>{{$pr->id}}</td>
                  <td>{{$pr->pr_code}}</td>
                  <td>{{Carbon\Carbon::parse($pr->created_at)->format('m-d-y')}}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal"
                      id="poModal">
                      <i class="fas fa-plus"></i>
                    </button>
                  </td>
                </tr>

                @else

                @endif
                @endforeach

              </tbody>
            </table>
          </div>
        </div>

        <!-- table -->
        <div class="col-md-7">
          <h6 class="card-title">Registered Inpection Reports</h6>
          <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
                  <th>Code</th>
                  <th>Date </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($ir as $ir)
                <tr>
                  <td>{{$ir->id}}</td>
                  <td>{{$pr->pr_code}}</td>
                  <td>{{Carbon\Carbon::parse($ir->created_at)->format('m-d-y')}}</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-secondary">
                      <i class="fas fa-print"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-danger">
                      <i class="fas fa-minus"></i>
                    </a>
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

</div>

{{-- MODAL --}}
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5>Purchase Order Form Details</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form action="{{route('ir.store')}}" method="POST">
          {{ csrf_field() }}


          <div class="row">
            <div class="col-md-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Supplier</span>
                </div>
                <input type="text" name="purchase_request_id" value="" hidden>
                <input type="text" name="user_id" value="" hidden>
                <input type="text" value="" name="supplierName" class="form-control" disabled>
              </div>
              <br>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">PO No.</span>
                </div>
                <input type="text" value="" name="poNumber" class="form-control" disabled>
              </div>
              <br>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Requisioning Office/Dpt</span>
                </div>
                <input type="text" value="" name="tinNumber" class="form-control" disabled>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Invoice No.</span>
                </div>
                <input type="text" name="invoiceNo" class="form-control" required>
              </div>
              <br>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Property Officer</span>
                </div>
                <select class="custom-select" name="property_officer">
                  @foreach ($signatory as $signatory1)
                  @if ($signatory1->category == 6 && $signatory1->is_activated == 1)
                  <option value="{{$signatory1->id}}">{{$signatory1->signatory_name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <br>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Inspection Officer</span>
                </div>
                <select class="custom-select" name="inspection_officer">
                  @foreach ($signatory as $signatory2)
                  @if ($signatory2->category == 7 && $signatory2->is_activated == 1 && $signatory2->office_id == Auth::user()->office_id)
                  <option value="{{$signatory2->id}}">{{$signatory2->signatory_name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <br>
          <input type="submit" value="Submit">
        </form>
      </div>

    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function () {
    var table = $('#prDatatable').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    });

    table.on('click', 'button#poModal', function () {
      var data = table.row($(this).parents('tr')).data();
      // $('[name=pr_id]').val(data[0]);

      // console.log(data[0])

      getModalPoContent(data);

    });

    function getModalPoContent(data) {
      var values = {
        pr_id: data[0]
      }

      // console.log(data[0])

      $.ajax({
        url: '/getModalPoData',
        method: 'get',
        data: values,
        success: function (response) {
          console.log(response);
          // console.log(response.po[0]);
          // console.log(response.os[0]);
          // console.log(response.office[0]);

          // $('[name=purchase_request_id]').empty();
          // $('[name=user_id]').empty();
          // $('[name=poNumber]').empty();
          // $('[name=supplierName]').empty();
          // $('[name=tinNumber]').empty();

          // $('[name=purchase_request_id]').val(response.prId);
          // $('[name=user_id]').val(response.po[0].user_id);
          // $('[name=poNumber]').val(response.po[0].id);
          // $('[name=supplierName]').val(response.os[0].supplier_name);
          // $('[name=tinNumber]').val(response.office[0].office_code);
          // $('[name=supplierAddress]').val(response.os[0].supplier_address);


        },
        error: function (response) {
          console.log(response);
        }
      })
    }


  });
</script>
@endsection