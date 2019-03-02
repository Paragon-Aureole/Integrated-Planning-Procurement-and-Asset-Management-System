<table id="ppmpDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
  <thead class="thead-dark">
    <tr>
      <th>Code</th>
      <th>General Description</th>
      <th>Qty</th>
      <th>Unit</th>
      <th>Est. Cost/Unit</th>
      <th>Est. Budget/Item</th>
      <th>Stock</th>
      <th>Procurement Mode</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody> 
  @foreach($ppmp_itemDT as $codeKey => $items)
    <tr>
      <td>{{$items->ppmp_item_code_id}}</td>
      <td>{{$items->item_description}}</td>
      <td>{{$items->item_quantity}}</td>
      <td>{{$items->measurementUnit->unit_code}}</td>
      <td>{{number_format($items->item_cost, 2)}}</td>
      <td>{{number_format($items->item_budget, 2)}}</td>
      <td>{{$items->item_stock}}</td>
      <td>{{$items->procurementMode->method_name}}</td>
      <td><button class="btn btn-sm btn-warning">Action</button></td>
    </tr>
  @endforeach   
  </tbody>
  <tfoot class="thead-dark">
    <tr>
      <th colspan="5">Total Estimated Budget</th>
      <th>&#8369; {{number_format($ppmp_itemDT->sum('item_budget'), 2)}}</th>
      <td colspan="3"></td>
    </tr>
  </tfoot>
</table>