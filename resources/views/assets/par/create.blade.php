@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
  <li class="breadcrumb-item active" aria-current="page">PAR Module </li>
</ol>
@endsection

@section('content')

<div id="bull">

</div>

@endsection

@section('script')
<script src="{{asset('js/area51.js')}}"></script>
@endsection