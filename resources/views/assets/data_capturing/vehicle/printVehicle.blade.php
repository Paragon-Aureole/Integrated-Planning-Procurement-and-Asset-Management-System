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
            <div class="col-xs-12">As of {{date("Y-m-d")}}</div>
            <div class="col-xs-12">&nbsp;</div>
        </div>
        <div class="row text-center">
            {{-- {{$assetData}} --}}
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
                        <th>Status/Condition/Worthiness</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assetData as $record)
                        @foreach ($record->purchaseOrder->assetPar as $item)
                            @php
                                $cost = ($record->amount / $record->item_quantity) * $item->assetParItem->first()->quantity;
                            @endphp
                            <tr>
                                <td></td>
                                <td>{{$record->purchaseOrder->purchaseRequest->prItem->first()->ppmpItem->first()->item_description}}</td>
                                <td></td>
                                <td></td>
                                <td>{{$item->assetParItem->first()->date_acquired}}</td>
                                <td>P{{number_format($cost, 2)}}</td>
                                <td>{{$record->purchaseOrder->purchaseRequest->office->office_code}}</td>
                                <td>{{$item->assignedTo}}</td>
                                <td>
                                    @if ($item->assetParItem->first()->itemStatus == 0)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </td>
                        @endforeach
                            </tr>
                    @endforeach

                    @foreach ($capturedData as $item)
                        <tr>
                            <td></td>
                            <td>{{$item->item_name}}</td>
                            <td></td>
                            <td></td>
                            <td>{{$item->date_acquired}}</td>
                            <td>P{{number_format($item->unit_cost, 2)}}</td>
                            <td>{{$item->Office->office_code}}</td>
                            <td>{{$item->receiver_name}}</td>
                            <td>
                                @if ($item->status == 'Active')
                                    Active
                                @elseif ($item->status == 'Unserviceable')
                                    Inactive 
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>