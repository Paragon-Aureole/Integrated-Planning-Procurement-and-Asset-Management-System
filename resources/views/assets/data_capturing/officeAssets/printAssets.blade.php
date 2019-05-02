<!DOCTYPE html>
<html>

<head>
    <title>Captured Office Assets Form</title>
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
            <div class="col-xs-12">REPORT OF THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT</div>
            <div class="col-xs-12">As of date here</div>
            <div class="col-xs-12"><strong><u>Type of Asset Here (sample: OFFICE EQUIPMENT)</u></strong></div>
            <div class="col-xs-12">(Type of Property, Plant and Equipment)</div>
            <div class="col-xs-12">&nbsp;</div>
        </div>
        <div class="row">
            <center>
                <table class="text-center">
                    <tr>
                        <td>For Which &nbsp</td>
                        <td>__________________________, &nbsp</td>
                        <td>_____________________, &nbsp</td>
                        <td>_____________________</td>
                        <td>&nbsp is accontable having assumed such accountability on</td>
                    </tr>
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
                        <th rowspan="2">PAR Number</th>
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
                    <tr>
                        <td style="background-color:yellow">
                            {{$parData->first()->asset->purchaseOrder->purchaseRequest->office->office_name}}</td>
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
                    @foreach ($parData as $record)
                    <tr>
                        <td>{{$record->asset->details}}</td>
                        <td>{{$record->description}}</td>
                        <td>Sample Property</td>
                        <td>{{$record->asset->measurementUnit->unit_code}}</td>
                        <td>{{$record->asset->amount}}</td>
                        <td>{{$record->asset->item_quantity}}</td>
                        <td>{{$record->asset->item_stock}}</td>
                        <td></td>
                        <td>{{$record->asset->created_at}}</td>
                        <td>{{$record->id}}</td>
                        <td>Assigned To: {{$record->assignedTo}}</td>
                        <td></td>
                    </tr>
                    @endforeach

                    {{--  @foreach ($IcslipData as $record)
                    <tr>
                        <td>{{$record->asset->details}}</td>
                        <td>{{$record->description}}</td>
                        <td>Sample Property</td>
                        <td>{{$record->asset->measurementUnit->unit_code}}</td>
                        <td>{{$record->asset->amount}}</td>
                        <td>{{$record->asset->item_quantity}}</td>
                        <td>{{$record->asset->item_stock}}</td>
                        <td></td>
                        <td>{{$record->asset->created_at}}</td>
                        <td>{{$record->id}}</td>
                        <td>Assigned To: {{$record->assignedTo}}</td>
                        <td></td>
                    </tr>
                    @endforeach  --}}

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>