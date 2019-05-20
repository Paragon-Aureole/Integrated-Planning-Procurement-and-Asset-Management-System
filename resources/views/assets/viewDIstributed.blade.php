@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
  <li class="breadcrumb-item active" aria-current="page">List of All Assets</li>
</ol>
@endsection

@section('content')

{{-- TABLE FOR DISTRIBUTED ASSETS --}}
<div class="container-fluid">
  <div class="card">
    <div class="card-header pt-2 pb-2">List of All Assets</div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <h6 class="card-title">
            @can("Asset Management", "full control")
              All Departments
            @else
              {{Auth::user()->office->office_name}}
            @endcan
          </h6>
          <div class="table-responsive">
            <table id="distributedItemsDatatable"
              class="table table-bordered table-hover table-sm display nowrap w-100">
              <thead class="thead-light">
                <tr>
                  {{--  <th>ID</th>
                  <th>Signatory Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Item Name</th>
                  <th>Quantity</th>
                  <th>Amount</th>
                  <th>Classification</th>
                  <th>Asset Type</th>
                  <th>Action</th>  --}}
                  <th>PO No.</th>
                  <th>Signatory Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Details</th>
                  <th>Classification</th>
                  <th>Actions</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($assetPar as $record)
                  
                <td>{{$record->id}}</td>
                <td>{{$record->assignedTo}}</td>
                <td>{{$record->position}}</td>
                <td>{{$record->purchaseOrder->purchaseRequest->office->office_code}}</td>
                <td>
                  @php
                      $firstTwo = $record->assetParItem->take(2);
                      {{}}
                  @endphp
                  @foreach ($firstTwo as $item)
                    {{$item->description}}
                  @endforeach
                </td>
                {{--  <td>{{$record->quantity}}</td>  --}}
                  <td>
                  PAR
                  </td>
                  
                  <td>
                    <a href="{{route('assets.printPar', $record->id)}}" target="_blank" class="btn btn-sm btn-success">
                    <i class="fas fa-print"></i>
                  </a>
                  </td>
              </tr>
              @endforeach

              @foreach ($assetIcs as $record)
                
                <td>{{$record->id}}</td>
                <td>Name Here</td>
                <td>Position Here</td>
                <td>{{$record->purchaseOrder->purchaseRequest->office->office_code}}</td>
                <td>
                  @php
                      $firstTwo = $record->assetIcslipItem->take(2);
                      {{}}
                  @endphp
                  @foreach ($firstTwo as $item)
                   || {{$item->description}} ||
                  @endforeach
                <td>
                  ICS
                  </td>

                  <td>
                    
                    <a href="{{route('assets.printIcs', $record->id)}}" class="btn btn-sm btn-success"><i class="fas fa-print"></i></a>
                  
                  </td>
              </tr>
              @endforeach
              
            

                {{--  @foreach ($assetIcs as $record)
                <td>{{$record->asset_id}}</td>
                <td>{{$record->assignedTo}}</td>
                <td>{{$record->position}}</td>
                <td>{{$record->asset->purchaseOrder->purchaseRequest->office->office_code}}</td>
                <td>{{$record->asset->details}}</td>
                <td>{{$record->quantity}}</td>
                <td>{{$record->asset->amount}}</td>
                <td>{{$record->asset->asset_type->type_name}}</td>
                <td>ICS</td>
                <td>
                    <a href="{{'/printIcs/' . $record->asset_id}}" target="_blank" class="btn btn-sm btn-success">
                      <i class="fas fa-print"></i>
                    </a>
                  </td>
                </tr>
                @endforeach  --}}
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src="{{asset('js/asset_moduleFinal.js')}}"></script>
@endsection