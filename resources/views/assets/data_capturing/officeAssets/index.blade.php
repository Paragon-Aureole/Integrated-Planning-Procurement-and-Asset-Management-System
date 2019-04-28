@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Migrate Existing Assets</li>
</ol>
@endsection

@section('content')
    <div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb-2"><i class="fas fa-table"></i>Migrate Existing Assets</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <h6 class="card-title">
                            Migrate Existing Assets
                        </h6>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="asset_type" class="small">Type of Asset:</label>
                                <select name="assetType" id="asset_type" class="form-control form-control-sm">
                                    <option value="0">-Select Asset Type-</option>
                                    <option value="1">Vehicle</option>
                                    <option value="2">Office Supplies</option>
                                    <option value="3">Furnitures and Fixtures</option>
                                    <option value="4">IT Equipments</option>
                                </select>
                            </div>
                        </div>
                        
                        {{-- inputs for office assets --}}
                        <div id="office_assets" style="display:none">
                            <form action="{{route('migrateAssets.store')}}" method="post" id="needs-validation" novalidate>
                                    {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" id="asset_type_officeAsset" name="asset_type_officeAsset" hidden>
                                        <div class="form-group col-md-12">
                                            <label for="name_of_accountable" class="small">Name of Accountable:</label>
                                            <input type="text" name="name_of_accountable" class="form-control form-control-sm" value="Teresita M. Gacayan" readonly>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="official_designation" class="small">Official Designation:</label>
                                            <input type="text" name="official_designation" class="form-control form-control-sm" value="OIC-City GSO" readonly>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="lgu" class="small">LGU:</label>
                                            <input type="text" name="lgu" class="form-control form-control-sm" value="CSF" readonly>
                                        </div>
                                        <hr>
                                        <div class="form-group col-md-12">
                                            <label for="article" class="small">Article</label>
                                            <input type="text" name="article" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="office_id" class="small">Department:</label>
                                            <select name="office_id" class="form-control form-control-sm">
                                                <option value="">-Select One-</option>
                                                @foreach ($office as $officeValue)
                                                    <option value="{{$officeValue->id}}">{{$officeValue->office_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description" class="small">Description:</label>
                                            <input type="text" name="description" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="property_number" class="small">Property Number:</label>
                                            <input type="number" name="property_number" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div>&nbsp</div>
                                            <button type="submit" class="btn btn-primary"> Submit</button>
                                            <button type="reset" class="btn btn-secondary"> Clear</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label for="unit_of_measure" class="small">Unit of Measure:</label>
                                            <input type="text" name="unit_of_measure" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="unit_value" class="small">Unit Value:</label>
                                            <input type="number" name="unit_value" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="balance_per_card" class="small">Balance Per Card:</label>
                                            <input type="number" name="balance_per_card" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="on_hand_per_count" class="small">Onhand Per Card:</label>
                                            <input type="number" name="on_hand_per_count" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="shortage_overage" class="small">Shortage/Overage:</label>
                                            <input type="text" name="shortage_overage" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="date_purchase" class="small">Date Purchase:</label>
                                            <input type="date" name="date_purchase" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="status" class="small">Status/Condition/Worthiness:</label>
                                            <select name="status" class="form-control form-control-sm">
                                                <option value="Good">Good</option>
                                                <option value="Fair">Fair</option>
                                                <option value="Repairable">Repairable</option>
                                                <option value="Unserviceable">Unserviceable</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="remarks" class="small">Remarks:</label>
                                            <input type="text" name="remarks" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="par_ics_number" class="small">PAR/ICS Number:</label>
                                            <input type="text" name="par_ics_number" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- inputs for vehicle --}}
                        <div id="vehicle" style="display:none">
                            <form action="{{route('migrateVehicle.store')}}" method="post">
                                    {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" id="asset_type_vehicle" name="asset_type_vehicle" hidden>
                                        <div class="form-group col-md-12">
                                            <label for="number" class="small">Number:</label>
                                            <input type="text" name="number" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="type_of_vehicle" class="small">Type of Vehicle:</label>
                                            <input type="text" name="type_of_vehicle" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="make" class="small">Make:</label>
                                            <input type="text" name="make" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="plate_number" class="small">Plate Number:</label>
                                            <input type="text" name="plate_number" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div>&nbsp</div>
                                            <button type="submit" class="btn btn-primary"> Submit</button>
                                            <button type="reset" class="btn btn-secondary"> Clear</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label for="acquisition_date" class="small">Acquisition Date:</label>
                                            <input type="date" name="acquisition_date" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="acquisition_cost" class="small">Acquisition Cost:</label>
                                            <input type="text" name="acquisition_cost" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                                <label for="office" class="small">Department:</label>
                                                <select name="office" class="form-control form-control-sm">
                                                    <option value="">-Select One-</option>
                                                    @foreach ($office as $officeValue)
                                                        <option value="{{$officeValue->id}}">{{$officeValue->office_name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="accountable_officer" class="small">Accountable Officer:</label>
                                            <input type="text" name="accountable_officer" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="status" class="small">Status/Condition/Worthiness:</label>
                                            <select name="status" class="form-control form-control-sm">
                                                <option value="Good">Good</option>
                                                <option value="Fair">Fair</option>
                                                <option value="Repairable">Repairable</option>
                                                <option value="Unserviceable">Unserviceable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="col-md-7" id="officeDataTable">
                        <table id="migratedAssetDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="display:none">Office ID</th>
                                    <th>Department</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($office as $officeItem)
                                    <tr>
                                        <td style="display:none;">
                                            {{$officeItem->id}}
                                        </td>
                                        <td>
                                            {{$officeItem->office_name}}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-target="#migratedAssetModal" data-toggle="modal" id="viewMigratedItems"><i class="fas fa-th-list"></i></button>
                                            {{-- <a href="http://ipams.test/printPar" target="_blank" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-print"></i>
                                            </a> --}}
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

    {{-- MODAL --}}
    <div class="modal fade" id="migratedAssetModal" data-backdrop="static" data-keyboard="false"> 
            <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5>Purchase Order Form Details</h5>
                    <button id="closeModal" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                       <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" id="office_id_modal" hidden>
                                <select class="custom-select" id="modal_asset_type">
                                    <option value="0">-Select One-</option>
                                    @foreach ($assetType as $assetTypeItem)
                                        <option value="{{$assetTypeItem->id}}">{{$assetTypeItem->type_name}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                <button class="btn btn-xl btn-secondary" id="print_migration"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div>&nbsp</div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Name of Accountable</th>
                                        <th>Office</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
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
        $('#asset_type').on('change', function(){
            var asset_type = $('#asset_type').val();
                if (asset_type == 1) {
                    console.log('show vehicle');
                    $('#asset_type_vehicle').empty();

                    $('#asset_type_vehicle').val(asset_type);
                    $('#vehicle').show();
                    $('#office_assets').hide();
                    
                } else if (asset_type == 1 || asset_type == 2 || asset_type == 3 || asset_type == 4) {
                    console.log('show Ofice Asset');
                    $('#asset_type_officeAsset').empty();

                    $('#asset_type_officeAsset').val(asset_type);
                    $('#office_assets').show();
                    $('#vehicle').hide();
                }else {
                    console.log('No type Selected');
                    $('#vehicle').hide();
                    $('#office_assets').hide();
                }
            });
    }

    $('[name=asset_types]').on('change', function () {
        console.log('changed');
        
        var assetTypes = $('[name=asset_types]').val();
        if (assetTypes == 1) {
            console.log('1');
            
            $('[name=asset_id]').val(assetTypes);

        }else if (assetTypes == 2) {
            $('[name=asset_id]').val(assetTypes);

        }else if (assetTypes == 3) {
            $('[name=asset_id]').val(assetTypes);
        }
    });

    var table = $('#migratedAssetDatatable').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
        });

    table.on('click', 'button#viewMigratedItems', function () {
        var data = table.row( $(this).parents('tr') ).data();
        $('#office_id_modal').val(data[0]);
        getModalContent(data);
        
    });

    $('#closeModal').on('click', function () {
        location.reload()
        
    })

    
    function  getModalContent(data) {
        var values;
        values = {
            office_id : data[0]
        }
        $.ajax({
            url: '/migrationDatatable',
            method: 'get',
            data: values,
            success: function ( response ) {
                var migratedOfficeAssets = response.migratedAssets;
                var migratedOfficeVehicles = response.migratedVehicles;
                
                // console.log(migratedVehicles);
                
                validateAssetType(migratedOfficeAssets, migratedOfficeVehicles);               
            }
        })  
    }

    function validateAssetType(migratedOfficeAssets, migratedOfficeVehicles) {     
        var office_id_asset;
        var office_id_vehicle;
        $('#modal_asset_type').on('change', function () {
            $(migratedOfficeAssets).each(function(i, v) {
                office_id_asset = v.office_id
            })

            $(migratedOfficeVehicles).each(function(i, v) {
                office_id_vehicle = v.office_id
            })

            var values = {
                asset_type_id : $('#modal_asset_type').val(),
                office_id : office_id_asset,
                office_id_vehicle : office_id_vehicle
            }

            if (values.asset_type_id == 2 || values.asset_type_id == 3 || values.asset_type_id == 4) {
                $.ajax({
                    url: '/validateAssetType',
                    method: 'get',
                    data: values,
                    success: function ( response ) {
                        var migratedAssets = response.migratedAssets;
                        var office = response.office;
                        
                        // console.log(office);
                        
                        populateModalTable(migratedAssets, office);               
                    }
                }); 

            } else if (values.asset_type_id == 1) { 
                $.ajax({
                    url: '/validateAssetTypeVehicle',
                    method: 'get',
                    data: values,
                    success: function ( response ) {
                        var migratedVehicles = response.migratedVehicles;
                        var office = response.office;
                        
                        // console.log(office);
                        console.log(migratedVehicles);
                        
                        populateModalTableVehicle(migratedVehicles, office);               
                    }
                }); 
            } 
        });
    }

    function populateModalTable(migratedAssets, office) {
        
        table = $('#datatable').DataTable({
            destroy:true,
            data: migratedAssets,
            responsive:true,
            columns:[
                {data:'name_of_accountable'},
                {data: 'office_id'},
                {data:'status'},
            ]
        })
    }

    function populateModalTableVehicle(migratedVehicles, office) {
        table = $('#datatable').DataTable({
            destroy:true,
            data: migratedVehicles,
            responsive:true,
            columns:[
                {data:'accountable_officer'},
                {data:'office_id'},
                {data:'status'},
            ]
        })
    };

    $('#print_migration').on('click', function () {
        var values = {
            office_id : $('#office_id_modal').val(),
            asset_type_id : $('#modal_asset_type').val(),
        }
        console.log(values);
        
        $.ajax({
            url: '/selectMigratedAssets',
            method: 'get',
            data: values,
            success: function ( response ) {
                if (response.input.asset_type_id == 1) {
                    window.open('printMigratedVehicles/' + response.input.office_id + '/' + response.input.asset_type_id , '_blank');

                } else {
                    window.open('printMigratedAssets/' + response.input.office_id + '/' + response.input.asset_type_id , '_blank');
                    
                }
                          
            },
            error: function ( response ) {
                console.log(response);
                
            }
        }); 
    });

  });
</script>
@endsection