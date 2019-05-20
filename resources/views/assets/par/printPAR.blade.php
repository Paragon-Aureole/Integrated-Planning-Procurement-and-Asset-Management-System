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
            <div class="text-right">PAR No.: {{$parData->first()->assetPar->id}}</div>
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
                    
                    
                    
                    @foreach ($parData as $record)
                    <tr>
                    @php
                     $unitCost = $record->asset->amount / $record->asset->item_quantity;
                     $quantity = $record->quantity;   
                    @endphp
                    
                    <td>{{$record->quantity}}</td>
                    <td>{{$record->asset->measurementUnit->unit_code}}</td>
                    <td>
                        <div class="text-left">{{$record->asset->details}}</div>
                        <div class="text-left">{{$record->description}}</div>
                    </td>
                    <td>{{$record->property_no}}</td>
                    <td>{{$record->date_acquired}}</td>
                    <td>{{number_format($unitCost, 2)}}</td>
                    <td>{{number_format(($unitCost * $quantity),2)}}</td>
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
                                    <div class="col-xs-12">{{$parData->first()->assetPar->assignedTo}}</div>
                                    <div class="col-xs-12" style="font-size:15px;">Signature over Printed Name of End
                                        User</div><br>
                                    <div class="col-xs-12">{{$parData->first()->assetPar->position}}</div>
                                    <div class="col-xs-12" style="font-size:15px;">Position/Office</div><br><br>
                                    <div class="col-xs-12" style="font-size:15px;">@php echo date("Y-m-d H:i:s");
                                    @endphp</div>
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
                                    <div class="col-xs-12" style="font-size:15px;">@php echo date("Y-m-d H:i:s");
                                    @endphp</div>
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