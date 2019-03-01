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
  <form class="">
  <div class="row">
    
    <div class="col-md-6">
      <div class="row">
        <div class="form-group col-md-12">
          <label class="small">Code:</label>
          <div class="input-group mb-3">
            <select class="custom-select custom-select-sm">
              @foreach($ppmp->ppmpItemCode as $codes) 
                <option>{{$codes->code_description}}</option>
              @endforeach 
            </select>
            <div class="input-group-append">
              <a class="btn btn-outline-secondary btn-sm">Add Item Code</a> 
            </div>
            <div class="invalid-feedback">  
              @if ($errors->has('code_description'))
                {{$errors->first('code_description')}}
              @else
                Code description is required.
              @endif  
            </div>
          </div>
        </div>
        <div class="form-group col-md-12">
          <label class="small">General Description:</label>
          <textarea class="form-control form-control-sm" rows="3" name=""></textarea>
          <div class="invalid-feedback">  
              @if ($errors->has('code_description'))
                {{$errors->first('code_description')}}
              @else
                Code description is required.
              @endif  
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="small">Quantity:</label>
          <input class="form-control form-control-sm" rows="3" name="">
          <div class="invalid-feedback">  
              @if ($errors->has('code_description'))
                {{$errors->first('code_description')}}
              @else
                Code description is required.
              @endif  
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="small">Unit:</label>
          <input class="form-control form-control-sm" rows="3" name="">
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
          <input class="form-control form-control-sm" rows="3" name="">
          <div class="invalid-feedback">  
              @if ($errors->has('code_description'))
                {{$errors->first('code_description')}}
              @else
                Code description is required.
              @endif  
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="small">Mode of Procurement:</label>
          <input class="form-control form-control-sm" rows="3" name="">
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
      <table class="  table table-bordered table-hover table-sm display ">
        <thead class="thead-light ">
          <tr>
            <th>JAN</th>
            <th>FEB</th>
            <th>MAR</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="" name=""></td>
            <td><input type="" name=""></td>
            <td><input type="" name=""></td>
          </tr>
        </tbody>
        <thead class="thead-light">
          <tr>
            <th>APR</th>
            <th>MAY</th>
            <th>JUNE</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="" name=""></td>
            <td><input type="" name=""></td>
            <td><input type="" name=""></td>
          </tr>
        </tbody>
        <thead class="thead-light">
          <tr>
            <th>JUL</th>
            <th>AUG</th>
            <th>SEPT</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="" name=""></td>
            <td><input type="" name=""></td>
            <td><input type="" name=""></td>
          </tr>
        </tbody>
        <thead class="thead-light">
          <tr>
            <th>OCT</th>
            <th>NOV</th>
            <th>DEC</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="" name=""></td>
            <td><input type="" name=""></td>
            <td><input type="" name=""></td>
          </tr>
        </tbody>
      </table> 
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
