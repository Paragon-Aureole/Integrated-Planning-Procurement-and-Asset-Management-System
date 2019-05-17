@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('distribution.index')}}">Distribute Assets</a></li>
        <li class="breadcrumb-item active" aria-current="page">Distribution of Items to Signatory</li>
    </ol>
@endsection

@section('content')

{{-- {{$fetchedDataPAR}} --}}


<form action="{{route('distribution.store')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="countPAR" value=@if ($countPAR == "")
    1    
    @else
    {{$countPAR + 1}}
    @endif>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header pt-2 pb-2">List of PAR</div>
            <div class="card-body">
                <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                    <thead class="thead-light">
                            <th>ID</th>
                            <th>Details</th>
                            <th>Office</th>
                            <th>Action</th>
                            <th>Add to PAR</th>
                    </thead>
                        @foreach ($fetchedData as $key => $item)
                            @if (!empty($fetchedDataPAR))
                                @if ($fetchedDataPAR[$key]->isProvisioned == '0' && $fetchedDataPAR[$key]->assets_id == $item->id)    
                                    <tr>
                                        <td>
                                            <input type="hidden" name="id[{{$key}}]" value={{$item->id}}>
                                            {{$item->id}}
                                        </td>
                                        <td>
                                            {{-- <input type="hidden" name="details[{{$key}}]" value={{$item->details}}> --}}
                                            {{$item->details}}
                                        </td>
                                        <td>
                                            Office
                                        </td>
                                        <td>
                                            <a href="EXPAND DATA" class="btn btn-sm btn-info" title="Expand Details"><i class="fas fa-th-list"></i></a>
                                            {{-- <td> <input type="hidden" name="isProvisioned[{{$key}}]" value=0></input></td> --}}
                                            <input type="hidden" name="isProvisioned[{{$key}}]" value=0></input>
                                            <td> <input type="checkbox" name="isProvisioned[{{$key}}]" value=1 
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach      

                </table>

                    {{-- <label for="inputSignatory">Input Signatory</label>
                    <input type="text" name="inputSignatory"></input>
                    <input type="submit"></input> --}}

                    <div class="container">
                        {{-- <label>Select Form To Create:</label> --}}
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Input Signatory" name="inputSignatory">
                            <div class="input-group-append">
                                <input class="btn btn-outline-secondary" type="submit" />
                            </div>
                        </div>
                    </div>

                </div>
        </div>
    </div>

</form>

@endsection

{{-- @section('script')
<script type="text/javascript">
  $(document).ready(function() {
      var table =  $('#prDatatable').DataTable({
              responsive: true,
              "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
      });

      $('#prDatatable tbody').on('click', 'tr', function(){
        $('[name=pr_id]').val(table.row(this).index()+1);
      });
  });
</script>
@endsection --}}
