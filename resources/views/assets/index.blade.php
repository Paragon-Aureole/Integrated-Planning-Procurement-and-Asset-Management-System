@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{route('view.ppmp')}}">PPMP</a></li>
        <li class="breadcrumb-item active" aria-current="page">Procured Assets</li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="card-deck mb-3 text-center">
            @for ($i = 0; $i < count($departments); $i++)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">{{$departments[$i]}}</h4>
                    </div>
                    <div class="card-body">
                        <br><br>
                            <h1 class="card-title pricing-card-title">{{$assets[$i]}}</h1>
                            <h3 class="text-muted">current Assets</h3>
                        <br><br>
                            <a type="button" class="btn btn-primary" href="/showDetails">More Details</a>
                    </div>
                </div>
            @endfor
            {{-- {{$arrange->links}} --}}
        </div>
    </div>
@endsection
