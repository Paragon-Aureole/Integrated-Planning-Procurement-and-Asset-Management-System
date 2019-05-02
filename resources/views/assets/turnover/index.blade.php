@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Turnover Assets</li>
</ol>
@endsection

@section('content')
{{--  {{$assetParData}} --}}
{{--  {{$assetIcslipData}} --}}
{{csrf_field()}}
<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb-2">List of PAR Item</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table id="parDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>PAR No</th>
                                <th>Description</th>
                                <th>Item Qty</th>
                                <th>Assigned To</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assetParData as $key => $record)
                            <tr>
                                <td>{{$record['id']}}</td>
                                <td>{{$record['description']}}</td>
                                <td>{{$record['quantity']}}</td>
                                <td>{{$record['assignedTo']}}</td>
                                <td>{{$record['position']}}</td>
                                <td><button type="button" name="btn_assignItem" class="btn btn-info btn-xs"
                                        data-toggle="modal" data-target="#TurnoverModal">Turnover</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
                <div class="col-md-6">
                    <table id="datatableTurnoverPar" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>Turnover PAR ID</th>
                                <th>Remarks</th>
                                <th>Assigned To</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assetTurnoverParData->get() as $record)
                            <tr>
                                <td>{{$record['par_id']}}</td>
                                <td>{{$record['remarks']}}</td>
                                <td>{{$record['assignedTo']}}</td>
                                <td>
                                    <a href="http://ipams.test/printTurnover/{{$record['id']}}" target="_blank"
                                        class="btn btn-sm btn-secondary">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- <input type="submit" class="btn btn-primary"> --}}

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb-2">List of ICS Item</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table id="icsDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>ICS No</th>
                                <th>Description</th>
                                <th>Item Qty</th>
                                <th>Assigned To</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assetIcslipData as $key => $record)
                            <tr>
                                <td>{{$record['id']}}</td>
                                <td>{{$record['description']}}</td>
                                <td>{{$record['quantity']}}</td>
                                <td>{{$record['assignedTo']}}</td>
                                <td>{{$record['position']}}</td>
                                <td><button type="button" name="btn_assignItem" class="btn btn-info btn-xs"
                                        data-toggle="modal" data-target="#TurnoverModal">Turnover</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
                <div class="col-md-6">
                    <table id="datatableTurnoverIcs" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>Turnover ICS ID</th>
                                <th>Remarks</th>
                                <th>Assigned To</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assetTurnoverIcsData->get() as $record)
                            <tr>
                                <td>{{$record['ics_id']}}</td>
                                <td>{{$record['remarks']}}</td>
                                <td>{{$record['assignedTo']}}</td>
                                <td>
                                    <a href="http://ipams.test/printTurnover/{{$record['id']}}" target="_blank"
                                        class="btn btn-sm btn-secondary">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- <input type="submit" class="btn btn-primary"> --}}

        </div>
    </div>>
</div>

<!-- Modal for Turnover -->
<div class="modal" id="TurnoverModal">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Turnover Assets</h3>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <form id="TurnoverModalForm" action="{{route('AssetTurnover.store')}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="ParOrIcs">
                <div class="modal-body" id="assetTurnoverBody">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Item</span>
                                    </div>
                                    {{-- SELECTED ITEM INPUT HERE  --}}
                                    <input type="text" name="selectedItemName" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        readonly>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Quantity</span>
                                    </div>
                                    {{-- QUANTITY SELECITION HERE --}}
                                    <input type="text" name="selectedItemQty" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        readonly>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Unit Cost</span>
                                    </div>
                                    {{-- UNIT COST INPUT HERE  --}}
                                    <input type="text" name="selectedItemUnitCost" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">PAR/ICS No.</span>
                                    </div>
                                    {{-- PAR NUMBER INPUT HERE  --}}
                                    <input type="text" name="selectedItemICS-PARNo" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        readonly>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Date Assigned</span>
                                    </div>
                                    {{-- ASSIGNED DATE HERE  --}}
                                    <input type="date" name="selectedItemDateAssigned" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        readonly>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Total Amount</span>
                                    </div>
                                    {{-- TOTAL AMOUNT INPUT HERE  --}}
                                    <input type="text" name="selectedItemTotalAmount" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        readonly>
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
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        placeholder="Name" readonly>
                                    <input type="text" name="selectedItemEmployeePosition" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                        placeholder="Position" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Remarks:</label><br>
                                <textarea name="selectedItemRemarks" cols="30" rows="10"
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

<script src="{{asset('js/asset_TurnoverIndex.js')}}"></script>
@endsection