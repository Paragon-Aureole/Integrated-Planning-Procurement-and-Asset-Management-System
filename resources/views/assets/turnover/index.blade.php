@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Turnover Assets</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            List of Distributed Items
            <a href="ViewTurnedover" title="Capture New Data" id="cloneData" class="btn btn-info float-right">View All
                Turned-over Items</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">

                        <div class=" form-group col-md-3">
                            Department:

                            <select name="departmentSelect" id="departmentSelect" class="form-control form-control-sm"
                                @hasrole('Department') readonly @endhasrole>
                                @foreach ($office as $item)
                                <option data-value="{{$item->office_code}}" value="{{$item->office_id}}"
                                    @hasrole('Department') selected @endhasrole>{{$item->office_name}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class=" form-group col-md-3">
                            Signatory Name:
                            <input type="text" name="departmentSignatory" id="departmentSignatory"
                                class="form-control form-control-sm" value="">
                        </div>
                    </div>
                </div>
                <hr style="height: 5px; background-color:gray">
                <div class="col-md-12">
                    <h6 class="card-title">
                        Available Distributed Assets
                    </h6>
                    <table id="itemDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-light">
                            <tr>
                                <th>Item ID</th>
                                <th>Item</th>
                                <th>Office Code</th>
                                <th>Assigned To</th>
                                <th>Status</th>
                                <th>PAR Number</th>
                                <th>Description</th>
                                <th data-priority='4'>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="parTbody">

                            @foreach ($to as $record)
                            {{--  {{$record->AssetParItem}} --}}
                            @foreach ($record->AssetParItem as $item)


                            <tr>
                                <td><input type="text" class="border-0" name="item_id[{{$item->id}}]"
                                        value={{$item->id}} readonly></td>
                                <td>{{$item->asset->details}}</td>
                                <td>{{$item->asset->purchaseOrder->purchaseRequest->office->office_code}}</td>
                                <td>{{$item->assetPar->assignedTo}}</td>
                                @if ($item->itemStatus == 0)
                                <td>
                                    Active
                                </td>
                                <td>PAR: {{$item->asset_par_id}}</td>
                                <td>{{$item->description}}</td>
                                <td><button id="turnoverAddItem" class="btn btn-info btn-sm"><i
                                            class="fas fa-plus"></i></button></td>
                                @elseif($item->itemStatus == 1)
                                <td>
                                    Pending Turnover
                                </td>
                                <td>PAR: {{$item->asset_par_id}}</td>
                                <td>{{$item->description}}</td>
                                <td></td>
                                @elseif($item->itemStatus == 4)
                                <td>
                                    Returned
                                </td>
                                <td>PAR: {{$item->asset_par_id}}</td>
                                <td>{{$item->description}}</td>
                                <td><button id="turnoverAddItem" class="btn btn-info btn-sm"><i
                                            class="fas fa-plus"></i></button></td>
                                @else
                                <td>
                                    Unserviceable
                                </td>
                                <td>PAR: {{$item->asset_par_id}}</td>
                                <td>{{$item->description}}</td>
                                <td></td>
                                @endif

                            </tr>
                            {{--  <tr>
                                <td>Laptop</td>
                                <td><h5><span class="badge badge-info">Active</span></h5></td>
                                <td>PAR - 1000211</td>
                                <td>SN: 38303040880</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Laptop</td>
                                <td><h5><span class="badge badge-warning">Pending Turnover</span></h5></td>
                                <td>PAR - 1000211</td>
                                <td>SN: 38303040880</td>
                                <td><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i></button></td>
                            </tr>
                            <tr>
                                <td>Laptop</td>
                                <td><h5><span class="badge badge-danger">Unserviceable</span></h5></td>
                                <td>PAR - 1000211</td>
                                <td>SN: 38303040880</td>
                                <td><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i></button></td>
                            </tr>  --}}
                            @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">&nbsp;</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb-2">List of Chosen Turnover Items</div>
        <div class="card-body">
            <form action="{{route('AssetTurnover.store')}}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Turnover Number:</label>
                                <input name="turnover_number" id="turnover_number" class="form-control" type="text"
                                    value="{{$turnoverCount}}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label>Turnover Type:</label>
                                <select name="forReturn" id="forReturn" class="form-control form-control-sm" required>
                                    <option value="1">Return</option>
                                    <option value="0">Unserviceable</option>
                                </select>
                            </div>
                        </div>
                        {{--  <a href="AssetTurnover/create" class="btn btn-success btn-md float-right">Save Chosen Items</a>  --}}
                        <button class="btn btn-success btn-md float-right" id="createNewTurnover"
                            data-toggle="confirmation">Create Turnover</button>
                        <table id="chosenDatatable"
                            class="table table-bordered table-hover table-sm display nowrap w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>Item ID</th>
                                    <th>Item</th>
                                    <th>Office Code</th>
                                    <th>Assigned To</th>
                                    <th>Status</th>
                                    <th>PAR Number</th>
                                    <th>Description</th>
                                    <th data-priority='4'>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@section('script')
<script src="{{asset('js/asset_TurnoverIndex.js')}}"></script>
@endsection