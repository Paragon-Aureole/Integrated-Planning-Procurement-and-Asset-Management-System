@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb p-2">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('abstract.index')}}">Abstract</a></li>
    <li class="breadcrumb-item active" aria-current="page">Abstract Supplier</li>
</ol>
@endsection

@section('content')
@php
$allSuppliers = $abstract->outlineSupplier()->get();
$querySupplier = $abstract->outlineSupplier()->paginate(3);
$countSupplier = $querySupplier->count();
@endphp
<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb- 2"><b>Add Suppliers</b></div>
        <div class="card-body">
            <form autocomplete="off" action="{{route('abstract.update', $abstract->id)}}" id="bekkelAbstract"
                method="POST" class="needs-validation" novalidate>
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Purchase Request #</label>
                        <input class="form-control form-control-sm" value="{{$abstract->purchaseRequest->pr_code}}"
                            readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Requesting Office:</label>
                        <input class="form-control form-control-sm"
                            value="{{$abstract->purchaseRequest->office->office_name}}" readonly>
                    </div>
                    @if($abstract->outlineSupplier()->count() > 0)
                    <div class="form-group col-md-3">
                        <label>Selected Bidder:</label>
                        <select class="form-control form-control-sm" name="bid_winner" required>
                            <option value="">Select Supplier</option>
                            @forelse ($allSuppliers as $supp)
                            <option value="{{$supp->id}}" @if ($supp->supplier_status == TRUE)
                                selected
                                @endif>{{$supp->supplier_name}}</option>
                            @empty
                            <option>Add Supplier</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Reason:</label>
                        <select class="form-control form-control-sm" name="status_reason" required>
                            <option value="">Select Reason</option>
                            <option value="0" @foreach ($allSuppliers as $chosenSupplier) @if ($chosenSupplier->
                                supplier_status == 1 &&$chosenSupplier->status_reason == 0)
                                selected
                                @endif
                                @endforeach>Lowest Price</option>
                            <option value="1" @foreach ($allSuppliers as $chosenSupplier) @if ($chosenSupplier->
                                supplier_status == 1 &&$chosenSupplier->status_reason == 1)
                                selected
                                @endif
                                @endforeach
                                >Most Responsive</option>
                        </select>
                    </div>
                    @endif

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Procurement Of:</label>
                        <textarea class="form-control form-control-sm" name="outline_detail"
                            required>{{$abstract->outline_detail}}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Comments:</label>
                        <textarea class="form-control form-control-sm" name="supplier_comments"
                            required>@if($abstract->outline_comment != "None") {{$abstract->outline_comment}}@endif</textarea>
                    </div>


                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">

                        <button type="submit" class="btn btn-sm btn-primary" data-toggle="confirmation" 
                        @if($abstract->purchaseRequest->supplier_type == 2 || $abstract->purchaseRequest->supplier_type == 3)
                            @if ($countSupplier < 1)
                                disabled 
                            @endif 
                        @else
                                @if ($countSupplier < 3) 
                                    disabled 
                                @endif
                        @endif
                        >
                                Update Abstract
                        </button>
                        @if ($allSuppliers->where('supplier_status', 1)->count() == 1)
                        <a href="{{route('abstract.print', $abstract->id)}}" target="_blank"
                            class="btn btn-sm btn-success">
                            <i class="fas fa-print"></i> Print
                        </a>
                        @else
                        @if ($countSupplier >= 3)
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal"
                            data-target="#supplierModal">
                            <i class="fas fa-plus"></i> Add Additional Suppliers
                        </button>
                        @endif
                        @endif

                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="text-center thead-light">
                            <th rowspan="4" style="width:25%;">Particulars</th>
                            <th rowspan="4" style="width:5%;">Qty</th>
                            <th rowspan="4" style="width:5%;">Unit</th>
                            @foreach ($querySupplier as $action)
                            <th colspan="2" style="width:15%;">
                                @if($allSuppliers->where('supplier_status', 1)->count() == 1)
                                @can('full control')
                                <button class="btn btn-sm btn-warning" data-supplierid="{{$action->id}}"
                                    name='update_supplier' data-toggle="modal" data-target="#editSupplier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" name='delete_supplier' data-toggle="modal"
                                    data-target="#deleteSupplier" data-supplierid="{{$action->id}}"
                                    data-suppliername="{{$action->supplier_name}}">
                                    <i class="fas fa-minus"></i>
                                </button>
                                @endcan
                                @else
                                <button class="btn btn-sm btn-warning" data-supplierid="{{$action->id}}"
                                    name='update_supplier' data-toggle="modal" data-target="#editSupplier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a @if ($abstract->purchaseRequest->supplier_type == 1)
                                    href="{{route('destruct.supplier', $action->id)}}"
                                    @endif
                                    data-toggle="confirmation" class="btn btn-sm btn-danger">
                                    <i class="fas fa-minus"></i>
                                </a>
                                @endif
                            </th>
                            @endforeach
                            @for ($i = $countSupplier; $i <= 2; $i++) <th colspan="2" style="width:15%;">

                                @if ($allSuppliers->where('supplier_status', 1)->count() < 1) <button
                                    class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#supplierModal"
                                    @if($abstract->purchaseRequest->supplier_type == 2 OR
                                    $abstract->purchaseRequest->supplier_type == 3 )
                                    disabled
                                    @endif
                                    >
                                    <i class="fas fa-plus"></i>
                                    </button>
                                    @endif

                                    </th>
                                    @endfor
                        </tr>
                        <tr class="text-center thead-light">

                            @foreach ($querySupplier as $indexkey1 => $supplierNo)
                            <th colspan="2">Supplier {{$indexkey1 + $querySupplier->firstItem()}}</th>
                            @endforeach
                            @for ($i = $countSupplier; $i <= 2; $i++) {{-- @if($i == 0)
                                    <th colspan="2">Supplier {{$i+ 1}}</th> @else --}} <th colspan="2">Supplier
                                {{$i+ $querySupplier->firstItem()}}</th>
                                {{-- @endif --}}

                                @endfor
                        </tr>
                        <tr class="text-center">
                            @foreach ($querySupplier as $supplierName)
                            <td colspan="2">{{$supplierName->supplier_name}}</td>
                            @endforeach
                            @for ($i = $countSupplier; $i <= 2; $i++) <td colspan="2">Supplier Name</td>
                                @endfor
                        </tr>
                        <tr class="text-center thead-light">
                            @foreach ($querySupplier as $priceHeader)
                            <th>Price/Unit</th>
                            <th>Price/Item</th>
                            @endforeach
                            @for ($i = $countSupplier; $i <= 2; $i++) <th>Price/Unit</th>
                                <th>Price/Item</th>
                                @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pr_items as $pr)
                        <tr>
                            <td>{{$pr->ppmpItem->item_description}}</td>
                            <td class="text-center">{{$pr->item_quantity}}</td>
                            <td class="text-center">{{$pr->ppmpItem->measurementUnit->unit_code}}</td>
                            @foreach ($querySupplier as $supplierId)
                            @php
                            $price = $supplierId->outlinePrice()->where('pr_item_id', $pr->id)->first();
                            @endphp
                            <td class="text-right">{{number_format($price->final_cpu, 2)}}</td>
                            <td class="text-right">{{number_format($price->final_cpi, 2)}}</td>
                            @endforeach

                            @for ($i = $countSupplier; $i <= 2; $i++) <td>
                                </td>
                                <td></td>
                                @endfor

                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="thead-light">
                            <th class="text-right" colspan="3">TOTAL</th>
                            @foreach ($querySupplier as $total_price)
                            @php
                            $total = $total_price->outlinePrice()->sum('final_cpi');
                            @endphp
                            <th>&nbsp;</th>
                            <th class="text-right">&#8369; {{number_format($total, 2)}}</th>
                            @endforeach
                        </tr>
                    </tfoot>
                </table>
                {{$querySupplier->links("pagination::bootstrap-4")}}
            </div>
        </div>
    </div>
