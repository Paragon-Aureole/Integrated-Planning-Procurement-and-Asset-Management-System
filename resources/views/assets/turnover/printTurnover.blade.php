<!DOCTYPE html>
<html>

<head>
    <title>Turnover Form</title>
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
    <table style="border: 1px solid black">
        <tr>
            <td>
                <div class="container">
                    <div class="container-fluid">
                        <div class="row text-center header">
                            <div class="col-xs-12"><b><i>Inspection Report</i></b></div>
                            <div class="col-xs-12">(Unserviceable Assets)</div>
                            <div class="col-xs-12">&nbsp;</div>
                        </div>
                        <div class="text-right">
                            <div class="col-xs-12">Form No.:__________</div>
                            <div class="col-xs-12">Date:__________</div>
                            <div class="text-center">I hereby turn-over the following item/items to the General Services
                                Office.</div>
                        </div>
                        <div class="row text-center">
                            <table
                                class=" table table-bordered table-hover table-sm table-condensed display nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Particulars</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            <textarea cols="50" rows="30"
                                                style="border:none;">
                                                    @foreach ($turnoverData as $turnoverDataItem)
                                                {{"&#13;&#10;" . $turnoverDataItem->assetParItem->description . "&#13;&#10;"}}
                                                @endforeach
                                            </textarea>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <div class="container">
                                                <div class="col-xs-12">&nbsp;</div>
                                                <div class="col-xs-12">&nbsp;</div>
                                                {{--  <div class="text-left">
                                                    Received by:
                                                </div>  --}}
                                                <div class="text-left">
                                                    <div class="col-xs-12"><u></u></div>
                                                    <div class="col-xs-12" style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;<u>{{$turnoverData->first()->assetParItem->assetPar->assignedTo}}</u>
                                                </div>
                                                <div class="col-xs-12" style="font-size:15px;">Name and Signature</div>
                                                <br>
                                            </div>
                                            <div class="row text-center header">
                                                <div class="col-xs-12">I hereby acknowledge the receipt of said property
                                                    / properties
                                                    enumerated above from ______________ found out to be ______________
                                                </div>
                                                <div class="col-xs-12">&nbsp;</div>
                                                <div class="col-xs-12">&nbsp;</div>

                                                <div class="text-left">
                                                    <div class="container">
                                                        <div class="col-xs-12">___________________</div>
                                                        <div class="col-xs-12">Property Inspector</div>
                                                        <div class="col-xs-12">&nbsp;</div>
                                                        <div class="col-xs-12">&nbsp;</div>
                                                        <div class="col-xs-12">Noted by:</div>
                                                        <div class="col-xs-12">&nbsp;</div>
                                                        <div class="col-xs-12">&nbsp;</div>
                                                        <div class="container">
                                                            <div class="col-xs-12"><b>TERESITA M. GACAYAN</b></div>
                                                            <div class="col-xs-12">OIC-City GSO</div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                        </div>
            </td>
        </tr>
        </tbody>
    </table>

    </div>
    </div>
    </div>
    </td>
    </tr>
    </table>

</body>

</html>