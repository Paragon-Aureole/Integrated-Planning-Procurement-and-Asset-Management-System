  $(document).ready(function () {
    var table = $('#prDatatable').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    });

    //datatable shitshits
    $('#prDatatable').on('click', 'button#btn_assignItem', function () {
      // var tr = $(this).closest('tr');
      // var selectedRow = table.row(tr).data();
      var selectedRow = table.row($(this).parents('tr')).data();
      clearModalFields().done(function () {
        console.log(selectedRow);
        getAssetData(selectedRow[0]).then(function (itemData) {
          fillModalFields(itemData.assetData[0]);
        });
      });

      //$('[name=pr_id]').val(table.row(this).index()+1);
    });

    //select item quantity calculates the total amount
    $('[name=selectedItemQty]').on('change', function () {
      console.log('is changing PAR');
      var qtyData = $('[name=selectedItemQty]').val()
      // console.log(qtyData);
      $('#descriptionPar').empty();
      $('#qtyValPar').val('');
      $('#qtyValPar').val(qtyData);
      for (var i = 1; i <= qtyData; i++) {
        $('#descriptionPar').append('<label>Description:' + i + '</label><br><textarea name="selectedItemDescription[]" cols="30" rows="10"class="form-control form-control-sm"></textarea><br>')
      }
      setTotalAmount();
    });

    function setTotalAmount() {
      // console.log($('[name=selectedItemQty]').val());

      var itemQty = parseInt($('[name=selectedItemQty]').val());
      var unitCost = parseFloat($('[name=selectedItemUnitCost]').val());
      var finalResult = calculateTotalAmount(itemQty, unitCost);
      $('[name=selectedItemTotalAmount]').val(finalResult);
    }

    //save function
    $('[name=submitNewPar]').on('click', function () {

      var itemData = [];

      var itemQty = $('[name=selectedItemQty]').val();
      var itemDescription = $('textarea[name="selectedItemDescription[]"]').map(function () {
        return $(this).val();
      }).get();
      var itemEmployeeName = $('[name=selectedItemEmployeeName]').val();
      var itemEmployeePosition = $('[name=selectedItemEmployeePosition]').val();
      var itemID = $('[name=currentItemID]').val();
      var currentPARNo = $('#currentPARNo').val();

      itemData[0] = itemID;
      itemData[1] = itemQty;
      itemData[2] = itemDescription;
      itemData[3] = itemEmployeeName;
      itemData[4] = itemEmployeePosition;
      itemData[5] = currentPARNo;

      console.log(itemData);
      if (itemData[0] == "" || itemData[1] == "" || itemData[2] == "" || itemData[3] == "" || itemData[4] == "" || itemData[5] == "") {
        console.log('fields missing');
        alert('Some fields are incomplete, please recheck.');
      } else {
        console.log('fields complete');
        savePARAssign(itemData);;
      }

      

    });

    function clearModalFields() {
      var deferredObject = $.Deferred();
      $('[name=selectedItemName]').empty();
      $('[name=selectedItemQty]').empty();
      $('[name=selectedItemUnitCost]').empty();
      $('[name=selectedItemEmployeeName]').empty();
      $('[name=selectedItemEmployeePosition]').empty();
      $('[name=selectedItemPARNo]').empty();
      $('[name=selectedItemDateAssigned]').empty();
      $('[name=selectedItemTotalAmount]').empty();
      $('[name=selectedItemSpecifications]').empty();
      deferredObject.resolve();
      return deferredObject.promise();
    }

    function fillModalFields(itemData) {
      getPARNo().then(function (parNo) {

        $('[name=currentItemID]').val(itemData['id']);
        $('[name=selectedItemPARNo]').val(parNo + 1);
        // console.log(parNo);

        //setting Date to Now
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);
        $('[name=selectedItemDateAssigned]').val(today);

        getClassifiedItemQtyNo(itemData['id']).then(function (qtyData) {
          $('#qtyValPar').val('');
          $('#qtyValPar').val(qtyData);

          $('#descriptionPar').empty();
          for (var i = 1; i <= qtyData; i++) {

            $('#descriptionPar').append('<label>Description:' + i + '</label><br><textarea name="selectedItemDescription[]" cols="30" rows="10"class="form-control form-control-sm"></textarea>')

          }

          fillQuantityDropdown(qtyData);
          setTotalAmount();
        })

        var unitCost = parseFloat(itemData['amount']) / parseFloat(itemData['item_quantity']);
        // $('[name=selectedItemPARNo]').val(parseInt(parNo) + 1);
        $('[name=selectedItemName]').val(itemData['details']);
        $('[name=selectedItemUnitCost]').val(unitCost);

      });
    }

    function fillQuantityDropdown(remainingItems) {
      console.log(remainingItems);

      var dropdown = $('[name=selectedItemQty]');
      dropdown.empty();
      for (let index = remainingItems; index >= 1; index--) {
        dropdown.append('<option value=' + index + '> ' + index + '</option>');
      }
    }

    function calculateTotalAmount(itemQty, unitCost) {
      var result = itemQty * unitCost;
      // console.log(itemQty);
      // console.log(unitCost);
      return result;
    }

    function savePARAssign(formData) {

      var formUrl = '/saveNewPar';

      return new Promise(function (resolve) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          data: {
            data: formData
          },
          type: 'POST',
          url: formUrl,
          success: function (data) {
            console.log(data);

            getPARNo().then(function (parNo) {
              $('[name=selectedItemPARNo]').val(parNo + 1);

              getClassifiedItemQtyNo(formData[0]).then(function (qtyData) {
                if (qtyData == 0) {
                  alert('Asset Fully Assigned.');
                  setIsAssigned(formData[0]);

                } else {
                  $('[name=selectedItemEmployeeName]').val('');
                  $('[name=selectedItemEmployeePosition]').val('');
                  $('#descriptionPar').empty();
                  for (var i = 1; i <= qtyData; i++) {

                    $('#descriptionPar').append('<label>Description:' + i + '</label><br><textarea name="selectedItemDescription[]" cols="30" rows="10"class="form-control form-control-sm"></textarea>')
        
                  }
                  fillQuantityDropdown(qtyData);
                  setTotalAmount();
                  alert('PAR Asset Assigned.');
                }
              });
            });

            // resolve($('#currentPARNo').val(parseInt(data) + 1));
          },
          error: function (data) {
            console.log(data);

            // console.log(response);
          }
        });
      });

    }

    function setIsAssigned(id) {
      return new Promise(function (resolve) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          data: {
            asset_id: id
          },
          type: 'POST',
          url: '/setAssetIsAssigned',
          success: function (data) {
            console.log(data);
            window.location.reload();

            // resolve($('#currentICSNo').val(parseInt(data) + 1));
          },
          error: function (data) {
            console.log(data);

            // console.log(response);
          }
        });
      });
    }

    function getAssetData(asset_id) {
      var values = {
        asset_id: asset_id
      }
      return new Promise(function (resolve) {
        $.ajax({
          data: values,
          type: 'GET',
          url: '/getAssetData',
          success: function (data) {
            console.log(data);
            resolve(data);
          }
        });
      });
    };

    function getClassifiedItemQtyNo(id) {
      return new Promise(function (resolve) {
        $.ajax({

          type: 'GET',
          url: '/getClassifiedItemQtyNo/' + id,
          success: function (data) {
            console.log(data);
            resolve(data);
          }
        });
      });
    };

    function getPARNo() {
      return new Promise(function (resolve) {
        $.ajax({

          type: 'GET',
          url: '/getPARNo',
          success: function (data) {
            console.log(data);
            resolve(parseInt(data));
          }
        });
      });
    };

    table.on('click', 'button#requestBtn', function () {
      var rowData = table.row($(this).parents('tr')).data();
      console.log(rowData);

      $('#itemId').val(rowData[0]);
      $('#itemName').val(rowData[1]);
      $('#classifiedIcs').val('ICS');

    });

  });