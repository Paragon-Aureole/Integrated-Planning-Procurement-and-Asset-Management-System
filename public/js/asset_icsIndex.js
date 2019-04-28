  $(document).ready(function () {
    getICSNo();
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

    function getICSNo() {
      return new Promise(function (resolve) {
        $.ajax({

          type: 'GET',
          url: '/getICSNo',
          success: function (data) {
            console.log(data);
            resolve($('#currentICSNo').val(parseInt(data) + 1));
          }
        });
      });
    };

    //save function
    $('#itemAssignForm').on('submit', function (e) {
      // console.log('clicking');
      e.preventDefault();
      
      var itemData = [];
      
      // console.log($('[name=selectedItemICSNo]').val());
      // console.log($('[name=selectedItemName]').val());
      // console.log($('[name=selectedItemQty]').val());
      // console.log($('[name=selectedItemEstimatedUsefulLife]').val());
      // console.log($('[name=selectedItemDescription]').val());
      // console.log($('[name=selectedItemEmployeeName]').val());
      // console.log($('[name=selectedItemEmployeePosition]').val());
      // console.log($('[name=currentItemID]').val());
      
      
      var itemQty = $('[name=selectedItemQty]').val();
      var itemEstimatedUsefulLife = $('[name=selectedItemEstimatedUsefulLife]').val();
      var itemDescription = $('[name=selectedItemDescription]').val();
      var itemEmployeeName = $('[name=selectedItemEmployeeName]').val();
      var itemEmployeePosition = $('[name=selectedItemEmployeePosition]').val();
      var itemID = $('[name=currentItemID').val();
      
      itemData[0] = itemID;
      itemData[1] = itemQty;
      itemData[2] = itemDescription;
      itemData[3] = itemEmployeeName;
      itemData[4] = itemEmployeePosition;
      itemData[5] = itemEstimatedUsefulLife;
      

      // console.log(itemData);

      saveICSAssign(itemData);

    });

    function clearModalFields() {
      var deferredObject = $.Deferred();
      $('[name=selectedItemICSNo]').empty();
      $('[name=selectedItemName]').empty();
      $('[name=selectedItemQty]').empty();
      // $('[name=selectedItemUnitCost]').empty();
      $('[name=selectedItemSpecifications]').empty();
      $('[name=selectedItemEmployeeName]').empty();
      $('[name=selectedItemEmployeePosition]').empty();
      $('[name=currentItemID]').empty();
      
      deferredObject.resolve();
      return deferredObject.promise();
    }

    function fillModalFields(selectedRow) {
      $('[name=remainingItems]').val(selectedRow[3]);
      getICSNo().then(function () {

        fillQuantityDropdown($('[name=remainingItems]').val());

        var currentICSNo = $('#currentICSNo').val();
        $('[name=selectedItemName]').val(selectedRow[1]);
        $('[name=selectedItemICSNo]').val(currentICSNo);
      });
    }

    function fillQuantityDropdown(remainingItems) {
      var dropdown = $('[name=selectedItemQty]');
      dropdown.empty();
      for (let index = remainingItems; index >= 1; index--) {
        dropdown.append('<option value=' + index + '> ' + index + '</option>');
      }
    }

    function saveICSAssign(formData) {

      var minuend = parseInt($('[name=remainingItems]').val());
      var subtrahend = parseInt(formData[1]);

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
          url: 'http://ipams.test/DistributeAssetsICS',
          success: function (data) {
            console.log(data);

            getICSNo().then(function () {
              var currentICSNo = $('#currentICSNo').val();
              $('[name=selectedItemICSNo]').val(currentICSNo);

              fillQuantityDropdown($('[name=remainingItems]').val());
              
              if ($('[name=remainingItems]').val() == 0) {
                // console.log($('[name=currentItemID]').val());
                setIsAssigned($('[name=currentItemID]').val());
              }
            });

            // resolve($('#currentICSNo').val(parseInt(data) + 1));
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

            // resolve($('#currentICSNo').val(parseInt(data) + 1));
          },
          error: function (data) {
            console.log(data);

            // console.log(response);
          }
        });
      });
    }

  });