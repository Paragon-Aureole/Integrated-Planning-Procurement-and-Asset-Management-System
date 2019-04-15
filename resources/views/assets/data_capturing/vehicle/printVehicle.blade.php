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
            <div class="col-xs-12">As of date here</div>
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
                    <tr>
                        <td>Sample No.</td>
                        <td>Sample Type of Vehicle</td>
                        <td>Sample Make</td>
                        <td>sample Plate No.</td>
                        <td>Sample Acquisition Date</td>
                        <td>Sample Acquisition Cost</td>
                        <td>Sample Office</td>
                        <td>Sample Accoutable Office</td>
                        <td>Sample Status/Condition/Worthiness (Good/Fair/Repairable/Unserviceable)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>