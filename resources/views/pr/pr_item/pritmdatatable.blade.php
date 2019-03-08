<table  id= "datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
          <thead class="thead-dark">
            <tr>
              <th data-priority="1">Item No.</th>
              <th data-priority="2">Description</th>
              <th data-priority="3">Qty</th>
              <th data-priority="3">Unit</th>
              <th data-priority="3">Cost/Unit</th>
              <th data-priority="3">Cost/Item</th>
              <th data-priority="1" style="width: 100px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pr->prItem()->get() as $items)
              <td>{{$items->id}}</td>
              <td>{{$items->ppmpItem->item_description}}</td>
              <td>{{$items->item_quantity}}</td>
              <td>{{$items->ppmpItem->measurementUnit->unit_code}}</td>
              <td>{{number_format($items->item_cost,2)}}</td>
              <td>{{number_format($items->item_budget,2)}}</td>
              <td>
                  <a href="{{route('edit.pritm',[$pr->id, $items->id])}}"  class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                  <a href="{{route('delete.pritm',[$pr->id, $items->id])}}" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></a>
                </td>
            @endforeach
          </tbody>
        </table>