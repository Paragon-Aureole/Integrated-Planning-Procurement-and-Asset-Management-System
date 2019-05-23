@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
    <li class="breadcrumb-item active"><a href="{{route('AssetTurnover.index')}}">Turnover Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Turnover Item List</li>
</ol>
@endsection

@section('content')
{{--  {{$parData}}  --}}
<div class="col-sm-12">
    <div class="container-fluid">
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
                                    <th>Type</th>
                                    <th>Details</th>
                                    <th data-priority='3'>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="parTbody">

                                @foreach ($pendingTurnoverData as $record)
                                <tr>
                                    <td>{{$record->id}}</td>
                                    <td>
                                        @if ($record->isApproved == 0)
                                            Pending Approval
                                        @else
                                            Approved
                                        @endif
                                    </td>
                                    <td>
                                        @if ($record->isReturn == 1)
                                            Return
                                        @else
                                            Unserviceable
                                        @endif
                                    </td>
                                    <td>
                                            {{--  {{$record->assetTurnoverItem->take(2)}}  --}}
                                        @foreach ($record->assetTurnoverItem->take(2) as $item)
                                        ||{{$item->assetParItem->asset->details}}||
                                        @endforeach
                                        
                                    </td>
                                    <td>
                                        @if ($record->isApproved == 0)
                                        @can('Asset Management', 'Supervisor')
                                        <a href="ApproveParTurnover/{{$record->id}}/{{$record->isReturn}}" class="btn btn-success btn-sm">Approve Turnover  <i class="fas fa-check" title="Approved Turnover Request"></i></a>
                                        @endcan
                                        @endif
                                        <a href="{{route('AssetTurnover.show', $record->id)}}" class="btn btn-info btn-sm"><i class="fas fa-th-list" title="View Items"></i></a>
                                        @if ($record->isReturn == 0)
                                            <a href="/printTurnover/{{$record->id}}" class="btn btn-success btn-sm" target="_blank"><i class="fas fa-print" title="Print Turnover Request"></i></a>
                                        @else
                                            
                                        @endif
                                    </td>

                                </tr>
                                {{--  {{$record->assetTurnoverItem}}  --}}
                                    {{--  @foreach ($record->assetTurnoverItem as $item)
                                        {{$item->assetParItem}}
                                    @endforeach  --}}
                                @endforeach
    
                                {{--  @foreach ($to as $record)
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
                                @endforeach  --}}
    
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
<script>
$(document).ready(function(){
    var turnedOverDatatable = $('#turnedOverDatatable').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    })
})
</script>
@endsection