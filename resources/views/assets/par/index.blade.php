@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
  <li class="breadcrumb-item active" aria-current="page">PAR Distribution</li>
</ol>
@endsection

@section('content')

<form autocomplete="off" action="" method="post">
  {{csrf_field()}}
  <div class="container-fluid">
    <div class="card">
      <div class="card-header pt-2 pb-2">Distribution of Assets</div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
              <h6 class="card-title">
                  Available Assets for Distribution (PAR) 
              </h6>
            <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-light">
                <tr>
                  {{--  <th>ID</th>  --}}
                  <th>PO Number</th>
                  <th>Details</th>
                  <th>Office</th>
                  <th data-priority="5">Actions</th>
                </tr>
              </thead>
              <tbody>
               @foreach ($assetPar as $item)
                  {{--  {{$item}}  --}}
                  <tr>
                    {{--  <td>{{$item->id}}</td>  --}}
                    <td>{{$item->purchase_order_id}}</td>
                    <td>Details</td>
                    <td>{{$item->purchaseOrder->purchaseRequest->office->office_code}}</td>
                    <td>
                      <a href="{{route('assets.parTransaction', $item->purchase_order_id)}}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i></a>
                      {{--  <a href="/displayParTransactions/{{$item->purchase_order_id}}" class="btn btn-success "><i class="fas fa-print"></i></a></td>  --}}
                  </tr>
              @endforeach
                
              </tbody>
            </table>
          </div>
          <div class="col-md-6">
              <h6 class="card-title">
                  Distributed Assets (PAR)
              </h6>
            <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-light">
                <tr>
                  {{--  <th>ID</th>  --}}
                  <th>PAR Number</th>
                  <th>Signatory Name</th>
                  <th>Transaction Details</th>
                  <th>Office</th>
                  <th data-priority="4">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($distributedAssetPar as $record)
                <tr>
                  <td>{{$record->id}}</td>
                  <td>{{$record->assignedTo}}</td>
                  <td>
                  @foreach ($record->assetParItem->take(2) as $itemDescription)
                  ||{{$itemDescription->description}}||
                  @endforeach
                  </td>
                  <td>{{$record->purchaseOrder->purchaseRequest->office->office_code}}</td>
                  <td>
                  <a href="{{route('assets.printPar', $record->id)}}" target="_blank" class="btn btn-sm btn-success">
                    <i class="fas fa-print"></i>
                  </a>
                </td>
              </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        {{-- <input type="submit" class="btn btn-primary"> --}}

      </div>
    </div>
  </div>

</form>
{{-- <button id="btn_test">shit</button> --}}
<!-- Modal for inputting signatory -->
<div class="modal" id="inputSignatoryModal">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Distribute Items Classified</h4>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
  <input type="hidden" name="currentItemID"></input>
  <input type="hidden" name="currentPARNo"></input>
      <div class="modal-body" id="assetAssignBody">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Item</span>
                </div>
                {{-- SELECTED ITEM INPUT HERE  --}}
                <input type="text" name="selectedItemName" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
              </div>
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Quantity</span>
                </div>
                {{-- QUANTITY SELECITION HERE --}}
                <select name="selectedItemQty" class="custom-select">
                  <option>None</option>
                </select>
              </div>
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Unit Cost</span>
                </div>
                {{-- UNIT COST INPUT HERE  --}}
                <input type="text" name="selectedItemUnitCost" class="form-control"
                  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">PAR No.</span>
                </div>
                {{-- PAR NUMBER INPUT HERE  --}}
                <input type="text" id="currentPARNo" name="selectedItemPARNo" class="form-control"
                  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
              </div>
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Date Assigned</span>
                </div>
                {{-- ASSIGNED DATE HERE  --}}
                <input type="date" name="selectedItemDateAssigned" class="form-control"
                  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
              </div>
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Total Amount</span>
                </div>
                {{-- TOTAL AMOUNT INPUT HERE  --}}
                <input type="text" name="selectedItemTotalAmount" class="form-control"
                  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Signatory</span>
                </div>
                {{-- NAME AND POSITION OF EMPLOYEE INPUT HERE  --}}
                <input type="text" name="selectedItemEmployeeName" class="form-control"
                  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Name">
                <input type="text" name="selectedItemEmployeePosition"
                  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                  placeholder="Position">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12" id="descriptionPar">

            </div>
          </div>
        </div>
      </div>
      
      <div class="modal-footer">
        <button name="submitNewPar" class="btn btn-primary">Save New PAR</button>
        <button class="btn btn-warning">cancel</button>
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
      <form autocomplete="off" action="{{route('asset.requestEdit')}}" autocomplete="off" method="GET" class="needs-validation" novalidate>
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Item Id:</label>
                    <input name="itemId" id="itemId" class="form-control" type="text" readonly>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Item name:</label>
                <input id="itemName" class="form-control" type="text" disabled>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Item Classification:</label>
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
              <input type="text" name="classificationNo" value="1" hidden>
          </div>
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

<script src="{{asset('js/asset_parIndex.js')}}"></script>
@endsection