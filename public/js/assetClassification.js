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
      console.log(selectedRow);

    });

    var assetDataCount = $('[name=assetDataCount]').val();

    for (let index = 0; index < assetDataCount; index++) {
      // console.log(index);
      $('.assetCheckboxSelection['+ index +']').on('click', function () {
        $('.assetCheckboxSelection[' + index + ']').not(this).prop('checked', false);
      });  
    }

    //save function
    $('#assetClassificationForm').on('submit', function (e) {
      // console.log('clicking');
      e.preventDefault();

      var voucherNo = $('[name=voucherNo]').val();
      if (voucherNo == "") {
        console.log('voucherNo Empty, Please fill.');
        
      } else {
        console.log('voucherNo filled.');
        // return true;
      }
    });

  });