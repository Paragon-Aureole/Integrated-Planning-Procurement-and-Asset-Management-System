	@extends('layouts.app')

	@section('breadcrumb')
	<ol class="breadcrumb p-2">
		<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	  <li class="breadcrumb-item active"><a href="{{route('pr.index')}}">Purchase Request</a></li>
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
			  <form autocomplete="off" action="{{route('add.pritm', $pr->id)}}" method="POST" class="needs-validation" novalidate>
			  	{{csrf_field()}}
			  	<div class="row">
							<div class="col-md-6 form-group">
									<span class="text-danger">*</span> <label for="itemDesc" class="small">Item Description:</label>
										
								<input list="itemDescs" id="itemDesc" class="form-control form-control-sm {{ $errors->has('item_description') ? 'is-invalid' : '' }}" required>
									<datalist id="itemDescs">
										@foreach($ppmp_item as $item)
											<option data-value = "@if($pr->is_supplemental == 1) {{$item->ppmp_item_id}} @else {{$item->id}} @endif">
													@if($pr->is_supplemental == 1)
														{{$item->ppmpItem->item_description}}
													@else
														{{$item->item_description}}
													@endif
											</option>
										@endforeach
									</datalist>
								<div class="invalid-feedback">
									@if ($errors->has('item_description'))
										{{$errors->first('item_description')}}
									@else
										Select a valid item.
									@endif
								</div>
										
								<input name="item_description" id="itemDesc-hidden" type="hidden" required>
							</div>
			        <div class="form-group col-md-3">
									<span class="text-danger">*</span> <label class="small">Quantity:</label>
			          <select oninput="multiply();" id="itemQty" class="custom-select custom-select-sm {{ $errors->has('item_quantity') ? 'is-invalid' : '' }}" name="item_quantity" required="required">
							
			          </select>
			          <div class="invalid-feedback">  
			              @if ($errors->has('item_quantity'))
			                {{$errors->first('item_quantity')}}
			              @else
			                Quantity is required.
			              @endif  
			          </div>
			        </div>
			        <div class="form-group col-md-3">
									<span class="text-danger">*</span> <label class="small">Unit:</label>
			          <input class="form-control form-control-sm {{ $errors->has('item_unit') ? 'is-invalid' : '' }}" required="required" id="itemUnit" disabled>
			          <input type="hidden" name="item_unit" value="{{old('item_unit')}}">
			          <div class="invalid-feedback">  
			              @if ($errors->has('item_unit'))
			                {{$errors->first('item_unit')}}
			              @else
			                Unit is required.
			              @endif  
			          </div>
			        </div>
			        <div class="form-group col-md-6">
									<span class="text-danger">*</span> <label class="small">Cost per Unit:</label>
			          <input oninput="multiply();" id="itemCost" type="text" class="form-control form-control-sm" name="item_cpu" required="">
			          <div class="invalid-feedback">  
			              @if ($errors->has('item_cpu'))
			                {{$errors->first('item_cpu')}}
			              @else
			                Cost per unit is required.
			              @endif  
			          </div>
			        </div>
			        <div class="form-group col-md-6">
									<span class="text-danger">*</span> <label class="small">Cost per Item:</label>
			          <input id="itemBudget" type="text" class="form-control form-control-sm" name="item_cpi" required="required" readonly="required">
			          <div class="invalid-feedback">  
			              @if ($errors->has('item_cpi'))
			                {{$errors->first('item_cpi')}}
			              @else
			                Cost per item is required.
			              @endif  
			          </div>
			        </div>
			        <div class="form-group text-right col-md-12">
								<button class="btn btn-sm btn-primary"
									@if ($pr->pr_status == 1 || $pr->pr_status == 2)
										disabled
									@endif
								><i class="fas fa-plus"></i> Add Item</button>
			          <a href="{{route('print.pr', $pr->id)}}" target="_blank" class="btn btn-sm btn-secondary"><i class="fas fa-print"></i> Print</a>
			        </div>
		        </div>
			  </form>
	  		</div>
	  		<div class="col-md-12">
	  			&nbsp;
	  		</div>
	  		<div class="col-md-12">
		      <div class="table-responsive">
		        @include('pr.pr_item.pritmdatatable')
		      </div>  
		    </div>
	  	</div>
	  </div>

		
	@endsection

	@section('script')
	<script src="{{asset('js/function-script.js')}}"></script>
	<script src="{{asset('js/pr-item-script.js')}}"></script>
	@endsection
