@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('distribution.index')}}">Distribute Assets</a></li>
        <li class="breadcrumb-item active" aria-current="page">Form Selection </li>
    </ol>
@endsection

@section('content')

<form autocomplete="off" action="{{route('distribution.create')}}" method="get">
    {{csrf_field()}}
    {{-- <label>Select Form To Create:</label>
    <select name="selectedOption">
        <option value="Supply">Supply</option>
        <option value="ICS">ICS</option>
        <option value="PAR">PAR</option>
    </select> --}}
    {{-- <input type="submit"></input> --}}

    <div class="container">
        <label>Select Form To Create:</label>
        <div class="input-group mb-3">
            <select class="custom-select" name="selectedOption">
                <option value="Supply">Supply</option>
                <option value="ICS">ICS</option>
                <option value="PAR">PAR</option>
            </select>
            <div class="input-group-append">
                <input class="btn btn-outline-secondary" type="submit" />
            </div>
        </div>
    </div>
</form>

@endsection