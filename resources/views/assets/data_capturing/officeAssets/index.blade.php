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
                                        <div class="form-group col-md-12">
                                            <label for="name_of_accountable" class="small">Name of Accountable:</label>
                                            <input type="text" name="name_of_accountable" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="official_designation" class="small">Official Designation:</label>
                                            <input type="text" name="official_designation" class="form-control form-control-sm">
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
                                            <label for="onhand_per_count" class="small">Onhand Per Card:</label>
                                            <input type="number" name="onhand_per_count" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="shortage_overage" class="small">Shortage/Overage:</label>
                                            <input type="text" name="shortage_overage" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="date_purchase" class="small">Date Purchase:</label>
                                            <input type="text" name="date_purchase" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="remarks" class="small">Remarks:</label>
                                            <input type="text" name="remarks" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- inputs for vehicle --}}
                        <div id="vehicle" style="display:none">
                            <form action="{{route('migrateAssetsVehicle.storeVehicle')}}" method="post">
                                    {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6">
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
                                            <input type="text" name="acquisition_date" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="acquisition_cost" class="small">Acquisition Cost:</label>
                                            <input type="text" name="acquisition_cost" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="office" class="small">Office:</label>
                                            <input type="text" name="office" class="form-control form-control-sm">
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
                    
                    <div class="col-md-7">
                        <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Department</th>
                                    <th>Asset Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($migratedAssets as $migrationItem)
                                    <tr>
                                        <td>{{$migrationItem->signatory_name}}</td>
                                        <td>{{$migrationItem->item}}</td>
                                        <td>
                                            <a href="http://ipams.test/printPar" target="_blank" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-print"></i>
                                            </a>
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
    $('#asset_type').on('change', function(){
    var asset_type = $('#asset_type').val();
        if (asset_type == 1) {
            console.log('show vehicle');
            $('#vehicle').show();
            $('#office_assets').hide();
            
        } else if (asset_type == 1 || asset_type == 2 || asset_type == 3 || asset_type == 4) {
            console.log('show Ofice Asset');
            $('#office_assets').show();
            $('#vehicle').hide();
        }else {
            console.log('No type Selected');
            $('#vehicle').hide();
            $('#office_assets').hide();
        }
        
    });
  });
</script>
@endsection