<table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
  <thead class="thead-dark">
    <tr>
      <th data-priority="1">PR Code</th>
      <th data-priority="3">Purpose</th>
      <th data-priority="1">Status</th>
      <th data-priority="2">Date</th>
      <th data-priority="1" style="width: 100px;">Action</th>
    </tr>
  </thead>
  {{-- <tbody>
  @foreach($prDT as $key => $pr)      
    <tr>
      <td>{{$pr->pr_code}}</td>
      <td>{{$pr->pr_purpose}}</td>
      <td>
        @if($pr->pr_status == 1)
          Approved
        @else
          Pending
        @endif
      </td>
      <td>{{Carbon\Carbon::parse($pr->created_at)->format('m-d-y')}}</td>
      <td>
<<<<<<< HEAD
        <a href="{{route('view.pritm', $pr->id)}}" class="btn btn-sm btn-info" title="Add PR Items"><i class="fas fa-th-list"></i></a>
        <a href="{{route('pr.edit', $pr->id)}}" class="btn btn-sm btn-warning">
=======
        //<a href="{{route('view.pritm', $pr->id)}}" class="btn btn-sm btn-info" title="Add PR Items"><i class="fas fa-th-list"></i></a>
        <a href="" class="btn btn-sm btn-info" title="Add PR Items" data-toggle="modal"
        data-target="#prItemModal"><i class="fas fa-th-list"></i></a>
        <a href="{{route('edit.pr', $pr->id)}}" class="btn btn-sm btn-warning">
>>>>>>> 9a6d3bb836127d4bb2f6f69a3e3a2f1386a7c892
          <i class="fas fa-edit"></i>
        </a>
        <a href="{{route('pr.destroy', $pr->id)}}" class="btn btn-sm btn-danger">
          <i class="fas fa-minus"></i>
        </a>
      </td>
    </tr>
  @endforeach
  </tbody> --}}
</table>

{{-- MODALLLL --}}
<div class="modal" id="prItemModal">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
               <!-- Modal Header -->
          <div class="modal-header">
              {{-- <h1 class="modal-title">Item Codes</h1> --}}
              <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="small">Purchase Request Code:</label>
                            {{-- <input class="form-control form-control-sm" type="text" value="{{$pr->pr_code}}" disabled=""> --}}
                            <input id="prCode" class="form-control form-control-sm" type="text"  disabled="">
                          </div>  			
                          <div class="col-md-12">
                            <label class="small">Purpose:</label>
                            {{-- <textarea class="form-control form-control-sm" rows="2" type="text" style="resize: none;" disabled>{{$pr->pr_purpose}}</textarea> --}}
                            <textarea id="txtAreaPurpose" class="form-control form-control-sm" rows="2" type="text" style="resize: none;" disabled></textarea>
                          </div>
                          <div class="col-md-6">
                              <label class="small">Supplier Type:</label>
                              <input id="prSupplierType" class="form-control form-control-sm" type="text"
                
                              {{-- @if($pr->supplier_type == 1)
                               value="Canvass"
                              @elseif($pr->supplier_type == 2)
                               value="Government Agency"
                              @elseif($pr->supplier_type == 3)
                               value="Sole Distributor"
                              @endif  --}}
                              disabled="">
                          </div>
                          <div class="col-md-6">
                              <label class="small">Budget Alllocation:</label>
                              {{-- <input class="form-control form-control-sm" type="text" value="&#8369; {{number_format($pr->pr_budget,2)}}" disabled=""> --}}
                              <input id="budgetAllocation" class="form-control form-control-sm" type="text" value="" disabled="">
                            </div>
                    </div>
                </div>
                <div class="col-md-7">
                  <div class="row">
                      <div class="form-group col-md-6">
                          <label class="small">Item:</label>
                          <select class="custom-select custom-select-sm {{ $errors->has('item_description') ? 'is-invalid' : '' }}" id="itemDesc" name="item_description" required="required">
                            <option value="">Select Item</option>
                          </select>
                          {{-- <div class="invalid-feedback">  
                              @if ($errors->has('item_description'))
                                {{$errors->first('item_description')}}
                              @else
                                Item Descripiton is required.
                              @endif  
                          </div> --}}
                        </div>
                        <div class="form-group col-md-3">
                            <label class="small">Quantity:</label>
                            <select id="itemQty" class="custom-select custom-select-sm" name="item_quantity" required="required">
                          
                            </select>
                            {{-- <div class="invalid-feedback">  
                                @if ($errors->has('item_quantity'))
                                  {{$errors->first('item_quantity')}}
                                @else
                                  Quantity is required.
                                @endif  
                            </div> --}}
                          </div>
                          <div class="form-group col-md-3">
                              <label class="small">Unit:</label>
                              <input class="form-control form-control-sm {{ $errors->has('item_unit') ? 'is-invalid' : '' }}" required="required" id="itemUnit" disabled>
                              {{-- <input type="hidden" name="item_unit" value="{{old('item_unit')}}"> --}}
                              <input id="itemUnit" type="hidden" name="item_unit" value="{{old('item_unit')}}">
                              <div class="invalid-feedback">  
                                  @if ($errors->has('item_unit'))
                                    {{$errors->first('item_unit')}}
                                  @else
                                    Unit is required.
                                  @endif  
                              </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="small">Cost per Unit:</label>
                                <input oninput="multiply();" id="CostPerUnit" type="text" class="form-control form-control-sm" name="item_cpu" required="">
                                {{-- <div class="invalid-feedback">  
                                    @if ($errors->has('item_cpu'))
                                      {{$errors->first('item_cpu')}}
                                    @else
                                      Cost per unit is required.
                                    @endif  
                                </div> --}}
                              </div>
                            <div class="form-group col-md-6">
                                <label class="small">Cost per Item:</label>
                                <input id="itemCost" type="text" class="form-control form-control-sm" name="item_cpi" required="required" readonly="required">
                                {{-- <div class="invalid-feedback">  
                                    @if ($errors->has('item_cpi'))
                                      {{$errors->first('item_cpi')}}
                                    @else
                                      Cost per item is required.
                                    @endif  
                                </div> --}}
                            </div>
                            <div class="form-group text-right col-md-12">
                                <button class="btn btn-sm btn-primary" id="addPrItem"><i class="fas fa-plus"></i> Add Item</button>
                                {{-- <a href="{{route('print.pr', $pr->id)}}" target="_blank" class="btn btn-sm btn-secondary"><i class="fas fa-print"></i> Print</a> --}}
                                <a href="" target="_blank" class="btn btn-sm btn-secondary"><i class="fas fa-print"></i> Print</a>
                            </div>

                        <input type="text" id="prId" hidden>
                  </div>
                </div>
                <div class="col-md-12">
                  &nbsp;
                </div>
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                      <thead class="thead-dark">
                        <tr>
                          <th data-priority="1">PR Code</th>
                          <th data-priority="3">Purpose</th>
                          <th data-priority="1">Status</th>
                          <th data-priority="2">Date</th>
                          <th data-priority="1" style="width: 100px;">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>  
                </div>
            </div>
          </div>
        </div>
          
        </div>
    </div>
</div>
