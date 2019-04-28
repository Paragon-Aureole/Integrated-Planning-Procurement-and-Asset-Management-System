<!DOCTYPE html>
<html>
<head>
    <title>Captured Vehicle Form</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset('css/bootstrap4.min.css') }}" rel="stylesheet">
    <style type="text/css">
        *{
            font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif; 
            color:#262626;
        }
        .table-bordered thead tr th, .table-bordered tbody tr th, .table-bordered tbody tr td{
            border: #262626 solid 1px !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row text-center header">
            <div class="col-xs-12">Republic Of the Philippines</div>
            <div class="col-xs-12"><strong>CITY OF GOVERNMENT OF SAN FERENANDO, LA UNION</strong></div>
            <div class="col-xs-12">&nbsp;</div>
            <div class="col-xs-12"><strong>UPDATED INVENTORY/ACCOUNTING OF ALL EXISTING MOTOR VEHICLES</strong></div>
            <div class="col-xs-12"><?php echo date('Y-m-d');?></div>
            <div class="col-xs-12">&nbsp;</div>
        </div>
        <div class="row text-center">
            <table class=" table table-bordered table-hover table-sm table-condensed display nowrap w-100">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Type of Vehicle</th>
                        <th>Make</th>
                        <th>Plate No.</th>
                        <th>Acquisition Date</th>
                        <th>Acquisition Cost</th>
                        <th>Office</th>
                        <th>Accountable Officer</th>
                        <th>Status/Condition/Worthiness (Good/Fair/Repairable/Unserviceable)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($migratedVehicle as $migratedVehicleItem)
                        
                    @endforeach
                    <tr>
                        <td>{{$migratedVehicleItem->number}}</td>
                        <td>{{$migratedVehicleItem->type_of_vehicle}}</td>
                        <td>{{$migratedVehicleItem->make}}</td>
                        <td>{{$migratedVehicleItem->plate_number}}</td>
                        <td>{{$migratedVehicleItem->acquisition_date}}</td>
                        <td>{{$migratedVehicleItem->acquisition_cost}}</td>
                        <td>{{$migratedVehicleItem->office_id}}</td>
                        <td>{{$migratedVehicleItem->accountable_officer}}</td>
                        <td>{{$migratedVehicleItem->status}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>