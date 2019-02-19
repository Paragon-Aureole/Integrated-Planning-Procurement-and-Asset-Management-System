@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">PPMP</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2"><i class="fas fa-table"></i> Project Procurement Management Plan</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-4">
   	  <h6 class="card-title">
  		Add PPMP
  	  </h6>
      <form action="{{route('add.ppmp')}}" method="post" id="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="row">
          <div class="form-group col-md-12">
            <label for="ppmpYear" class="small">PPMP Year:</label>
            <input class="form-control form-control-sm {{ $errors->has('ppmp_year') ? 'is-invalid' : '' }}" type="text" name="ppmp_year" value="{{ old('ppmp_year') }}" required>
            <div class="invalid-feedback">  
              @if ($errors->has('ppmp_year'))
                {{$errors->first('ppmp_year')}}
              @else
                PPMP Year is required.
              @endif  
            </div>
          </div>

          @role('Admin')
          <div class="col-md-12 form-group">
              <label for="ppmpOffice" class="small">Office:</label>
                <select id="ppmpOffice" class="custom-select custom-select-sm {{ $errors->has('office_id') ? 'is-invalid' : '' }}" name="office_id" required>
                  <option value = "">-Select One-</option>
                @foreach($offices as $department)
                  <option value = "{{$department->id}}">{{$department->office_name}}</option>
                @endforeach
                </select>
                <div class="invalid-feedback">
                @if ($errors->has('office_id'))
                      {{$errors->first('office_id')}}
                    @else
                      Select a valid office.
                    @endif
                </div>
          </div>
          @else
          <input type="hidden" name="office_id" value="{{Auth::user()->office_id}}">
          @endrole

          <div class="form-group col">
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          </div>
        </div>
      </form>
      
      @if($ppmp_DT->where('is_active', '=', '1')->count() > 0)
      <h6 class="card-title">
      Add PPMP Item Code
      </h6>

      <form action="{{route('add.ppmpitemcode')}}" method="POST" novalidate>
        {{csrf_field()}}
        <div class="row">
          <div class="col-md-12 form-group">
              <label for="ppmpSelect" class="small">Select PPMP:</label>
                <select id="ppmpSelect" class="custom-select custom-select-sm {{ $errors->has('ppmp_select') ? 'is-invalid' : '' }}" name="ppmp_select" required>
                  <option value = "">-Select One-</option>
                @foreach($ppmp_DT->where('is_active', '=', '1') as $ppmp_list)
                  <option value = "{{$ppmp_list->id}}">{{$ppmp_list->ppmp_year}}  {{$ppmp_list->office->office_name}}</option>
                @endforeach
                </select>
                <div class="invalid-feedback">
                @if ($errors->has('ppmp_select'))
                      {{$errors->first('ppmp_select')}}
                    @else
                      Select a valid PPMP.
                    @endif
                </div>
          </div>
          <div class="form-group col-md-12">
            <label class="small">Code Description:</label>
            <input class="form-control form-control-sm {{ $errors->has('code_description') ? 'is-invalid' : '' }}" name="code_description" value="{{ old('code_description') }}" required>
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
              <option value='1'>Department & Office Supplies</option>
              <option value='2'>Departmental Projects</option>
              <option value='3'>Projects Chargeable to Other Offices</option>
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
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            <button type="button" id="editBtn" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ppmpCodeModal">
              View/Edit
            </button>
          </div>
        </div>
      </form>
	   @endif
   	</div>


    <!-- The Modal -->
    <div class="modal fade" id="ppmpCodeModal">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title">Edit PPMP Code</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
            <div class="row">
              <div class="col-8">
                <select class="custom-select custom-select-sm" id="selectPpmp">
                  @foreach($ppmp_DT->where('is_active', '=', '1') as $ppmp_list)
                    <option value = "{{$ppmp_list->id}}">{{$ppmp_list->ppmp_year}}  {{$ppmp_list->office->office_name}}</option>
                  @endforeach
                </select>
              </div><br><br>
              <div class="col-12">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-sm w-100">
                    <thead class="thead-dark">
                      <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
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

   	<!-- table -->
   	<div class="col-md-8">
   	  <h6 class="card-title">Registered PPMP</h6>
   	  <div class="table-responsive">
   	  	@include('ppmp.ppmpdatatable')
   	  </div>	
   	</div>
   </div>
 </div>
</div>

</div>
	
@endsection

@section('script')
<script type="text/javascript">
  $("").click(function(){
  $.get("#", function(data, status){
      
    });
  });
</script>
@endsection
