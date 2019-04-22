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

                        <form action="{{route('migrateAssets.store')}}" method="post" id="needs-validation" novalidate>
                                {{csrf_field()}}
                            <div class="form-group col-md-12">
                                <label for="item" class="small">Item:</label>
                                <input class="form-control form-control-sm" type="text" name="item" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="itemQty" class="small">Quantity:</label>
                                <input class="form-control form-control-sm" type="number" name="itemQty" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="unitCost" class="small">Unit Cost:</label>
                                <input class="form-control form-control-sm" type="number" name="unitCost" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="classificationNo" class="small">PAR/ICS No.:</label>
                                <input class="form-control form-control-sm" type="number" name="classificationNo" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="dateAssigned" class="small">Date Assigned:</label>
                                <input class="form-control form-control-sm" type="date" name="dateAssigned" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="totalAmount" class="small">Total Amount:</label>
                                <input class="form-control form-control-sm" type="number" name="totalAmount" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="signatoryName" class="small">Signatory Name:</label>
                                <input class="form-control form-control-sm" type="text" name="signatoryName" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="position" class="small">Position:</label>
                                <input class="form-control form-control-sm" type="text" name="position" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="totalAmmount" class="small">Type of Asset:</label>
                                <select name="assetType" id="assetType" class="form-control form-control-sm">
                                    <option value="1">Vehicle</option>
                                    <option value="2">Office Supplies</option>
                                    <option value="3">Furnitures and Fixtures</option>
                                    <option value="4">IT Equipments</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary"> Submit</button>
                                <button type="reset" class="btn btn-secondary"> Clear</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="col-md-7">
                        <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Received By</th>
                                    <th>Item</th>
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