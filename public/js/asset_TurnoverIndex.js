  $(document).ready(function () {
    
    $('#filterOption').on('change', function () {
      var filterOption = $('#filterOption').val();

      if (filterOption == 1) {
        console.log('You Selected PAR Number');
        $('#showParInputs').show();
        $('#showOfficeInputs').hide();

        getFilterPar();
        
      } else if (filterOption == 2){
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

    function getFilterName () {
      $('#searchName').on('click', function () {
        var values = {
          'office_id' : $('#office_id').val(),
          'signatory_name' : $('#signatory_name').val()
        }
        console.log(values);
        $.ajax({
          url: '/nameSearchTurnover',
          method: 'get',
          data: values,
          success: function ( response ) {
            var tableContent = response.assetPar;
            populateTurnoverTable(tableContent);

          }
        });
        
      });
    }

    function getFilterPar () {
      $('#searchPar').on('click', function () {
        var values = {
          'par_id' : $('#par_id').val()
        }

        console.log(values);
        
        $.ajax({
          url: '/parSearchTurnover',
          method: 'get',
          data: values,
          success: function ( response ) {
            var tableContent = response.assetPar;
            populateTurnoverTable(tableContent);

          }
        });
        
      });
      
    };

    function populateTurnoverTable(tableContent) {
      $('parTbody').empty();
       var table = $('#parDatatable').DataTable({
            destroy:true,
            data: tableContent,
            responsive:true,
            columns:[
                {data:'id'},
                {data:'quantity'},
                {data:'assignedTo'},
                {data:'position'},
                {
                    'data': null,
                    'defaultContent': '<button type="button" id="turnoverButton" name="btn_assignItem" class="btn btn-info btn-xs"data-toggle="modal" data-target="#turnoverModal">Turnover</button>'
                }
            ]
        })
    };
    
  });