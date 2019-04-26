  $(document).ready(function () {
    getPARNo();
    // getPARData();
    var table = $('#prDatatable').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    });

    //datatable shitshits
    $('#prDatatable tbody').on('click', 'tr button', function () {
      var tr = $(this).closest('tr');
      var selectedRow = table.row(tr).data();
      clearModalFields().done(function () {
        console.log(selectedRow);
        $('[name=currentItemID]').val(selectedRow[0]);
        $('[name=totalItemQuantity]').val(selectedRow[2]);
        // console.log(selectedRow[4]);

        // createModalForms(selectedRow[1]);
        fillModalFields(selectedRow);

      });

      //$('[name=pr_id]').val(table.row(this).index()+1);
    });

    function getPARNo() {
      return new Promise(function (resolve) {
        $.ajax({

          type: 'GET',
          url: '/getPARNo',
          success: function (data) {
            console.log(data);
            resolve($('#currentPARNo').val(parseInt(data) + 1));
          }
        });
      });
    };

    // function getPARData() {
    //   return new Promise(function (resolve) {
    //     $.ajax({

    //       type: 'GET',
    //       url: '/getPARData',
    //       success: function (data) {
    //         console.log(data);
    //         // resolve($('#currentPARNo').val(parseInt(data) + 1));
    //       }
    //     });
    //   });
    // };

    //select item quantity calculates the total amount
    $('[name=selectedItemQty]').on('change', function () {
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
    $('#itemAssignForm').on('submit', function (e) {
      // console.log('clicking');
      e.preventDefault();

      var itemData = [];
      // console.log($('[name=selectedItemName]').val());
      // console.log($('[name=selectedItemQty]').val());
      // console.log($('[name=selectedItemUnitCost]').val());
      // console.log($('[name=selectedItemEmployeeName]').val());
      // console.log($('[name=selectedItemEmployeePosition]').val());
      // console.log($('[name=selectedItemPARNo]').val());
      // console.log($('[name=selectedItemDateAssigned]').val());
      // console.log($('[name=selectedItemTotalAmount]').val());
      // console.log($('[name=selectedItemSpecifications]').val());

      var itemPARNo = $('[name=selectedItemPARNo]').val();
      var itemName = $('[name=selectedItemName]').val();
      var itemQty = $('[name=selectedItemQty]').val();
      var itemUnitCost = $('[name=selectedItemUnitCost]').val();
      var itemDescription = $('[name=selectedItemSpecifications]').val();
      var itemEmployeeName = $('[name=selectedItemEmployeeName]').val();
      var itemEmployeePosition = $('[name=selectedItemEmployeePosition]').val();
      var itemID = $('[name=currentItemID').val();
      var itemCurrentPONo = $('#currentPONo').val();

      itemData[0] = itemPARNo;
      itemData[1] = itemName;
      itemData[2] = itemQty;
      itemData[3] = itemUnitCost;
      itemData[4] = itemDescription;
      itemData[5] = itemEmployeeName;
      itemData[6] = itemEmployeePosition;
      itemData[7] = itemID;
      itemData[8] = itemCurrentPONo;

      // console.log(itemData);

      savePARAssign(itemData);

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

    function fillModalFields(selectedRow) {
      $('[name=remainingItems]').val(selectedRow[3]);
      getPARNo().then(function () {

        //setting Date to Now
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);
        $('[name=selectedItemDateAssigned]').val(today);

        fillQuantityDropdown($('[name=remainingItems]').val());

        var unitCost = parseFloat(selectedRow[4]) / parseFloat(selectedRow[2]);
        var currentPARNo = $('#currentPARNo').val();
        $('[name=selectedItemName]').val(selectedRow[1]);
        // console.log(parseFloat(selectedRow[1]));
        // console.log(parseFloat(selectedRow[2]));
        // $('#selectedItemName').val(selectedRow[0]);
        // $('#selectedItemQty').val(selectedRow[1]);

        $('[name=selectedItemUnitCost]').val(unitCost);
        // $('#selectedItemEmployeeName').val();
        // $('#selectedItemEmployeePosition').val();
        $('[name=selectedItemPARNo]').val(currentPARNo);
        // $('#selectedItemDateAssigned').val();
        $('[name=selectedItemTotalAmount]').val(setTotalAmount());
        // $('#selectedItemSpecifications').val();
      });
    }

    function fillQuantityDropdown(remainingItems) {
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

      var minuend = parseInt($('[name=remainingItems]').val());
      var subtrahend = parseInt(formData[2]);

      $('[name=remainingItems]').val(minuend - subtrahend);

      // console.log(minuend - subtrahend);

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
          url: 'http://ipams.test/DistributeAssetsPAR',
          success: function (data) {
            console.log(data);

            getPARNo().then(function () {
              var currentPARNo = $('#currentPARNo').val();
              $('[name=selectedItemPARNo]').val(currentPARNo);

              fillQuantityDropdown($('[name=remainingItems]').val());
              setTotalAmount();
              if ($('[name=remainingItems]').val() == 0) {
                // console.log($('[name=currentItemID]').val());
                setIsAssigned($('[name=currentItemID]').val());
              }
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

    function setIsAssigned(id)
    {
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
          url: 'http://ipams.test/setIsAssignedPAR',
          success: function (data) {
            console.log(data);
            window.location.reload();

            // resolve($('#currentPARNo').val(parseInt(data) + 1));
          },
          error: function (data) {
            console.log(data);

            // console.log(response);
          }
        });
      });
    }

  });