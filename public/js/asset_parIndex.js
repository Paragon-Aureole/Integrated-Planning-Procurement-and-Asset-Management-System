  $(document).ready(function () {
    getPARNo();
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

    // function createModalForms(itemQty) {
    //   // for (let index = 0; index < itemQty; index++) {
    //   //   $('#bull').append("<div id='sheet" + index + "'></div>");
    //   //   createModalFields(index);

    //   // }

    //   $('#bull').append("<div id='sheet" + index + "'></div>");
    //   createModalFields(index);
    // }

    // function createModalFields(param) {
    //   console.log(param);

    //   $('#sheet' + param).append('Name:<input type="text" name="selectedItemName"> <br>');
    //   $('#sheet' + param).append('Quantity:<select name="selectedItemQty"> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select> <br>');
    //   $('#sheet' + param).append('UnitCost:<input type="text" name="selectedItemUnitCost"> <br>');
    //   $('#sheet' + param).append('PAR No:<input type="text" name="selectedItemPARNo"> <br>');
    //   $('#sheet' + param).append('DateAssigned:<input type="date" name="selectedItemDateAssigned"> <br>');
    //   $('#sheet' + param).append('TotalAmount<input type="text" name="selectedItemTotalAmount"> <br>');
    //   $('#sheet' + param).append('EmployeeName<input type="text" name="selectedItemEmployeeName"> <br>');
    //   $('#sheet' + param).append('EmployeePosition<input type="text" name="selectedItemEmployeePosition"> <br>');
    //   $('#sheet' + param).append('Specifications:<textarea name="selectedItemSpecifications" cols="30" rows="10"></textarea> <br>');

    // }

    //select item quantity calculates the total amount
    $('[name=selectedItemQty]').on('change', function () {
      setTotalAmount();
    });

    function setTotalAmount() {
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
      // var itemDateAssigned = $('[name=selectedItemDateAssigned]').val();
      // 

      itemData[0] = itemPARNo;
      itemData[1] = itemName;
      itemData[2] = itemQty;
      itemData[3] = itemUnitCost;
      itemData[4] = itemDescription;
      itemData[5] = itemEmployeeName;
      itemData[6] = itemEmployeePosition;
      // itemData[7] = itemDateAssigned;

      // console.log(itemData);
      // console.log($(this).serialize());

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
      $('[name=remainingItems]').val(selectedRow[1]);
      getPARNo().then(function () {

        //setting Date to Now
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);
        $('[name=selectedItemDateAssigned]').val(today);

        fillQuantityDropdown($('[name=remainingItems]').val());

        var unitCost = parseFloat(selectedRow[2]) / parseFloat(selectedRow[1]);
        var currentPARNo = $('#currentPARNo').val();
        $('[name=selectedItemName]').val(selectedRow[0]);
        // console.log(parseFloat(selectedRow[1]));
        // console.log(parseFloat(selectedRow[2]));
        // $('#selectedItemName').val(selectedRow[0]);
        // $('#selectedItemQty').val(selectedRow[1]);

        $('[name=selectedItemUnitCost]').val(unitCost);
        // $('#selectedItemEmployeeName').val();
        // $('#selectedItemEmployeePosition').val();
        $('[name=selectedItemPARNo]').val(currentPARNo);
        // $('#selectedItemDateAssigned').val();
        $('[name=selectedItemTotalAmount]').val(selectedRow[2]);
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
          url: 'http://ipams.test/DistributeAssets',
          success: function (data) {
            console.log(data);

            getPARNo().then(function () {
              var currentPARNo = $('#currentPARNo').val();
              $('[name=selectedItemPARNo]').val(currentPARNo);

              fillQuantityDropdown($('[name=remainingItems]').val());
              setTotalAmount();
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

  });