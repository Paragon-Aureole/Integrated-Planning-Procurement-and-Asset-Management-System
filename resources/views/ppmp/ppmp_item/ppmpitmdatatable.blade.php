<table class="table table-bordered table-hover table-sm display nowrap w-100">
  <thead class="thead-dark text-center">
    <tr>
      <th rowspan="2">Code</th>
      <th class="w-25" rowspan="2">General Description</th>
      <th rowspan="2">Qty</th>
      <th rowspan="2">Unit</th>
      <th rowspan="2">Estimated Cost</th>
      <th rowspan="2">Estimated Budget</th>
      <th rowspan="2">Stock</th>
      <th class="w-10" rowspan="2">Procurement Mode</th>
      <th>
        @if($ppmp->ppmpItem()->count() > 0)
        <a href="{{route('print.ppmp', $ppmp->id)}}" target="_blank" class="btn btn-sm btn-secondary"><i class="fas fa-print"></i></a>
        @endif
      </th>
    </tr>
    <tr>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($ppmp_itemDT as $codeKey => $group)
    @php 
      $ppmp_itmcode = App\PpmpItemCode::findorFail($codeKey)
    @endphp
    <tr>
      <th class="table-secondary" colspan="9">{{$ppmp_itmcode->code_description}}</th>
    </tr> 
    @foreach($group as $codeKey => $items)
      <tr>
        <td></td>
        <td>{{$items->item_description}}</td>
        <td class="text-center">{{$items->item_quantity}}</td>
        <td>{{$items->measurementUnit->unit_code}}</td>
        <td class="text-right">{{number_format($items->item_cost, 2)}}</td>
        <td class="text-right">{{number_format($items->item_budget, 2)}}</td>
        <td class="text-center">{{$items->item_stock}}</td>
        <td>{{$items->procurementMode->method_name}}</td>
        <td>
          <a href="{{route('edit.ppmpitm', [$ppmp->id, $items->id])}}"  class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
          <a href="{{route('delete.ppmpitm', [$ppmp->id, $items->id])}}" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></a>
        </td>
      </tr>
    @endforeach
  @endforeach   
  </tbody>
  <tfoot class="thead-dark">
    <tr>
      <th colspan="5">Total Estimated Budget</th>
      <th class="text-right">&#8369; {{number_format($total->ppmp_est_budget, 2)}}</th>
      <td colspan="3"></td>
    </tr>
  </tfoot>
</table>