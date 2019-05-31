$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var itemDataTable = $('#itemDatatable').DataTable({
        responsive: true,
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],

    }).columns([2,3]).visible(false);

    var chosenDatatable = $('#chosenDatatable').DataTable({
        responsive: true,
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
    });

    var turnedOverDataTable = $('#turnedOverDatatable').DataTable({
        responsive: true,
        "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
    });

        itemDataTable.on('click', 'tr button#turnoverAddItem', function () {
            console.log('I know you want me~☻');
            // console.log();


            var rowData = itemDataTable.row($(this).parents('tr')).data();
            // var rowData = $('#parDatatable').DataTable().row($(this)).data();
            console.log(rowData);

            var chosenTurnoverButton = "<button id='turnoverRemoveItem' class='btn btn-danger btn-sm'><i class='fas fa-minus'></i></button>";
            var newRowData = new Array();
            newRowData.push(rowData[0],rowData[1],rowData[2],rowData[3],rowData[4],rowData[5],rowData[6],chosenTurnoverButton);

            console.log(newRowData);
            
            chosenDatatable.row.add(newRowData).draw();
            itemDataTable.row($(this).parents('tr')).remove().draw();
            
        });``
        
        chosenDatatable.on('click', 'tr button#turnoverRemoveItem', function () {
            console.log('You know I want you~☻');
            // console.log();
            
            
            var rowData = chosenDatatable.row($(this).parents('tr')).data();
            // var rowData = $('#parDatatable').DataTable().row($(this)).data();
            console.log(rowData);
            
            var chosenTurnoverButton = "<button id='turnoverAddItem' class='btn btn-info btn-sm'><i class='fas fa-plus'></i></button>";
            var newRowData = new Array();
            newRowData.push(rowData[0], rowData[1], rowData[2], rowData[3], rowData[4], rowData[5], rowData[6], chosenTurnoverButton);
            
            console.log(newRowData);
            itemDataTable.row.add(newRowData).draw();
            chosenDatatable.row($(this).parents('tr')).remove().draw();

        });

        $("select[name='departmentSelect']").on('change', function () {
           
           var office_code = $("select[name='departmentSelect'] option:selected").attr('data-value'); // $("input[name=category]").val('1');
        //    console.log(office_code);
            // $('#officeInput option').show();
            var filteredData = itemDataTable
            filteredData
                .column(2)
                .search(office_code)
                .draw();
        });

        $("#departmentSignatory").on('input', function () {
            // alert("Handler for .change() called.");
            var assigned_to = $("#departmentSignatory").val(); // $("input[name=category]").val('1');
            //    console.log(office_code);
            // $('#officeInput option').show();
            var filteredData = itemDataTable
            filteredData
                .column(3)
                .search(assigned_to)
                .draw();
        });

        
});