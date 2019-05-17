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
      <form action="{{route('add.ppmp')}}" method="post" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="row">
          <div class="form-group col-md-12">
            <span class="text-danger">*</span><label for="ppmpYear" class="small">PPMP Year:</label>
            <input class="form-control form-control-sm {{ $errors->has('ppmp_year') ? 'is-invalid' : '' }}" type="text" name="ppmp_year" value="{{ old('ppmp_year') }}" required>
            <div id="feedback" class="invalid-feedback">  
              @if ($errors->has('ppmp_year'))
                {{$errors->first('ppmp_year')}}
              @else
                PPMP Year is required.
              @endif  
            </div>
          </div>

          @role('Admin')
          <div class="col-md-12 form-group">
              <span class="text-danger">*</span><label for="ppmpOffice" class="small">Office:</label>
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
            <button type="submit" id="submitPpmp" class="btn btn-primary btn-sm">Submit</button>
          </div>
        </div>
      </form>
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

<script src="{{asset('js/numeric-validation.js')}}"></script>
<script>
  $(document).ready(function () {

    $('input[name="ppmp_year"]').inputFilter(function(value) {
      var test_val = /^\d*$/.test(value);
      // console.log(test_val);

      if(test_val == false){
        $('input[name="ppmp_year"]').addClass('is-invalid');
        $('#feedback').html("Not a valid year");
      }
      return test_val;

    });


    $("#submitPpmp").on('click', function(e){
      
      var ppmp_year = $('input[name="ppmp_year"]').val();
      var current_year=new Date().getFullYear();

      if(ppmp_year < current_year){
        e.preventDefault();
        $('input[name="ppmp_year"]').addClass('is-invalid');
        $('#feedback').html("Invalid PPMP Year.");
      }
    });
    
  });
</script>
    
@endsection
