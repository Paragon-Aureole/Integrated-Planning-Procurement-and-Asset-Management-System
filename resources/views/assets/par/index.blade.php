@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
        <li class="breadcrumb-item active" aria-current="page">PAR Module </li>
    </ol>
@endsection

@section('content')

<form action="{{route('assets.store')}}" method="post">
    {{csrf_field()}}
    {{--  <input type="hidden" name="purchase_order_id" value={{$assetData[0]->purchase_order_id}}>  --}}
    {{--  <input type="hidden" name="PO_id" value={{$id->searchPO}}></input>  --}}
    <div class="container-fluid">
        <div class="card">
            <div class="card-header pt-2 pb-2">List of Item</div>
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>Item</th>
                                <th>Item Qty</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>Sample Item</td>
                              <td>sample Item Qty</td>
                              <td>Sample Price</td>
                              <td><!-- Trigger the modal with a button -->
                                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#inputSignatoryModal">Assign</button></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                      <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                          <thead class="thead-dark">
                              <tr>
                                  <th>Received By</th>
                                  <th>Items</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                <td>TEDD MAMUYAC</td>
                                <td>
                                  <!-- Trigger the modal with a button -->
                                  <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#itemsAssignedModal">Items Assigned</button>
                                </td>
                                <td>
                                  <a href="http://ipams.test/printPar" target="_blank" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-print"></i>
                                  </a>
                                </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                </div>

                {{-- <input type="submit" class="btn btn-primary"> --}}

            </div>
        </div>
    </div>

</form>

<!-- Modal for inputting signatory -->
<div class="modal" id="inputSignatoryModal">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Input Signatory</h3>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>

        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Item</span>
                    </div>
                    {{-- SELECTED ITEM INPUT HERE  --}}
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                  </div>
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Quantity</span>
                    </div>
                    {{-- QUANTITY SELECITION HERE --}}
                    <select name="" id="" class="custom-select">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="N">N</option>
                    </select>
                  </div>
                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Unit Cost</span>
                    </div>
                    {{-- UNIT COST INPUT HERE  --}}
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                  </div>
              </div>
              <div class="col-md-6">
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">diko maintindihan #</span>
                  </div>
                  {{-- DIKO MAINTINDIHAN INPUT HERE  --}}
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">diko maintindihan date</span>
                  </div>
                  {{-- DIKO MAINTIDIHAN DATE HERE  --}}
                  <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">di ko talga to maintindihan</span>
                  </div>
                  {{-- ????????????? INPUT HERE  --}}
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Name">
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Position">
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label>Specifications:</label><br>
                <textarea name="" id="" cols="30" rows="10" class="form-control form-control-sm"></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Save</button>
          <button class="btn btn-warning">cancel</button>
        </div>
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
<script type="text/javascript">
  $(document).ready(function() {
      var table =  $('#prDatatable').DataTable({
              responsive: true,
              "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
      });

      $('#prDatatable tbody').on('click', 'tr', function(){
        $('[name=pr_id]').val(table.row(this).index()+1);
      });
  });
</script>
@endsection
