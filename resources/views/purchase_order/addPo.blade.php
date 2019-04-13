@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Purchase Order</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Purchase Order</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-5">
   	  <h6 class="card-title">
  		Available Purchase Order
  	  </h6>
      <div class="table-responsive">
        <table id="poDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>PR Code</th>
              <th>Date Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pr as $pr)
              @if ($pr->created_po == '0')
                <tr>
                  <td>{{$pr->id}}</td>
                  <td>{{$pr->pr_code}}</td>
                  <td>{{Carbon\Carbon::parse($pr->created_at)->format('m-d-y')}}</td>
                  <td>
                  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal" id="poContent">
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
   	  <h6 class="card-title">Registered Purchase Order</h6>
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
            @foreach ($po as $po)
                <tr>
                  <td>{{$po->id}}</td>
                  <td>{{$po->purchaseRequest->pr_code}}</td>
                  <td>{{Carbon\Carbon::parse($po->created_at)->format('m-d-y')}}</td>
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
            <form action="{{route('po.store')}}" method="POST">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-6">

                  @foreach ($oq as $oq)
                      @foreach ($os as $os)
                          @if ($pr->id == $oq->purchase_request_id && $oq->id == $os->outline_of_quotation_id)
                          
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Supplier</span>
                            </div>
                            
                                {{-- <input type="text" name="pr_id" value="{{$pr->id}}"> --}}
                                {{-- <input type="text" name="user_id" value="{{$pr->user_id}}"> --}}
                                {{-- <input type="text" name="outline_supplier_id" value="{{$os->id}}"> --}}
                                <input type="text" name="pr_id" value="" hidden>
                                <input type="text" name="user_id" value="" hidden>
                                <input type="text" name="outline_supplier_id" value="" hidden>

                                <input type="text" value="" name="supplierName" class="form-control" disabled>

                            </div>
                            <br>  
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Supplier Address</span>
                                </div>
                                <input type="text" name="supplierAddress" value="" class="form-control" disabled>
                            </div>
                            <br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">TIN Number</span>
                                </div>
                                <input type="text" name="tinNumber" class="form-control">
                            </div>
                            <br>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <label class="input-group-text">Procurement Mode</label>
                                </div>
                                <select class="custom-select" name="modeOfProcurement">
                                  @foreach ($prMode as $prMode)
                                    <option value="{{$prMode->id}}">{{$prMode->method_name}}</option>
                                  @endforeach
                                </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Place of Delivery</span>
                                  </div>
                                  <input type="text" name="placeOfDelivery" class="form-control">
                              </div>
                              <br>  
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Date of Delivery</span>
                                  </div>
                                  <input type="date" name="dateOfDelivery" class="form-control">
                              </div>
                              <br>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Delivery Term</span>
                                  </div>
                                  <input type="text" name="deliveryTerm" class="form-control">
                              </div>
                              <br>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Payment Term</span>
                                  </div>
                                  <input type="text" name="paymentTerm" class="form-control">
                              </div>
                          </div>
                        </div>
                          @endif
                      @endforeach
                  @endforeach

              <input type="submit" value="Submit">
            </form>
        </div>

    </div>
  </div>
</div>
      
      


@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
       var table = $('#poDatatable').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
        });

        table.on('click', 'button#poContent', function () {
          var data = table.row( $(this).parents('tr') ).data();
          // $('[name=pr_id]').val(data[0]);
          

          getModalContent(data);
        
        });

        function getModalContent(data) {
          var values = {
            pr_id : data[0]
          }
          
          $.ajax({
                url: '/getModalData',
                method: 'get',
                data: values,
                success: function ( response ) {
                    // var updateData = response.updateContent;
                    console.log(response.prId);
                    console.log(response.oq[0]);
                    console.log(response.os[0]);

                    $('[name=pr_id]').empty();
                    $('[name=user_id]').empty();
                    $('[name=outline_supplier_id]').empty();
                    $('[name=supplierName]').empty();
                    $('[name=supplierAddress]').empty();
                    
                    $('[name=pr_id]').val(response.prId);
                    $('[name=user_id]').val(response.oq[0].user_id);
                    $('[name=user_id]').val(response.oq[0].user_id);
                    $('[name=outline_supplier_id]').val(response.os[0].id);
                    $('[name=supplierName]').val(response.os[0].supplier_name);
                    $('[name=supplierAddress]').val(response.os[0].supplier_address);

                                   
                },
                error: function ( response ){
                    console.log( response );
                }
            }) 
          
        }
    });
</script>
@endsection
