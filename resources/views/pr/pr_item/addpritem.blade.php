	@extends('layouts.app')

	@section('breadcrumb')
	<ol class="breadcrumb p-2">
		<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	  <li class="breadcrumb-item active"><a href="{{route('view.pr')}}">Purchase Request</a></li>
		<li class="breadcrumb-item active" aria-current="page">Add PR Items</li>
	</ol>
	@endsection

	@section('content')
	<div class="container-fluid">
	<div class="card">
	  <div class="card-header pt-2 pb- 2"><b>Add Items</b></div>
	  <div class="card-body">
	  	<div class="row">
	  		<div class="col-md-5">
	  			<div class="row">
		  			<div class="col-md-12">
		  				<label class="small">Purchase Request Code:</label>
		  				<input class="form-control form-control-sm" type="text" value="{{$pr->pr_code}}" disabled="">
		  			</div>  			
		  			<div class="col-md-12">
		  				<label class="small">Purpose:</label>
		  				<textarea class="form-control form-control-sm" rows="2" type="text" style="resize: none;" disabled>{{$pr->pr_purpose}}</textarea>
		  			</div>
		  			<div class="col-md-6">
		  				<label class="small">Supplier Type:</label>
		  				<input class="form-control form-control-sm" type="text"

		  				@if($pr->supplier_type == 1)
		  				 value="Canvass"
		  				@elseif($pr->supplier_type == 2)
		  				 value="Government Agency"
		  				@elseif($pr->supplier_type == 3)
		  				 value="Sole Distributor"
		  				@endif 
		  				disabled="">
		  			</div>
		  			<div class="col-md-6">
		  				<label class="small">Budget Alllocation:</label>
		  				<input class="form-control form-control-sm" type="text" value="&#8369; {{number_format($pr->pr_budget,2)}}" disabled="">
		  			</div>
	  			</div>
	  		</div>
	  		<div class="col-md-7">
			  <form action="{{route('add.pritm', $pr->id)}}" method="POST">
			  	{{csrf_field()}}
			  	<div class="row">
				  	<div class="form-group col-md-6">
			          <label class="small">Item:</label>
			          <select class="custom-select custom-select-sm {{ $errors->has('item_description') ? 'is-invalid' : '' }}" name="item_description" required="required">
			          	<option value="">Select Item</option>
						@foreach($ppmp_item as $item)
							<option value="{{$item->id}}">{{$item->item_description}}</option>
						@endforeach
			          </select>
			          <div class="invalid-feedback">  
			              @if ($errors->has('item_description'))
			                {{$errors->first('item_description')}}
			              @else
			                Procurement Mode is required.
			              @endif  
			          </div>
			        </div>
			        <div class="form-group col-md-3">
			          <label class="small">Quantity:</label>
			          <select oninput="multiply();" id="itemQty" class="custom-select custom-select-sm {{ $errors->has('item_quantity') ? 'is-invalid' : '' }}" name="item_quantity" required="required">
							
			          </select>
			          <div class="invalid-feedback">  
			              @if ($errors->has('item_quantity'))
			                {{$errors->first('item_quantity')}}
			              @else
			                Procurement Mode is required.
			              @endif  
			          </div>
			        </div>
			        <div class="form-group col-md-3">
			          <label class="small">Unit:</label>
			          <input class="form-control form-control-sm {{ $errors->has('item_unit') ? 'is-invalid' : '' }}" required="required" disabled>
			          <input type="hidden" name="item_unit" value="{{old('item_unit')}}">
			          <div class="invalid-feedback">  
			              @if ($errors->has('item_unit'))
			                {{$errors->first('item_unit')}}
			              @else
			                Procurement Mode is required.
			              @endif  
			          </div>
			        </div>
			        <div class="form-group col-md-6">
			          <label class="small">Cost per Unit:</label>
			          <input onchange="multiply();" id="itemCost" type="text" class="form-control form-control-sm" name="item_cpu" required="">
			          <div class="invalid-feedback">  
			              @if ($errors->has('item_cpu'))
			                {{$errors->first('item_cpu')}}
			              @else
			                Procurement Mode is required.
			              @endif  
			          </div>
			        </div>
			        <div class="form-group col-md-6">
			          <label class="small">Cost per Item:</label>
			          <input id="itemBudget" type="text" class="form-control form-control-sm" name="item_cpi" required="required" readonly="required">
			          <div class="invalid-feedback">  
			              @if ($errors->has('item_cpi'))
			                {{$errors->first('item_cpi')}}
			              @else
			                Procurement Mode is required.
			              @endif  
			          </div>
			        </div>
			        <div class="form-group text-right col-md-12">
			          <button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add Item</button>
			          <a href="" target="_blank" class="btn btn-sm btn-secondary"><i class="fas fa-print"></i> Print</a>
			        </div>
		        </div>
			  </form>
	  		</div>
	  		<div class="col-md-12">
	  			&nbsp;
	  		</div>
	  		<div class="col-md-12">
		      <div class="table-responsive">
		        <table  id= "datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
				  <thead class="thead-dark">
				    <tr>
				      <th data-priority="1">Item No.</th>
				      <th data-priority="2">Description</th>
				      <th data-priority="3">Qty</th>
				      <th data-priority="3">Unit</th>
				      <th data-priority="3">Cost/Unit</th>
				      <th data-priority="3">Cost/Item</th>
				      <th data-priority="1" style="width: 100px;">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	
				  </tbody>
				</table>
		      </div>  
		    </div>
	  	</div>
	  </div>

		
	@endsection

	@section('script')
	<script src="{{asset('js/function-script.js')}}"></script>
	<script type="text/javascript">
	$(document).ready(function() {

		 $('select[name="item_description"]').on('change', function(){
            var itemId = $(this).val();
            if(itemId) {
                $.ajax({
                    url: '/pr/item/get/'+ppmpId,
                    type:"GET",
                    dataType:"json",
                   

                    success:function(data) {
                       $.each(data, function(key, value){
                        $('select[name="item_quantity"]').append('<option value="'+ value['id'] +'">' + value['distributor_name'] + '</option>');
                      });
                    },
                   
                });
            } else {
                
            }

        });
    });
	</script>
	@endsection
