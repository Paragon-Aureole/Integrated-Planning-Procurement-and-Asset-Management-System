@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('view.ppmp')}}">PPMP</a></li>
  <li class="breadcrumb-item active"><a href="{{route('view.ppmpitemcode', $ppmp->id)}}">View PPMP Codes</a></li>
  <li class="breadcrumb-item active" aria-current="page">Edit PPMP Code</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">PPMP Item Codes</div>
 <div class="card-body">
   <div class="row">
    <div class="col-md-4">
            <h6 class="card-title">
      Update PPMP Item Code
      </h6>

      <form action="{{route('update.ppmpitemcode', $ppmp_key->id)}}" method="POST" id="needs-validation2" novalidate>
        {{csrf_field()}}
        {{ method_field('put') }}
        <div class="row">
          <div class="form-group col-md-12">
            <label class="small">Code Description:</label>
            <input class="form-control form-control-sm {{ $errors->has('code_description') ? 'is-invalid' : '' }}" name="code_description" value="{{ old('code_description', $ppmp_key->code_description) }}" required>
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
            <select class="custom-select custom-select-sm {{ $errors->has('code_type') ? 'is-invalid' : '' }}" name="code_type" required>
              <option value='1' @if($ppmp_key->code_type == 1) selected @endif>Department & Office Supplies</option>
              <option value='2' @if($ppmp_key->code_type == 2) selected @endif>Departmental Projects</option>
              <option value='3' @if($ppmp_key->code_type == 3) selected @endif>Projects Chargeable to Other Offices</option>
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
            <button type="submit" class="btn btn-warning btn-sm">Update</button>
          </div>
        </div>
      </form>

    </div>

    <!-- table -->
    <div class="col-md-8">
      <h6 class="card-title">Registered PPMP Codes</h6>
      <div class="table-responsive">
        @include('ppmp.ppmp_item_codes.ppmpcodesdatatable')
      </div>  
    </div>
   </div>
 </div>
</div>

</div>
  
@endsection

