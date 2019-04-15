
<!DOCTYPE html>
<html>
<head>
	<title>Abstract of Quotation</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	
	<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <link href="{{ asset('css/bootstrap3.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/all.min.css')}}">
	<style type="text/css">
		*{
			color:#262626;
		}
		[class^="col"] {
		    border: 1px solid #fff;
		}
		.well{
			border:solid #262626;
			border-radius: 0 !important;
		}
		.twg th, .twg td{
			text-align: center;
			border: #262626 solid 1px !important;
			font-size: 10px;
		}
		.content thead  tr th, .content thead  tr td, .content tbody tr td, .content tfoot tr th, .content tfoot tr td {
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
	</style>
</head>
<body>

<div class="container-fluid">
@foreach($abstract->purchaseRequest->prItem->chunk(15) as $checkitems)
	@foreach($abstract->outlineSupplier->chunk(3) as $checksupplier)
	<!-- start of header -->
	<div class="row">
		<div class="col-xs-3">
			<div>
				Total Estimated: <u> &#8369; {{$abstract->purchaseRequest->prItem()->sum('item_budget')}}</u>
			</div>
		</div>
		<div class="col-xs-6">
			<div class="col-xs-2 text-right" style="padding-top: 10px;">
				<img src="{{asset('img/sfclogo.png')}}" width="50px" height="50px">
			</div>
            <div class="col-xs-8 text-center">
              <div class="row">
              	<div class="col-xs-12" style="font-size: 14px;"><b>REPUBLIC OF THE PHILIPPINES</b></div>
                <div class="col-xs-12">City of San Fernando, La Union</div>
                <div class="col-xs-12"><b>INFORMATION TECHNOLOGY SECTION</b></div>
              </div>
            </div>
            <div class="col-xs-12 text-center">
			<b>ABSTRACT OF QUOTATION ON PROCUREMENT OF <u>{{strtoUpper($abstract->outline_detail)}}</u></b>
            </div>
		</div>
		<div class="col-xs-3" style="padding-right: 0px;padding-left: 40px;">
			<div class="well"></div>
		</div>
	</div>

	<!-- content -->
	<div class="row">
		<div class="col">&nbsp;</div>
		<!-- table -->
		<div class="col-xs-10">
			<div class="row">
			 <div class="col-xs-12">
				<table class="content table table-condensed table-bordered table-responsive">
					<thead>
						<tr>
							<th style="width: 35%;" rowspan="4" colspan="2">PARTICULARS</th>
					  		<th style="width: 5%;"rowspan="4">QTY</th>
					  		<th style="width: 5%;"rowspan="4">UNIT</th>

					  		@foreach($checksupplier as $key01 => $supplier_header)
					  		<th colspan="2">SUPPLIER {{$key01+1}}</th>
                            @endforeach
                              
                            @for($h=$checksupplier->count(); $h < 3 ;$h++)
									<th  colspan="2">SUPPLIER</th>	
							@endfor
					  	
						</tr>
						<tr>

						@foreach($checksupplier as $key02 => $supplier_name)
					  		<td @if(strlen($supplier_name->supplier) >= 20) style="font-size:11.5px;" @endif colspan="2">
					  			{{$supplier_name->supplier_name}}
					  		</td>
					  	@endforeach

					  		<!-- if the suppliers is lesser than 3 generate blank -->
					  		@if($checksupplier->count() < 3)
								@for($i=$checksupplier->count(); $i < 3 ;$i++)
									<td colspan="2"></td>	
								@endfor
							@endif  
					  		
						</tr>
						<tr>
						@foreach($checksupplier as $key03 => $supplier_address)
					  		<td colspan="2" @if(strlen($supplier_address->supplier_address) >= 20) style="font-size:11.5px;" @endif>
                                   {{$supplier_address->supplier_address}}
					  		</td>
					  	@endforeach

					  		<!-- if the suppliers is lesser than 3 generate blank -->
					  		@if($checksupplier->count() < 3)
								@for($j=$checksupplier->count(); $j < 3 ;$j++)
									<td colspan="2"></td>	
								@endfor
							@endif

						</tr>
						<tr>
						@foreach($checksupplier as $key04 => $price_head)
					  		<th style="font-size: 8px;">UNIT PRICE</th>
					  		<th style="font-size: 8px;">TOTAL PRICE</th>
					  		@endforeach

					  		<!-- if the suppliers is lesser than 3 generate blank -->
					  		@if($checksupplier->count() < 3)
								@for($k=$checksupplier->count(); $k < 3 ;$k++)
									<th style="font-size: 8px;">UNIT PRICE</th>
					  				<th style="font-size: 8px;">TOTAL PRICE</th>	
								@endfor
							@endif
						</tr>
					</thead>
					<tbody>
                    @if ($loop->parent)
                        @foreach($checkitems as $key05 => $items)
                            <tr>
                                <td style="width:3%;">{{$key05+1}}</td>
							    <td  style="text-align:left !important;">{{$items->ppmpItem->item_description}}</td>
							    <td>{{$items->item_quantity}}</td>
                                <td>{{$items->ppmpItem->measurementUnit->unit_code}}</td>
                                @foreach ($checksupplier as $supplierId)
                                    @php
                                        $price = $supplierId->outlinePrice()->where('pr_item_id', $items->id)->first(); 
                                    @endphp
                                    <td style="text-align:right !important;">{{number_format($price->final_cpu, 2)}}</td>
                                    <td style="text-align:right !important;">{{number_format($price->final_cpi, 2)}}</td>
                                @endforeach

                                <!-- if the suppliers is lesser than 3 generate blank -->
								@if($checksupplier->count() < 3)
								@for($k=$checksupplier->count(); $k < 3 ;$k++)
									<td></td>
                                    <td></td>	
								@endfor
							@endif
                            </tr>
                        @endforeach
                        <!-- if the items is lesser than 15 generate blank -->
						@if($checkitems->count() < 15)
							@for($m=$checkitems->count(); $m < 15 ;$m++)
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
								<td></td>
								<!-- if the suppliers is lesser than 3 generate blank -->
								@for($n=0; $n < 3 ;$n++)
									<td></td>
					  				<td></td>
								@endfor
							</tr>
							@endfor
						@endif
                    @endif
					</tbody>	
					<tfoot>
						<tr>
							<th colspan="2">TOTAL</th>
					  		<th></th>
                            <th></th>
                              
                            @foreach($checksupplier as $key06 => $sub_total)
                                @php
                                    $total = $sub_total->outlinePrice()->where('pr_item_id', $items->id)->first(); 
                                @endphp
					  		<th></th>
					  		<th style='text-align: right;'>&#8369;&nbsp; {{number_format($sub_total->outlinePrice()->sum('final_cpi'), 2)}}</th>
					  		@endforeach

					  		<!-- if the suppliers is lesser than 3 generate blank -->
					  		@if($checksupplier->count() < 3)
								@for($o=$checksupplier->count(); $o < 3 ;$o++)
									<td>&nbsp;</td>
					  				<td></td>
								@endfor
							@endif

						</tr> 
					</tfoot>	
				</table>
			 </div>
			</div>
			<!-- semi footer -->
			<div class="row">
				<div class="col">&nbsp;</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
                    @php
                        $bidder = $abstract->outlineSupplier()->where('supplier_status', TRUE)->first();
                    @endphp
					<b>SELECTED BIDDER:</b> <u>{{$bidder->supplier_name}}</u> <br/>
					<span @if($bidder->status_reason == 0) class="far fa-check-square" @else class="far fa-square" @endif style="margin-top: 5px;"></span> Lowest and Responsive Price Quotation
			 		<br><span @if($bidder->status_reason == 1) class="far fa-check-square" @else class="far fa-square" @endif style="margin-top: 5px;"></span> Most Responsive Price Quotation
				</div>
				<div class="col-xs-7">
					<b>NOTE ON BIDDER SELECTION:</b><br>
					{{strtoupper($abstract->outline_comment)}}<hr style="border:solid 1px #131221; margin-top: 0px;">
				</div>
			</div>
		</div>
		<!-- technical working group -->
		<div class="col-xs-2">
			<div class="row">
				<div class="col-xs-12 text-center" style="color: #ffffff !important;background:#262626;padding: 10px 0px; margin-bottom: 2px; font-weight: bold; border: 1px solid #262626;">
				TECHNICAL WORKING GROUP
				</div>
				<div class="col-xs-12" style="padding:0px;border: 1px solid #262626;">
					<table class="twg table table-condensed table-bordered" style="margin-bottom: 0px;">
						<tr style="background:#bfbfbf;">
							<td colspan="3">GOODS AND SUPPLIES</td>
						</tr>
						<tr>
							<td class="col-xs-4">Name</td>
							<td class="col-xs-4">Signature</td>
							<td class="col-xs-4">Date</td>
                        </tr>
                        @foreach ($twg->where('signatory_position', 'Goods & Supplies') as $twg_sign1)                 
						<tr style="font-size:10px !important;">
							<td>{{strtoUpper($twg_sign1->signatory_name)}}</td>
							<td></td>
							<td></td>
                        </tr>
                        @endforeach
						<tr style="background:#bfbfbf;">
							<td colspan="3">CONSTRUCTION AND SUPPLIES</td>
						</tr>
						@foreach ($twg->where('signatory_position', 'Construction & Supplies') as $twg_sign2)                 
						<tr>
							<td>{{strtoUpper($twg_sign2->signatory_name)}}</td>
							<td></td>
							<td></td>
                        </tr>
                        @endforeach
						<tr style="background:#bfbfbf;">
							<td colspan="3">AUTO REPAIR AND SUPPLIES</td>
                        </tr>
                        @foreach ($twg->where('signatory_position', 'Auto Repair & Supplies') as $twg_sign3)                 
						<tr style="font-size:10px !important;">
							<td>{{strtoUpper($twg_sign3->signatory_name)}}</td>
							<td></td>
							<td></td>
                        </tr>
                        @endforeach
						<tr style="background:#bfbfbf">
							<td colspan="3">IT AND SUPPLIES</td>
						</tr>
						@foreach ($twg->where('signatory_position', 'IT & Supplies') as $twg_sign3)                 
						<tr style="font-size:10px !important; ">
							<td>{{strtoUpper($twg_sign3->signatory_name)}}</td>
							<td></td>
							<td></td>
                        </tr>
                        @endforeach
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td style="font-size:9px;text-align: justify !important;" colspan="3">
							I certify that the assigned TWG Member has verified/validated the prices indicated by the supplier and has provided technical assistance to ensure relevance to the requirements of the End-User.
							</td>
						</tr>
						<tr style="font-size:10px;">
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr style="font-size:10px;">
							<td colspan="3">
								<b>MERCY G. GO</b> <br>
								TWG Chairman
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="row">
		<div class="col">&nbsp;</div>
		@if(strlen(strtoupper($abstract->outline_comment)) < 180 && strlen(strtoupper($abstract->outline_comment)) < 75)
		<div class="col">&nbsp;</div>
		<div class="col">&nbsp;</div>
		@elseif(strlen(strtoupper($abstract->outline_comment)) < 180 && strlen(strtoupper($abstract->outline_comment)) <= 80 && strlen(strtoupper($abstract->outline_comment)) > 75)
		<div class="col">&nbsp;</div>
		@endif
	</div>
	<div class="row text-center">
		<div class="col-xs-4"><b>{{strtoupper($abstract->purchaseRequest->signatory->signatory_name)}}</b><br>Requesting Office</div>
		<div class="col-xs-4"><b>CLEOPATRA A. NOCES</b><br>BAC Member</div>
		<div class="col-xs-4"><b>TERESITA M. GACAYAN</b><br>BAC Member</div>
	</div>
	<div class="row"><br><br></div>
	<div class="row text-center">
		<div class="col-xs-4"><b>ENGR. AMADO R. GACAYAN</b><br>BAC Member</div>
		<div class="col-xs-4"><b>ERNESTO V. DATUIN</b><br>BAC Vice-Chairman</div>
		<div class="col-xs-4"><b>ATTY. NANCY LOPEZ-BILAOEN</b><br>BAC Chairman</div>
	</div>
        @if(strlen(strtoupper($abstract->outline_comment)) < 180)
        <div class="row">
            <div class="col">&nbsp;</div>
        </div>
        @endif
    @endforeach
@endforeach
</div>
<span style="page-break-after:avoid;"></span>
</body>
</html>