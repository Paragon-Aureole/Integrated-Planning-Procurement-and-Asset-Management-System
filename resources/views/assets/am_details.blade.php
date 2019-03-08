@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('view.ppmp')}}">PPMP</a></li>
        <li class="breadcrumb-item active"><a href="/assets">Procured Assets</a></li>
        <li class="breadcrumb-item active" aria-current="page">More Details</li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
            <thead class="thead-dark">
                <tr>
                    <th>Assets</th>
                    <th>Unit Type</th>
                    <th>Quantity</th>
                    <th>Invoice #</th>
                    <th>Property Officer</th>
                    <th>Inspection Officer</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Laptop</td>
                    <td>Pack</td>
                    <td>3</td>
                    <td>73289</td>
                    <td>Tedd Mamuyac</td>
                    <td>Tedd Mamuyac</td>
                    <td><button data-toggle="modal" data-target="#exampleModalCenter"  class="btn btn-sm btn-secondary"><i class="fas fa-table"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Asset Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>73289_23</td>
                            <td>Available</td>
                        </tr>
                        <tr>
                            <td>73289_24</td>
                            <td>Available</td>
                        </tr>
                        <tr>
                            <td>73289_25</td>
                            <td>Available</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection