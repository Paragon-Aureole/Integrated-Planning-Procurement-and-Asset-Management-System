@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('view.ppmp')}}">PPMP</a></li>
	<li class="breadcrumb-item active"><a href="{{route('view.ppmpitm', $ppmp->id)}}">Add PPMP Items</a></li>
  <li class="breadcrumb-item active" aria-current="page">Update PPMP Items</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2"><b>Add Items</b></div>
 <div class="card-body">
  <form action="{{route('update.ppmpitm', [$ppmp->id, $ppmp_item->id])}}" method="post" id="needs-validation" novalidate>
    {{csrf_field()}}
    {{ method_field('put') }}
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="form-group col-md-12">
          <label class="small">Code:</label>
          <div class="input-group mb-3">
              <input type="text" id="ppmp_id" value="{{$ppmp->id}}" hidden>
            <select class="custom-select custom-select-sm {{ $errors->has('item_code') ? 'is-invalid' : '' }}" name="item_code" required="required">
              @foreach($ppmp->office->ppmpItemCode as $codes) 
                <option value="{{$codes->id}}" {{ old('item_code', $ppmp_item->ppmp_item_code_id) == $codes->id ? 'selected' : '' }}>{{$codes->code_description}}</option>
              @endforeach 
            </select>
            <div class="input-group-append">
              {{-- <a href="{{route('view.ppmpitemcode', $ppmp->id)}}" class="btn btn-outline-secondary btn-sm">Add Item Code</a>  --}}
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
          <label class="small">General Description:</label>
          <textarea class="form-control form-control-sm {{ $errors->has('item_description') ? 'is-invalid' : '' }}" name="item_description" rows="3" required="required">{{$ppmp_item->item_description}}</textarea>
          <div class="invalid-feedback">  
              @if ($errors->has('item_description'))
                {{$errors->first('item_description')}}
              @else
                Item description is required.
              @endif  
          </div>
        </div>
        <div class="form-group col-md-12">
          <label class="small">Mode of Procurement:</label>
          <select class="custom-select custom-select-sm {{ $errors->has('item_mode') ? 'is-invalid' : '' }}" name="item_mode" required="required">
            @foreach($modes as $mode)
            <option value="{{$mode->id}}" {{ old('item_mode', $ppmp_item->procurement_mode_id) == $mode->id ? 'selected' : '' }}>{{$mode->method_name}}</option>
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
          <label class="small">Quantity:</label>
          <input oninput="multiply();" id="itemQty" class="form-control form-control-sm {{ $errors->has('item_quantity') ? 'is-invalid' : '' }}" value="{{ old('item_quantity', $ppmp_item->item_quantity) }}" name="item_quantity" required="required">
          <div class="invalid-feedback">  
              @if ($errors->has('item_quantity'))
                {{$errors->first('item_quantity')}}
              @else
                Item Quantity is required.
              @endif  
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="small">Unit:</label>
          <select class="custom-select custom-select-sm {{ $errors->has('item_unit') ? 'is-invalid' : '' }}" name="item_unit" required="required">
            @foreach($units as $unit)
            <option value="{{$unit->id}}" {{ old('item_unit', $ppmp_item->measurement_unit_id) == $unit->id ? 'selected' : '' }}>{{$unit->unit_description}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">  
              @if ($errors->has('item_unit'))
                {{$errors->first('item_unit')}}
              @else
                Code description is required.
              @endif  
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="small">Estimated Cost per Unit:</label>
          <input oninput="multiply();" id="itemCost" class="form-control form-control-sm money{{ $errors->has('item_cost') ? 'is-invalid' : '' }}" value="{{ old('item_cost', $ppmp_item->item_cost) }}" name="item_cost" required="required">
          <div class="invalid-feedback">  
              @if ($errors->has('item_cost'))
                {{$errors->first('item_cost')}}
              @else
                Code description is required.
              @endif  
          </div>
        </div>        
        <div class="form-group col-md-6">
          <label class="small">Estimated Budget per Item:</label>
          <input id="itemBudget" class="form-control form-control-sm money{{ $errors->has('item_budget') ? 'is-invalid' : '' }}" value="{{ old('item_budget', $ppmp_item->item_budget) }}" oninput="divide();" name="item_budget" required="required">
          <div class="invalid-feedback">  
              @if ($errors->has('item_budget'))
                {{$errors->first('item_budget')}}
              @else
                Code description is required.
              @endif  
          </div>
        </div>
        <div class="form-group col-md-12 text-right">
          <button class="btn btn-sm btn-warning">Update</button>
        </div>
      </div> 
    </div>
    <div class="col-md-6">
      <h6>Schedule/Milestones of Activities</h6>
      <hr class="mt-0">
      <div class="row">
        @php
          $schedules = explode(",", $ppmp_item->item_schedule);
        @endphp
        @foreach($schedules as $s => $schedule)
        @php $month_num = $s-1; @endphp
         <div class="form-group col-md-4">
          <label class="small">{{strtoupper(date('M', mktime(0, 0, 0, $s+1, 1)))}}</label>
          <input class="form-control form-control-sm {{ $errors->has('item_schedule.'.$month_num) ? 'is-invalid' : '' }}" name="item_schedule[{{$month_num}}]" value="{{ old('item_schedule.'.$month_num, $schedule ) }}">
          <div class="invalid-feedback">  
              @if ($errors->has('item_schedule.'.$month_num))
                {{$errors->first('item_schedule.'.$month_num)}}
              @else
                Schedule required.
              @endif  
          </div>
        </div>
        @endforeach
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
@include('ppmp.ppmp_item.itemcodeModal')
 </div>
</div>

</div>
	
@endsection

@section('script')
<script src="{{asset('js/function-script.js')}}"></script>
<script src="{{asset('js/ppmp_field_validation.js')}}"></script>
<script src="{{asset('js/editPpmpItem-script.js')}}"></script>
@endsection
