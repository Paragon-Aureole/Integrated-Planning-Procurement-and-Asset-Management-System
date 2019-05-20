@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Turnover Assets</li>
</ol>
@endsection

@section('content')
{{--  {{$assetTurnoverData}}  --}}
<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb-2">List of PAR Item</div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <h6 class="card-title">
                        Pending Turnover List
                    </h6>
                    <table id="parDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-light">
                            <tr>
                                <th>Item Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th data-priority='4'>Action</th>
                            </tr>
                        </thead>
                        <tbody id="parTbody">
                            {{--  <form action="{{route('AssetTurnover.store')}}" method="post">  --}}
                            <form action="{{route('AssetTurnover.update', $turnover_id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                           <input type="hidden" name="turnover_id" value={{$turnover_id}}>
                            @foreach ($assetTurnoverData->AssetTurnoverItem as $item)
                            <tr>
                                <td>
                                    {{$item->assetParItem->asset->details}}
                                </td>
                                <td>{{$item->assetParItem->description}}</td>
                                @if ($item->assetParItem->itemStatus == 0)
                                <td>Active</td>
                                    <td>
                                    <input type="hidden" name="itemStatus[{{$item->id}}]" value=0>
                                    <input type="checkbox" name="itemStatus[{{$item->id}}]" value=1>
                                    </td>
                                    @elseif ($item->assetParItem->itemStatus == 1)
                                    <td>Pending Turnover</td>
                                    <td>
                                        <input type="checkbox" checked disabled name="itemStatus[{{$item->id}}]" value=1>
                                    </td>
                                        @elseif ($item->assetParItem->itemStatus == 2)
                                    <td>Unserviceable</td>
                                    <td>
                                        <input type="checkbox" checked disabled name="itemStatus[{{$item->id}}]" value=1>
                                    </td>
                                @endif
                            </tr>
                                {{--  {{$item}}  --}}
                            @endforeach
                            <button type="submit">Accept Turnover</button>
                             </form>
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
            </div>

            {{-- <input type="submit" class="btn btn-primary"> --}}

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){
    var parDataTable = $('#parDatatable').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ]
    });
</script>
@endsection