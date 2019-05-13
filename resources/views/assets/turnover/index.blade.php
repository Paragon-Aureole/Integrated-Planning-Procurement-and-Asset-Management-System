@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Turnover Assets</li>
</ol>
@endsection

@section('content')
{{--  {{$to}}  --}}
<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb-2">List of PAR Item</div>
        <div class="card-body">

            @can('full control')
            <h6 class="card-title">
                    Filter Items 
                </h6>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group col-md-12">
                            <label for="filterOption" class="small">Search For:</label>
                            <select name="filterOption" id="filterOption" class="form-control form-control-sm">
                                <option value="0">-Select option for Searching-</option>
                                <option value="1">PAR Number</option>
                                <option value="2">Office and Signatory Name</option>
                            </select>
                        </div>
                    </div> 
                </div>
                <div id="showParInputs" style="display:none;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group container-fluid">
                                <input type="text" id="par_id" class="form-control">
                                <div class="input-group-prepend">
                                    <button class="input-group-text" id="searchPar">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="showOfficeInputs" style="display:none;">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group container-fluid">
                                <select name="office_id" id="office_id" class="form-control">
                                    @foreach ($office as $officeItem)
                                        <option value="{{$officeItem->id}}">{{$officeItem->office_name}}</option>
                                    @endforeach
                                </select>
                                <input type="text" id="signatory_name" placeholder="Signatory Name" class="form-control">
                                <div class="input-group-prepend">
                                    <button id="searchName" class="input-group-text">Search Office and Signatory</button>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <hr style="height:5px; background-color:grey">
            @endcan

            <div class="row">
                <div class="col-md-6">
                    <h6 class="card-title">
                        Available Distributed Assets
                    </h6>
                    <table id="parDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>PAR No</th>
                                <th>Item Qty</th>
                                <th>Assigned To</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="parTbody">
                            @foreach ($to as $toItem)
                            @if ($toItem->asset->purchaseOrder->purchaseRequest->office->id == $currentOfficeId)
                            <tr>
                                <td>{{$toItem->id}}</td>
                                <td>{{$toItem->quantity}}</td>
                                <td>{{$toItem->assignedTo}}</td>
                                <td>{{$toItem->position}}</td>
                                <td>
                                <button type="button" id="turnoverButton" name="btn_assignItem" class="btn btn-info btn-xs"data-toggle="modal" data-target="#turnoverModal">Turnover</button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td>Sample #</td>
                                <td>Sample Qty</td>
                                <td>Sample Assigned to</td>
                                <td>Sample Position</td>
                                <td>
                                        <button type="button" id="turnoverButton" name="btn_assignItem" class="btn btn-info btn-xs"data-toggle="modal" data-target="#turnoverModal">Turnover</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
                <div class="col-md-6">
                    <h6 class="card-title">
                        Turnover Assets
                    </h6>
                    <table id="datatableTurnover" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th>Turnover PAR ID</th>
                                <th>Remarks</th>
                                <th>Assigned To</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($assetTurnoverParData->get() as $record) --}}
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="http://ipams.test/printTurnover/" target="_blank"
                                        class="btn btn-sm btn-secondary">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </td>
                            </tr>
                            {{-- @endforeach --}}

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
    <div class="modal-dialog">
        <div class="modal-content">
    
        <!-- Modal Header -->
        <div class="modal-header">
            <h5>Turnover Item</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
    
        <!-- Modal body -->
        <div class="modal-body">
        <form action="" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="pr_id" value="">
            <div class="form-group">
                <label>PAR Number:</label>
                <input id="prCode" class="form-control" type="text" disabled>
            <div>
            <div class="form-group">
                <label>Quantity:</label>
                <select name="" id="quantity" class="form-control">
                    <option value="">Total Quantity will append here</option>
                </select>
            <div>
            <div class="form-group">
                <label>Description:</label>
                <textarea name="turnover_description" class="form-control" required></textarea>
            <div><br/>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
        $('#parDatatable').DataTable({
            responsive: false,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
        });
        $('#datatableTurnover').DataTable({
            responsive: false,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
        });
    } );
</script>
<script src="{{asset('js/asset_TurnoverIndex.js')}}"></script>
@endsection