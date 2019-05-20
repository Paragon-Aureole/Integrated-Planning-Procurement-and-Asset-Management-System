@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Turnover Assets</li>
</ol>
@endsection

@section('content')
{{--  {{$approvalAssets}} --}}
<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb-2">List of PAR Item</div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <h6 class="card-title">
                        Available Distributed Assets
                    </h6>
                    <table id="parDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Assigned To</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th data-priority='4'>Items</th>
                            </tr>
                        </thead>
                        <tbody id="parTbody">

                            @foreach ($to as $record)
                            {{--  {{$record}} --}}
                            <tr>
                                <td>{{$record->id}}</td>
                                <td>{{$record->assignedTo}}</td>
                                <td>{{$record->position}}</td>
                                <td>{{$record->purchaseOrder->purchaseRequest->office->office_name}}</td>
                                <td>
                                    <a href="{{route('AssetTurnover.create', 'id='.$record->id)}}">View Items</a>
                                    {{--  <button type="button" id="turnoverButton" class="btn btn-info btn-xs"
                                        data-toggle="modal" data-target="#turnoverModal">View Items</button>  --}}
                                </td>
                            </tr>
                            @endforeach



                            {{--  <tr>
                                <td>Sample ID</td>
                                <td>Sample Signatory</td>
                                <td>Sample Position</td>
                                <td>Sample Office</td>
                                <td>
                                    <button type="button" id="turnoverButton" name="btn_assignItem" class="btn btn-info btn-xs" data-toggle="modal" data-target="#turnoverModal">View Items</button>
                                </td>
                            </tr>  --}}
                        </tbody>
                    </table>


                </div>
                <div class="col-md-6">
                    <h6 class="card-title">
                        Turnover Assets
                    </h6>
                    <table id="datatableTurnover"
                        class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Assigned To</th>
                                <th>Item Name</th>
                                <th>Office</th>
                                <th>Status</th>
                                <th data-priority='5'>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--  {{$approvalAssets->first()->assetPar}} --}}

                            @foreach ($approvalAssets as $record)
                            <tr>
                                <td>{{$record->id}}</td>
                                
                                <td>{{$record->assetTurnoverItem->first()->AssetParItem->assetPar->assignedTo}}</td>
                                <td>
                                    @php
                                    $firstTwo = $record->assetTurnoverItem->take(2)    
                                    @endphp
                                    
                                    @foreach ($firstTwo as $item)
                                    |{{$item->AssetParItem->asset->details}}|
                                    @endforeach
                                    
                                </td>
                                <td>{{$record->assetTurnoverItem->first()->AssetParItem->assetPar->purchaseOrder->purchaseRequest->office->office_code}}
                                </td> 
                                {{--  {{$item->AssetParItem->assetPar}}  --}}
                                
                                @if ($record->isApproved == 0)
                                <td>Pending</td>
                                @else
                                <td>Approved</td>
                                @endif
                                <td>
                                    <a href="{{route('AssetTurnover.show', $record->id)}}">View Items</a>
                                    <a href="{{route('asset.printTurnover', $record->id)}}">Print</a>
                                    {{--  <button type="button" id="turnoverButton" name="btn_assignItem"
                                        class="btn btn-warning btn-xs" data-toggle="modal"
                                        data-target="#turnedOverModal">View Items</button>  --}}
                                </td>

                            </tr>
                            @endforeach

                            {{--  <tr>
                                    <td>Sample Signatory</td>
                                    <td>Sample Position</td>
                                    <td>Sample Office</td>
                                    <td>Pending</td>
                                    <td>
                                        <button type="button" id="turnoverButton" name="btn_assignItem"
                                            class="btn btn-warning btn-xs" data-toggle="modal"
                                            data-target="#turnedOverModal">View Items</button>
                                    </td>
                            </tr>  --}}

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- <input type="submit" class="btn btn-primary"> --}}

        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="turnoverModal">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5>Signatory Current Assigned Items</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label>Signatory Name:</label>
                    <input id="signatoryName" class="form-control" type="text" disabled>
                </div>
                <form autocomplete="off" id="turnoverDataTableForm" action="{{route('AssetTurnover.store')}}"
                    method="post">
                    <input type="hidden" name="turnoverParId">
                    <input type="hidden" name="currentTurnoverId">
                    {{csrf_field()}}
                    <div class="form-group">
                        <hr style="height:5px; background-color:grey;">

                        <table id="modalTurnoverDatatable"
                            class="table table-bordered table-hover table-sm display nowrap w-100">
                            <thead class="thead-light">
                                <th>Item Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>

                            <tbody>

                                {{--  <tr>
                                    <td>Laptop</td>
                                    <td><textarea style="border:none;" name="" id="" cols="100" rows="2" readonly>A</textarea></td>
                                    <td>Active</td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr>
                                    <td>Laptop</td>
                                    <td><textarea style="border:none;" name="" id="" cols="100" rows="2" readonly>B</textarea></td>
                                    <td>Active</td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr>
                                    <td>Laptop</td>
                                    <td><textarea style="border:none;" name="" id="" cols="100" rows="2" readonly>C</textarea></td>
                                    <td>Active</td>
                                    <td><input type="checkbox"></td>
                                </tr>  --}}
                            </tbody>
                        </table>
                        <div class="col-md-12">&nbsp</div>
                        <button type="submit" id="SubmitTurnover" name="btn_assignItem"
                            class="btn btn-danger btn-xs float-right">Turnover Items</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- The Modal -->
<div class="modal" id="turnedOverModal">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5>Signatory Current Turned Over Items</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label>Turnover Number:</label>
                    <input id="turnover_id" class="form-control" type="text" disabled>
                </div>
                <div class="form-group">
                    <hr style="height:5px; background-color:grey;">

                    <table id="modalApprovalTurnoverDatatable"
                        class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-light">
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Status</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="col-md-12">&nbsp</div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group ">
                                <button type="button" id="PrintTurnover" name="btn_PrintTurnover"
                                    class="btn btn-success btn-md container-fluid">Print Turned Over Items</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group ">
                                <button type="button" id="ApproveTurnover" name="btn_ApproveTurnover"
                                    class="btn btn-primary btn-md container-fluid">Approve Turned Over Items</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        var parDataTable = $('#parDatatable').DataTable({
            responsive: true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],

        });

        var turnoverDataTable = $('#datatableTurnover').DataTable({
            responsive: true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
        });
    });
</script>
@endsection