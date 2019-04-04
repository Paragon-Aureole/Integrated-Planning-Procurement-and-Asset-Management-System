@extends('layouts.app')
@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item"><a href="{{route('abstract.index')}}">Abstract</a></li>
	<li class="breadcrumb-item active" aria-current="page">Abstract Supplier</li>
</ol>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header pt-2 pb- 2"><b>Add Suppliers</b></div>
        <div class="card-body">
            <form>
                <div>
                    <label>Purchase Request #</label>
                    <input value="">
                </div>
                <div>
                    <label>Procurement Of:</label>
                    <input value="">
                </div>
                <div>
                    <label>Requestor Name:</label>
                    <input value="">
                </div>
                <div>
                    <label>Requesting Office:</label>
                    <input value="">
                </div>
                <div>
                    <label>Selected Bidder:</label>
                    <select>
                        <option>Selected Bidder</option>
                    </select>
                </div>
                <div>
                    <label>Reason:</label>
                    <select>
                        <option>Selected Reason</option>
                    </select>
                </div>
                <div>
                    <label>Comments:</label>
                    <textarea></textarea>
                </div>   
            </form>
            <div>
                <table class="table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th rowspan="4">Particulars</th>
                            <th rowspan="4">Qty</th>
                            <th rowspan="4">Unit</th>
                            <th colspan="2">Action</th>
                        </tr>
                        <tr class="text-center">
                            <th colspan="2">Supplier #</th>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2">Supplier Name</td>
                        </tr>
                        <tr class="text-center">
                            <th>Price/Unit</th>
                            <th>Price/Item</th>
                        </tr> 
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>	
@endsection