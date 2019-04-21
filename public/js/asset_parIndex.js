  $(document).ready(function () {
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
        fillModalFields(selectedRow);
      });

      //$('[name=pr_id]').val(table.row(this).index()+1);
    });

    //select item quantity calculates the total amount
    $('#selectedItemQty').on('change', function () {
      var itemQty = parseInt($('#selectedItemQty').val());
      var unitCost = parseFloat($('#selectedItemUnitCost').val());
      var finalResult = calculateTotalAmount(itemQty, unitCost);
      $('#selectedItemTotalAmount').val(finalResult);

      $('#inputSignatoryModal').clone(1).appendTo('#inputSignatoryModal');
      

    });

    function clearModalFields() {
      var deferredObject = $.Deferred();
      $('#selectedItemName').empty();
      $('#selectedItemQty').empty();
      $('#selectedItemUnitCost').empty();
      $('#selectedItemEmployeeName').empty();
      $('#selectedItemEmployeePosition').empty();
      $('#selectedItemPARNo').empty();
      $('#selectedItemDateAssigned').empty();
      $('#selectedItemTotalAmount').empty();
      $('#selectedItemSpecifications').empty();
      deferredObject.resolve();
      return deferredObject.promise();
    }

    function fillModalFields(selectedRow) {
      var unitCost = parseFloat(selectedRow[2]) / parseFloat(selectedRow[1]);
      var currentPARNo = parseInt($('#currentPARNo').val()) + 1;
      $('#selectedItemName').val(selectedRow[0]);
      // console.log(parseFloat(selectedRow[1]));
      // console.log(parseFloat(selectedRow[2]));
      $('#selectedItemName').val(selectedRow[0]);
      // $('#selectedItemQty').val(selectedRow[1]);

      var dropdown = $('#selectedItemQty');
      for (let index = selectedRow[1]; index >= 1; index--) {
        dropdown.append('<option value=' + index + '> ' + index + '</option>');
      }

      $('#selectedItemUnitCost').val(unitCost);
      // $('#selectedItemEmployeeName').val();
      // $('#selectedItemEmployeePosition').val();
      $('#selectedItemPARNo').val(currentPARNo);
      // $('#selectedItemDateAssigned').val();
      // $('#selectedItemTotalAmount').val();
      // $('#selectedItemSpecifications').val();
    }


    function calculateTotalAmount(itemQty, unitCost) {
      var result = itemQty * unitCost;
      return result;
    }
  });