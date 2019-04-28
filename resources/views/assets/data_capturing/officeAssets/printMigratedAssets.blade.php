<!DOCTYPE html>
<html>
<head>
    <title>Captured Office Assets Form</title>
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
        <div class="col-xs-12">REPORT OF THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT</div>
        <div class="col-xs-12"><?php echo date('Y-m-d');?></div>
        <div class="col-xs-12">
            <strong><u>
                @foreach($migratedAssetsFirst as $migratedAssetsFirstItem)
                    {{$migratedAssetsFirstItem->asset_type_id}}
                @endforeach
            </u></strong>
        </div>
        <div class="col-xs-12">(Type of Property, Plant and Equipment)</div>
        <div class="col-xs-12">&nbsp;</div>
    </div>
    <div class="row">
        <center>
            <table class="text-center">
                @foreach ($migratedAssetsFirst as $migratedAssetsFirstItem)
                    <tr>
                        <td>For Which &nbsp</td>
                        <td><u>{{$migratedAssetsFirstItem->name_of_accountable}}</u>, &nbsp</td>
                        <td><u>{{$migratedAssetsFirstItem->official_designation}}</u>, &nbsp</td>
                        <td><u>{{$migratedAssetsFirstItem->lgu}}</u></td>
                        <td>&nbsp is accontable having assumed such accountability on</td>
                    </tr>
                @endforeach
                    <tr>
                        <td></td>
                        <td>(Name of Accountable)</td>
                        <td>(Official Designation)</td>
                        <td>(LGU)</td>
                        <td></td>
                    </tr>
                </table>
        </center>
    </div>
    <div class="col-xs-12">&nbsp;</div>
    <div class="row">
        <table class=" table table-bordered table-hover table-sm table-condensed display nowrap w-100">
            <thead>
                <tr>
                    <th rowspan="2">ARTICLE</th>
                    <th rowspan="2">DESCRIPTION</th>
                    <th>Property</th>
                    <th>unit of</th>
                    <th>UNIT</th>
                    <th>BALANCE</th>
                    <th>ON HAND</th>
                    <th rowspan="2">SHORTAGE/ OVERAGE</th>
                    <th rowspan="2">Date of Purchase</th>
                    <th rowspan="2">PAR/ICS Number</th>
                    <th rowspan="2">Status</th>
                    <th rowspan="2">REMARKS</th>
                </tr>
                <tr>
                    <th>Number</th>
                    <th>Measure</th>
                    <th>VALUE</th>
                    <th>PER CARD</th>
                    <th>PER COUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($migratedAssetsFirst as $migratedAssetsFirstItem)
                <tr>
                    <td style="background-color:yellow">{{$migratedAssetsFirstItem->office_id}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>
                @endforeach
                @foreach ($migratedAssets as $migratedAssetsItem)
                    <tr>
                        <td>{{$migratedAssetsItem->article}}</td>
                        <td>{{$migratedAssetsItem->description}}</td>
                        <td>{{$migratedAssetsItem->property_number}}</td>
                        <td>{{$migratedAssetsItem->unit_of_measure}}</td>
                        <td>{{$migratedAssetsItem->unit_value}}</td>
                        <td>{{$migratedAssetsItem->balance_per_card}}</td>
                        <td>{{$migratedAssetsItem->on_hand_per_count}}</td>
                        <td>{{$migratedAssetsItem->shortage_overage}}</td>
                        <td>{{$migratedAssetsItem->date_purchase}}</td>
                        <td>{{$migratedAssetsItem->par_ics_number}}</td>
                        <td>{{$migratedAssetsItem->status}}</td>
                        <td>{{$migratedAssetsItem->remarks}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>