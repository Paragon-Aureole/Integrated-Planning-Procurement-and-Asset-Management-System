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
            <div class="col-xs-12">Entity Name:</div>
            <div class="col-xs-12">fund Cluster:</div>
            <div class="text-right">PAR No.: {{$parData->par_number}}</div>
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
                    <tr>
                        <td>{{$parData->item_quantity}}</td>
                        <td>{{$parData->item_unit}}</td>
                        {{--  <td>{{$unit->unit_code}}</td> --}}
                        <td><textarea cols="30" rows="20" style="border:none">{{$parData->description}}</textarea></td>
                        {{--  <td>Sample Description</td>  --}}
                        <td>{{$parData->property_number}}</td>
                        <td>{{$parData->created_at}}</td>
                        {{--  <td>Sample Date Acquired</td>  --}}
                        <td>{{$parData->unit_cost}}</td>
                        <td>{{$parData->amount}}</td>
                    </tr>
                    @for ($i = 0; $i < 5; $i++)
                        <tr>
                            @for ($j = 0; $j < 7; $j++)
                                <td>&nbsp;</td>
                            @endfor
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
                                    <div class="col-xs-12">{{$parData->receiver_name}}</div>
                                    <div class="col-xs-12" style="font-size:15px;">Signature over Printed Name of End
                                        User</div><br>
                                    <div class="col-xs-12">{{$parData->receiver_position}}</div>
                                    <div class="col-xs-12" style="font-size:15px;">Position/Office</div><br>
                                    <div class="col-xs-12" style="font-size:15px;">Date</div>
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
                                    <div class="col-xs-12">{{$parData->issuer_position}}</div>
                                    <div class="col-xs-12" style="font-size:15px;">Signature over Printed Name of Supply
                                        and/or Property Custodian</div><br>
                                    <div class="col-xs-12">
                                        <strong><u>{{$parData->issuer_position}}</u></strong>
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