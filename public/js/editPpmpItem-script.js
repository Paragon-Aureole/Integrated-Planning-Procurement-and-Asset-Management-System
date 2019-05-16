//PPMP ITEM CODE
$( document ).ready( function () {
    // Setting up the ajax 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    console.log("edit ppmp items ready!");
    
    var table;
    getTableData();
    // getPpmpData();

    // get the data from the database
    function getTableData () {
        var values = {
            ppmp_id : $('#ppmp_id').val()
        }
        console.log(values.ppmp_id);
        
        $.ajax({
            url: '/dataTable',
            method: 'get',
            data: values,
            success: function ( response ) {
                var tableContent = response.tableContent;
                console.log(tableContent);
                populateTable(tableContent);                
                populateDropdown(tableContent);                
            }
        })
    }



    // populate Dropdown
    function populateDropdown (tableContent) {
        var codeType = $('#optionValue');
        var rep;
        var values = [1, 2, 3];
        codeType.empty();
        $(values).each(function (index, value) {
            if (value == 1) {
            var optionName = 'Department & Office Supplies';
            }else if (value == 2) {
                var optionName = 'Departmental Projects';
            }else if (value == 3){
                var optionName = 'Projects Chargeable to Other Offices';
            }
            codeType.append('<option value=' + value + '> ' + optionName + '</option>')
        })
    }

    // populate table using dataTable js
    function populateTable (tableContent) {
        table = $('#datatable').DataTable({
            destroy:true,
            data: tableContent,
            responsive:false,
            columns:[
                {data:'code_description'},
                {
                    'data': null,
                    'defaultContent': '<button id="btnUpdate" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>&nbsp<button id="btnDelete" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></button>'
                }
            ]
        })

        // on click functions of every button from the table
        table.on('click', 'button#btnUpdate', function () {
            console.log("button update clicked");
            var data = table.row( $(this).parents('tr') ).data();
            console.log(data);
            
            $('#updateContent').show();
            $('#cancelUpdate').show();
            $('#submitContent').hide();

            updateTableContent(data);
        })
        table.on('click', 'button#btnDelete', function () {
            // console.log("button delete clicked");
            var data2 = table.row( $(this).parents('tr') ).data();
            // console.log(data2);
            
            // $('#updateContent').show();
            // $('#cancelUpdate').show();
            // $('#submitContent').hide();

            deleteTableContent(data2);
        })
    }

    //function that deletes the field
    function deleteTableContent (data2){
        // console.log('/ppmp/code/delete/' + data2.id);
        $.ajax({
            url: '/ppmp/code/delete/' + data2.id,
            method: 'get',
            success: function ( response ) {
                // var updateData = response.updateContent;
                // console.log(response);

                getTableData();
                               
            },
            error: function ( response ){
                // console.log( response );
            }
        });
    }

    // Function that populates textboxes
    function updateTableContent (data) {
        $('#descriptionValue').empty();
        $('#optionValue').empty();

        populateDropdown();
        
        $('#descriptionValue').val(data.code_description);
        $('#codeId').val(data.id);
        

        if (data.code_type == 1) {
            $("#optionValue option[value=1]").attr('selected', 'selected');
            
        }else if (data.code_type == 2) {
            $("#optionValue option[value=2]").attr('selected', 'selected');
            
        }else if (data.code_type == 3) {
            $("#optionValue option[value=3]").attr('selected', 'selected');
            
        }

        // update content
        $('#updateContent').on('click', function (event) {
            event.preventDefault();

            console.log(data.id);

            var values = {
                code_description : $('#descriptionValue').val(),
                optionValue : $('#optionValue').val(),
                codeId : $('#codeId').val()
            }
            
            $.ajax({
                url: '/updateData',
                method: 'put',
                data: values,
                success: function ( response ) {
                    // var updateData = response.updateContent;
                    console.log(response);

                    getTableData();
                                   
                },
                error: function ( response ){
                    console.log( response );
                }
            });

            $('#descriptionValue').val('');
            $('#optionValue').val('');
            
            $('#updateContent').hide();
            $('#cancelUpdate').hide();
            $('#submitContent').show();
        });
        
        // canceling update function
        $('#cancelUpdate').on('click', function (event) {
            event.preventDefault();
            console.log('Update cancelled');
            
            $('#descriptionValue').val('');
            $('#optionValue').val('');

            $('#updateContent').hide();
            $('#cancelUpdate').hide();
            $('#submitContent').show();

            getTableData();
        })
    }

    
  
})