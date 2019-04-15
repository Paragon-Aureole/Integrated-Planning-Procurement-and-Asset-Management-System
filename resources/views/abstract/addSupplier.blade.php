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
            <form action="{{route('abstract.update', $abstract->id)}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div>
                    <label>Purchase Request #</label>
                    <input value="{{$abstract->purchaseRequest->pr_code}}" readonly>
                </div>
                <div>
                    <label>Requesting Office:</label>
                    <input value="{{$abstract->purchaseRequest->office->office_name}}">
                </div>
                <div>
                    <label>Selected Bidder:</label>
                    <select name="bid_winner">
                        @forelse ($allSuppliers as $supp)
                        <option value="{{$supp->id}}" @if ($supp->supplier_status == TRUE)
                            selected
                        @endif>{{$supp->supplier_name}}</option>
                        @empty
                        <option>Add Supplier</option>    
                        @endforelse
                    </select>
                </div>
                <div>
                    <label>Reason:</label>
                    <select name="status_reason">
                        <option value="0"
                        @foreach ($allSuppliers as $chosenSupplier)
                            @if ($chosenSupplier->supplier_status == 1 &&$chosenSupplier->status_reason == 0)
                                selected
                            @endif 
                        @endforeach>Lowest Price</option>
                        <option value="1"
                        @foreach ($allSuppliers as $chosenSupplier)
                            @if ($chosenSupplier->supplier_status == 1 &&$chosenSupplier->status_reason == 1)
                                selected
                            @endif 
                        @endforeach
                        >Most Responsive</option>
                    </select>
                </div>
                <div>
                    <label>Comments:</label>
                    <textarea name="supplier_comments" required>{{$abstract->outline_comment}}</textarea>
                </div>

                <a href="{{route('abstract.print', $abstract->id)}}" target="_blank" class="btn btn-sm btn-success">
                    <i class="fas fa-print"></i>
                </a>
                <button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
            @if ($countSupplier >= 3)
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#supplierModal">
                    <i class="fas fa-plus"></i>
                </button>
            @endif
            </form>
            
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th rowspan="4" class="w-75">Particulars</th>
                            <th rowspan="4" class="w-25">Qty</th>
                            <th rowspan="4" class="w-50">Unit</th>
                            @foreach ($querySupplier as $action)
                            <th colspan="2">
                                <button class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </th>
                            @endforeach
                            @for ($i = $countSupplier; $i <= 2; $i++)
                            <th colspan="2" >
                                <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#supplierModal">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </th>
                            @endfor 
                        </tr>
                        <tr class="text-center">
                  
                            @foreach ($querySupplier as $indexkey1 => $supplierNo)
                                <th colspan="2" >Supplier {{$indexkey1+1}}</th> 
                            @endforeach
                            @for ($i = $countSupplier; $i <= 2; $i++)
                                <th colspan="2">Supplier {{$i+1}}</th>
                            @endfor
                        </tr>
                        <tr class="text-center">
                            @foreach ($querySupplier as $supplierName)
                                <td colspan="2">{{$supplierName->supplier_name}}</td> 
                            @endforeach
                            @for ($i = $countSupplier; $i <= 2; $i++)
                                <td colspan="2">Supplier Name</td>
                            @endfor 
                        </tr>
                        <tr class="text-center">
                            @foreach ($querySupplier as $priceHeader)
                                <th>Price/Unit</th>
                                <th>Price/Item</th>
                            @endforeach
                            @for ($i = $countSupplier; $i <= 2; $i++)
                                <th class="col-2">Price/Unit</th>
                                <th class="col-2">Price/Item</th>
                            @endfor  
                        </tr> 
                    </thead>
                    <tbody>
                    @foreach ($pr_items as $pr)
                        <tr>
                            <td>{{$pr->ppmpItem->item_description}}</td>
                            <td>{{$pr->item_quantity}}</td>
                            <td>{{$pr->ppmpItem->measurementUnit->unit_code}}</td>
                            @foreach ($querySupplier as $supplierId)
                                @php
                                    $price = $supplierId->outlinePrice()->where('pr_item_id', $pr->id)->first(); 
                                @endphp
                                <td>{{$price->final_cpu}}</td>
                                <td>{{$price->final_cpi}}</td>
                            @endforeach
                            
                            @for ($i = $countSupplier; $i <= 2; $i++)
                                <td></td>
                                <td></td>
                            @endfor
                           
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$querySupplier->links()}}
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
            <form action="{{route('supplier.store')}}" method="POST" class="needs-validation">
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
                                <option value="{{$abstract->purchaseRequest->office_id}}">{{$abstract->purchaseRequest->office->office_name}}</option>
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
                                <input id="itemQty{{$indexKey}}" value="{{$pr->item_quantity}}" class="form-control form-control-sm" disabled>
                                </td>
                                <td>{{$pr->ppmpItem->measurementUnit->unit_code}}</td>
                                <td>
                                <input oninput="multiply2({{$indexKey}});" id="itemCost{{$indexKey}}" name="unit_price[]" value="" class="form-control form-control-sm" required>
                                </td>
                                <td>
                                <input id="itemBudget{{$indexKey}}" name="item_price[]" value="" class="form-control form-control-sm" readonly>
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

@section('script')

<script src="{{asset('js/function-script.js')}}"></script>
    
@endsection