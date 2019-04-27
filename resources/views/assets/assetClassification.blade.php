@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
    <li class="breadcrumb-item active" aria-current="page">List of Details </li>
</ol>
@endsection

@section('content')


<input type="hidden" name="assetDataCount" value="{{count($assetData->where('isEditable', 0))}}">
<form id="assetClassificationForm" action="{{route('assets.store')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="purchase_order_id" value={{$assetData[0]->purchase_order_id}}>

            {{--  <input type="hidden" name="purchase_order_no" value={{$poID}}>  --}}
    Disbursement Voucher No:<input type="text" class="form-control" placeholder="Input Voucher No" name="voucherNo">


    {{--  <input type="hidden" name="PO_id" value={{$id->searchPO}}></input> --}}
    <div class="container-fluid">
        <div class="card">
            <div class="card-header pt-2 pb-2">List of Item</div>
            <div class="card-body">
                <table id="prDatatable" class="table table-bordered table-hover table-sm display nowrap w-100">
                    <thead class="thead-dark">
                        <tr>
                            <th>Details</th>
                            <th>Amount</th>
                            <th>Item Qty</th>
                            <th>ICS</th>
                            <th>PAR</th>
                            <th>Asset Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assetData as $key => $record)
                        @if ($record['isEditable'] == 0)
                        <tr>
                            <input type="hidden" name="id[{{$key}}]" value={{$record['id']}}>
                            <td>{{$record['details']}}</td>
                            {{--  <input type="hidden" name="recordDetails[{{$key}}]" value={{$record['details']}}> --}}
                            <td>{{$record['amount']}}</td>
                            {{--  <input type="hidden" name="recordAmount[{{$key}}]" value={{$record['amount']}}> --}}

                            <td>{{$record['item_quantity']}}</td>

                            {{-- <td> <input type="hidden" name="ICS[{{$key}}]" value=0></input></td> --}}
                            <input type="hidden" name="ICS[{{$key}}]" value=0>
                            <td> <input type="checkbox" class="assetCheckboxSelection[{{$key}}]" name="ICS[{{$key}}]" value=1></td>

                            {{-- <td> <input type="hidden" name="PAR[{{$key}}]" value=0></input></td> --}}
                            <input type="hidden" name="PAR[{{$key}}]" value=0>
                            <td> <input type="checkbox" class="assetCheckboxSelection[{{$key}}]" name="PAR[{{$key}}]" value=1></td>
                            <td>
                                <select name="asset_type[{{$key}}]" class="custom-select">
                                    @foreach ($assetTypeData as $key => $record)
                                    <option value={{$key}}>{{$record['type_name']}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>

                <input type="submit" class="btn btn-primary">
                <br> <br>
                {{-- <button name="createPAR" class="btn btn-secondary"> Create PAR </button>
                <button name="createICS" class="btn btn-secondary"> Create ICS </button> --}}
                <a href="{{route('DistributeAssetsPAR.index', 'id=' . $assetData[0]->purchase_order_id)}}"
                    class="btn btn-secondary">create PAR</a>
                <a href="{{route('DistributeAssetsICS.index', 'id=' . $assetData[0]->purchase_order_id)}}"
                    class="btn btn-secondary">create ICS</a>

            </div>
        </div>
    </div>

</form>
@endsection

@section('script')
<script src="{{asset('js/assetClassification.js')}}"></script>
@endsection