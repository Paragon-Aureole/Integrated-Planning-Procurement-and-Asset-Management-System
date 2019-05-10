<!DOCTYPE html>
<html>
<head>
    <title>ICS Form</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset('css/bootstrap4.min.css') }}" rel="stylesheet">
    <style type="text/css">
        * {
            font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;
            color: #262626;
        }

        .table-bordered thead tr th,
        .table-bordered tbody tr th,
        .table-bordered tbody tr td {
            border: #262626 solid 1px !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row text-center header">
            <div class="col-xs-12">Republic Of the Philippines</div>
            <div class="col-xs-12">CITY OF SAN FERNANDO</div>
            <div class="col-xs-12">&nbsp;</div>
            <div class="col-xs-12"><i>Office of the City General Services Officer</i></div>
            <div class="col-xs-12">&nbsp;</div>
        </div>        
        <div class="row text-center">
            <table class=" table table-bordered table-hover table-sm table-condensed display nowrap w-100">
                <thead>
                    <tr>
                        <th colspan="6">
                            <div class="container" style="font-size:20px;">
                                INVENTORY CUSTODIAN SLIP
                                <div class="col-xs-12">&nbsp;</div>
                                <div class="text-right">ICS No.: {{$IcsData->ics_number}}</div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Description</th>
                        <th>Inventory Item No.</th>
                        <th>Estimated Useful Life</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$IcsData->item_quantity}}</td>
                        <td>{{$IcsData->item_unit}}</td>
                        <td><textarea cols="30" rows="30" style="border:none">{{$IcsData->description}}</textarea></td>
                        <td>{{$IcsData->inventory_item_number}}</td>
                        <td>{{$IcsData->estimated_useful_life}}</td>
                    </tr>
                    {{-- @for ($i = 0; $i < 5; $i++)
                        <tr>
                            @for ($j = 0; $j < 5; $j++)
                                <td>&nbsp;</td>
                            @endfor
                        </tr>
                    @endfor --}}
                    <tr>       
                        <td colspan="3">
                            <div class="container">
                                <div class="col-xs-12">&nbsp;</div>
                                {{-- <div class="col-xs-12">&nbsp;</div> --}}
                                <div class="text-left">
                                    Received by:
                                </div>
                                <div class="text-center">
                                    <div class="col-xs-12">{{$IcsData->receiver_name}}</div>
                                    <div class="col-xs-12" style="font-size:15px;">Signature over Printed Name</div><br>
                                    <div class="col-xs-12">{{$IcsData->receiver_position}}</div>
                                    <div class="col-xs-12" style="font-size:15px;">Position/Office</div><br>
                                    <div class="col-xs-12" style="font-size:15px;">Date</div>
                                </div>
                            </div>
                        </td>
                        <td colspan="3">
                            <div class="container">
                                <div class="col-xs-12">&nbsp;</div>
                                {{-- <div class="col-xs-12">&nbsp;</div> --}}
                                <div class="text-left">
                                    Received From:
                                </div>
                                <div class="text-center">
                                    <div class="col-xs-12">{{$IcsData->issuer_name}}</div>
                                    <div class="col-xs-12" style="font-size:15px;">Signature over Printed Name</div><br>
                                    <div class="col-xs-12">
                                        <strong><u>{{$IcsData->issuer_position}}</u></strong>
                                    </div>
                                    <div class="col-xs-12" style="font-size:15px;">Position/Office</div><br>
                                    <div class="col-xs-12" style="font-size:15px;">Date</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>