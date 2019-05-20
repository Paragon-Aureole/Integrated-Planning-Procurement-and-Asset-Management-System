$(document).ready(function () {
    var physicalReport = $('#phyisicalReportsDatatable').DataTable({
        responsive: true,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50,"All"]],
    });

    physicalReport.on('click', 'button#printPhysicalBtn', function () {
        console.log('CLICKED');
        var data = physicalReport.row($(this).parents('tr')).data();
        getData(data);

        $('#signatoryName').val(data[1]);
        $('#signatoryId').val(data[0]);



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
                // console.log(response.getName);
                // var parItem = response.reportData;
                // var nameData = response.getName;
                var findName = response.findName;
                // console.log(parItem);
                // console.log(nameData);
                console.log(findName.asset_id);
                
                $('#asset_id').val(findName.asset_id)
                populateTableData(findName);
            }
        });
        
        function populateTableData(findName) {

            var putData = new Array;
            var asset_par_item = findName.asset_par_item;
            var asset = findName.asset;
            
            for (let index = 0; index < asset_par_item.length; index++) {
                var description = asset_par_item[index].description;
                var Name = asset.details;
               if (asset_par_item[index].itemStatus == 0) {
                   var status = 'Active'
                } else if (asset_par_item[index].itemStatus == 1) {
                    var status = 'Turnover Pending'
                    
                } else {
                    var status = 'Unserviceable'
                    
                } 
                
               putData.push({
                    Name,
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
                    {data: 'Name'},
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

                    window.open('/printPhysicalForm/'+$('#signatoryId').val()+'/'+asset_type_id, 'blank');
                }
            })

        }
    };

    physicalReport.on('click', 'button#printPhysicalBtnCaptured', function () {
        console.log('CLICKED Captured');
        var data = physicalReport.row($(this).parents('tr')).data();
        getDataCaptured(data);

        $('#signatoryName').val(data[1]);
        $('#position').val(data[2]);
        $('#signatoryId').val(data[0]);



    });
        function getDataCaptured(data) {
            var values = {
                name: data[1],
                position: data[2]
            };

            console.log(values);
            

            $.ajax({
                data: values,
                type: 'GET',
                url: '/getPrintPhysicalDataCaptured',
                success: function (response) {

                    var capturedData = response.capturedData
                    console.log(capturedData);
                    
                    // $('#asset_id').val(findName.asset_id)
                    populateTableDataCaptured(capturedData);
                }
            });

            function populateTableDataCaptured(capturedData) {
                var table = $('#modalTurnoverDatatable').DataTable({
                    destroy: true,
                    data: capturedData,
                    responsive: false,
                    "lengthMenu": [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"]
                    ],
                    columns: [{
                            data: 'item_name'
                        },
                        {
                            data: 'description'
                        },
                        {
                            data: 'status'
                        },
                    ]
                })

                // on click functions of every button from the table
                table.on('click', 'button#btnPrint', function () {
                    console.log("button update clicked");
                    var data = table.row($(this).parents('tr')).data();
                    console.log(data.id);

                    window.open('printIcs/' + data.id, 'blank');
                });

                $('#SubmitPrintPhysical').on('click', function () {
                    var asset_type_id = $('#asset_type_id').val();
                    if (asset_type_id == "") {
                        alert('Please Select an Asset Type to Print')
                    } else {

                        window.open('/printPhysicalFormCaptured/' + $('#signatoryId').val() + '/' + asset_type_id, 'blank');
                    }
                })

            }
        };



});