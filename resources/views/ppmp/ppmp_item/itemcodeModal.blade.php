 <!-- The Modal -->
 <div class="modal" id="itemCodeModal">
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
                    <div class="card">
                     <div class="card-header pt-2 pb-2">PPMP Item Codes</div>
                     <div class="card-body">
                       <div class="row">
                        <div class="col-md-4">
                                <h6 class="card-title">
                          Add PPMP Item Code
                          </h6>
                          <form action="{{route('add.ppmpitemcode', $ppmp->id)}}" method="POST" id="needs-validation2" novalidate>
                            {{csrf_field()}}
                            <div class="row">
                              <div class="form-group col-md-12">
                                <input type="text" id="codeId" hidden>
                                <label class="small">Code Description:</label>
                                <input id="descriptionValue" class="form-control form-control-sm {{ $errors->has('code_description') ? 'is-invalid' : '' }}" name="code_description" value="{{ old('code_description') }}" required>
                                <div class="invalid-feedback">
                                  @if ($errors->has('code_description'))
                                    {{$errors->first('code_description')}}
                                  @else
                                    Code description is required.
                                  @endif
                                </div>
                              </div>
                              <div class="form-group col-md-12">
                                <label for="codeType" class="small">Code Type:</label>
                                <select id="optionValue" class="custom-select custom-select-sm {{ $errors->has('code_type') ? 'is-invalid' : '' }}" name="code_type" required>
                                  {{-- <option value='1'>Department & Office Supplies</option>
                                  <option value='2'>Departmental Projects</option>
                                  <option value='3'>Projects Chargeable to Other Offices</option> --}}
                                </select>
                                <div class="invalid-feedback">
                                  @if ($errors->has('code_type'))
                                    {{$errors->first('code_type')}}
                                  @else
                                    Category is required.
                                  @endif
                                </div>
                              </div>
                              <div class="form-group col">
                                <button type="submit" class="btn btn-primary btn-sm" id="submitContent">Submit</button>
                                <button class="btn btn-warning btn-sm" id="updateContent" style="display:none">Update</button>
                                <button class="btn btn-primary btn-sm" id="cancelUpdate" style="display:none">Cancel</button>
                              </div>
                            </div>
                          </form>
                          <div class="form-group col">
                            {{-- <button class="btn btn-primary btn-sm" id="submitContent">Submit</button> --}}
      
                          </div>
      
                        </div>
      
                        <!-- table -->
                        <div class="col-md-8">
                          <h6 class="card-title">Registered PPMP Codes</h6>
                          <div class="table-responsive">
                            @include('ppmp.ppmp_item_codes.ppmpcodesdatatable')
                            {{-- asdasdasd --}}
                          </div>
                        </div>
                       </div>
                     </div>
                    </div>
      
                    </div>
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>