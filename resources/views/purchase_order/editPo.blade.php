@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item"><a href="{{route('po.index')}}">Purchase Order</a></li>
	<li class="breadcrumb-item active" aria-current="page">Edit Purchase Order</li>
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
                                Edit Purchase Order
                        </h6>
                    <form action="" method="" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="small">Supplier Name:</label>
                                <input class="form-control form-control-sm" type="text" value="{{$ind_po->outlineSupplier->supplier_name}}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="small">Supplier Address:</label>
                                <input class="form-control form-control-sm" type="text" value="{{$ind_po->outlineSupplier->supplier_address}}" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="small">TIN Number:</label>
                                <input class="form-control form-control-sm" type="text" value="{{$ind_po->supplier_tin}}" required>
                            </div>  			
                            <div class="form-group col-md-12">
                                <label class="small">Place of Delivery:</label>
                                <input class="form-control form-control-sm" type="text" value="{{$ind_po->delivery_place}}"  required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="small">Delivery Term:</label>
                                <input class="form-control form-control-sm" type="text" value="{{$ind_po->delivery_term}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="small">Payment Term:</label>
                                <input class="form-control form-control-sm" type="text" value="{{$ind_po->payment_term}}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="small">Reason:</label>
                                <textarea class="form-control form-control-sm" name="edit_reason" required></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <button class="btn btn-warning btn-sm" type="submit"
                                data-popout="true"
                                data-toggle="confirmation" data-title="Are you sure?" 
                                data-btn-ok-label="Continue" data-btn-ok-class="btn-success"
                                data-btn-cancel-label="Cancel" data-btn-cancel-class="btn-danger"
                                data-content="Update Purchase Order" data-placement="right"
                                >Update Purchase Order</button>
                            </div>
                        </div>
                    </form>
                </div>
                        
               <!-- table -->
               <div class="col-md-7">
                    <h6 class="card-title">Registered Purchase Order</h6>
                    <div class="table-responsive">
                            @include('purchase_order.podt')
                    </div>
                  </div>
            </div>
           </div>
         </div>
        </div>
        
        </div>
    
@endsection