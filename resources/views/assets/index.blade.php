@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
        <li class="breadcrumb-item active" aria-current="page">Set Asset State </li>
    </ol>
@endsection

@section('content')
<form action="{{route('assets.assetClassification')}}" method="get">
    {{csrf_field()}}
    {{-- <label>Search PO:</label>
    <input name="searchPO" type="text"></input>
    <input type="submit"></input> --}}

    <div class="container">
        <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search for Purchase Order Number" name="purchase_order_id">
        <div class="input-group-append">
            <input class="btn btn-outline-secondary" type="submit" />
        </div>
    </div>
    </div>
</form>

@endsection

