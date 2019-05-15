@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item" ><a href="{{route('ir.index')}}">AIR</a></li>
  <li class="breadcrumb-item active" aria-current="page">Edit Acceptance & Inspection Report</li>
</ol>
@endsection


@section('content')
<div class="container-fluid">
        <div class="card">
          <div class="card-header pt-2 pb-2">Acceptance & Inspection Report</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h6 class="card-title">
                  Edit Acceptance & Inspection Report
                </h6>
                <form method="POST" action="{{route('ir.update', $air->id)}}" class="needs-validation" novalidate>
                    {{ csrf_field() }}
                    {{method_field('PUT')}}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="small">Supplier Name:</label>
                            <input class="form-control form-control-sm" value="{{$air->purchaseRequest->purchaseOrder->outlineSupplier->supplier_name}}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small">Supplier Name:</label>
                            <input class="form-control form-control-sm" value="{{$air->purchaseRequest->purchaseOrder->outlineSupplier->supplier_address}}" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="small">PO Code:</label>
                            <input class="form-control form-control-sm" value="{{$air->purchaseRequest->purchaseOrder->id}}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="small">Requisitioning Office/Department</label>
                            <input class="form-control form-control-sm" value="{{$air->purchaseRequest->office->office_code}}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <span class="text-danger">*</span><label class="small">Invoice Number</label>
                            <input class="form-control form-control-sm" value="{{$air->invoice_number}}" name="invoice_number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span class="text-danger">*</span><label class="small">Property Officer</label>
                            <input class="form-control form-control-sm" value="{{$air->property_officer}}" name="property_officer" required>
                        </div>
                        <div class="form-group col-md-6">
                            <span class="text-danger">*</span><label class="small">Inspection Officer</label>
                            <input class="form-control form-control-sm" value="{{$air->inspection_officer}}" name="inspection_officer" required>
                        </div>
                        <div class="form-group col-md-12">
                            <span class="text-danger">*</span><label class="small">Reason for Editing</label>
                            <textarea class="form-control form-control-sm" name="edit_reason" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button class="btn btn-sm btn-warning" type="submit">Update Acceptance & Inspection Report</button>
                        </div>
                    </div>
                </form>
              </div>
      
              <!-- table -->
              <div class="col-md-6">
                <h6 class="card-title">Registered Acceptance & Inspection Reports</h6>
                <div class="table-responsive">
                  <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                    <thead class="thead-dark">
                      <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Date </th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($ir as $ir)
                      <tr>
                        <td>{{$ir->id}}</td>
                        <td>{{$ir->purchaseRequest->pr_code}}</td>
                        <td>{{Carbon\Carbon::parse($ir->created_at)->format('m-d-y')}}</td>
                        <td>
                          <a href="{{route('ir.print', $ir->id)}}" target="_blank" class="btn btn-sm btn-success">
                            <i class="fas fa-print"></i>
                          </a>
                          @can('full control')
                          <a href="{{route('ir.edit', $ir->id)}}" class="btn btn-sm btn-warning">
                              <i class="fas fa-edit"></i>
                          </a>
                          
                          <a href="#" class="btn btn-sm btn-danger">
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
      
      </div>
@endsection