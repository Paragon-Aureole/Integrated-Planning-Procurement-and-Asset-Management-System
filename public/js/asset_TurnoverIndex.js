  $(document).ready(function () {
    //declare datatables here
    var parDataTable = $('#parDatatable').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],

    });

    var turnoverDataTable = $('#datatableTurnover').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    });

    var modalApprovalTurnoverDatatable = $('#modalApprovalTurnoverDatatable').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    });

    var modalTurnoverDataTable = $('#modalTurnoverDatatable').DataTable({
      responsive: true,
      "lengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"]
      ],
    });

    //on datatable button click functions here
    parDataTable.on('click', 'tr button#turnoverButton', function () {
      console.log('I know you want me~☻');
      // console.log();


      var rowData = parDataTable.row($(this).parents('tr')).data();
      // var rowData = $('#parDatatable').DataTable().row($(this)).data();
      // console.log(rowData);


      fillForTurnoverModalForm(rowData);


    });

    turnoverDataTable.on('click', 'tr button#turnoverButton', function () {
      console.log('You know I want you~☻');
      // console.log();


      var rowData = turnoverDataTable.row($(this).parents('tr')).data();
      // var rowData = turnoverDataTable.row($(this)).data();
      console.log(rowData);

      // approveParTurnover(rowData[0]);
      fillAssignedTurnoverModalForm(rowData);


    });

    //button click functions here

    $('#ApproveTurnover').on('click', function () {
      console.log('baby hit me one more time~');
      console.log($('#turnover_id').val());
      
      approveParTurnover($('#turnover_id').val());
      
    });

    //datatable filling functions here
    function fillForTurnoverModalForm(rowData) {
      console.log(rowData);
      $('#signatoryName').val(rowData[1]);
      getParAssignedItems(rowData).then(function (assetParItems) {
        getCurrentTurnoverId();
        console.log(assetParItems);
        var tableRowDataContent = new Array;

        $('[name=turnoverParId]').val(assetParItems[1][0].asset_par_id);
        for (let index = 0; index < assetParItems[1].length; index++) {
          const description = assetParItems[1][index].description;
          if (assetParItems[1][index].itemStatus == 0) {
            var status = "Active";
            var checkbox = '<input type="hidden" name="toTurnover[' + assetParItems[1][index].id + ']" value="0"><input type="checkbox" name="toTurnover[' + assetParItems[1][index].id + ']" value="1">';
          } else if (assetParItems[1][index].itemStatus == 1) {
            var status = "Pending Turnover";
            var checkbox = '<input type="checkbox" name="toTurnover[' + assetParItems[1][index].id + ']" value="1" disabled checked>'
          } else {
            var status = "Unserviceable";
            var checkbox = '<input type="checkbox" name="toTurnover[' + assetParItems[1][index].id + ']" value="1" disabled checked>'
          }
          // console.log(element);
          tableRowDataContent.push([assetParItems[0],
            description,
            status,
            checkbox
          ]);

          console.log(tableRowDataContent);

          modalTurnoverDataTable.clear();
          for (let index = 0; index < tableRowDataContent.length; index++) {
            modalTurnoverDataTable.row.add(tableRowDataContent[index]);
          }
          modalTurnoverDataTable.draw();
        }

      });
    }

    function fillAssignedTurnoverModalForm(rowData) {
      console.log(rowData);
      if (rowData[4] == "Pending") {
        $('#PrintTurnover').hide();
        $('#ApproveTurnover').show();
      } else {
        $('#PrintTurnover').show();
        $('#ApproveTurnover').hide();

      }

      getParTurnoverItems(rowData).then(function (assetParTurnoverItems) {
        console.log(assetParTurnoverItems);
        var tableRowDataContent = new Array;

        $('#turnover_id').val(rowData[0]);
        for (let index = 0; index < assetParTurnoverItems.length; index++) {
          const description = assetParTurnoverItems[index].asset_par_item.description;
          if (assetParTurnoverItems[index].asset_par_item.itemStatus == 0) {
            var status = "Active";
            // var checkbox = '<input type="hidden" name="toTurnover[' + assetParTurnoverItems[index].id + ']" value="0"><input type="checkbox" name="toTurnover[' + assetParTurnoverItems[index].id + ']" value="1">';
          } else if (assetParTurnoverItems[index].asset_par_item.itemStatus == 1) {
            var status = "Pending Turnover";
            // var checkbox = '<input type="checkbox" name="toTurnover[' + assetParTurnoverItems[index].id + ']" value="1" readonly>';
          } else {
            var status = "Unserviceable";
            // var checkbox = '<input type="checkbox" name="toTurnover[' + assetParTurnoverItems[index].id + ']" value="1" readonly>';
          }
          // console.log(element);
          tableRowDataContent.push([description,
            description,
            status
            // checkbox
          ]);

          console.log(tableRowDataContent);

          modalApprovalTurnoverDatatable.clear();
          for (let index = 0; index < tableRowDataContent.length; index++) {
            modalApprovalTurnoverDatatable.row.add(tableRowDataContent[index]);
          }
          modalApprovalTurnoverDatatable.draw();
        }

      });

    }

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


    //filter options by Pacleb here
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

    function getCurrentTurnoverId() {

        $.ajax({
          url: '/getCurrentTurnoverId',
          method: 'get',
          success: function (response) {
            $('[name=currentTurnoverId]').val(parseInt(response.currentTurnoverId) + 1);

          }
        });

      };
    

    //ajax fetching functions here
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

    function getParTurnoverItems(rowData) {
      console.log('turnover fetch');
      
      return new Promise(function (resolve, reject) {

        var values = {
          'id': rowData[0]
        }
        console.log(values);
        $.ajax({
          url: '/getParTurnoverItems',
          method: 'get',
          data: values,
          success: function (response) {
            var assetParTurnoverItems = response.assetParTurnoverItems;
            console.log(assetParTurnoverItems);
            resolve(assetParTurnoverItems)
          },
          error: function (response) {
            var assetParTurnoverItems = new Array;
            reject(assetParTurnoverItems)
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

    function approveParTurnover(par_id) {
      return new Promise(function (resolve) {
        var id = par_id
        var values = {
          'par_id': id
        }
        console.log(values);
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: '/ApproveParTurnover',
          method: 'post',
          data: values,
          success: function (response) {
            //  var assetParTurnoverItems = response.assetParTurnoverItems;
            console.log(response);
            alert('Turnover Approved.');
            document.location.reload();
            resolve(response);


          }
        });
      });

    }

    $('#PrintTurnover').on('click', function () {
      var turnoverId = $('#turnover_id').val()
      console.log(turnoverId);

      window.open('printTurnover/' + turnoverId, '_blank');


    })

  });