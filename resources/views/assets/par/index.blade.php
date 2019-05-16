@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
  <li class="breadcrumb-item active" aria-current="page">PAR Distribution</li>
</ol>
@endsection

@section('content')

<form action="" method="post">
  {{csrf_field()}}
  <div class="container-fluid">
    <div class="card">
      <div class="card-header pt-2 pb-2">Distribution of PAR</div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
              <h6 class="card-title">
                  Available PAR
              </h6>
            <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
                  <th>Item Name</th>
                  <th>Quantity</th>
                  <th>Office</th>
                  <th data-priority="4">Actions</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach ($parData as $key => $record) --}}
                <tr>  
                  <td>1</td>
                  <td>Laptop</td>
                  <td>12</td>
                  <td>Information Technology Section</td>
                  <td><button type="button" name="btn_assignItem" class="btn btn-info btn-xs" data-toggle="modal" data-target="#inputSignatoryModal">Assign</button></td>
                  {{-- <td><a href="{{route('DistributeAssets.create')}}" target="_blank" class="btn btn-sm btn-secondary">Assign</a></td> --}}
                </tr>
                {{-- @endforeach --}}
              </tbody>
            </table>
          </div>
          <div class="col-md-6">
              <h6 class="card-title">
                  Distributed Par
              </h6>
            <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
                  <th>Signatory Name</th>
                  <th>Office</th>
                  <th>PAR Number</th>
                  <th data-priority="4">Actions</th>
                </tr>
              </thead>
              <tbody>                
                {{-- @foreach ($assetParData as $record) --}}
                <tr>
                  <td>1</td>
                  <td>Ramon Pacleb</td>
                  <td>Information Technology Section</td>
                  <td>1</td>
                  <td>
                    <a href="http://ipams.test/printPar/"  target="_blank" class="btn btn-sm btn-secondary">
                      <i class="fas fa-print"></i>
                    </a>
                  </td>
                </tr>
                {{-- @endforeach --}}
                
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
<input name="remainingItems" type="hidden"></input>
<input name="currentItemID" type="hidden"></input>
<input name="totalItemQuantity" type="hidden"></input>
<form id="itemAssignForm" action="" method="POST">
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
                <input type="text" name="selectedItemPARNo" class="form-control"
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
            <div class="col-md-12">
              <label>Specifications:</label><br>
              <textarea name="selectedItemSpecifications" cols="30" rows="10"
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

@endsection

@section('script')

<script src="{{asset('js/asset_parIndex.js')}}"></script>
@endsection