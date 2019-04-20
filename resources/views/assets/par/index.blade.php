@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
        <li class="breadcrumb-item active" aria-current="page">PAR Module </li>
    </ol>
@endsection

@section('content')

<form action="{{route('assets.store')}}" method="post">
    {{csrf_field()}}
    {{--  <input type="hidden" name="purchase_order_id" value={{$assetData[0]->purchase_order_id}}>  --}}
    {{--  <input type="hidden" name="PO_id" value={{$id->searchPO}}></input>  --}}
    <div class="container-fluid">
        <div class="card">
            <div class="card-header pt-2 pb-2">List of Item</div>
            <div class="card-body">
                <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                    <thead class="thead-dark">
                        <tr>
                            <th>Item</th>
                            <th>Item Qty</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

                <input type="submit" class="btn btn-primary">

            </div>
        </div>
    </div>

</form>

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

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
