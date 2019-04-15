<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	
	<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<link href="{{ asset('css/bootstrap3.min.css') }}" rel="stylesheet">
	<style type="text/css">
		*{color:#262626;}

		/*[class^="col"] {border: 1px solid #FFF;}*/

		/*#logosfc{margin-top: 5px;}*/

		.well{
			border:solid #262626;
			border-radius: 0 !important;
			margin-top: 15px;
			background: #262626 !important;
			color: #fff !important;
			padding: 5px;
			font-size: 20px;
			font-weight: bold;
			text-align: center;
		}
		.header-pr div{font-size: 16px;font-weight: bold;}

		.header-pr .heading2{
			font-size: 18px !important;
			background: #262626 !important;
			color: #fff !important;
			text-align: center;
			font-weight: bold;
			border:1px solid #262626;
		}
		.heading-sm{
			background: #262626 !important;
			color: #fff !important;
			font-weight: bold;
		}
		.content thead  tr th, .content thead  tr td, .content tbody tr td, .content tfoot tr th {
			vertical-align: middle !important;
			text-align: center;
			border: #262626 solid 1px !important;
		}
		.content tbody tr td{
			padding: 1px 1px;
		}
		.content thead  tr th,.content tfoot tr th{
			background:#bfbfbf;
		}

		hr{margin:0px; border: 1px solid #262626;}

		.head-label{margin-top: 1px;padding: 0px;}

		.topped{margin-top:10px;}
		.topped-border{border:1px solid #262626;}
		.f-12-px{font-size: 12px;}

	</style>
</head>
<body>
@foreach($rfq->purchaseRequest->prItem->chunk(15) as $dos)
<div class="container-fluid">
	<!-- start of header -->
	<div class="row">
		<div class="col-xs-3">
		</div>
		<div class="col-xs-6">
			<div class="col-xs-2 text-right">
				<img id="logosfc" src="{{asset('img/sfclogo.png')}}" width="60px" height="60px">
			</div>
            <div class="col-xs-8 text-center">
              <div class="row header-pr">
              	<div class="col-xs-12">REPUBLIC OF THE PHILIPPINES</div>
                <div class="col-xs-12">PROVINCE OF LA UNION</div>
                <div class="col-xs-12">CITY OF SAN FERNANDO</div>
              </div>
            </div>
            <div class="col-xs-2">
            	<div class="well">RFQ</div>
            </div>
		</div>
		<div class="col-xs-3">
		</div>
	</div>

	<div class="row header-pr" style="border:1px solid #262626;">
		<div class="col-xs-12 heading2">REQUEST FOR QUOTATION</div>
	</div>

	<div class="row topped">
		<div class="col-xs-4 topped-border" style="padding: 0px;">
			<div class="col-xs-12 topped-border heading-sm">SUPPLIER</div>
			<div class="col-xs-12 f-12-px">Name/Company:<br>
				@if($rfq->purchaseRequest->supplier_type == "3")
					{{$rfq->purchaseRequest->distributor->distributor_name}}
                @else <br> @endif
                {{--  <br>  --}}
				<hr></div>
			<div class="col-xs-12 f-12-px">Address:<br><br><hr></div>
			<div class="col-xs-12 f-12-px" style="margin-bottom: 10px;">Contact No:<hr style="margin-left:80px;"></div>
		</div>
		<div class="col-xs-5"></div>
		<div class="col-xs-3 topped-border" style="padding: 0px;" >
			<div class="col-xs-4 text-center topped-border heading-sm">DATE</div>
			<div class="col-xs-8">{{$date}}</div>
		</div>
	</div>

	<div class="row topped">
		<div class="col-xs-12">Sir/Madam,<br>
		We would like to request for quotation from your company on the following items/articles.
		</div>
	</div>

	<!-- content -->
	<div class="row">
		<table class="table table-condensed table-bordered content">
			<thead>
				<tr>
					<th class="col-xs-1">QTY</th>
					<th class="col-xs-1">UNIT</th>
					<th class="col-xs-6">DESCRIPTION</th>
					<th class="col-xs-2">UNIT PRICE</th>
					<th class="col-xs-2">TOTAL</th>
				</tr>
			</thead>
			<tbody>
                @foreach($dos as $key01=>$items)
                {{--  @php var_dump($items); @endphp  --}}
				<tr>
					<td>{{$items->item_quantity}}</td>
					<td>{{$items->ppmpItem->measurementUnit->unit_code}}</td>
					<td>
			      		{{$items->ppmpItem->item_description}}
					</td>
					<td></td>
					<td></td>
				</tr>
				@endforeach
				@if($dos->count() < 15)
					@for($i=$dos->count();$i < 15;$i++)
					<tr>
						@for($j = 0; $j < 5; $j++)
						<td>&nbsp;</td>
						@endfor
					</tr>
					@endfor
				@endif
			</tbody>
			<tfoot>
				<tr>
					<th style="text-align: right;" colspan="4">GRAND TOTAL</th>
					<th style="text-align: right;"></th>
				</tr>
			</tfoot>
		</table>
		<div class="col-xs-9"></div>
		<div class="col-xs-3" style="margin-top: -10px;">
			Very Truly Yours,<br><br>
			TERESITA M. GACAYAN<br>
			The CITY GENERAL SERVICES OFFICER
		</div>
	</div>
	<!-- footer -->
	<div class="row">
		<hr>
		<div class="col-xs-6 topped-border" style="padding: 0px;margin-top: 5px;">
			<div class="col-xs-12">
			I certify that I personally requested for quotation and the prices herein indicated have been given by the supplier.<br><br><br>
			</div>
			<div class="col-xs-4 text-center">{{Auth::user()->wholename}}<hr>Name & Signature of Canvasser</div>
			<div class="col-xs-4 text-center">{{Auth::user()->contact_number}}<hr>Contact No. (Required)</div>
			<div class="col-xs-4 text-center">{{$rfq->purchaseRequest->office->office_code}}<hr>Department</div>
		</div>
		<div class="col-xs-1"></div>
		<div class="col-xs-5 topped topped-border" style="padding: 0px;margin-top: 5px;">
			<div class="col-xs-12">
				TO THE CANVASSER<br>
				City of San Fernando<br>
			</div>
			<div class="col-xs-12">
				Sir/Madam:<br>
				&nbsp;&nbsp;&nbsp;&nbsp;My prices for the above stated articles are as indicated opposite each item.<br><br>
			</div>
			<div class="col-xs-6 text-center"><hr>Signature Over Printed Name (Dealer/Supplier)</div>
			<div class="col-xs-6 text-center"><hr>Contact No. (Required)</div>
		</div>
	</div>
</div>
@if($rfq->purchaseRequest->supplier_type == "3")
@else
<div class="container-fluid">
	<!-- start of header -->
	<div class="row">
		<div class="col-xs-3">
		</div>
		<div class="col-xs-6">
			<div class="col-xs-2 text-right">
				<img id="logosfc" src="{{asset('img/sfclogo.png')}}" width="60px" height="60px">
			</div>
            <div class="col-xs-8 text-center">
              <div class="row header-pr">
              	<div class="col-xs-12">REPUBLIC OF THE PHILIPPINES</div>
                <div class="col-xs-12">PROVINCE OF LA UNION</div>
                <div class="col-xs-12">CITY OF SAN FERNANDO</div>
              </div>
            </div>
            <div class="col-xs-2">
            	<div class="well">RFQ</div>
            </div>
		</div>
		<div class="col-xs-3">
		</div>
	</div>

	<div class="row header-pr" style="border:1px solid #262626;">
		<div class="col-xs-12 heading2">REQUEST FOR QUOTATION</div>
	</div>

	<div class="row topped">
		<div class="col-xs-4 topped-border" style="padding: 0px;">
			<div class="col-xs-12 topped-border heading-sm">SUPPLIER</div>
			<div class="col-xs-12 f-12-px">Name/Company:<br><br><hr></div>
			<div class="col-xs-12 f-12-px">Address:<br><br><hr></div>
			<div class="col-xs-12 f-12-px" style="margin-bottom: 10px;">Contact No:<hr style="margin-left:80px;"></div>
		</div>
		<div class="col-xs-5"></div>
		<div class="col-xs-3 topped-border" style="padding: 0px;" >
			<div class="col-xs-4 text-center topped-border heading-sm">DATE</div>
			<div class="col-xs-8">{{$date}}</div>
		</div>
	</div>

	<div class="row topped">
		<div class="col-xs-12">Sir/Madam,<br>
		We would like to request for quotation from your company on the following items/articles.
		</div>
	</div>

	<!-- content -->
	<div class="row">
		<table class="table table-condensed table-bordered content">
			<thead>
				<tr>
					<th class="col-xs-1">QTY</th>
					<th class="col-xs-1">UNIT</th>
					<th class="col-xs-6">DESCRIPTION</th>
					<th class="col-xs-2">UNIT PRICE</th>
					<th class="col-xs-2">TOTAL</th>
				</tr>
			</thead>
			<tbody>
				@foreach($dos as $key02=>$item)
				<tr>
					<td>{{$items->item_quantity}}</td>
					<td>{{$items->ppmpItem->measurementUnit->unit_code}}</td>
					<td>
			      		{{$items->ppmpItem->item_description}}
					</td>
					<td></td>
					<td></td>
				</tr>
				@endforeach
				@if($dos->count() < 15)
					@for($k=$dos->count();$k < 15;$k++)
					<tr>
						@for($l = 0; $l < 5; $l++)
						<td>&nbsp;</td>
						@endfor
					</tr>
					@endfor
				@endif
			</tbody>
			<tfoot>
				<tr>
					<th style="text-align: right;" colspan="4">GRAND TOTAL</th>
					<th style="text-align: right;"></th>
				</tr>
			</tfoot>
		</table>
		<div class="col-xs-9"></div>
		<div class="col-xs-3" style="margin-top: -10px;">
			Very Truly Yours,<br><br>
			TERESITA M. GACAYAN<br>
			The CITY GENERAL SERVICES OFFICER
		</div>
	</div>
	<!-- footer -->
	<div class="row">
		<hr>
		<div class="col-xs-6 topped-border" style="padding: 0px;margin-top: 5px;">
			<div class="col-xs-12">
			I certify that I personally requested for quotation and the prices herein indicated have been given by the supplier.<br><br><br>
			</div>
			<div class="col-xs-4 text-center"><span style="color:#FFF;">A</span><hr>Name & Signature of Canvasser</div>
			<div class="col-xs-4 text-center"><span style="color:#FFF;">A</span><hr>Contact No. (Required)</div>
			<div class="col-xs-4 text-center">GSO<hr>Department</div>
		</div>
		<div class="col-xs-1"></div>
		<div class="col-xs-5 topped topped-border" style="padding: 0px;margin-top: 5px;">
			<div class="col-xs-12">
				TO THE CANVASSER<br>
				City of San Fernando<br>
			</div>
			<div class="col-xs-12">
				Sir/Madam:<br>
				&nbsp;&nbsp;&nbsp;&nbsp;My prices for the above stated articles are as indicated opposite each item.<br><br>
			</div>
			<div class="col-xs-6 text-center"><hr>Signature Over Printed Name (Dealer/Supplier)</div>
			<div class="col-xs-6 text-center"><hr>Contact No. (Required)</div>
		</div>
	</div>
</div>
@endif
@endforeach
<span style="page-break-after:avoid;"></span>

<!-- scripts -->
<script src="{{ asset('js/datatables.js') }}"></script>
{{--  <script src="{{ asset('js/bootstrap.min.js') }}"></script>  --}}
<!-- end scripts -->
</body>
</html>