$( document ).ready( function () {
    // Setting up the ajax 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    console.log('PR FUNCTION READY');
    
    getTableData();

    // data From database
    function getTableData () {
        $.ajax({
            url: '/prData',
            method: 'get',
            success: function ( response ) {
                var tableContent = response.tableContent;  
                var signatoryValue = response.signatoryValue;  
                console.log(tableContent);
                console.log(response.signatoryValue);
                populatePrTable(tableContent, signatoryValue);
                            
            }
        })
    }

    // putting getTableData() to dataTable
    function populatePrTable (tableContent, signatoryValue) {
        var table = $('#datatable').DataTable({
            destroy:true,
            data: tableContent,
            responsive:true,
            columns:[
                {data:'pr_code'},
                {data:'pr_purpose'},
                {data: function(data, type, full){
                    if (data.pr_status == 1) {
                        return 'Approved';
                    }else {
                        return 'Pending';
                    }
                }},
                {data:'created_at'},
                {
                    'data': null,
                    'defaultContent': '<button class="btn btn-sm btn-info" title="Add PR Items" data-toggle="modal"data-target="#prItemModal" id="btnModal"><i class="fas fa-th-list"></i></button>&nbsp<button id="btnUpdate" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>&nbsp<button id="btnDelete" class="btn btn-sm btn-danger"><i class="fas fa-minus"></i></button>'
                }
            ]
        })

        // on click functions of button that triggers the modal from the table
        table.on('click', 'button#btnModal', function () {
            console.log("button update clicked");
            var data = table.row( $(this).parents('tr') ).data();
            console.log(data);
            
            getItemData(data);
        })
        
        // on click functions of button that will update data
        table.on('click', 'button#btnUpdate', function () {
            var data = table.row( $(this).parents('tr') ).data();
            // console.log(data);
            // console.log(signatoryValue);
            updateData(data, signatoryValue);

        })
        
        // on click functions of button that will delete data
        table.on('click', 'button#btnDelete', function () {
            var data = table.row( $(this).parents('tr') ).data();
            deleteData(data);
        })

    }

    // get item from database
    function getItemData(data){
        var values = {
            id: data.id
        }
        var valId = values.id;
        $.ajax({
            url: '/pr/'+valId+'/item',
            method: 'get',
            data: values,
            success: function ( response ) {
                var tableItemContent = response.prItemContent;  
                console.log(tableItemContent);
                populateItemData(tableItemContent);
                            
            },
            error: function ( response ) {
                console.log(response);
            }
        });

        $('#prCode').val('');
        $('#txtAreaPurpose').val('');
        $('#prSupplierType').val('');
        $('#budgetAllocation').val('');
        
        $('#prId').val(data.id);
        $('#prCode').val(data.pr_code);
        $('#txtAreaPurpose').val(data.pr_purpose);
        if (data.supplier_type == 1) {
            $('#prSupplierType').val('Canvass');
            
        }else if (data.supplier_type == 2) {
            $('#prSupplierType').val('Government Agency');
            
        }else if (data.supplier_type == 3) {
            $('#prSupplierType').val('Sole Distributor');
            
        }
        $('#budgetAllocation').val('P ' + data.pr_budget);

    }

    // function that populate the data from getItemData()
    function populateItemData (tableItemContent) {
        var itemDesc = $('#itemDesc');
        var itemQty = $('#itemQty');
        var costPerUnit = $('#CostPerUnit');
        itemDesc.empty();
        itemQty.empty();
        $('#itemUnit').empty();
        costPerUnit.empty();
        $('#itemCost').empty();

        // code that populate the select#itemDesc
        itemDesc.append('<option value="">Select Item</option>');
 
        $(tableItemContent).each( function (itemIndex, itemValue) {
            itemDesc.append('<option value="' + itemValue.id + '">' + itemValue.item_description + '</option>');
        });

        // codes that will look for the select#itemDesc's id to match to the id on the db then populate fields
        $('#itemDesc').on('change', function () {
            var itemDesc = $('#itemDesc').val();
            
            var result = tableItemContent.find(obj => {
                return obj.id == itemDesc;
                })
                
                console.log(itemDesc + ' is the id');
    
                var itemStock = result.item_stock;
                itemIds = [];
                    for (i = 1; i <= itemStock; i++) {
                        itemIds.push({i});
                    }
                    
                    $('#itemQty').empty();
                    
                    $(itemIds).each(function (idIndex, idValue) {
                        itemQty.append('<option value="'+ idValue.i +'">' + idValue.i +  '</option>');
    
                    })
                    
                    itemQty.val(result.item_quantity);
                    $('#itemUnit').val(result.measurement_unit_id);
                    costPerUnit.val(result.item_cost);

                    var total = itemQty.val() * costPerUnit.val();
                    $('#itemCost').val(total);
                })
                
        // function that compute the total everytime u change the quantity
        $(itemQty).on('change', function () {
            var total = itemQty.val() * costPerUnit.val();

            $('#itemCost').empty()
            $('#itemCost').val(total)
            
        })
    }

    // function that will update selected data from the db
    function updateData (data, signatoryValue) {
        console.log(data);
        console.log(signatoryValue);
        
    }

    // function that will delete selected data from the db
    function deleteData (data) {
        var values = {
            id: data.id
        }
        var valId = values.id;
        console.log('id to be deleted: ' + valId);
        
    //     $.ajax({
    //         url: '/pr/'+valId+'/item/delete/'+valId,
    //         method: 'get',
    //         data: values,
    //         success: function ( response ) {
    //             var tableItemContent = response.prItemContent;  
    //             console.log(tableItemContent);
    //             populateItemData(tableItemContent);
                            
    //         },
    //         error: function ( response ) {
    //             console.log(response);
    //     }
    // })
}
    

})