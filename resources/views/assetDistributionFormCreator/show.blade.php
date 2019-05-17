@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('distribution.index')}}">Distribute Assets</a></li>
        <li class="breadcrumb-item active" aria-current="page">'Create New Form'</li>
    </ol>
@endsection

@section('content')

{{--  <form autocomplete="off" action="{{route('assets.show')}}" method="get">
    {{csrf_field()}}
    <label>Search:</label>
    <input id="searchPO" type="text"></input>
    <input type="submit"></input>
</form>  --}}

@endsection