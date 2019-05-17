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
   	<div class="col-md-6">
   	  <h6 class="card-title">
  		Available Purchase Requests
  	  </h6>
      <div class="table-responsive">
        <table id="poDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-light">
            <tr>
              <th>Id</th>
              <th>PR Code</th>
              <th>Purpose</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pr as $pr)
              @if ($pr->created_po == '0' && $pr->outlineQuotation->outlineSupplier()->where('supplier_status', TRUE)->count() > 0)
                <tr>
                  <td>{{$pr->id}}</td>
                  <td>{{$pr->pr_code}}</td>
                  <td>{{$pr->pr_purpose}}</td>
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
   	<div class="col-md-6">
   	  <h6 class="card-title">Registered Purchase Order</h6>
   	  <div class="table-responsive">
          @include('purchase_order.podt')
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
            <form autocomplete="off" action="{{route('po.store')}}" method="POST" class="needs-validation" novalidate>
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-6">

                 
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Supplier</span>
                            </div>
                                <input type="text" name="pr_id" value="" hidden required>
                                <input type="text" name="outline_supplier_id" value="" hidden required>
                                <input type="text" value="" name="supplierName" class="form-control" disabled required>

                            </div>
                            <br>  
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Supplier Address</span>
                                </div>
                                <input type="text" name="supplierAddress" value="" class="form-control" disabled required>
                            </div>
                            <br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">TIN Number</span>
                                </div>
                                <input type="text" name="tinNumber" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-6">
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><span class="text-danger">*</span>Place of Delivery</span>
                                  </div>
                                  <input type="text" name="placeOfDelivery" class="form-control" required>
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
        

              {{-- <input type="submit" class="btn btn-primary" datvalue="Add Purchase Order"> --}}
              <button type="submit" class="btn btn-primary" data-toggle="confirmation">Add Purchase Order</button>
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
          $('[name=pr_id]').val(data[0]);
          

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
                    var updateData = response.updateContent;
                    // console.log(response.abstract);
                    // console.log(response.pr);
                    console.log(response.pr);

                    $('[name=pr_id]').empty();
                    $('[name=outline_supplier_id]').empty();
                    $('[name=supplierName]').empty();
                    $('[name=supplierAddress]').empty();
                    
                    $('[name=pr_id]').val(response.pr['id']);
                    $('[name=outline_supplier_id]').val(response.abstract['id']);
                    $('[name=supplierName]').val(response.abstract['supplier_name']);
                    $('[name=supplierAddress]').val(response.abstract['supplier_address']);

                                   
                },
                error: function ( response ){
                    console.log( response );
                }
            }) 
          
        }
    });
</script>
@endsection
