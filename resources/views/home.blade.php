@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2 mb-2">
	<li class="breadcrumb-item active" aria-current="page">Home</li>
</ol>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">WELCOME</h4>
          <p class="card-text">{{$auth->wholename}}</p>
        </div>
      </div>
</div>
@endsection
