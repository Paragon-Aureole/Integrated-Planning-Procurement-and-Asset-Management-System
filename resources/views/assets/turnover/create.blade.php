@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
    <li class="breadcrumb-item active"><a href="{{route('AssetTurnover.index')}}">Turnover Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Turover Item List</li>
</ol>
@endsection

@section('content')
{{--  {{$parData}}  --}}
<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb-2"> List of Turnover Number Items</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="/AssetTurnover" class="btn btn-info btn-md float-right">Go Back</a>
                    <table id="itemDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                        <thead class="thead-light">
                            <tr>
                                <th>Turnover Number</th>
                                <th>Item Name</th>
                                <th>Status</th>
                                <th>PAR Number</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Printer</td>
                                    <td><h4><span class="badge badge-info">Active</span></h4></td>
                                    <td>123-PAR</td>
                                    <td>SN: 3-04834</td>
                                </tr>
                            </form>
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