</div>

<!-- Add Supplier Modal -->
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
                <form autocomplete="off" action="{{route('supplier.store')}}" name="s_store" method="POST"
                    class="needs-validation" novalidate>
                    {{ csrf_field() }}
                    <input type="hidden" name="abstract_id" value="{{$abstract->id}}">
                    <div class="form-row">
                        <div class="col">
                            <label class="small">Supplier Name</label>
                            <input type="text" name="supplier_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="col">
                            <label class="small">Supplier Address</label>
                            <input type="text" name="supplier_address" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="small">Canvasser Name</label>
                            <input type="text" name="canvasser_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="col">
                            <label class="small">Canvasser Department</label>
                            @php
                            $gso = App\Office::where('office_code', 'GSO')->firstorFail();
                            @endphp
                            <select class="custom-select custom-select-sm" name="canvasser_dept" required>
                                <option value="{{$abstract->purchaseRequest->office_id}}">
                                    {{$abstract->purchaseRequest->office->office_name}}</option>
                                <option value="{{$gso->id}}">{{$gso->office_name}}</option>
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
                                @foreach ($pr_items as $indexKey => $pr)
                                <tr>
                                    <td>
                                        {{$pr->ppmpItem->item_description}}
                                        <input type="hidden" name="pr_item_id[]" value="{{$pr->id}}" required>
                                    </td>
                                    <td>
                                        <input id="itemQty{{$indexKey}}" value="{{$pr->item_quantity}}"
                                            class="qty form-control form-control-sm" disabled>
                                    </td>
                                    <td>{{$pr->ppmpItem->measurementUnit->unit_code}}</td>
                                    <td>
                                        <input oninput="multiply2({{$indexKey}});" id="itemCost{{$indexKey}}"
                                            name="unit_price[]" value="" class="money form-control form-control-sm"
                                            required>
                                    </td>
                                    <td>
                                        <input id="itemBudget{{$indexKey}}" name="item_price[]" value=""
                                            class="money form-control form-control-sm" readonly>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary" data-toggle="confirmation">Add Supplier</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Supplier Modal -->
