@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  @if ($ppmp->is_supplemental == 1)
  <li class="breadcrumb-item active"><a href="{{route('supplemental.ppmp')}}">Supplemental PPMP</a></li>
  @else
  <li class="breadcrumb-item active"><a href="{{route('view.ppmp')}}">PPMP</a></li>
  @endif
  
	<li class="breadcrumb-item active" aria-current="page">Add PPMP Items</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb- 2"><b>Add Items</b></div>
 <div class="card-body">
  <form autocomplete="off" action="{{route('add.ppmpitm', $ppmp->id)}}" method="post" name="ppmp_form" class="needs-validation">
    {{csrf_field()}}
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="form-group col-md-12">
            <span class="text-danger">*</span><label class="small">Code:</label>
          <div class="input-group mb-3">
            <input type="text" id="ppmp_id" value="{{$ppmp->id}}" hidden>
            <select class="custom-select custom-select-sm {{ $errors->has('item_code') ? 'is-invalid' : '' }}" name="item_code" required="required">
              <option value="">Select Item Code</option>
              @foreach($ppmp_codeDT as $codes)
                <option value="{{$codes->id}}" name="{{$codes->code_type}}" >{{$codes->code_description}}</option>
              @endforeach
            </select>
            <div class="input-group-append">
              <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#itemCodeModal" name="addItemCode">Add Item Code</button>
            </div>
            <div class="invalid-feedback">
              @if ($errors->has('item_code'))
                {{$errors->first('item_code')}}
              @else
                Item Code is required.
              @endif
            </div>
          </div>
        </div>
        <div class="form-group col-md-12">
            <span class="text-danger">*</span><label class="small">General Description:</label>
          <textarea class="form-control form-control-sm {{ $errors->has('item_description') ? 'is-invalid' : '' }}" name="item_description" rows="3" required></textarea>
          <div class="invalid-feedback">
              @if ($errors->has('item_description'))
                {{$errors->first('item_description')}}
              @else
                Item description is required.
              @endif
          </div>
        </div>
        <div class="form-group col-md-12">
            <span class="text-danger">*</span><label class="small">Mode of Procurement:</label>
          <select class="custom-select custom-select-sm {{ $errors->has('item_mode') ? 'is-invalid' : '' }}" name="item_mode" required="required">
            @foreach($modes as $mode)
            <option value="{{$mode->id}}" {{ old('item_unit') == $mode->id ? 'selected' : '' }}>{{$mode->method_name}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">
              @if ($errors->has('item_mode'))
                {{$errors->first('item_mode')}}
              @else
                Procurement Mode is required.
              @endif
          </div>
        </div>
        <div class="form-group col-md-6">
            <span class="text-danger">*</span><label class="small">Quantity:</label>
          <input oninput="multiply();" id="itemQty" class="form-control form-control-sm qty{{ $errors->has('item_quantity') ? 'is-invalid' : '' }}" value="{{ old('item_quantity', 0) }}" value="{{ old('item_quantity') }}" name="item_quantity" required="required">
          <div class="invalid-feedback" id="qtyFeedback">
              @if ($errors->has('item_quantity'))
                {{$errors->first('item_quantity')}}
              @else
                Item Quantity is required.
              @endif
          </div>
        </div>
        <div class="form-group col-md-6">
            <span class="text-danger">*</span><label class="small">Unit:</label>
          <select class="custom-select custom-select-sm {{ $errors->has('item_unit') ? 'is-invalid' : '' }}" name="item_unit" required="required">
            @foreach($units as $unit)
            <option value="{{$unit->id}}" {{ old('item_unit') == $unit->id ? 'selected' : '' }}>{{$unit->unit_description}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">
              @if ($errors->has('item_unit'))
                {{$errors->first('item_unit')}}
              @else
                Unit of measurement is required.
              @endif
          </div>
        </div>
        <div class="form-group col-md-6">
            <span class="text-danger">*</span><label class="small">Estimated Cost per Unit:</label>
          <input oninput="multiply();" id="itemCost" class="form-control form-control-sm money {{ $errors->has('item_cost') ? 'is-invalid' : '' }}" value="{{ old('item_cost' , 0.00)}}" name="item_cost" required="required">
          <div id="itemCost-Feedback" class="invalid-feedback">
              @if ($errors->has('item_cost'))
                {{$errors->first('item_cost')}}
              @else
                Cost per unit is required.
              @endif
          </div>
        </div>
        <div class="form-group col-md-6">
            <span class="text-danger">*</span><label class="small">Estimated Budget per Item:</label>
          <input oninput="divide();" id="itemBudget" class="form-control form-control-sm money{{ $errors->has('item_budget') ? 'is-invalid' : '' }}" value="{{ old('item_budget', 0.00) }}" name="item_budget" required="required">
          <div id="itemBudget-Feedback" class="invalid-feedback">
              @if ($errors->has('item_budget'))
                {{$errors->first('item_budget')}}
              @else
                Estimated budget is required.
              @endif
          </div>
        </div>
        <div class="form-group col-md-12 text-right">
          <button class="btn btn-sm btn-primary" id="btn_submit" @can('full control') @else @if($ppmp->is_printed == true) disabled @endif @endcan>Add PPMP Item</button>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <h6>Schedule/Milestones of Activities</h6>
      <hr class="mt-0">
      <div class="row">
        @for($s=1; $s<=12; $s++)
        @php $month_num = $s-1; @endphp
         <div class="form-group col-md-4">
            <span class="text-danger">*</span><label class="small">{{strtoupper(date('M', mktime(0, 0, 0, $s, 1)))}}</label>
          <input class="form-control form-control-sm {{ $errors->has('item_schedule.'.$month_num) ? 'is-invalid' : '' }}" name="item_schedule[{{$month_num}}]" value="{{ old('item_schedule.'.$month_num, '0' ) }}" required>
          <div class="invalid-feedback" id="schedFeedback{{$month_num}}">
              @if ($errors->has('item_schedule.'.$month_num))
                {{$errors->first('item_schedule.'.$month_num)}}
              @endif
          </div>
        </div>
        @endfor
      </div>
      <div id="feedback" class="invalid-feedback">
          Incomplete or surplus entries, Please distribute scheduled items properly.
      </div>
    </div>
    </form>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        @include('ppmp.ppmp_item.ppmpitmdatatable')
      </div>
    </div>
  </div>
</div>

 </div>
</div>

</div>

<!-- Modal -->
<style>
.modal-content{
  overflow-y: auto;
}
</style>

@include('ppmp.ppmp_item.itemcodeModal')

@endsection

@section('script')
<script src="{{asset('js/function-script.js')}}"></script>
<script src="{{asset('js/ppmp_field_validation.js')}}"></script>
<script src="{{asset('js/editPpmpItem-script.js')}}"></script>
<script src="{{asset('js/numeric-validation.js')}}"></script>
@endsection
