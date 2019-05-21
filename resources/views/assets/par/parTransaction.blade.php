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
            <form action="{{route('assets.saveNewPar', $id)}}" method="post" class="needs-validation">
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
                    <input name="fund_cluster" required id="fund_cluster" class="form-control" type="text">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Entity Name:</label>
                    <input name="entity_name" required id="entity_name" class="form-control" type="text">
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
                    <input name="signatory" required id="signatory" class="form-control" type="text">
                </div>
            </div>
            <div class="col-md-2 float-right">
                <div class="form-group">
                    <label>Receiver Position:</label>
                    <input name="position" required id="position" class="form-control" type="text">
                </div>
            </div>
        </div>
      <div class="table-responsive">
        <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-light">
            <tr>
              <th>ID</th>
              <th>Quantity</th>
              <th>Unit</th>
              <th>Description</th>
              <th>Additional Details</th>
              <th>Property Number</th>
              <th>Date Acquired</th>
              <th>Unit Cost</th>
              <th>Amount</th>
              <th>Edit Request</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($assetParItems as $item)
            {{--  {{$item->asset}}  --}}
            @php
                $unitCost = $item->amount / $item->item_quantity;
            @endphp
            <tr>
                @if ($item->isEditable == 0)
                    <td>{{$item->id}}</td>
                    <td>
                        <select id="itemQty{{$item->id}}" name="itemQuantity[{{$item->id}}]" onchange="calculateFinalCost({{$item->id}})">
                            @for ($i = 0; $i <= $item->item_stock; $i++)
                                <option value={{$i}}>{{$i}}</option>
                            @endfor
                        </select>
                    </td>
                    
                    <td>{{$item->measurementUnit->unit_code}}</td>
                    <td>{{$item->details}}</td>
                    <td id="extraDescription{{$item->id}}"></td>
                    {{--  <td id="extraDescription{{$item->id}}"><textarea name="itemExtraDescription[{{$item->id}}][0]" cols="30" rows="1"></textarea></td>  --}}
                    <td><input type="text" disabled id="itemPropertyNo{{$item->id}}" name="itemPropertyNo[{{$item->id}}]"></td>
                    <td><input type="date" disabled id="itemDateAcquired{{$item->id}}" name="itemDateAcquired[{{$item->id}}]"></td>
                    <td><input type="text" disabled id="itemUnitCost{{$item->id}}" name="itemUnitCost[{{$item->id}}]" value="{{$unitCost}}"></td>
                    <td name="finalCost{{$item->id}}"></td>
                @else
                    <td>{{$item->id}}</td>
                    <td>
                        <select id="itemQty{{$item->id}}" name="itemQuantity[{{$item->id}}]" onchange="calculateFinalCost({{$item->id}})">
                            @for ($i = 0; $i <= $item->item_stock; $i++)
                                <option value={{$i}}>{{$i}}</option>
                            @endfor
                        </select>
                    </td>
                    
                    <td>{{$item->measurementUnit->unit_code}}</td>
                    <td>{{$item->details}}</td>
                    <td id="extraDescription{{$item->id}}"></td>
                    {{--  <td id="extraDescription{{$item->id}}"><textarea name="itemExtraDescription[{{$item->id}}][0]" cols="30" rows="1"></textarea></td>  --}}
                    <td><input type="text" disabled id="itemPropertyNo{{$item->id}}" name="itemPropertyNo[{{$item->id}}]"></td>
                    <td><input type="date" disabled id="itemDateAcquired{{$item->id}}" name="itemDateAcquired[{{$item->id}}]"></td>
                    <td><input type="text" disabled id="itemUnitCost{{$item->id}}" name="itemUnitCost[{{$item->id}}]" value="{{$unitCost}}"></td>
                    <td name="finalCost{{$item->id}}"></td>
                @endif
                <td> 
                  @can('Asset Management')
                    @if ($item->isRequested == 0 && $item->isAssigned == 0 && $item->item_quantity == $item->item_stock)
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#editRequestPar" id="requestBtn" name="requestBtn">Request to Edit</button>
                    @elseif ($item->isEditable == 0 && $item->item_quantity == $item->item_stock)
                        <button class="btn btn-sm btn-warning" disabled>Pending</button>
                    @elseif ($item->isRequested == 1 && $item->isEditable == 1)
                        <button class="btn btn-sm btn-warning" disabled>Approved</button>
                    @endif
                  @endcan
                  @can('Supervisor')
                    @if ($item->isRequested == 0)
                        
                    @elseif ($item->isRequested == 1 && $item->isEditable == 0)
                        <a href="/acceptEdit/{{$item->id}}" class="btn btn-sm btn-info" data-toggle="confirmation" data-content="Approve Item {{$item->id}} to Edit">Accept to Edit</a>
                        <a href="/cancelEdit/{{$item->id}}" class="btn btn-sm btn-danger" data-toggle="confirmation" data-content="Cancel Item {{$item->id}} to Edit">Cancel Request</a>
                    @endif
                  @endcan
                </td>
            
            </tr>

            @endforeach
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

{{-- REQUEST TO EDIT MODAL --}}
<div class="modal" id="editRequestPar">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4>Item Edit Request</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="{{route('asset.requestEdit')}}" autocomplete="off" method="GET" class="needs-validation" novalidate>
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" id="itemId" name="itemId">
                <label>Item Unit:</label>
                <input id="itemName" class="form-control" type="text" disabled>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Item Description:</label>
                <input id="classifiedIcs" class="form-control" type="text" disabled>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Reason:</label>
                  <textarea name="reason" class="form-control" id="reasob" cols="30" rows="5" required></textarea>
                </div>
              </div>
          </div>
          <input type="text" value="1" name="classificationNo" hidden>
          <div class="=col-md-12">
            <button class="btn btn-danger container-fluid" type="submit">Submit Request</button>
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
        var table = $('#prDatatable').DataTable({
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

            if (itemQuantity != 0)
            {
                for (let index = 0; index < itemQuantity; index++) {
                $('#extraDescription'+param).append('<textarea name="itemExtraDescription['+param+']['+index+']" cols="30" rows="1"></textarea><br>');
                $('#itemPropertyNo'+param).removeAttr('disabled');
                $('#itemDateAcquired'+param).removeAttr('disabled');
                $('#itemPropertyNo'+param).attr('required', true);
                $('#itemDateAcquired'+param).attr('required', true);
            }
            }else{
                $('#itemPropertyNo'+param).attr('disabled', true);
                $('#itemDateAcquired'+param).attr('disabled', true);
                $('#itemPropertyNo'+param).removeAttr('required');
                $('#itemDateAcquired'+param).removeAttr('required');
            }
            
            
        }

        table.on('click', 'button#requestBtn', function (e) {
        e.preventDefault();
        
        var rowData = table.row($(this).parents('tr')).data();
        console.log(rowData[0]);

        $('#itemName').val(rowData[2]);
        $('#classifiedIcs').val(rowData[3]);
        $('#itemId').val(rowData[0]);

        });
    } );
</script>
@endsection