<div class="modal" id="editSupplier">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5>Edit Supplier</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form autocomplete="off" name="s_update" method="POST" class="needs-validation" novalidate>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    {{-- <input type="hidden" name="abstract_id" value="{{$abstract->id}}"> --}}
                    <div class="form-row">
                        <div class="col">
                            <label class="small">Supplier Name</label>
                            <input type="text" name="supplier_name2" class="form-control form-control-sm"
                                @if($abstract->purchaseRequest->supplier_type == 2 OR
                            $abstract->purchaseRequest->supplier_type == 3) readonly @endif required>
                        </div>
                        <div class="col">
                            <label class="small">Supplier Address</label>
                            <input type="text" name="supplier_address2" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="small">Canvasser Name</label>
                            <input type="text" name="canvasser_name2" class="form-control form-control-sm" required>
                        </div>
                        <div class="col">
                            <label class="small">Canvasser Department</label>
                            @php
                            $gso = App\Office::where('office_code', 'GSO')->firstorFail();
                            @endphp
                            <select class="custom-select custom-select-sm" name="canvasser_dept2" required>
                                <option value="">Select Office</option>
                                <option value="{{$abstract->purchaseRequest->office_id}}">
                                    {{$abstract->purchaseRequest->office->office_name}}</option>
                                <option value="{{$gso->id}}">{{$gso->office_name}}</option>
                            </select>
                        </div>
                    </div>
                    @can('full control')
                    <div class="form-row">
                        <div class="col">
                            <label class="small">Reason</label>
                            <textarea type="text" name="s_reason" class="form-control form-control-sm"
                                required></textarea>
                        </div>
                    </div>
                    @else
                    <input type="hidden" name="reason" class="form-control form-control-sm" value="None" required>
                    @endcan

                    <div>&nbsp;</div>
                    <div class="table-responsive">
                        <table name="edit_table" class="table table-sm table-bordered">
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
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-warning" data-toggle="confirmation">Update Supplier Details</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal" id="deleteSupplier">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Deactivate User Account</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form autocomplete="off" name="deactivation_reason">
                    {{ csrf_field() }}
                    {{method_field("get")}}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small">Supplier ID:</label>
                            <input name="sId" class="form-control form-control-sm" value="" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small">Supplier_name:</label>
                            <input name="sName" class="form-control form-control-sm" value="" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="small">Reason for Deletion</label>
                            <textarea class="form-control form-control-sm" name="del_reason" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" data-toggle="confirmation" type="submit">Delete Supplier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script src="{{asset('js/function-script.js')}}"></script>
<script src="{{asset('js/abstract_supplier.js')}}"></script>
@endsection