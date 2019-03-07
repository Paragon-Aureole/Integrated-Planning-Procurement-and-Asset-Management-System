	@extends('layouts.app')

	@section('breadcrumb')
	<ol class="breadcrumb p-2">
		<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	  	<li class="breadcrumb-item active"><a href="{{route('view.pr')}}">Purchase Request</a></li>
		<li class="breadcrumb-item active"><a href="{{route('view.pritm', $pr->id)}}">Add PR Item</a></li>
		<li class="breadcrumb-item active" aria-current="page">Update PR Item</li>
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
			  <form action="{{route('update.pritm', [$pr->id, $pr_item->id])}}" method="POST">
			  	{{csrf_field()}}
			  	{{ method_field('put') }}
			  	<div class="row">
				  	<div class="form-group col-md-6">
			          <label class="small">Item Description:</label>
			          <input type="text" class="form-control form-control-sm" value="{{$pr_item->ppmpItem->item_description}}" readonly>
			          <input type="hidden" name="item_description" value="{{$pr_item->ppmpItem->id}}">
			        </div>
			        <div class="form-group col-md-3">
			          <label class="small">Quantity:</label>
			          <select oninput="multiply();" id="itemQty" class="form-control form-control-sm {{ $errors->has('item_quantity') ? 'is-invalid' : '' }}" name="item_quantity" required="required">
						@for($i=0; $i <= $pr_item->item_quantity; $i++)
							<option value="{{$i+1}}">{{$i+1}}</option>
						@endfor
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
			          <label class="small">Unit:</label>
			          <input class="form-control form-control-sm" value="{{$pr_item->ppmpItem->measurementUnit->unit_code}}" disabled>
			        </div>
			        <div class="form-group col-md-6">
			          <label class="small">Cost per Unit:</label>
			          <input oninput="multiply();" id="itemCost" type="text" class="form-control form-control-sm" name="item_cpu" required="" value="{{$pr_item->item_cost}}">
			          <div class="invalid-feedback">  
			              @if ($errors->has('item_cpu'))
			                {{$errors->first('item_cpu')}}
			              @else
			                Cost per unit is required.
			              @endif  
			          </div>
			        </div>
			        <div class="form-group col-md-6">
			          <label class="small">Cost per Item:</label>
			          <input id="itemBudget" type="text" class="form-control form-control-sm" name="item_cpi" required="required" readonly="required" value="{{$pr_item->item_budget}}">
			          <div class="invalid-feedback">  
			              @if ($errors->has('item_cpi'))
			                {{$errors->first('item_cpi')}}
			              @else
			                Cost per item is required.
			              @endif  
			          </div>
			        </div>
			        <div class="form-group text-right col-md-12">
			          <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Update Item</button>
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
	@endsection
