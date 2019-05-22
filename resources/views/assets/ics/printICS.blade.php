<!DOCTYPE html>
<html>
<head>
    <title>ICS Form</title>
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
                                <div class="text-right">ICS No.: {{$IcslipData->first()->id}}</div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th colspan="2">Description</th>
                        <th>Inventory Item No.</th>
                        <th>Estimated Useful Life</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($IcslipData as $item)
                    @php
                    $amount = $item->asset->amount;
                    $item_quantity = $item->quantity;
                    @endphp
                    <tr>
                        <td style="border-bottom: 1px solid white !important">{{$item->quantity}}</td>
                        <td style="border-bottom: 1px solid white !important">{{$item->asset->measurementUnit->unit_code}}</td>
                        <td width="40%" class="text-left" style="border-bottom: 1px solid white !important; border-right: 1px solid white !important">
                            <b>{{$item->asset->details}}</b><br>{{$item->description}}
                        </td>
                        <td style="border-bottom: 1px solid white !important"><b>P{{number_format($item->asset->amount, 2)}}</b></td>
                        <td style="border-bottom: 1px solid white !important">{{$item->inventory_name_no}}</td>
                        <td style="border-bottom: 1px solid white !important">{{$item->useful_life}}</td>
                    </tr>
                    @endforeach

                    @for ($i = $IcslipData->count(); $i <= 25; $i++)
                        <tr>
                            <td style="border-bottom: 1px solid white !important">&nbsp;</td>
                            <td style="border-bottom: 1px solid white !important">&nbsp;</td>
                            <td style="border-bottom: 1px solid white !important; border-right: 1px solid white !important">&nbsp;</td>
                            <td style="border-bottom: 1px solid white !important">&nbsp;</td>
                            <td style="border-bottom: 1px solid white !important">&nbsp;</td>
                            <td style="border-bottom: 1px solid white !important">&nbsp;</td>
                        </tr>
                    @endfor
                    <tr>
                        <td style="border-bottom: 1px solid black !important">&nbsp;</td>
                        <td style="border-bottom: 1px solid black !important">&nbsp;</td>
                        <td style="border-bottom: 1px solid black !important; border-right: 1px solid white !important">&nbsp;</td>
                        <td style="border-bottom: 1px solid black !important">&nbsp;</td>
                        <td style="border-bottom: 1px solid black !important">&nbsp;</td>
                        <td style="border-bottom: 1px solid black !important">&nbsp;</td>
                    </tr>
                    <tr>       
                        <td colspan="3">
                            <div class="container">
                                <div class="col-xs-12">&nbsp;</div>
                                {{-- <div class="col-xs-12">&nbsp;</div> --}}
                                <div class="text-left">
                                    Received by:
                                </div>
                                <div class="text-center">
                                    <div class="col-xs-12">{{$IcslipData->first()->assignedTo}}</div>
                                    <div class="col-xs-12" style="font-size:15px;">Signature over Printed Name</div><br>
                                    <div class="col-xs-12">{{$IcslipData->first()->position}}</div>
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
                                    <div class="col-xs-12">_______________________________________</div>
                                    <div class="col-xs-12" style="font-size:15px;">Signature over Printed Name</div><br>
                                    <div class="col-xs-12">
                                        <strong><u>OIC-CITY-GSO</u></strong>
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