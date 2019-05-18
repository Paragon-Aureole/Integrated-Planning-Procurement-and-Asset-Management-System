$(document).ready(function () {
    var physicalReport = $('#phyisicalReportsDatatable').DataTable({
        responsive: true,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
    });

    physicalReport.on('click', 'button#printPhysicalBtn', function () {
        console.log('CLICKED');
        var data = physicalReport.row($(this).parents('tr')).data();
        getData(data);

        $('#signatoryName').val(data[0])



    });

    function getData(data) {
        var values = {
            asset_par_id : data[0]
        };

        $.ajax({
            data: values,
            type: 'GET',
            url: '/getPrintPhysicalData',
            success: function ( response ) {
                console.log(response.getName);
                
                var tableData = response.reportData;
                $('#asset_id').val(tableData.asset_id)
                populateTableData(tableData);
            }
        });
        
        function populateTableData(tableData) {
            var putData = new Array;

            for (let index = 0; index < tableData.length; index++) {
                var description = tableData[index].description;
                // var description = tableData[index].Description;
               if (tableData[index].itemStatus == 0) {
                   var status = 'Active'
                } else if (tableData[index].itemStatus == 1) {
                    var status = 'Turnover Pending'
                    
                } else {
                    var status = 'Unserviceable'
                    
                } 
                
               putData.push({
                    description,
                    status
               });
            }
            
            console.log(putData);
            

            var table = $('#modalTurnoverDatatable').DataTable({
                destroy:true,
                data: putData,
                responsive:false,
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
                columns:[
                    {data:'description'},
                    {data:'status'},
                ]
            })
    
            // on click functions of every button from the table
            table.on('click', 'button#btnPrint', function () {
                console.log("button update clicked");
                var data = table.row( $(this).parents('tr') ).data();
                console.log(data.id);
                
                window.open('printIcs/'+data.id, 'blank');
            });

            $('#SubmitPrintPhysical').on('click', function () {
                var asset_type_id = $('#asset_type_id').val();
                if (asset_type_id == "") {
                    alert('Please Select an Asset Type to Print')
                }else {

                    window.open('/printPhysicalForm/'+$('#signatoryName').val()+'/'+asset_type_id, 'blank');
                }
            })

        }
    };

});