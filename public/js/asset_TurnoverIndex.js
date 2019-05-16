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

    turnoverDataTable.on('click', 'tr button#turnoverViewButton', function () {
      console.log('You know I want you~☻');
      // console.log();


      var rowData = turnoverDataTable.row($(this).parents('tr')).data();
      // var rowData = turnoverDataTable.row($(this)).data();
      console.log(rowData);


      fillassignedTurnoverModalForm(rowData);


    });

    //button click functions here

    $('#ApproveTurnover').on('click', function () {
      console.log('baby hit me one more time~');
      approveParTurnover();
    });

    //datatable filling functions here
    function fillForTurnoverModalForm(rowData) {
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
            '<input type="hidden" name="toTurnover[' + assetParItems[1][index].id + ']" value="0"><input type="checkbox" name="toTurnover[' + assetParItems[1][index].id + ']" value="1">'
          ]);

        }

        var newArray = tableRowDataContent.filter(function (el) {
          return el[2] != 'Unserviceable'
        });

        console.log(newArray);

        // $.each(tableRowDataContent, function(i,v){
        //   // console.log(i);

        //   // console.log(v[2]);

        //   if (v[2] == "Unserviceable") {
        //     console.log('unserviceable po eto');
        //     this.splice(i,1);
        //   }
        // });

        console.log(tableRowDataContent);

        modalTurnoverDataTable.clear();
        for (let index = 0; index < newArray.length; index++) {
          modalTurnoverDataTable.row.add(newArray[index]);
        }
        modalTurnoverDataTable.draw();

      });
    }

    function fillassignedTurnoverModalForm(rowData) {
      console.log(rowData);
      if (rowData[4] == "Pending") {
        $('#PrintTurnover').hide();
        $('#ApproveTurnover').show();
        getParAssignedItems(rowData).then(function (assetParItems) {
          getParTurnoverItems(rowData).then(function (assetParTurnoverItems) {
            console.log(assetParItems);
            console.log(assetParTurnoverItems);

            var tableRowDataContent = new Array;

            for (let index = 0; index < assetParItems[1].length; index++) {
              const description = assetParItems[1][index].description;
              var status;
              $.each(assetParTurnoverItems, function (i, v) {
                if (v == 0 && i == assetParItems[1][index].id) {
                  status = "Active";
                } else if (v == 1 && i == assetParItems[1][index].id) {
                  status = "Unserviceable";
                }
              });
              // if (assetParTurnoverItems[index] == 0) {
              //   var status = "Active";
              // } else if (assetParTurnoverItems[index] == 1) {
              //   var status = "Unserviceable";
              // }
              // console.log(element);
              tableRowDataContent.push([
                assetParItems[0],
                description,
                status
              ]);
            }

            var newArray = tableRowDataContent.filter(function (el) {
              return el[2] != 'Active'
            });

            console.log(newArray);

            console.log(tableRowDataContent);

            modalApprovalTurnoverDatatable.clear();
            for (let index = 0; index < newArray.length; index++) {
              modalApprovalTurnoverDatatable.row.add(newArray[index]);
            }
            modalApprovalTurnoverDatatable.draw();
          });
        });
      } else {
        $('#PrintTurnover').show();
        $('#ApproveTurnover').hide();
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
              '<input type="hidden" name="toTurnover[' + assetParItems[1][index].id + ']" value="0"><input type="checkbox" name="toTurnover[' + assetParItems[1][index].id + ']" value="1">'
            ]);
          }

          console.log(tableRowDataContent);

          var newArray = tableRowDataContent.filter(function (el) {
            return el[2] != 'Unserviceable'
          });

          console.log(newArray);

          modalApprovalTurnoverDatatable.clear();
          for (let index = 0; index < newArray.length; index++) {
            modalApprovalTurnoverDatatable.row.add(newArray[index]);
          }
          modalApprovalTurnoverDatatable.draw();

        });
      }

      $('#turnoverPar_id').val(rowData[0]);

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
      return new Promise(function (resolve) {

        var values = {
          'par_id': rowData[0]
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

    function approveParTurnover() {
      return new Promise(function (resolve) {

        var values = {
          'par_id': $('#turnoverPar_id').val()
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
            window.location.reload;
            resolve(response);


          }
        });
      });

    }

  });