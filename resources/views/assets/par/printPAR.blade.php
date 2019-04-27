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
            <div class="text-right">PAR No.:</div>
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
                    @php
                    $amount = $parData->asset->amount;
                    $item_quantity = $parData->asset->item_quantity;
                    $unitCost = $amount / $item_quantity;
                    @endphp
                    <tr>
                        <td>{{$parData->quantity}}</td>
                        <td>{{$parData->asset->measurementUnit->unit_code}}</td>
                        {{--  <td>{{$unit->unit_code}}</td> --}}
                        <td>{{$parData->description}}</td>
                        {{--  <td>Sample Description</td>  --}}
                        <td></td>
                        <td>{{$parData->created_at}}</td>
                        {{--  <td>Sample Date Acquired</td>  --}}
                        <td>{{$unitCost}}</td>
                        {{--  <td>SampleUnit Cost</td>  --}}
                        @php
                        $totalAmount = $parData->quantity * $unitCost;
                        @endphp
                        <td>{{$totalAmount}}</td>
                    </tr>
                    {{--  <tr>
                        <td>sample Quantity</td>
                        <td>Sample Unit</td>
                        <td>Sample Description</td>
                        <td>Sample Property Number</td>
                        <td>Sample Date Aqcuired</td>
                        <td>SampleUnit Cost</td>
                        <td>Sample Amount</td>
                    </tr>  --}}
                    <tr>
                        <td colspan="3">
                            <div class="container">
                                <div class="col-xs-12">&nbsp;</div>
                                {{-- <div class="col-xs-12">&nbsp;</div> --}}
                                <div class="text-left">
                                    Received by:
                                </div>
                                <div class="text-center">
                                    <div class="col-xs-12">_______________________________________</div>
                                    <div class="col-xs-12" style="font-size:15px;">Signature over Printed Name of End
                                        User</div><br>
                                    <div class="col-xs-12">Information Technology Officer II</div>
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
                                    <div class="col-xs-12">_______________________________________</div>
                                    <div class="col-xs-12" style="font-size:15px;">Signature over Printed Name of Supply
                                        and/or Property Custodian</div><br>
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