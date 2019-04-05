@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item"><a href="{{route('abstract.index')}}">Abstract</a></li>
	<li class="breadcrumb-item active" aria-current="page">Abstract Supplier</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb- 2"><b>Add Suppliers</b></div>
        <div class="card-body">
            <form action="#">
                <div>
                    <label>Purchase Request #</label>
                    <input value="">
                </div>
                <div>
                    <label>Procurement Of:</label>
                    <input value="">
                </div>
                <div>
                    <label>Requestor Name:</label>
                    <input value="">
                </div>
                <div>
                    <label>Requesting Office:</label>
                    <input value="">
                </div>
                <div>
                    <label>Selected Bidder:</label>
                    <select>
                        <option>Selected Bidder</option>
                    </select>
                </div>
                <div>
                    <label>Reason:</label>
                    <select>
                        <option>Selected Reason</option>
                    </select>
                </div>
                <div>
                    <label>Comments:</label>
                    <textarea></textarea>
                </div>   
            </form>

            <div>
                @php
                    $countSupplier = $abstract->outlineSupplier()->count();
                @endphp
                <table class="table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th rowspan="4">Particulars</th>
                            <th rowspan="4">Qty</th>
                            <th rowspan="4">Unit</th>
                            @for ($i = $countSupplier; $i <= 2; $i++)
                            <th colspan="2">
                                <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#supplierModal">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </th>
                            @endfor  
                        </tr>
                        <tr class="text-center">
                            @for ($i = $countSupplier; $i <= 2; $i++)
                        <th colspan="2">Supplier {{$i+1}}</th>
                            @endfor
                        </tr>
                        <tr class="text-center">
                            @for ($i = $countSupplier; $i <= 2; $i++)
                            <td colspan="2">Supplier Name</td>
                            @endfor 
                        </tr>
                        <tr class="text-center">
                            @for ($i = $countSupplier; $i <= 2; $i++)
                            <th>Price/Unit</th>
                            <th>Price/Item</th>
                            @endfor  
                        </tr> 
                    </thead>
                    <tbody>
                    @foreach ($pr_items as $pr)
                        <tr>
                            <td>{{$pr->ppmpItem->item_description}}</td>
                            <td>{{$pr->item_quantity}}</td>
                            <td>{{$pr->ppmpItem->measurementUnit->unit_code}}</td>
                            @for ($i = $countSupplier; $i <= 2; $i++)
                            <td></td>
                            <td></td>
                            @endfor 
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <!-- The Modal -->
    <div class="modal" id="supplierModal">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h5>Add Supplier</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
            <form action="{{route('supplier.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="col">
                            <label class="small">Supplier Name</label>
                            <input type="text" name="supplier_name" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label class="small">Supplier Address</label>
                            <input type="text" name="supplier_address" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="small">Canvasser Name</label>
                            <input type="text" name="canvasser_name" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label class="small">Canvasser Department</label>
                            <select class="custom-select custom-select-sm" name="canvasser_dept">
                                <option>{{$abstract->purchaseRequest->office->office_code}}</option>
                                <option>GSO</option>
                            </select>
                        </div>
                    </div>
                
                <div>&nbsp;</div>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Particulars</th>
                                <th style="width:10%;">Qty</th>
                                <th style="width:10%;">Unit</th>
                                <th style="width:20%;">Unit Price</th>
                                <th style="width:20%;">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($pr_items as $pr)
                            <tr>
                                <td>
                                    {{$pr->ppmpItem->item_description}}
                                    <input type="hidden" name="pr_item_id[]" value="{{$pr->id}}">
                                </td>
                                <td>
                                    <input id="itemQty" value="{{$pr->item_quantity}}" class="form-control form-control-sm" disabled>
                                </td>
                                <td>{{$pr->ppmpItem->measurementUnit->unit_code}}</td>
                                <td>
                                    <input name="unit_price[]" value="" class="form-control form-control-sm">
                                </td>
                                <td>
                                    <input name="item_price[]" value="" class="form-control form-control-sm" readonly>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit">Submit</button>
            </form>
            </div>
          </div>
        </div>
    </div>
@endsection