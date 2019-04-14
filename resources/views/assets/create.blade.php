@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
        <li class="breadcrumb-item active" aria-current="page">List of Details </li>
    </ol>
@endsection

@section('content')

<form action="{{route('assets.store')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="PO_id" value={{$id->searchPO}}></input>
        
    <div class="container-fluid">
        <div class="card">
            <div class="card-header pt-2 pb-2">List of Item</div>
            <div class="card-body">
                <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                    <thead class="thead-dark">
                        <tr>
                            <th>Details</th>
                            <th>Amount</th>
                            <th>Sup.</th>
                            <th>ICS</th>
                            <th>PAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dummyData as $key => $record)
                        <tr>
                            <td>{{$record[0]}}</td>
                            <input type="hidden" name="recordDetails[{{$key}}]" value={{$record[0]}}>
                            <td>{{$record[1]}}</td>
                            <input type="hidden" name="recordAmount[{{$key}}]" value={{$record[1]}}>
                            
                            {{-- <td> <input type="hidden" name="Supply[{{$key}}]" value=0></input></td> --}}
                            <input type="hidden" name="Supply[{{$key}}]" value=0>
                            <td> <input type="checkbox" name="Supply[{{$key}}]" value=1></td>
                            
                            {{-- <td> <input type="hidden" name="ICS[{{$key}}]" value=0></input></td> --}}
                            <input type="hidden" name="ICS[{{$key}}]" value=0>
                            <td> <input type="checkbox" name="ICS[{{$key}}]" value=1></td>
                            
                            {{-- <td> <input type="hidden" name="PAR[{{$key}}]" value=0></input></td> --}}
                            <input type="hidden" name="PAR[{{$key}}]" value=0>
                            <td> <input type="checkbox" name="PAR[{{$key}}]" value=1></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <input type="submit" class="btn btn-primary">
            </div>
        </div>
    </div>

</form>
@endsection

@section('script')
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
@endsection
