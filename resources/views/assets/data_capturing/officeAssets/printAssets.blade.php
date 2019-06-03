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
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @if ($parData->first()->purchaseOrder->purchaseRequest->office->id)
        <div class="container-fluid">
            <div class="row text-center header">
                <div class="col-xs-12">REPORT OF THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT</div>
                <div class="col-xs-12">As of {{Carbon\Carbon::now('+08:00')->format('F Y')}}</div>
                <div class="col-xs-12"><strong><u>OFFICE SUPPLIES</u></strong></div>
                <div class="col-xs-12">(Type of Property, Plant and Equipment)</div>
                <div class="col-xs-12">&nbsp;</div>
            </div>
            <div class="row">
                <center>
                    <table class="text-center">
                        <tr>
                            <td>For Which &nbsp</td>
                            {{-- @foreach ($parData as $parDataItem) --}}
                            <td><u>&nbsp;&nbsp;{{$parData->first()->assignedTo}}&nbsp;&nbsp;</u>, &nbsp;</td>
                            <td><u>&nbsp;&nbsp;{{$parData->first()->position}}&nbsp;&nbsp;</u>, &nbsp;</td>
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
                                {{$parData->first()->purchaseOrder->purchaseRequest->office->office_code}}</td>
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
                        @foreach ($parData as $assetItem)
                            @foreach ($assetItem->assetParItem as $item)
                                @php
                                    $value = $item->asset->amount / $item->asset->item_quantity;
                                @endphp
                                <tr class="text-center">
                                    @if ($item->asset->asset_type_id == 2)
                                        <td class="text-left" width="10%">{{$item->asset->details}}</td>
                                        <td class="text-left" width="20%">{{$item->description}}</td>
                                        <td>{{$item->property_no}}</td>
                                        <td>{{$item->asset->measurementUnit->unit_description}}</td>
                                        <td class="text-right">P{{number_format($value, 2)}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>&nbsp;</td>
                                        <td>{{$assetItem->purchaseOrder->created_at}}</td>
                                        <td>&nbsp;</td>
                                    @endif
                                </tr> 
                            @endforeach
                        @endforeach
    
                        @foreach ($parMigrationData as $assetItem)
                            @if ($assetItem->asset_type_id == 2)
                                <tr class="text-center">
                                    <td class="text-left" width="10%">{{$assetItem->item_name}}</td>
                                    <td class="text-left" width="20%">{{$assetItem->description}}</td>
                                    <td>{{$assetItem->property_number}}</td>
                                    <td>{{$assetItem->item_unit}}</td>
                                    <td class="text-right">P{{number_format($assetItem->amount, 2)}}</td>
                                    <td>{{$assetItem->item_quantity}}</td>
                                    <td>{{$assetItem->item_quantity}}</td>
                                    <td>&nbsp;</td>
                                    <td>{{$assetItem->date_acquired}}</td>
                                    <td>&nbsp;</td>
                                </tr> 
                            @endif
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>

        <div class="page-break"></div>
        <div class="container-fluid">
            <div class="row text-center header">
                <div class="col-xs-12">REPORT OF THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT</div>
                <div class="col-xs-12">As of {{Carbon\Carbon::now('+08:00')->format('F Y')}}</div>
                <div class="col-xs-12"><strong><u>FURNITURES AND FIXTURES</u></strong></div>
                <div class="col-xs-12">(Type of Property, Plant and Equipment)</div>
                <div class="col-xs-12">&nbsp;</div>
            </div>
            <div class="row">
                <center>
                    <table class="text-center">
                        <tr>
                            <td>For Which &nbsp</td>
                            {{-- @foreach ($parData as $parDataItem) --}}
                            <td><u>&nbsp;&nbsp;{{$parData->first()->assignedTo}}&nbsp;&nbsp;</u>, &nbsp;</td>
                            <td><u>&nbsp;&nbsp;{{$parData->first()->position}}&nbsp;&nbsp;</u>, &nbsp;</td>
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
                                {{$parData->first()->purchaseOrder->purchaseRequest->office->office_code}}</td>
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
                        @foreach ($parData as $assetItem)
                            @foreach ($assetItem->assetParItem as $item)
                                @php
                                    $value = $item->asset->amount / $item->asset->item_quantity;
                                @endphp
                                <tr class="text-center">
                                    @if ($item->asset->asset_type_id == 3)
                                        <td class="text-left" width="10%">{{$item->asset->details}}</td>
                                        <td class="text-left" width="20%">{{$item->description}}</td>
                                        <td>{{$item->property_no}}</td>
                                        <td>{{$item->asset->measurementUnit->unit_description}}</td>
                                        <td class="text-right">P{{number_format($value, 2)}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>&nbsp;</td>
                                        <td>{{$assetItem->purchaseOrder->created_at}}</td>
                                        <td>&nbsp;</td>
                                    @endif
                                </tr> 
                            @endforeach
                        @endforeach
    
                        @foreach ($parMigrationData as $assetItem)
                            @if ($assetItem->asset_type_id == 3)
                                <tr class="text-center">
                                    <td class="text-left" width="10%">{{$assetItem->item_name}}</td>
                                    <td class="text-left" width="20%">{{$assetItem->description}}</td>
                                    <td>{{$assetItem->property_number}}</td>
                                    <td>{{$assetItem->item_unit}}</td>
                                    <td class="text-right">P{{number_format($assetItem->amount, 2)}}</td>
                                    <td>{{$assetItem->item_quantity}}</td>
                                    <td>{{$assetItem->item_quantity}}</td>
                                    <td>&nbsp;</td>
                                    <td>{{$assetItem->date_acquired}}</td>
                                    <td>&nbsp;</td>
                                </tr> 
                            @endif
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="page-break"></div>
        <div class="container-fluid">
            <div class="row text-center header">
                <div class="col-xs-12">REPORT OF THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT</div>
                <div class="col-xs-12">As of {{Carbon\Carbon::now('+08:00')->format('F Y')}}</div>
                <div class="col-xs-12"><strong><u>OFFICE EQUIPMENTS</u></strong></div>
                <div class="col-xs-12">(Type of Property, Plant and Equipment)</div>
                <div class="col-xs-12">&nbsp;</div>
            </div>
            <div class="row">
                <center>
                    <table class="text-center">
                        <tr>
                            <td>For Which &nbsp</td>
                            {{-- @foreach ($parData as $parDataItem) --}}
                            <td><u>&nbsp;&nbsp;{{$parData->first()->assignedTo}}&nbsp;&nbsp;</u>, &nbsp;</td>
                            <td><u>&nbsp;&nbsp;{{$parData->first()->position}}&nbsp;&nbsp;</u>, &nbsp;</td>
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
                                {{$parData->first()->purchaseOrder->purchaseRequest->office->office_code}}</td>
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
                        @foreach ($parData as $assetItem)
                            @foreach ($assetItem->assetParItem as $item)
                                @php
                                    $value = $item->asset->amount / $item->asset->item_quantity;
                                @endphp
                                <tr class="text-center">
                                    @if ($item->asset->asset_type_id == 4)
                                        <td class="text-left" width="10%">{{$item->asset->details}}</td>
                                        <td class="text-left" width="20%">{{$item->description}}</td>
                                        <td>{{$item->property_no}}</td>
                                        <td>{{$item->asset->measurementUnit->unit_description}}</td>
                                        <td class="text-right">P{{number_format($value, 2)}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>&nbsp;</td>
                                        <td>{{$assetItem->purchaseOrder->created_at}}</td>
                                        <td>&nbsp;</td>
                                    @endif
                                </tr> 
                            @endforeach
                        @endforeach
    
                        @foreach ($parMigrationData as $assetItem)
                            @if ($assetItem->asset_type_id == 4)
                                <tr class="text-center">
                                    <td class="text-left" width="10%">{{$assetItem->item_name}}</td>
                                    <td class="text-left" width="20%">{{$assetItem->description}}</td>
                                    <td>{{$assetItem->property_number}}</td>
                                    <td>{{$assetItem->item_unit}}</td>
                                    <td class="text-right">P{{number_format($assetItem->amount, 2)}}</td>
                                    <td>{{$assetItem->item_quantity}}</td>
                                    <td>{{$assetItem->item_quantity}}</td>
                                    <td>&nbsp;</td>
                                    <td>{{$assetItem->date_acquired}}</td>
                                    <td>&nbsp;</td>
                                </tr> 
                            @endif
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</body>

</html>