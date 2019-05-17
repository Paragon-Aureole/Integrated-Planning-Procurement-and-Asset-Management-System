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
                  <th>ID</th>
                  <th>Item Name</th>
                  {{--  <th>Qty</th>
                  <th>Qty Rem</th>  --}}
                  <th>Office</th>
                  <th data-priority="4">Actions</th>
                </tr>
              </thead>
              <tbody>
                {{--  {{$assetPar}}  --}}
               @foreach ($asset as $record)
                  <tr>
                    <td>{{$record->id}}</td>
                    <td>{{$record->details}}</td>
                    {{--  <td>{{$record->item_quantity}}</td>
                    <td>{{$record->item_stock}}</td>  --}}
                    <td>{{$record->purchaseOrder->purchaseRequest->office->office_name}}</td>
                    <td><button type="button" name="btn_assignItem" class="btn btn-info btn-xs" data-toggle="modal" data-target="#inputSignatoryModal">Assign</button></td>
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
                  <th>ID</th>
                  <th>Signatory Name</th>
                  <th>Office</th>
                  <th>PAR Number</th>
                  <th data-priority="4">Actions</th>
                </tr>
              </thead>
              <tbody>                
                @foreach ($assetPar as $record)
                  
                <td>{{$record->id}}</td>
                <td>{{$record->assignedTo}}</td>
                <td>{{$record->asset->purchaseOrder->purchaseRequest->office->office_name}}</td>
                <td>{{$record->asset_id}}</td>
                <td>
                  <a href="{{'/printPar/' . $record->id}}" target="_blank" class="btn btn-sm btn-success">
                    <i class="fas fa-print"></i>
                  </a>
                  @can('full control')
                  <button class="btn btn-sm btn-danger">
                    <i class="fas fa-minus"></i>
                  </button>
                  @endcan
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

@endsection

@section('script')

<script src="{{asset('js/asset_parIndex.js')}}"></script>
@endsection