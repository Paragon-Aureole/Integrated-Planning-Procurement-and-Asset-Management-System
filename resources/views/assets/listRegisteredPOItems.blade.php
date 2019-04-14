@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
        <li class="breadcrumb-item active" aria-current="page">Set Asset State </li>
    </ol>
@endsection

@section('content')
<label>PO ID:{{$fetchedData[0]->PO_id}}</label>
<table>
    <tr>
        <th> Details </th>
        <th> Amount </th>
        <th> Action </th>
    </tr>
@foreach ($fetchedData as $record)
<tr>
    <td>{{$record->details}}</td>
    <td>{{$record->amount}}</td>
    <td><a href="../{{$record->id}}">Show More</a></td>
</tr>

@endforeach

</table>

@endsection
