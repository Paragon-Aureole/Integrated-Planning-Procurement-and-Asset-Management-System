@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
    <li class="breadcrumb-item active"><a href="{{route('migrateAssets.index')}}">Capture Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">PAR Item List</li>
</ol>
@endsection

@section('content')
{{--  {{$parData}}  --}}
<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb-2"> List of PAR Items</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="/migrateAssets" class="btn btn-info btn-md float-right">Go Back</a>
                    <table id="itemDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-light">
                            <tr>
                                <th>Par Number</th>
                                <th>Item Name</th>
                                <th>Status</th>
                                <th>Receiver Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{$item->par_number}}</td>
                                    <td>{{$item->item_name}}</td>
                                    <td>
                                        @if ($item->status == 'Active')
                                            <h4><span class="badge badge-info">{{$item->status}}</span></h4>
                                        @elseif ($item->status == 'Unserviceable')
                                            <h4><span class="badge badge-danger">Inactive</span></h4> 
                                        @endif
                                    </td>
                                    <td>{{$item->receiver_name}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        <a href="{{route('migrateAssets.edit', $item->id)}}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @can('full control')
                                            <a id="deletePar" href="{{route('migrateAssets.destroy', $item->id)}}" class="btn btn-sm btn-danger" data-toggle="confirmation" data-content="Are you sure to delete {{$item->description}}">
                                                <i class="fas fa-minus"></i>
                                            </a>
                                        @endcan
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