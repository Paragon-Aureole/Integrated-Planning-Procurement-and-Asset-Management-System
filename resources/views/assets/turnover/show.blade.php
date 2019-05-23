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
<div class="container-fluid">
    <div class="card">
        <div class="card-header"> 
            List of Turnover Number Items
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group col-md-4">
                            <label>Turnover Number:</label>
                            {{--  <input name="turnover_number" id="turnover_number" class="form-control" type="text" value="{{$newTurnoverID}}" readonly>  --}}
                            <input name="turnover_number" id="turnover_number" class="form-control" type="text" value="{{$turnover_id}}" readonly>
                        </div>
                    {{--  <form action="{{route('asset.printTurnover', $newTurnoverID)}}" method="post">  --}}
                    <form action="" method="post">
                        {{csrf_field()}}
                        <div class="form-group col-md-6">
                            <a href="/AssetTurnover" title="Capture New Data" id="cloneData" class="btn btn-info">Back</a>  
                            <a href="/printTurnover/{{$turnover_id}}" target="_blank" class="btn btn-success"><i class="fas fa-print"></i>Print Turnover</a>  
                            {{--  <button title="Save Information Inputted" type="submit" class="btn btn-success">/button>  --}}
                        </div>
                        {{ Session::get('success') }}
                        <table id="itemDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>Item ID</th>
                                    <th>Item Name</th>
                                    <th>Status</th>
                                    <th>PAR Number</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assetTurnoverData as $item)
                                <tr>
                                    <td><input type="text" class="border-0" name="item_id[{{$item->id}}]" value={{$item->id}} readonly></td>
                                    <td>{{$item->AssetParItem->asset->details}}</td>
                                    
                                    @if ($item->itemStatus == 0)
                                    <td>
                                        Active
                                    </td>      
                                    @elseif($item->itemStatus == 1)
                                    <td>
                                        Pending Turnover
                                    </td>  
                                    @elseif($item->itemStatus == 4)
                                    <td>
                                        Returned
                                    </td>
                                    @else
                                    <td>
                                        Unserviceable
                                    </td>
                                    @endif
                                    <td>{{$item->AssetParItem->assetPar->id}}</td>
                                    <td>{{$item->AssetParItem->description}}</td>
                                        {{--  <td>
                                            <input type="radio" required name="itemStatus[{{$item->id}}]" value="3">
                                        </td>
                                        <td>
                                            <input type="radio" required name="itemStatus[{{$item->id}}]" value="2">
                                        </td>  --}}
                                </tr>
                                @endforeach
                                
                                {{--  <tr>
                                    <td>1</td>
                                    <td>Printer</td>
                                    <td><h5><span class="badge badge-info">Active</span></h5></td>
                                    <td>123-PAR</td>
                                    <td>SN: 3-04834</td>
                                </tr>  --}}
                            </tbody>
                        </table>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection
    
    @section('script')
    <script>
$(document).ready(function(){
    var parDataTable = $('#itemDatatable').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    })
})
</script>
@endsection