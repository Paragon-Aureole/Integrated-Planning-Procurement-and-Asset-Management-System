@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Capture Existing Assets</li>
</ol>
@endsection

@section('content')
    <div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb-2"><i class="fas fa-table"></i> Capture Existing Assets</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="card-title">
                            Input Existing Assets Data
                        </h6>
                        <div id="cloneAssetType">
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label for="classification" class="small">Classification:</label>
                                    <select name="assetType" id="classification" class="form-control form-control-sm">
                                        <option value="0">-Select Asset Type-</option>
                                        <option value="ICS">Inventory Custodian Slip</option>
                                        <option value="PAR">Property Acknowledgement Receipt</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="asset_type" class="small">Type of Asset:</label>
                                    <select name="assetType" id="asset_type" class="form-control form-control-sm">
                                        {{-- <option value="0">-Select Asset Type-</option> --}}
                                        <option value="1">Vehicle</option>
                                        <option value="2">Office Supplies</option>
                                        <option value="3">Furnitures and Fixtures</option>
                                        <option value="4">IT Equipments</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        {{-- inputs for office assets --}}
                        <div id="office_assets" style="display:none">
                            <form action="{{route('migrateAssets.store')}}" method="post">
                                    
                                <div id="cloneInputs">
                                    <div class="row">
                                        <input type="text" id="classification_id" name="classification[]" hidden>
                                        <input type="text" id="asset_type_id" name="asset_type_id[]" hidden>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Entity Name:</label>
                                                <select name="entity_name[]" class="form-control form-control-sm">
                                                    @foreach ($office as $officeValue)
                                                        <option value="{{$officeValue->id}}">{{$officeValue->office_code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Fund Cluster:</label>
                                                <input type="text" name="fund_cluster[]" class="form-control form-control-sm" required>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Receiver name:</label>
                                                <input type="text" name="receiver_name[]" class="form-control form-control-sm" required>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Receiver Position:</label>
                                                <input type="text" name="receiver_position[]" class="form-control form-control-sm" required>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Issuer Name:</label>
                                                <input type="text" name="issuer_name[]" class="form-control form-control-sm" required>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Issuer Position:</label>
                                                <input type="text" name="issuer_position[]" class="form-control form-control-sm" required>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Item Quantity:</label>
                                                <input type="number" name="item_quantity[]" class="form-control form-control-sm" required>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Item Unit:</label>
                                                <input type="text" name="item_unit[]" class="form-control form-control-sm" required>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Property Number:</label>
                                                <input type="text" name="property_number[]" class="form-control form-control-sm" required>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Date Acquired:</label>
                                                <input type="date" name="date_acquired[]" class="form-control form-control-sm" required>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Unit Cost:</label>
                                                <input type="number" name="unit_cost[]" class="form-control form-control-sm" required>
                                            </div> 
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Amount:</label>
                                                <input type="number" name="amount[]" class="form-control form-control-sm" required>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">PAR Number:</label>
                                                <input type="text" name="par_number[]" class="form-control form-control-sm" required>
                                            </div> 
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="form-group col-sm-12">
                                                <label class="small">Item Description:</label><br>
                                                <textarea id="description" name="description[]" cols="180" rows="1" class="form-control form-control-sm"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="height:5px; background-color:grey">
                                </div>
                                <div id="clonedInputs">

                                </div>
                                {{csrf_field()}}
                               <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group col-md-6">
                                            <button title="Capture New Data" id="cloneData" class="btn btn-warning"> <i class="fas fa-plus"></i></button>  
                                            <button title="Save Information Inputted" type="submit" class="btn btn-primary">Capture Data</button>
                                        </div>
                                    </div>
                               </div>
                            </form>
                        </div>


                        {{-- inputs for vehicle --}}
                        <div id="vehicle" style="display:none">
                            <form action="{{route('migrateIcsAssets.store')}}" method="post">
                                <div id="cloneIcs">
                                    
                                    <div class="row">
                                            <input type="text" id="classification_id_ics" name="classification_ics[]" hidden>
                                            <input type="text" id="asset_type_id_ics" name="asset_type_id_ics[]" hidden>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Receiver Name:</label>
                                                <input type="text" name="receiver_name[]" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Receiver Position:</label>
                                                <input type="text" name="receiver_position[]" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Issuer Name:</label>
                                                <input type="text" name="issuer_name[]" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Issuer Position:</label>
                                                <input type="text" name="issuer_position[]" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Item Quantity:</label>
                                                <input type="number" name="item_quantity[]" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Item Unit:</label>
                                                <input type="text" name="item_unit[]" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Inventory Item Number:</label>
                                                <input type="text" name="inventory_item_number[]" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">Estimated Useful Life:</label>
                                                <input type="text" name="estimated_useful_life[]" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group col-md-12">
                                                <label class="small">ICS Number:</label>
                                                <input type="text" name="ics_number[]" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="col-md-12">
                                                <label class="small">Item Description:</label><br>
                                                <textarea id="description" name="description[]" cols="180" rows="1" class="form-control form-control-sm"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="height:5px; background-color:grey">
                                </div>
                                <div id="clonedIcs">

                                </div>
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group col-md-6">
                                            <button title="Capture New Data" id="buttonCloneIcs" class="btn btn-warning"> <i class="fas fa-plus"></i></button>  
                                            <button title="Save Information Inputted" type="submit" class="btn btn-primary">Capture Data</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">&nbsp</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb-2">List of Captured Assets</div>
        <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6 class="card-title">
                Captured Property Acknowledgement Receipt
            </h6>
            <div class="table-responsive">
            <table id="parDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                <thead class="thead-dark">
                <tr>
                    <th>Receiver</th>
                    <th>Position</th>
                    <th>PAR Number</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($migratedAssets as $migratedAssetsValue)
                    <tr>
                        <td>{{$migratedAssetsValue->receiver_name}}</td>
                        <td>{{$migratedAssetsValue->receiver_position}}</td>
                        <td>{{$migratedAssetsValue->par_number}}</td>
                        <td>
                            <a href="#printPAR" target="_blank" class="btn btn-sm btn-success">
                                <i class="fas fa-print"></i>
                            </a>
                            @can('full control')
                            <a id="deletePar" href="{{route('migrateAssets.destroy', $migratedAssetsValue->id)}}" class="btn btn-sm btn-danger">
                                <i class="fas fa-minus"></i>
                            </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div> 
        </div>
    
            <!-- table -->
            <div class="col-md-6">
                <h6 class="card-title">Inventory Custodian Slip</h6>
                <div class="table-responsive">
                    <table id="icsDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                <thead class="thead-dark">
                <tr>
                    <th>Receiver</th>
                    <th>Position</th>
                    <th>ICS Number</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($migratedIcsAssets as $migratedIcsAssetsValue)
                    <tr>
                        <td>{{$migratedIcsAssetsValue->receiver_name}}</td>
                        <td>{{$migratedIcsAssetsValue->receiver_position}}</td>
                        <td>{{$migratedIcsAssetsValue->ics_number}}</td>
                        <td>
                            <a href="#printICS" target="_blank" class="btn btn-sm btn-success">
                                <i class="fas fa-print"></i>
                            </a>
                            @can('full control')
                            <a id="deleteIcs" href="{{route('migrateIcsAssets.destroy', $migratedIcsAssetsValue->id)}}" class="btn btn-sm btn-danger">
                                <i class="fas fa-minus"></i>
                            </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                </div>	
            </div>
        </div>
        </div>
    </div>
    
    </div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    
    selectAssetType();
    function selectAssetType () {
        $('#classification').on('change', function(){
            var classification = $('#classification').val();
                if (classification == 'ICS') {
                    $('#asset_type').val('2').attr('selected');
                    $('#classification_id_ics').empty();
                    $('#asset_type_id_ics').empty();
                    $('#clonedInputs').empty();

                    $('#classification_id_ics').val(classification);
                    $('#asset_type_id_ics').val(2);
                    $('#vehicle').show();
                    $('#office_assets').hide();
                    
                } else if (classification == 'PAR') {
                    $('#asset_type').val('3').attr('selected');
                    $('#classification_id').empty();
                    $('#asset_type_id').empty();
                    $('#clonedInputs').empty();

                    $('#classification_id').val(classification);
                    $('#asset_type_id').val(3);
                    $('#office_assets').show();
                    $('#vehicle').hide();
                }else {
                    $('#asset_type').val('1').attr('selected');
                    console.log('No type Selected');
                    $('#vehicle').hide();
                    $('#office_assets').hide();
                }
            });

            $('#asset_type').on('change', function () {
                var asset_type = $('#asset_type').val();
                var classification = $('#classification').val();
                if (asset_type == 1 && classification == 'PAR') {
                    $('#asset_type_id').empty();

                    $('#asset_type_id').val(asset_type);
                    
                    
                } else if ((asset_type == 2 && classification == 'PAR') || (asset_type == 3 && classification == 'PAR') || (asset_type == 4 && classification == 'PAR')) {
                    console.log(asset_type);
                    
                    $('#asset_type_id').empty();

                    $('#asset_type_id').val(asset_type);
                }else if (asset_type == 1 && classification == 'ICS'){
                    console.log(asset_type);
                    
                    $('#asset_type_id_ics').empty();

                    $('#asset_type_id_ics').val(asset_type);
                }else if ((asset_type == 2 && classification == 'ICS') || (asset_type == 3 && classification == 'ICS') || (asset_type == 4 && classification == 'ICS')) {
                    console.log(asset_type);
                    $('#asset_type_id_ics').empty();
                    $('#asset_type_id_ics').val(asset_type);
                }
            })
    }

    $('#cloneData').on('click', function (e) {
        e.preventDefault();
        console.log('clicked');
        $( "#cloneInputs" ).clone().appendTo( "#clonedInputs" );
    });

    $('#buttonCloneIcs').on('click', function (e) {
        e.preventDefault();
        console.log('clicked');
        $( "#cloneIcs" ).clone().appendTo( "#clonedIcs" );
    });

    var parTable = $('#parDatatable').DataTable({
        responsive: true,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
    });

    parTable.on('click', 'a#deletePar', function () {

        console.log('clicked delete');
        
          var parData = parTable.row( $(this).parents('tr') ).data();
          
          var validate = confirm('Are you sure you want to Delete ' + parData[2]);

          if (validate == true) {
              return true
          } else {
              return false
          }
        
    });

    var icsTable = $('#icsDatatable').DataTable({
        responsive: true,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
    });

    icsTable.on('click', 'a#deleteIcs', function () {

        console.log('clicked delete');
        
          var icsData = icsTable.row( $(this).parents('tr') ).data();
          
          var validate = confirm('Are you sure you want to Delete ' + icsData[2]);

          if (validate == true) {
              return true
          } else {
              return false
          }
        
    });


    

  });
</script>
@endsection