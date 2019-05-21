@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Turnover Assets</li>
</ol>
@endsection

@section('content')
{{-- <div class="container-fluid"> --}}
    <div class="card">
        <div class="card-header pt-2 pb-2">List of Distributed Items</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class=" form-group col-md-3">
                            Department:
                            <select name="asset_type" id="asset_type" class="form-control form-control-sm">
                                <option value="1">ICT</option>
                                <option value="2">ADM</option>
                                <option value="3">ADM</option>
                                <option value="4">ICT</option>
                            </select>
                        </div>
                        <div class=" form-group col-md-3">
                            Signatory Name:
                            <select name="asset_type" id="asset_type" class="form-control form-control-sm">
                                <option value="1">ICT</option>
                                <option value="2">ADM</option>
                                <option value="3">ADM</option>
                                <option value="4">ICT</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr style="height: 5px; background-color:gray">
                <div class="col-md-12">
                    <h6 class="card-title">
                        Available Distributed Assets
                    </h6>
                    <a href="#chosenItems" class="btn btn-info btn-md float-right">View Chosen Items</a>
                    <table id="itemDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-light">
                            <tr>
                                <th>Item</th>
                                <th>Status</th>
                                <th>PAR Number</th>
                                <th>Description</th>
                                <th data-priority='4'>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="parTbody">

                            {{-- @foreach ($to as $record) --}}
                            <tr>
                                <td>Laptop</td>
                                <td><h4><span class="badge badge-info">Active</span></h4></td>
                                <td>PAR - 1000211</td>
                                <td>SN: 38303040880</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Laptop</td>
                                <td><h4><span class="badge badge-warning">Pending Turnover</span></h4></td>
                                <td>PAR - 1000211</td>
                                <td>SN: 38303040880</td>
                                <td><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i></button></td>
                            </tr>
                            <tr>
                                <td>Laptop</td>
                                <td><h4><span class="badge badge-danger">Unserviceable</span></h4></td>
                                <td>PAR - 1000211</td>
                                <td>SN: 38303040880</td>
                                <td><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i></button></td>
                            </tr>
                            {{-- @endforeach --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
<div class="col-md-12">&nbsp;</div>
<div id="chosenItems">
    <div class="row">
        <div class="col-sm-6 container-fluid">
            {{-- <div class="container-fluid"> --}}
                <div class="card">
                    <div class="card-header pt-2 pb-2">List of Chosen Turnover Items</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-4">
                                    <label>Turnover Number:</label>
                                    <input name="po_number" id="po_number" class="form-control" type="text" value="" readonly>
                                </div>
                                <button class="btn btn-info btn-md float-right">Save Chosen Items</button>
                                <table id="chosenDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Item</th>
                                            <th>Status</th>
                                            <th>PAR Number</th>
                                            <th>Description</th>
                                            <th data-priority='4'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="parTbody">
            
                                        {{-- @foreach ($to as $record) --}}
                                            <tr>
                                            <td>Laptop</td>
                                            <td><h4><span class="badge badge-info">Active</span></h4></td>
                                            <td>PAR - 1000211</td>
                                            <td>SN: 38303040880</td>
                                            <td><button class="btn btn-danger btn-sm"><i class="fas fa-minus"></i></button></td>
                                        </tr>
                                        {{-- @endforeach --}}
            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
        <div class="col-sm-6 container-fluid">
            {{-- <div class="container-fluid"> --}}
                <div class="card">
                    <div class="card-header pt-2 pb-2">List of Requested Turnover Items</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="turnedOverDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Turnover #</th>
                                            <th>Status</th>
                                            <th>Details</th>
                                            <th data-priority='3'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="parTbody">
            
                                        {{-- @foreach ($to as $record) --}}
                                            <tr>
                                            <td>1</td>
                                            <td><h4><span class="badge badge-info">Active</span></h4></td>
                                            <td>||Printer|| ||laptop||</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm"><i class="fas fa-check" title="Approved Turnover Request"></i></button>
                                                <a href="AssetTurnover/create" class="btn btn-info btn-sm"><i class="fas fa-th-list" title="View Items"></i></a>
                                                <button class="btn btn-success btn-sm"><i class="fas fa-print" title="Print Turnover Request"></i></button>
                                            </td>
                                        </tr>
                                        {{-- @endforeach --}}
            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function () {
        var itemDataTable = $('#itemDatatable').DataTable({
            responsive: true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],

        });

        var chosenDatatable = $('#chosenDatatable').DataTable({
            responsive: true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
        });
        
        var turnedOverDataTable = $('#turnedOverDatatable').DataTable({
            responsive: true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
        });
    });
</script>
@endsection