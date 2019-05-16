<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
   	<thead class="thead-dark">
   	  <tr>
        @role('Admin')
        <th>Office</th>
        @endrole
   	  	<th>PPMP Year</th>
   	  	<th>Est. Budget</th>
        <th>Rem. Budget</th>
   	  	<th>Action</th>
   	  </tr>
   	</thead>
   	<tbody>
   	  @foreach($ppmp_DT as $ppmp)
   	  <tr>
      @role('Admin')
        <td>{{$ppmp->office->office_code}}</td>
      @endrole
   	  	<td>{{$ppmp->ppmp_year}}</td>
        <td>&#8369; {{number_format($ppmp->ppmpBudget->ppmp_est_budget, 2)}}</td>
        <td>&#8369; {{number_format($ppmp->ppmpBudget->ppmp_rem_budget, 2)}}</td>
   	  	<td>    
   	  	  <a href="{{route('view.ppmpitm', $ppmp->id)}}" class="btn btn-sm btn-primary" title="Add PPMP Items"><i class="fas fa-th-list"></i></a>
        @if($ppmp->is_active == 1)
          <a href="{{route('deactivate.ppmp', $ppmp->id)}}" title="Deactivate PPMP" data-content="PPMP Form {{$ppmp->ppmp_year}}" data-placement="top" class="btn btn-sm btn-success" data-toggle="confirmation">
            <i class="fas fa-check-circle"></i>
          </a>
        @else
          <a href="{{route('activate.ppmp', $ppmp->id)}}" class="btn btn-sm btn-secondary" data-toggle="confirmation"  title="Activate PPMP" data-content="PPMP Form {{$ppmp->ppmp_year}}">
            <i class="far fa-check-circle"></i>
          </a>
        @endif
        
        @if($ppmp->ppmpItem()->count() > 0)
          <a href="{{route('print.ppmp', $ppmp->id)}}" target="_blank" class="btn btn-sm btn-secondary"><i class="fas fa-print"></i></a>
        @endif
        @can('full control')
   	  	  <a href="{{route('delete.ppmp', $ppmp->id)}}" class="btn btn-sm btn-danger" data-toggle="confirmation"><i class="fas fa-minus"></i></a>
         </td>
        @endcan
   	  </tr>
   	@endforeach
            
  </tbody>
</table>