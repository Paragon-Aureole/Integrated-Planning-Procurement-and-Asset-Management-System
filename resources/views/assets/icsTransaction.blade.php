@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
  <li class="breadcrumb-item active" aria-current="page">Assign ICS</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Inventory Custodian Slip</div>
 <div class="card-body">
     <form action="{{route('assets.saveNewIcs')}}" method="post">
         {{csrf_field()}}

     
     PO Number:<input type="text" name="poNum" value="{{$id}}"></input>
   <div class="row">
   	<div class="col-md-12">
   	  <h6 class="card-title">
  		Available ICS Items
        </h6>
        <div class="row">
            <div class="col-md-6">
                <label class="text-center">Signatory Name:</label>
                <input type="text" class="container-fluid" name="itemSignatoryName" readonly value="{{$signatoryData->signatory_name}}">
            </div>
            <div class="col-md-6">
                    <label class="text-center">Position:</label>
                <input type="text" class="container-fluid" name="itemSignatoryPosition" readonly value="{{$signatoryData->signatory_position}}">
            </div>
        </div>
        <div class="col-md-12">&nbsp;</div>
      <div class="table-responsive">
        <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-light">
            <tr>
              <th>Quantity</th>
              <th>Unit</th>
              <th>Description</th>
              <th>Additional Description</th>
              <th>Inventory Item No.</th>
              <th>Estimated Useful Life</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($assetIcsItems as $item)
            <tr>
                <td>
                    <input type="text" readonly name="itemQuantity[{{$item->id}}]" value="{{$item->item_stock}}">
                    
                </td>
                <td>{{$item->measurementUnit->unit_code}}</td>
                <td>{{$item->details}}</td>
                <td><textarea name="itemExtraDescription[{{$item->id}}]" cols="30" rows="1"></textarea></td>
                <td><input type="text" name="itemInventoryNo[{{$item->id}}]"></td>
                <td><input type="text" name="itemEstimatedUsefulLife[{{$item->id}}]"></td>
            </tr>
            {{--  {{$item}}  --}}
                
            @endforeach
            {{--  @foreach ($pr as $pr)  --}}
                {{--  <tr>
                    <td>
                        <select name="" id="">
                            <option value="">3</option>
                            <option value="">2</option>
                            <option value="">1</option>
                        </select>
                    </td>
                    <td>UNIT</td>
                    <td>LAPTOP</td>
                    <td><textarea name="" id="" cols="30" rows="1"></textarea></td>
                    <td><input type="text" name="" id=""></td>
                    <td><input type="text"></td>
                </tr>
                <tr>
                    <td>
                        <select name="" id="">
                            <option value="">5</option>
                            <option value="">4</option>
                            <option value="">3</option>
                            <option value="">2</option>
                            <option value="">1</option>
                        </select>
                    </td>
                    <td>BAG</td>
                    <td>BALLPEN</td>
                    <td><textarea name="" id="" cols="30" rows="1"></textarea></td>
                    <td><input type="text" name="" id=""></td>
                    <td><input type="text"></td>
                </tr>  --}}
            {{--  @endforeach  --}}
          </tbody>
        </table>
    </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
                <div class="container-fluid">
                    <button type="submit" class="btn btn-info float-right" data-toggle="confirmation">Save Transaction</button>
                </div>
          </div> 
      </form>
    </div>
   </div>
 </div>
</div>
</div>

<div class="modal" id="saveTransactionModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4>Item Edit Request</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="{{route('asset.requestEdit')}}" autocomplete="off" method="GET" class="needs-validation" novalidate>
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="text-center">Add New Transactions?</label>
                </div>
              </div>
          </div>
          <input type="text" value="0" name="classificationNo" hidden>
          <div class="row">
            <div class="col-md-6">
                <button class="btn btn-success container-fluid" type="submit">YES</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-danger container-fluid" type="submit">No</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
	
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
        $('#prDatatable').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
        });
    } );
</script>
@endsection



