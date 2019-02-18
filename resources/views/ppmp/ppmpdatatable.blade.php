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
              <td>{{$ppmp->ppmpBudget->ppmp_est_budget}}</td>
              <td>{{$ppmp->ppmpBudget->ppmp_rem_budget}}</td>
   	  	  	  <td>
               
            @if($ppmp->ppmpItemCode->count() > 0)
   	  	  	  	<a href="#" class="btn btn-sm btn-info" title="Add PPMP Items"><i class="fas fa-th-list"></i></a>
            @endif

            @if($ppmp->is_active == 1)
              <a href="{{route('deactivate.ppmp', $ppmp->id)}}" title="Deactivate Signatory" class="btn btn-sm btn-success">
                <i class="fas fa-check-circle"></i>
              </a>
            @else
              <a href="{{route('activate.ppmp', $ppmp->id)}}" title="Activate Signatory" class="btn btn-sm btn-secondary">
                <i class="far fa-check-circle"></i>
              </a>
            @endif

   	  	  	  	<a href="{{route('delete.ppmp', $ppmp->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></a>
   	  	  	  </td>
   	  	  	</tr>
   	  	  	@endforeach
            
   	  	  </tbody>
   	  	</table>