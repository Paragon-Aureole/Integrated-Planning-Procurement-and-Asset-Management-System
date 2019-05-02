  $(document).ready(function () {
    // getPARNo();
    // getPARData();
    var partable = $('#parDatatable').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    });

    var icstable = $('#icsDatatable').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    });

    //datatable shitshits
    $('#parDatatable tbody').on('click', 'tr button', function () {
      var tr = $(this).closest('tr');
      var selectedRow = partable.row(tr).data();
      clearModalFields().done(function () {
        console.log(selectedRow);
        console.log("PAR");
        getParData(selectedRow[0]).then(function () {
          fillModalFields(parData, "PAR");
        });

      });

    });

    $('#icsDatatable tbody').on('click', 'tr button', function () {
      var tr = $(this).closest('tr');
      var selectedRow = icstable.row(tr).data();
      clearModalFields().done(function () {
        console.log(selectedRow);
        console.log("ICS");
        getIcsData(selectedRow[0]).then(function () {
          fillModalFields(icsData, "ICS");
        });

      });

    });

    function getParData(id) {
      return new Promise(function (resolve) {
        $.ajax({
          data: {
            par_id: id
          },
          type: 'GET',
          url: '/getParData',
          success: function (data) {
            // console.log(data);
            resolve(parData = data);
          }
        });
      });
    };

    function getIcsData(id) {
      return new Promise(function (resolve) {
        $.ajax({
          data: {
            ics_id: id
          },
          type: 'GET',
          url: '/getIcsData',
          success: function (data) {
            // console.log(data);
            resolve(icsData = data);
          }
        });
      });
    };


    //save function
    $('#TurnoverModalForm').on('submit', function (e) {
      // console.log('clicking');
      e.preventDefault();

      var itemData = [];

      var itemID = $('[name=selectedItemICS-PARNo').val();
      var itemParOrIcs = $('[name=ParOrIcs').val();
      var itemEmployeeName = $('[name=selectedItemEmployeeName]').val();
      var itemEmployeePosition = $('[name=selectedItemEmployeePosition]').val();
      var itemRemarks = $('[name=selectedItemRemarks]').val();

      itemData[0] = itemID;
      itemData[1] = itemParOrIcs;
      itemData[2] = itemEmployeeName;
      itemData[3] = itemEmployeePosition;
      itemData[4] = itemRemarks;

      // console.log(itemData);

      saveTurnover(itemData);

    });

    function clearModalFields() {
      var deferredObject = $.Deferred();
      $('[name=selectedItemName]').empty();
      $('[name=selectedItemQty]').empty();
      $('[name=selectedItemUnitCost]').empty();
      $('[name=selectedItemEmployeeName]').empty();
      $('[name=selectedItemEmployeePosition]').empty();
      $('[name=selectedItemICS-PARNo]').empty();
      $('[name=selectedItemDateAssigned]').empty();
      $('[name=selectedItemTotalAmount]').empty();
      $('[name=selectedItemRemarks]').empty();
      deferredObject.resolve();
      return deferredObject.promise();
    }

    function fillModalFields(data, formType) {
      if (formType == "PAR") {
        $('[name=ParOrIcs]').val("PAR");
        fieldFiller(data);

      } else if (formType == "ICS") {
        $('[name=ParOrIcs]').val("ICS");
        fieldFiller(data);

      }

    }

    function fieldFiller(data) {
      $('[name=selectedItemName]').val(data['name']);
      $('[name=selectedItemQty]').val(data['quantity']);
      $('[name=selectedItemUnitCost]').val(data['unitCost']);
      $('[name=selectedItemEmployeeName]').val(data['assignedTo']);
      $('[name=selectedItemEmployeePosition]').val(data['position']);
      $('[name=selectedItemICS-PARNo]').val(data['id']);
      $('[name=selectedItemDateAssigned]').val(data['dateAssigned']);
      $('[name=selectedItemTotalAmount]').val(data['totalAmount']);
    }

    function saveTurnover(formData) {

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
          url: 'http://ipams.test/AssetTurnover',
          success: function (data) {
            console.log(data);
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