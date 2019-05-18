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
        <div class="col-xs-12">As of {{Carbon\Carbon::now('+08:00')->format('F Y')}}</div>
            <div class="col-xs-12"><strong><u>{{$asset_type->type_name}}</u></strong></div>
            <div class="col-xs-12">(Type of Property, Plant and Equipment)</div>
            <div class="col-xs-12">&nbsp;</div>
        </div>
        <div class="row">
            <center>
                <table class="text-center">
                    <tr>
                        <td>For Which &nbsp</td>
                        {{-- @foreach ($parData as $parDataItem) --}}
                        <td><u>&nbsp;&nbsp;{{$parData->first()->assetPar->assignedTo}}&nbsp;&nbsp;</u>, &nbsp;</td>
                        <td><u>&nbsp;&nbsp;{{$parData->first()->assetPar->position}}&nbsp;&nbsp;</u>, &nbsp;</td>
                        <td><u>&nbsp;&nbsp;CSF&nbsp;&nbsp;</u>, &nbsp;</td>
                        {{-- @endforeach --}}
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
                            {{$parData->first()->assetPar->asset->purchaseOrder->purchaseRequest->office->office_name}}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    {{-- {{$parData->asset}} --}}
                    @foreach ($parData as $assetItem)
                    <tr>
                        @if ($assetItem->assetPar->asset->asset_type_id == $asset_type->id)
                        <td>{{$assetItem->assetPar->asset->details}}</td>
                        <td>{{$assetItem->description}}</td>
                        <td>&nbsp;</td>
                        <td>{{$assetItem->assetPar->asset->measurementUnit->unit_code}}</td>
                        <td>{{$assetItem->assetPar->asset->amount}}</td>
                        <td>{{$assetItem->assetPar->asset->item_quantity}}</td>
                        <td>{{$assetItem->assetPar->asset->item_stock}}</td>
                        <td>&nbsp;</td>
                        <td>{{$assetItem->assetPar->asset->created_at}}</td>
                        <td>Assigned To: {{$assetItem->assetPar->assignedTo}}</td>
                        <td></td>
                        @endif
                    </tr> 
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <span style="page-break-after:avoid;"></span>
</body>

</html>