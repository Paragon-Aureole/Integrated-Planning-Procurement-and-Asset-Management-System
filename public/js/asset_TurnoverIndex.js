  $(document).ready(function () {

    var parDataTable = $('#parDatatable').DataTable({
      responsive: false,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],

    });

    $('#datatableTurnover').DataTable({
      responsive: false,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    });

    var modalTurnoverDataTable = $('#modalTurnoverDatatable').DataTable({
      responsive: false,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    });

    parDataTable.on('click', 'tr button#turnoverButton', function () {
      console.log('I know you want me~☻');
      // console.log();


      var rowData = parDataTable.row($(this).parents('tr')).data();

      fillModalForm(rowData);


    });

    function fillModalForm(rowData) {
      console.log(rowData);
      $('#signatoryName').val(rowData[1]);
      getParAssignedItems(rowData).then(function (assetParItems) {

        console.log(assetParItems);
        var tableRowDataContent = new Array;

        $('[name=turnoverParId]').val(assetParItems[1][0].asset_par_id);
        for (let index = 0; index < assetParItems[1].length; index++) {
          const description = assetParItems[1][index].description;
          if (assetParItems[1][index].itemStatus == 0) {
            var status = "Active";
          } else {
            var status = "Unserviceable";
          }
          // console.log(element);
          tableRowDataContent.push([assetParItems[0],
            description,
            status,
            '<input type="hidden" name="toTurnover[' + assetParItems[1][index].id + ']" value="0"><input type="checkbox" name="toTurnover[' + assetParItems[1][index].id + ']" value="1">']);
        }

        console.log(tableRowDataContent);

        modalTurnoverDataTable.clear();
        for (let index = 0; index < tableRowDataContent.length; index++) {
          modalTurnoverDataTable.row.add(tableRowDataContent[index]);          
        }
        modalTurnoverDataTable.draw();

      });
    }

    $('#filterOption').on('change', function () {
      var filterOption = $('#filterOption').val();

      if (filterOption == 1) {
        console.log('You Selected PAR Number');
        $('#showParInputs').show();
        $('#showOfficeInputs').hide();

        getFilterPar();

      } else if (filterOption == 2) {
        console.log('You Selected Office and Signatory Name');
        $('#showParInputs').hide();
        $('#showOfficeInputs').show();

        getFilterName();

      } else {
        console.log('You Selected None');
        $('#showParInputs').hide();
        $('#showOfficeInputs').hide();

      }

    });

    function getFilterName() {
      $('#searchName').on('click', function () {
        var values = {
          'office_id': $('#office_id').val(),
          'signatory_name': $('#signatory_name').val()
        }
        console.log(values);
        $.ajax({
          url: '/nameSearchTurnover',
          method: 'get',
          data: values,
          success: function (response) {
            var tableContent = response.assetPar;
            populateTurnoverTable(tableContent);

          }
        });

      });
    }

    function getParAssignedItems(rowData) {
      return new Promise(function (resolve) {

        var values = {
          'par_id': rowData[0]
        }
        console.log(values);
        $.ajax({
          url: '/getParAssignedItems',
          method: 'get',
          data: values,
          success: function (response) {
            var assetParItems = response.assetParItems;
            console.log(assetParItems);
            resolve(assetParItems)


          }
        });
      });

    }

    function getFilterPar() {
      $('#searchPar').on('click', function () {
        var values = {
          'par_id': $('#par_id').val()
        }

        console.log(values);

        $.ajax({
          url: '/parSearchTurnover',
          method: 'get',
          data: values,
          success: function (response) {
            var tableContent = response.assetPar;
            populateTurnoverTable(tableContent);

          }
        });

      });

    };

    function populateTurnoverTable(tableContent) {
      // $('parTbody').empty();
      console.log(tableContent);

      var tableRowDataContent = new Array;

      tableRowDataContent.push(tableContent[0][0].id,
        tableContent[0][0].assignedTo,
        tableContent[0][0].position,
        tableContent[1][0].office_name,
        '<button type="button" id="turnoverButton" name="btn_assignItem" class="btn btn-info btn-xs"data-toggle="modal" data-target="#turnoverModal">View Items</button>');

      console.log(tableRowDataContent);
      parDataTable.clear();
      parDataTable.row.add(tableRowDataContent).draw();

    };


  });