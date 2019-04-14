@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('assets.index')}}">Assets</a></li>
        <li class="breadcrumb-item active" aria-current="page">Set Asset State </li>
    </ol>
@endsection

@section('content')
<form action="{{route('assets.update', $asset->id)}}" method="post">
    {{csrf_field()}}
    {{method_field('PATCH')}}

        <table>
                <thead>
                    <tr>
                        <th>Details</th>
                        <th>Amount</th>
                        <th>Sup.</th>
                        <th>ICS</th>
                        <th>PAR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$asset->details}}</td>
                        <input type="hidden" name="details" value={{$asset->details}}></input>
                        <td>{{$asset->amount}}</td>
                        <input type="hidden" name="amount" value={{$asset->amount}}></input>
                        
                        <td> <input type="hidden" name="isSup" value=0></input></td>
                        <td> <input type="checkbox" name="isSup" value=1 
                        @if ($asset->isSup == '1') checked @endif></input></td>
                        
                        <td> <input type="hidden" name="isICS" value=0></input></td>
                        <td> <input type="checkbox" name="isICS" value=1
                        @if ($asset->isICS == '1') checked @endif></input></td>
                        
                        <td> <input type="hidden" name="isPAR" value=0></input></td>
                        <td> <input type="checkbox" name="isPAR" value=1
                        @if ($asset->isPAR == '1') checked @endif></input></td>
                    </tr>
                </tbody>
        </table>

    <input type="submit">Bekkel</input>
</form>
@endsection
