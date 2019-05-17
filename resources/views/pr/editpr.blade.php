@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('pr.index')}}">Purchase Request</a></li>
	<li class="breadcrumb-item active" aria-current="page">Edit Purchase Request</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Purchase Request</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-4">
   	  <h6 class="card-title">
  		Edit Purchase Request
  	  </h6>
      
      <form autocomplete="off" action="{{route('pr.update', $pr->id)}}" method="post" id="needs-validation">
          {{csrf_field()}}
          {{ method_field('put') }}
          <div class="row">
            <div class="form-group col-md-12">
              <label for="prCode" class="small">PR Code:</label>
              <input value="{{old('pr_code', $pr->pr_code)}}" name="pr_code" class="form-control form-control-sm" readonly>
              <div class="invalid-feedback">  
                @if ($errors->has('pr_code'))
                  {{$errors->first('pr_code')}}
                @else
                  PR Code is required.
                @endif  
              </div>
            </div>
            <div class="form-group col-md-12">
              <label for="deptId" class="small">Office:</label>
              <input id="deptId" class="form-control form-control-sm " type="text" value="{{$pr->office->office_name}}" disabled>
              <input type="hidden" name="pr_office" value="{{old('pr_office', $pr->office_id)}}">
            </div>
            <div class="form-group col-md-12">
              <label for="prPurpose" class="small">Purpose:</label>
              <textarea id="prPurpose" name="pr_purpose" class="form-control form-control-sm {{ $errors->has('pr_purpose') ? 'is-invalid' : '' }}" rows="3" required>{{old('pr_purpose', $pr->pr_purpose)}}</textarea>
              <div class="invalid-feedback">  
                @if ($errors->has('pr_purpose'))
                  {{$errors->first('pr_purpose')}}
                @else
                  Purpose is required.
                @endif  
              </div>
            </div> 
            <div class="form-group col-md-6">
              <label for="supplierType" class="small">Supplier Type</label>
              <select id="suppplierType" class="custom-select custom-select-sm {{ $errors->has('supplier_type') ? 'is-invalid' : '' }}" name="supplier_type" required>
                  <option value="1" {{ old('supplier_type') == 1 ? 'selected' : '' }}>Canvass</option>
                  <option value="2" {{ old('supplier_type') == 2 ? 'selected' : '' }}>Government Agency</option>
                  <option value="3" {{ old('supplier_type') == 3 ? 'selected' : '' }}>Sole Distributor</option>
              </select>
              <div class="invalid-feedback">  
                @if ($errors->has('supplier_type'))
                  {{$errors->first('supplier_type')}}
                @else
                  Supplier Type is required.
                @endif  
              </div>
            </div>
            <div class="form-group col-md-6" id="supplierId">
              <label class="small">Supplier</label>
              <select class="custom-select custom-select-sm {{ $errors->has('supplier_id') ? 'is-invalid' : '' }}" name="supplier_id">
                <option value="">Select Supplier</option>
              </select>
              <div class="invalid-feedback">  
                @if ($errors->has('supplier_id'))
                  {{$errors->first('supplier_id')}}
                @else
                  Supplier is required.
                @endif  
              </div>
            </div>
            <div class="form-group col-md-6" id="agencyName">
              <label class="small">Agency Name</label>
              <input class="form-control form-control-sm {{ $errors->has('agency_name') ? 'is-invalid' : '' }}" name="agency_name" value="{{old('agency_name')}}">
              <div class="invalid-feedback">  
                @if ($errors->has('agency_name'))
                  {{$errors->first('agency_name')}}
                @else
                  Agency Name is required.
                @endif  
              </div>
            </div>
            <div class="form-group col-md-12">
              <label for="prRequestor" class="small">Requestor:</label>
              @php
                  $requestor = App\Signatory::where('office_id', Auth::user()->office->id)
                              ->where('category', '=', '1')
                              ->where('is_activated', '=', '1')
                              ->first();
              @endphp
              <input class="form-control form-control-sm {{ $errors->has('pr_requestor') ? 'is-invalid' : '' }}" type="text"  value="{{$requestor->signatory_name}}" disabled>
              <input type="hidden" name="pr_requestor" value="{{$requestor->id}}">
              <div class="invalid-feedback">  
                @if ($errors->has('pr_requestor'))
                  {{$errors->first('pr_requestor')}}
                @else
                  Requestor is required.
                @endif  
              </div>
            </div> 
            <div class="form-group col-md-12">
              <label class="small">Reason for Editing</label>
              <textarea class="form-control form-control-sm" name="edit_reason" required></textarea>
            </div>
            <div class="form-group col">
              <button type="Update" id="prBtn" class="btn btn-warning btn-sm" data-toggle="confirmation" data-content="Update Purchase Request?" >Update Purchase Request</button>
            </div>
          </div>
        </form>
   	</div>

   	<!-- table -->
   	<div class="col-md-8">
   	  <h6 class="card-title">Registered Purchase Request</h6>
   	  <div class="table-responsive">
   	  	@include('pr.prdatatable')
   	  </div>	
   	</div>
   </div>
 </div>
</div>

</div>
	
@endsection

@section('script')
<script src="{{asset('js/function-script.js')}}"></script>
<script src="{{asset('js/pr-script.js')}}"></script>
@endsection


