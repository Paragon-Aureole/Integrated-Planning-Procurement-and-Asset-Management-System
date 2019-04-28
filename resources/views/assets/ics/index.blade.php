@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
  <li class="breadcrumb-item active" aria-current="page">PAR Module </li>
</ol>
@endsection

@section('content')

{{--  {{$assetIcslipData}}  --}}
{{--  {{$IcslipData}}  --}}

{{-- {{route('distribution.store')}} --}}
{{-- <input type="hidden" id="currentPARNo" value={{$assetParData}}> --}}
<input type="hidden" id="currentICSNo">

{{-- {{$assetTypes}} --}}

<form action="" method="post">
  {{csrf_field()}}
  {{--  <input type="hidden" name="purchase_order_id" value={{$assetData[0]->purchase_order_id}}> --}}
  {{--  <input type="hidden" name="PO_id" value={{$id->searchPO}}></input> --}}
  <div class="container-fluid">
    <div class="card">
      <div class="card-header pt-2 pb-2">List of Item</div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
                  <th>Item</th>
                  <th>Total Qty</th>
                  <th>Remaining</th>
                  <th>Total Price</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($IcslipData as $key => $record)
                <tr>
                  <td>{{$record['id']}}</td>
                  <td>{{$record['details']}}</td>
                  <td>{{$record['item_quantity']}}</td>
                  <td>{{$record['item_stock']}}</td>
                  <td>{{$record['amount']}}</td>
                  <td><button type="button" name="btn_assignItem" class="btn btn-info btn-xs" data-toggle="modal" data-target="#inputSignatoryModal">Assign</button></td>
                  {{-- <td><a href="{{route('DistributeAssets.create')}}" target="_blank" class="btn btn-sm btn-secondary">Assign</a></td> --}}
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="col-md-6">
            <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-dark">
                <tr>
                  <th>ICS ID</th>
                  <th>Received By</th>
                  <th>Item Assigned</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>                
                @foreach ($assetIcslipData as $record)
                <tr>
                  <td>{{$record['id']}}</td>
                  <td>{{$record['assignedTo']}}</td>
                  <td>{{$record['name']}}</td>
                  <td>
                    <a href="http://ipams.test/printIcs/{{$record['id']}}"  target="_blank" class="btn btn-sm btn-secondary">
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
        <h3 class="modal-title">Input Signatory</h3>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
<input name="remainingItems" type="hidden"></input>
<input name="currentItemID" type="hidden"></input>
<input name="totalItemQuantity" type="hidden"></input>
<form id="itemAssignForm" action="{{route('DistributeAssetsPAR.store')}}" method="POST">
  {{csrf_field()}}
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
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">ICS No.</span>
                </div>
                {{-- ICS NUMBER INPUT HERE  --}}
                <input type="text" name="selectedItemICSNo" class="form-control"
                  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
              </div>
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Date Assigned</span>
                </div>
                {{-- ESTIMATED USEFUL LIFE DATE HERE  --}}
                <input type="text" name="selectedItemEstimatedUsefulLife" class="form-control"
                  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
            <div class="col-md-12">
              <label>Description:</label><br>
              <textarea name="selectedItemDescription" cols="30" rows="10"
                class="form-control form-control-sm"></textarea>
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button class="btn btn-warning">cancel</button>
      </div>
</form>


    </div>
  </div>
</div>

{{-- MODAL FOR ASSIGNED ITEMS --}}
<div class="modal" id="itemsAssignedModal">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Tedd Mamuyac's Accoutability Items</h3>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-dark">
                <tr>
                  <th>Item name</th>
                  <th>Quantity</th>
                  <th>assetClassification</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Item1</td>
                  <td>1</td>
                  <td>PAR</td>
                </tr>
                <tr>
                  <td>Item2</td>
                  <td>1</td>
                  <td>ICS</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

<script src="{{asset('js/asset_icsIndex.js')}}"></script>
@endsection