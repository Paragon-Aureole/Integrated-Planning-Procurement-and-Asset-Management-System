@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Supplemental PPMP</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2">Supplemental PPMP</div>
 <div class="card-body">
   <div class="row">
   	<div class="col-md-5">
   	  <h6 class="card-title">
  		Available PPMP Forms
  	  </h6>
      <div class="table-responsive">
        <table id="ppmpDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-dark">
            <tr>
              <th>PPMP Year</th>
              <th>Department</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($created_ppmp as $orig_ppmp)
            <tr>
                <td>{{$orig_ppmp->ppmp_year}}</td>
                <td>{{$orig_ppmp->office->office_code}}</td>
                <td>
                    <a href="{{route('createsupplemental.ppmp', $orig_ppmp->id)}}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i>
                    </a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div> 
    </div>

   	<!-- table -->
   	<div class="col-md-7">
   	  <h6 class="card-title">Registered Supplemental PPMP Forms</h6>
   	  <div class="table-responsive">
   	  	<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-dark">
            <tr>
              <th>Supplemental PPMP Year</th>
              <th>Office</th>
              <th>Supplemented Items/Projects</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>    
            @foreach ($ppmp_DT as $supplementals)
            @php
                if(Auth::user()->hasPermissionTo('full control')){
                    $suffix = App\Ppmp::where('office_id', $supplementals->office_id)->where('is_supplemental' , true)->count();
                }else{
                  $suffix = $ppmp_DT->count();
                }
            @endphp
            @php
                $firstTwo = $supplementals->ppmpItem->take(2);
            @endphp
                <td>{{$supplementals->ppmp_year}}-{{$suffix}}</td>
                <td>{{$supplementals->office->office_code}}</td>
                <td>
                    @foreach ($firstTwo as $item)
                        {{$item->item_description}} @if ($firstTwo->count() > 1) , @endif 
                    @endforeach
                </td>
                <td>
                {{-- @if($ppmp->ppmpItemCode->count() > 0) --}}
                <a href="{{route('view.ppmpitm', $supplementals->id)}}" class="btn btn-sm btn-info" title="Add PPMP Items"><i class="fas fa-th-list"></i></a>
                {{-- @else
                <a href="{{route('view.ppmpitemcode', $ppmp->id)}}" class="btn btn-sm btn-warning" title="Add PPMP Item Codes"><i class="fas fa-plus-square"></i></a>
                @endif --}}
                
                @if($supplementals->ppmpItem()->count() > 0)
                <a href="{{route('print.ppmp', $supplementals->id)}}" target="_blank" class="btn btn-sm btn-secondary"><i class="fas fa-print"></i></a>
                @endif
                @can('full control')
                <a href="{{route('delete.ppmp', $supplementals->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></a>
                @endcan
                
                </td>
            </tr>
            @endforeach
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
<script type="text/javascript">
  $(document).ready(function() {
        $('#ppmpDatatable').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
        });
    } );
</script>
@endsection



