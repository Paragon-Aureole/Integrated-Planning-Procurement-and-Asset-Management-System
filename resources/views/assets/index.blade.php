@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
        <li class="breadcrumb-item active" aria-current="page">CLassification and Distribution</li>
    </ol>
@endsection

@section('content')
{{-- <form action="{{route('assets.assetClassification')}}" method="get">
    {{csrf_field()}}

    <div class="container">
        <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search for Purchase Order Number" name="purchase_order_id">
        <div class="input-group-append">
            <input class="btn btn-outline-secondary" type="submit" />
        </div>
    </div>
    </div>
</form> --}}
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
                <thead class="thead-dark">
                  <tr>
                    <th>PO Number</th>
                    <th>Office</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($asset as $assetValue)
                    <tr>
                      {{-- <td>00000001</td>
                      <td>Office of the City Mayor</td> --}}
                      <td>{{$assetValue->purchaseOrder->id}}</td>
                      <td>{{$assetValue->user->office->office_name}}</td>
                        <td>
                          <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#itemsProcured" id="classificationModalBtn">
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
            <h6 class="card-title">Classified Items</h6>
            <div class="table-responsive">
                <table id="classifiedDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                  <thead class="thead-dark">
                    <tr>
                      <th>Item Name</th>
                      <th>Office</th>
                      <th>Classification</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>Laptop</td>
                        <td>Office of the City Mayor</td>
                        <td>PAR</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assetDistribution" id="distributeItems">
                                <i class="fas fa-plus"></i>
                            </button>
                            @can('full control')
                            <button class="btn btn-sm btn-danger">
                              <i class="fas fa-minus"></i>
                            </button>
                            @endcan
                          </td>
                      </tr>
                      <tr>
                        <td>Stapler</td>
                        <td>Office of the City Mayor</td>
                        <td>ICS</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assetDistribution" id="distributeItems">
                                <i class="fas fa-plus"></i>
                            </button>
                            @can('full control')
                            <button class="btn btn-sm btn-danger">
                              <i class="fas fa-minus"></i>
                            </button>
                            @endcan
                          </td>
                      </tr>
                  </tbody>
                </table>
            </div>	
          </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-12">&nbsp</div>

{{-- TABLE FOR DISTRIBUTED ASSETS --}}
<div class="container-fluid">
    <div class="card">
      <div class="card-header pt-2 pb-2">Distributed Assets</div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
              <h6 class="card-title">Distributed Items</h6>
              <div class="table-responsive">
                  <table id="distributedItemsDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                    <thead class="thead-dark">
                      <tr>
                        <th>Signatory Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Classification</th>
                        <th>Asset Type</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td>Tedd Mamuyac</td>
                          <td>System Admininstrator</td>
                          <td>Office of the City Administration</td>
                          <td>Laptop</td>
                          <td>1</td>
                          <td>50,000</td>
                          <td>PAR</td>
                          <td>IT Equipments</td>
                          <td>
                              <a href="/printPar" target="_blank" class="btn btn-sm btn-success">
                                <i class="fas fa-print"></i>
                              </a>
                              @can('full control')
                              <button class="btn btn-sm btn-danger">
                                <i class="fas fa-minus"></i>
                              </button>
                              @endcan
                            </td>
                        </tr>
                    </tbody>
                  </table>
              </div>	
            </div>
        </div>
      </div>
    </div>
  </div>

{{-- MODAL FOR ITEM CLASSIFICATION --}}
<div class="modal fade" id="itemsProcured">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h5>Classify Items Procured</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          {{-- body --}}
          <div class="modal-body">
            <label style="color:tomato">PO Number:  <p id="po_id"></p></label>
              <table id="itemClassification" class="table table-bordered table-hover table-sm display nowrap w-100">
                  <thead class="thead-dark">
                    <tr>
                      <th>Item Name</th>
                      <th>Amount</th>
                      <th>Item Quantity</th>
                      <th>ICS</th>
                      <th>PAR</th>
                      <th>Asset Type</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
              </table>
          </div>
      </div>
    </div>
</div>

{{-- MODAL FOR ASSET DISTRIBUTION --}}
<div class="modal fade" id="assetDistribution">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h5>Classify Items Procured</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            {{-- PAR INPUTS --}}
              <div class="container-fluid" id="parInputs" style="display:none">
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
                
                {{-- ICS INPUTS --}}
                <div class="container-fluid" id="icsInputs" style="display:none">
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
                <button class="btn btn-warning" data-dismiss="modal">cancel</button>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
        var table = $('#classifiedDatatable').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
        });

        $('#distributedItemsDatatable').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
        });

        table.on('click', 'button#distributeItems', function () {
          console.log('CLICKED');
          
          var data = table.row( $(this).parents('tr') ).data();
          
          toggleModalBody(data);

        });

        // show hide toggle for par and ics
        function toggleModalBody(data) {
          if (data[2] == 'PAR') {
            $('#parInputs').show();
            $('#icsInputs').hide();
          } else {
            $('#icsInputs').show();
            $('#parInputs').hide();
            
          }
        }
        
        // fetching procured Asset PO id from Table
        ClassificationModal();
        function ClassificationModal () {
            var table = $('#availableDatatable').DataTable({
                responsive: true,
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
            });
            
            // onclick function for fetching
            $('#availableDatatable').on('click', 'button#classificationModalBtn', function () {
            var data = table.row( $(this).parents('tr') ).data();
            
            console.log(data[0]);
            
              // give fetched data to this function
            getClassifcationModalContent(data);
          
          });
        }

        // get data from controller using ajax 
        function getClassifcationModalContent(data) {
          // id that will fetch from controller
          var values = {
            po_id : data[0]
          }
          
          // ajax function
          $.ajax({
                url: '/getClassificationModalData',
                method: 'get',
                data: values,
                success: function ( response ) {
                  var ClassificationModalContent = response.ClassificationModalContent;
                  // give fetched data to this function
                  populateClassificationModal(ClassificationModalContent);
                },
                error: function ( response ){
                    console.log( response );
                }
            }) 
        }

        // get data then populate the modal dataTable
        function populateClassificationModal(ClassificationModalContent){
          // populate PO Id
            $('#po_id').empty();
            console.log(ClassificationModalContent[0].id);
            
            $('#po_id').text(ClassificationModalContent[0].id);

            // Populate DataTable
            table = $('#itemClassification').DataTable({
              destroy:true,
              "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
              data: ClassificationModalContent,
              responsive:true,
              columns:[
                  {data:'details'},
                  {data:'amount'},
                  {data:'item_stock'},
                  {
                      'data': null,
                      'defaultContent': '<input type="radio" name="PARorICS[]" value="ICS">'
                  },
                  {
                      'data': null,
                      'defaultContent': '<input type="radio" name="PARorICS[]" value="PAR">'
                  },
                  {
                      'data': null,
                      'defaultContent': '<select name="asset_type[]" class="custom-select"><option value="">None</option><option value="">Vehicle</option>option value="">Office Supplies</option><option value="">Furniture and Fixture</option><option value="">IT Equipments</option>'
                  }
              ]
          })
        }
        
    } );
</script>
@endsection
