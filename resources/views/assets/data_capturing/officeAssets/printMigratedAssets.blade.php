<!DOCTYPE html>
<html>

<head>
    <title>PAR Form</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
            <div class="col-xs-12">PROPERTY ACKNOWLEDGEMENT RECEIPT</div>
            <div class="col-xs-12">&nbsp;</div>
            <div class="col-xs-12">&nbsp;</div>
        </div>
        <div class="text-left">
            <div class="col-xs-12">Entity Name: {{$parData->first()->Office->office_code}}</div>
            <div class="col-xs-12">fund Cluster: {{$parData->first()->fund_cluster}}</div>
            <div class="text-right">PAR No.: {{$parData->first()->par_number}}</div>
        </div>
        <div class="row text-center">
            <table class=" table table-bordered table-hover table-sm table-condensed display nowrap w-100">
                <thead>
                    <tr>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Description</th>
                        <th>Property Number</th>
                        <th>Date Acquired</th>
                        <th>Unit Cost</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parData as $item)
                        <tr>
                            <td>{{$item->item_quantity}}</td>
                            <td>{{$item->item_unit}}</td>
                            <td width="35%">
                                <div class="text-left">{{$item->description}}</div>
                            </td>
                            <td>{{$item->property_number}}</td>
                            <td>{{$item->date_acquired}}</td>
                            <td>{{$item->unit_cost}}</td>
                            <td>{{$item->amount}}</td>
                        </tr>
                    @endforeach
                    @for ($i = $parData->count(); $i <= 20; $i++)
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    @endfor
                    <tr>
                        <td colspan="3">
                            <div class="container">
                                <div class="col-xs-12">&nbsp;</div>
                                {{-- <div class="col-xs-12">&nbsp;</div> --}}
                                <div class="text-left">
                                    Received by:
                                </div>
                                <div class="text-center">
                                    <div class="col-xs-12">{{$parData->first()->receiver_name}}</div>
                                    <div class="col-xs-12" style="font-size:15px;">Signature over Printed Name of End User</div><br>
                                    <div class="col-xs-12">{{$parData->first()->receiver_position}}</div>
                                    <div class="col-xs-12" style="font-size:15px;">Position/Office</div><br><br>
                                    <div class="col-xs-12" style="font-size:15px;">{{date("Y.m.d")}}</div>
                                </div>
                            </div>
                        </td>
                        <td colspan="4">
                            <div class="container">
                                <div class="col-xs-12">&nbsp;</div>
                                {{-- <div class="col-xs-12">&nbsp;</div> --}}
                                <div class="text-left">
                                    Issued by:
                                </div>
                                <div class="text-center">
                                    <div class="col-xs-12">{{$parData->first()->issuer_name}}</div>
                                    <div class="col-xs-12" style="font-size:15px;">Signature over Printed Name of Supply and/or Property Custodian</div><br>
                                    <div class="col-xs-12">
                                        <strong><u>{{$parData->first()->issuer_position}}</u></strong>
                                    </div>
                                    <div class="col-xs-12" style="font-size:15px;">Position/Office</div><br>
                                    <div class="col-xs-12" style="font-size:15px;">{{date("Y.m.d")}}</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</body>

</html>