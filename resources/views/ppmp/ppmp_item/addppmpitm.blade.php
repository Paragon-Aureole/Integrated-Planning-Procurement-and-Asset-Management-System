@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('view.ppmp')}}">PPMP</a></li>
	<li class="breadcrumb-item active" aria-current="page">Add PPMP Items</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2"><b>Add Items</b></div>
 <div class="card-body">
  <form action="" method="post" id="needs-validation" novalidate>
    {{csrf_field()}}
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="form-group col-md-12">
          <label class="small">Code:</label>
          <div class="input-group mb-3">
            <select class="custom-select custom-select-sm {{ $errors->has('item_code') ? 'is-invalid' : '' }}" name="item_code" required="required">
              @foreach($ppmp->ppmpItemCode as $codes) 
                <option value="{{$codes->id}}">{{$codes->code_description}}</option>
              @endforeach 
            </select>
            <div class="input-group-append">
              <a href="{{route('view.ppmpitemcode', $ppmp->id)}}" class="btn btn-outline-secondary btn-sm">Add Item Code</a> 
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
          <textarea class="form-control form-control-sm {{ $errors->has('item_description') ? 'is-invalid' : '' }}" name="item_description" required="required"></textarea>
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
            <option>{{$mode->method_name}}</option>
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
          <input class="form-control form-control-sm {{ $errors->has('item_quantity') ? 'is-invalid' : '' }}" name="item_quantity">
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
          <select class="custom-select custom-select-sm {{ $errors->has('item_unit') ? 'is-invalid' : '' }}" name="item_unit">
            @foreach($units as $unit)
            <option value="{{$unit->id}}">{{$unit->unit_description}}</option>
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
          <label class="small">Estimated Cost per Item:</label>
          <input class="form-control form-control-sm {{ $errors->has('item_unit') ? 'is-invalid' : '' }}" name="">
          <div class="invalid-feedback">  
              @if ($errors->has('code_description'))
                {{$errors->first('code_description')}}
              @else
                Code description is required.
              @endif  
          </div>
        </div>        
        <div class="form-group col-md-6">
          <label class="small">Estimated Budget:</label>
          <input class="form-control form-control-sm {{ $errors->has('item_unit') ? 'is-invalid' : '' }}" name="">
          <div class="invalid-feedback">  
              @if ($errors->has('code_description'))
                {{$errors->first('code_description')}}
              @else
                Code description is required.
              @endif  
          </div>
        </div>
        <div class="form-group col-md-12 text-right">
          <button class="btn btn-sm btn-primary">Submit</button>
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
          <label class="small">{{strtoupper(date('M', mktime(0, 0, 0, $s, 1)))}}</label>
          <input class="form-control form-control-sm" name="schedule[{{$month_num}}]" value="0">
          <div class="invalid-feedback">  
              @if ($errors->has('schedule.'.$month_num))
                {{$errors->first('schedule.'.$month_num)}}
              @else
                Schedule required.
              @endif  
          </div>
        </div>
        @endfor
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
	
@endsection
