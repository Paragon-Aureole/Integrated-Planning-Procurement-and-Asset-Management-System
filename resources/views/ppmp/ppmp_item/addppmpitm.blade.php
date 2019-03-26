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
 <div class="card-header pt-2 pb- 2"><b>Add Items</b></div>
 <div class="card-body">
  <form action="{{route('add.ppmpitm', $ppmp->id)}}" method="post" id="needs-validation" novalidate>
    {{csrf_field()}}
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="form-group col-md-12">
          <label class="small">Code:</label>
          <div class="input-group mb-3">
            <select class="custom-select custom-select-sm {{ $errors->has('item_code') ? 'is-invalid' : '' }}" name="item_code" required="required">
              @foreach($ppmp->ppmpItemCode as $codes) 
                <option value="{{$codes->id}}" >{{$codes->code_description}}</option>
              @endforeach 
            </select>
            <div class="input-group-append">
              <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#itemCodeModal">Add Item Code</button> 
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
          <textarea class="form-control form-control-sm {{ $errors->has('item_description') ? 'is-invalid' : '' }}" name="item_description" rows="3" required="required"></textarea>
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
          <label class="small">Quantity:</label>
          <input oninput="multiply();" id="itemQty" class="form-control form-control-sm {{ $errors->has('item_quantity') ? 'is-invalid' : '' }}" value="{{ old('item_quantity') }}" value="{{ old('item_quantity') }}" name="item_quantity" required="required">
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
            <option value="{{$unit->id}}" {{ old('item_unit') == $unit->id ? 'selected' : '' }}>{{$unit->unit_description}}</option>
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
          <input oninput="multiply();" id="itemCost" class="form-control form-control-sm {{ $errors->has('item_cost') ? 'is-invalid' : '' }}" value="{{ old('item_cost') }}" name="item_cost" required="required">
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
          <input id="itemBudget" class="form-control form-control-sm {{ $errors->has('item_budget') ? 'is-invalid' : '' }}" value="{{ old('item_budget', number_format(0,2)) }}" name="item_budget" readonly="readonly" required="required">
          <div class="invalid-feedback">  
              @if ($errors->has('item_budget'))
                {{$errors->first('item_budget')}}
              @else
                Code description is required.
              @endif  
          </div>
        </div>
        <div class="form-group col-md-12 text-right">
          <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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
          <input class="form-control form-control-sm {{ $errors->has('item_schedule.'.$month_num) ? 'is-invalid' : '' }}" name="item_schedule[{{$month_num}}]" value="{{ old('item_schedule.'.$month_num, '0' ) }}">
          <div class="invalid-feedback">  
              @if ($errors->has('item_schedule.'.$month_num))
                {{$errors->first('item_schedule.'.$month_num)}}
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

<!-- Modal -->
<style>
.modal-content{
  overflow-y: auto;
}
</style>
{{-- <div class="modal fade" id="itemCodeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Asset Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <iframe src="{{route('view.ppmpitemcode', $ppmp->id)}}"></iframe>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> --}}

 <!-- The Modal -->
 <div class="modal" id="itemCodeModal">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h1 class="modal-title">Item Codes</h1>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
          <div class="container-fluid">
              <div class="card">
               <div class="card-header pt-2 pb-2">PPMP Item Codes</div>
               <div class="card-body">
                 <div class="row">
                  <div class="col-md-4">
                          <h6 class="card-title">
                    Add PPMP Item Code
                    </h6>
              
                    <form action="{{route('add.ppmpitemcode', $ppmp->id)}}" method="POST" id="needs-validation2" novalidate>
                      {{csrf_field()}}
                      <div class="row">
                        <div class="form-group col-md-12">
                          <input type="text" id="codeId" hidden>
                          <label class="small">Code Description:</label>
                          <input id="descriptionValue" class="form-control form-control-sm {{ $errors->has('code_description') ? 'is-invalid' : '' }}" name="code_description" value="{{ old('code_description') }}" required>
                          <div class="invalid-feedback">  
                            @if ($errors->has('code_description'))
                              {{$errors->first('code_description')}}
                            @else
                              Code description is required.
                            @endif  
                          </div>
                        </div>
                        <div class="form-group col-md-12">
                          <label for="codeType" class="small">Code Type:</label>
                          <select id="optionValue" class="custom-select custom-select-sm {{ $errors->has('code_type') ? 'is-invalid' : '' }}" name="code_type" required>
                            {{-- <option value='1'>Department & Office Supplies</option>
                            <option value='2'>Departmental Projects</option>
                            <option value='3'>Projects Chargeable to Other Offices</option> --}}
                          </select>
                          <div class="invalid-feedback">  
                            @if ($errors->has('code_type'))
                              {{$errors->first('code_type')}}
                            @else
                              Category is required.
                            @endif  
                          </div>
                        </div>
                        <div class="form-group col">
                          <button type="submit" class="btn btn-primary btn-sm" id="submitContent">Submit</button>
                          <button class="btn btn-warning btn-sm" id="updateContent" style="display:none">Update</button>
                          <button type="reset" class="btn btn-primary btn-sm" id="cancelUpdate" style="display:none">Cancel</button>
                        </div>
                      </div>
                    </form>
                    <div class="form-group col">
                      {{-- <button class="btn btn-primary btn-sm" id="submitContent">Submit</button> --}}
                      
                    </div>
              
                  </div>
              
                  <!-- table -->
                  <div class="col-md-8">
                    <h6 class="card-title">Registered PPMP Codes</h6>
                    <div class="table-responsive">
                      @include('ppmp.ppmp_item_codes.ppmpcodesdatatable')
                      {{-- asdasdasd --}}
                    </div>  
                  </div>
                 </div>
               </div>
              </div>
              
              </div>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>

	
@endsection

@section('script')
<script src="{{asset('js/function-script.js')}}"></script>
<script src="{{asset('js/editPpmpItem-script.js')}}"></script>
@endsection
