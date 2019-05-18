@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
  <li class="breadcrumb-item active" aria-current="page">CLassification and Distribution</li>
</ol>
@endsection

@section('content')
@can('Asset Management', 'Supervisor')
<div class="container-fluid">
    <div class="card">
      <div class="card-header pt-2 pb-2">Asset Classification and Distribution</div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <h6 class="card-title">
              Available Items Procured
            </h6>
            <div class="table-responsive">
              <table id="availableDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                <thead class="thead-light">
                  <tr>
                    <th>PO Number</th>
                    <th>Office</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($asset->where('isEditable', 0)->groupBy('purchase_order_id') as $record)
                  <tr>
                    <td>{{$record->first()->purchase_order_id}}</td>
                    <td>{{$record->first()->purchaseOrder->purchaseRequest->office->office_name}}</td>
                    <td>
                      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#itemsProcured"
                        id="classificationModalBtn">
                        <i class="fas fa-plus"></i>
                      </button>
                    </td>
                  </tr>
  
                  @endforeach
  
                </tbody>
              </table>
            </div>
          </div>
  
          <!-- table -->
          <div class="col-md-6">
            <h6 class="card-title">Classified ICS Items</h6>
            <div class="table-responsive">
              <table id="classifiedDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Office</th>
                    <th>Classification</th>
                    <th data-priority = '5'>Action</th>
                  </tr>
                </thead>
                <tbody>
  
                  @foreach ($asset as $key =>$record)
                  @if ($record->isICS == 1)
                  <tr>
                    <td>{{$record->id}}</td>
                    <td>{{$record->details}}</td>
                    <td>{{$record->purchaseOrder->purchaseRequest->office->office_code}}</td>
                    <td>ICS</td>
                    <td>
                      <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#printIcs" id="printBtnIcs">
                        <i class="fas fa-th-list"></i>
                      </button>
                      @if ($record->item_stock == 0)
                      @elseif ($record->item_stock != $record->item_quantity || $record->item_stock == $record->item_quantity)
                          <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assetDistribution"
                        id="distributeItems">
                              <i class="fas fa-plus"></i>
                          </button>
                      @else
                      @endif
                      @can('Asset Management')
                        @if ($record->isRequested == 0 && $record->isAssigned == 0 && $record->item_stock == $record->item_quantity)
                          <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#editRequestIcs" id="requestBtn">
                            Request to Edit
                          </button>
                          @elseif ($record->isRequested == 1 && $record->asset_type_id != null)
                          <button class="btn btn-sm btn-warning" disabled>
                            Approved
                          </button>
                          @elseif ($record->isRequested == 1)
                        <button class="btn btn-sm btn-warning" disabled>
                            Pending
                          </button>
                        @endif
                      @endcan
                      @can('Supervisor')
                        @if ($record->isRequested == 0)
                        @elseif ($record->isRequested == 1 && $record->asset_type_id == null)
                        <a href="/acceptEdit/{{$record->id}}" class="btn btn-sm btn-info" data-toggle="confirmation" data-content="Approved Item {{$record->id}} to Edit?">
                            Accept to Edit
                        </a>
                        @else
                        @endif
                      @endcan
                  </tr>
                  @else
                      
                  @endif
                  @endforeach
  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endcan

<div class="col-md-12">&nbsp</div>

{{-- MODAL FOR ITEM CLASSIFICATION --}}
<div class="modal fade" id="printIcs">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5>Print Distributed ICS</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="po_id">
            <table id="itemIcs" class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-light">
                <tr>
                  <th>Signatory Name</th>
                  <th>Description</th>
                  <th>Position</th>
                  <th>Quantity  </th>
                  <th>Useful Life</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
  
              </tbody>
            </table>
          </div>
    </div>
  </div>
</div>


{{-- MODAL FOR ITEM CLASSIFICATION --}}
<div class="modal fade" id="itemsProcured">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <!-- Modal Header -->
      <form action="{{route('assets.store')}}" id="assetClassificationForm" autocomplete="off" method="post" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="modal-header">
          <h5>Classify Items Procured</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        {{-- body --}}
        <div class="modal-body">
          <div class="row">
              <div class="col-md-4">
                  <label style="color:tomato">PO Number: </label><input class="form-control" type="text" name="po_id" id="po_id" readonly/>
              </div>
              <div class="col-md-4">
                  <label style="color:black">Disbursement Number: </label><input class="form-control" type="text" name="voucherNo" required/><br>
              </div>
          </div>
          <hr>
          <input type="hidden" name="po_id">
          <table id="itemClassification" class="table table-bordered table-hover table-sm display nowrap w-100">
            <thead class="thead-light">
              <tr>
                <th>Item Name</th>
                <th>Amount</th>
                <th>Item Quantity</th>
                <th>PAR</th>
                <th>ICS</th>
                <th>Asset Type</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
          <hr>
          <button id="btn_submit" class="btn btn-primary">Classify Items</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL FOR ASSET DISTRIBUTION --}}
<div class="modal fade" id="assetDistribution">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5>Classify Items Procured: <b id='assetType'></b></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <input type="hidden" name="currentItemID">
      </div>
      <div class="modal-body">

        {{-- ICS INPUTS --}}
        <div class="container-fluid" id="icsInputs" style="display:none">
          <div class="row">
            <div class="col-md-6">
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Item</span>
                </div>
                {{-- SELECTED ITEM INPUT HERE  --}}
                <input type="text" name="selectedItemName" class="form-control" aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-sm" readonly>
              </div>
              <input type="text" id="qtyValIcs" hidden>
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Quantity</span>
                </div>
                {{-- QUANTITY SELECITION HERE --}}
                <select name="selectedItemQty" id="selectedItemQtyIcs" class="custom-select">
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
                <input type="text" name="selectedItemICSNo" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
              </div>
              <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Estimated Useful Life</span>
                </div>
                {{-- ESTIMATED USEFUL LIFE DATE HERE  --}}
                <input type="text" name="selectedItemEstimatedUsefulLife" class="form-control"
                  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm required" required>
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
                  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Name" required>
                <input type="text" name="selectedItemEmployeePosition" class="form-control"
                  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Position" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12" id="selectedItemDescription">
              <label>Description:</label><br>
              <textarea name="selectedItemDescription" cols="30" rows="10"
                class="form-control form-control-sm"></textarea>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button id='distributionFormSubmit' class="btn btn-primary">Assign Item</button>
        <button class="btn btn-warning" data-dismiss="modal">cancel</button>
      </div>
    </div>
  </div>
</div>
</div>

{{-- REQUEST TO EDIT MODAL --}}
<div class="modal" id="editRequestIcs">
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
<script src="{{asset('js/asset_moduleFinal.js')}}"></script>
@endsection