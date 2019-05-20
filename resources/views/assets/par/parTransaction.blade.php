@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">PAR Distribution</li>
</ol>
@endsection

@section('content')
{{--  {{$assetParItems}}  --}}

<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb-2">Property Acknowledgement Receipt</div>
        <div class="card-body">
            <form action="{{route('assets.saveNewPar', $id)}}" method="post">
                {{csrf_field()}}
            <div class="row">
                <div class="col-md-12">
                    <h6 class="card-title">
                        Available PAR
                    </h6>
                    <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>PO Number:</label>
                    <input name="po_number" id="po_number" class="form-control" type="text" value="{{$id}}" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Office Code:</label>
                    <input name="office_code" id="office_code" class="form-control" type="text" value="{{$assetParItems->first()->purchaseOrder->purchaseRequest->office->office_code}}" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Fund Cluster:</label>
                    <input name="fund_cluster" id="fund_cluster" class="form-control" type="text">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Entity Name:</label>
                    <input name="entity_name" id="entity_name" class="form-control" type="text">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 float-right">
                <div class="form-group">
                    <label>PAR Number:</label>
                    <input name="par_number" id="par_number" class="form-control" type="text" value="{{$parCount}}" readonly>
                </div>
            </div>
            <div class="col-md-2 float-right">
                <div class="form-group">
                    <label>Receiver Name:</label>
                    <input name="signatory" id="signatory" class="form-control" type="text">
                </div>
            </div>
            <div class="col-md-2 float-right">
                <div class="form-group">
                    <label>Receiver Position:</label>
                    <input name="position" id="position" class="form-control" type="text">
                </div>
            </div>
        </div>
      <div class="table-responsive">
        <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-light">
            <tr>
              <th>Quantity</th>
              <th>Unit</th>
              <th>Description</th>
              <th>Additional Details</th>
              <th>Property Number</th>
              <th>Date Acquired</th>
              <th>Unit Cost</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($assetParItems as $item)
            {{--  {{$item->asset}}  --}}
            @php
                $unitCost = $item->amount / $item->item_quantity;
            @endphp
            <tr>
                <td>
                    <select id="itemQty{{$item->id}}" name="itemQuantity[{{$item->id}}]" onchange="calculateFinalCost({{$item->id}})">
                        @for ($i = 1; $i <= $item->item_stock; $i++)
                            <option value={{$i}}>{{$i}}</option>
                        @endfor
                    </select>
                </td>
                
                <td>{{$item->measurementUnit->unit_code}}</td>
                <td>{{$item->details}}</td>
                <td id="extraDescription{{$item->id}}"><textarea name="itemExtraDescription[{{$item->id}}][0]" cols="30" rows="1"></textarea></td>
                <td><input type="text" name="itemPropertyNo[{{$item->id}}]"></td>
                <td><input type="date" name="itemDateAcquired[{{$item->id}}]"></td>
                <td><input type="text" id="itemUnitCost{{$item->id}}" name="itemUnitCost[{{$item->id}}]" value="{{$unitCost}}"></td>
                <td name="finalCost{{$item->id}}"></td>
            
            </tr>

            @endforeach
            {{--  @foreach ($pr as $pr)
                <tr>
                    <td>
                        <select name="" id="">
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </td>
                    <td>Unit</td>
                    <td>Laptop</td>
                    <td><textarea name="" id="" cols="30" rows="1"></textarea></td>
                    <td><input type="text"></td>
                    <td><input type="date"></td>
                    <td>50,000</td>
                    <td>100,000</td>
                </tr>
                <tr>
                    <td>
                        <select name="" id="">
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </td>
                    <td>Unit</td>
                    <td>Printer</td>
                    <td><textarea name="" id="" cols="30" rows="1"></textarea></td>
                    <td><input type="text"></td>
                    <td><input type="date"></td>
                    <td>5,000</td>
                    <td>10,000</td>
                </tr>
            @endforeach  --}}
          </tbody>
        </table>
      </div>
      <div class="col-md-12">&nbsp;</div>
      <div class="=col-md-12">
        <button class="btn btn-info float-right" type="submit" data-toggle="confirmation">Save Transaction</button>
        {{--  <button class="btn btn-info float-right" type="submit" data-toggle="modal" data-target="#parTransactionModal">Save Transaction</button>  --}}
      </div>
    </div>
   </div>
 </div>
 </form>
</div>
</div>

{{-- REQUEST TO EDIT MODAL --}}
<div class="modal" id="parTransactionModal">
    <div class="modal-dialog">
        <div class="modal-content">
    
        <!-- Modal Header -->
        <div class="modal-header">
            <h4>Item Edit Request</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
    
        <!-- Modal body -->
        <div class="modal-body">
        <form autocomplete="off" action="{{route('asset.requestEdit')}}" autocomplete="off" method="GET" class="needs-validation" novalidate>
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Add new Transaction?</label>
                    </div>
                </div>
                <input type="text" name="classificationNo" value="1" hidden>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-success container-fluid" type="submit">YES</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-danger container-fluid" type="submit">NO</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
	
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
      console.log('scripts loaded');
        $('#prDatatable').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
        });

        calculateFinalCost = function(param){
            var unitCost = $('#itemUnitCost'+param).val();
            var itemQuantity = $('#itemQty'+param).val();
            var finalCost = unitCost * itemQuantity;
            $('[name=finalCost'+param+']').html(finalCost);
            console.log(param);

            $('#extraDescription'+param).empty();

            for (let index = 0; index < itemQuantity; index++) {
                $('#extraDescription'+param).append('<textarea name="itemExtraDescription['+param+']['+index+']" cols="30" rows="1"></textarea><br>');
            }
            
        }
    } );
</script>
@endsection



