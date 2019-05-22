@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
  <li class="breadcrumb-item active" aria-current="page">Print ICS Module </li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Inventory Custodian Slip</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-12">
   	  <h6 class="card-title">
  		Available ICS Items
        </h6>
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
            {{--  {{$assetIcsItem->first()->asset}}  --}}
            @foreach ($assetIcsItem as $item)
            <tr>
                <td>{{$item->quantity}}</td>
                <td>{{$item->asset->measurementUnit->unit_code}}</td>
                <td>{{$item->asset->details}}</td>
                <td>{{$item->description}}</td>
                <td>{{$item->inventory_name_no}}</td>
                <td>{{$item->useful_life}}</td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
    </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
                <div class="container-fluid">
                    <a href="/printIcs/{{$id}}" target="_blank" class="btn btn-success float-right">Print ICS</a>
                </div>
          </div> 
      </form>
    </div>
   </div>
 </div>
</div>
</div>
	
@endsection

@section('script')

{{--  <script src="{{asset('js/asset_icsIndex.js')}}"></script>  --}}
@endsection