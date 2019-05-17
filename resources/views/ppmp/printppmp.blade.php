<!DOCTYPE html>
<html>

<head>
	<title>PPMP</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<link href="{{ asset('css/bootstrap3.min.css') }}" rel="stylesheet">
	<style type="text/css">
		* {
			font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;
			color: #262626;
		}

		[class^="col"] {
			border: 1px solid #fff;
		}

		hr {
			margin: 0px;
			border: 1px solid #262626;
		}

		.content thead tr th,
		.content thead tr td,
		.content tbody tr td,
		.content tbody tr th,
		.content tfoot tr th {
			vertical-align: middle !important;
			text-align: center;
			border: #262626 solid 1px !important;
		}

		.content tbody tr td {
			padding: 1px 1px;
		}

		.well {
			border: 1px solid #262626;
			border-radius: 0 !important;
			padding: 3px;
		}

		.header {
			font-size: 10pt;
			font-weight: bold;
		}

		.total-foot tr th {
			border: #FFF solid 1px !important;
		}
	</style>
</head>

<body>
	@php
		$allppmp = $ppmp->ppmpItem()->get()->groupBy('ppmp_item_code_id')->chunk(100);
		// $allppmp = $ppmp->with(['ppmpItem' => function ($query) {
		// 				$query->get()->chunk(35);
		// 			}])->get()->groupBy('ppmp_item_code_id')->chunk(100);
	@endphp
@foreach($allppmp as $collection)
	<div class="container-fluid">
		<div class="row text-center header">
			<div class="col-xs-12">Republic of the Philippines</div>
			<div class="col-xs-12">Province of La Union</div>
			<div class="col-xs-12">City of San Fernando</div>
		</div>
		<div class="row text-center header">
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-12"> @if ($ppmp->is_supplemental == 1) Supplemental @endif Project Procurement Management
				Plan</div>
			<div class="col-xs-12">&nbsp;</div>
		</div>

		
		<div class="row">
			<table class="table table-bordered table-condensed content" style="table-layout: fixed;">
				<thead>
					<tr>
						<th rowspan="2" style="width:4%; text-align: center;">CODE</th>
						<th rowspan="2" style="width:27%; text-align: center;">GENERAL DESCRIPITON</th>
						<th rowspan="2" style="word-wrap: break-word;width:5%;text-align: center;">QTY/SIZE</th>
						<th rowspan="2" style="width:5%;text-align: center;">UNIT</th>
						<th rowspan="2" style="width:13%;text-align: center;">ESTIMATED BUDGET</th>
						<th rowspan="2" style="width:10%; text-align: center;">MODE OF PROCUREMENT</th>
						<th colspan="12" style="text-align: center;">SCHEDULE / MILESTONE OF ACTIVITIES </th>
					</tr>
					<tr>
						@for($m=1; $m<=12; ++$m) <th style="text-align: center;">
							{{strtoupper(date('M', mktime(0, 0, 0, $m, 1)))}} </th>
							@endfor
					</tr>
				</thead>
				<tbody>
					@foreach($collection as $key => $group)
					<tr>
						@php
						$ppmp_itmcode = App\PpmpItemCode::findorFail($key)
						@endphp
						<th colspan="18" style="text-align: justify;">{{strtoupper($ppmp_itmcode->code_description)}}
						</th>
					</tr>
					@foreach($group as $itemKey => $items)
					@php
					$schedule = explode(",", $items['item_schedule']);
					$unit = App\MeasurementUnit::findorFail($items['measurement_unit_id']);
					$mode = App\ProcurementMode::findorFail($items['procurement_mode_id']);
					@endphp
					<tr>
						<td></td>
						<td style="word-wrap: break-word; text-align: left;">{{$items['item_description']}}</td>
						<td style="word-wrap: break-word; text-align: center;">{{$items['item_quantity']}}</td>
						<td style="word-wrap: break-word; text-align: center;">{{$unit->unit_code}}</td>
						<td style="text-align: right;">{{number_format($items['item_budget'],2)}}</td>
						<td style="text-align: left;">{{$mode->method_name}}</td>

						@foreach($schedule as $milestones)
						<td>
							@if($milestones != 0)
							{{$milestones}}
							@endif
						</td>
						@endforeach
						@endforeach
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td style=" border:1px solid #FFF;" colspan="18">&nbsp;</td>
					</tr>
					<tr>
						<td style=" border:1px solid #FFF; text-align: right;" colspan="2"><b>TOTAL BUDGET</b></td>
						<td style=" border:1px solid #FFF; text-align: right;" colspan="3">
							<b>&#8369;
								{{number_format($ppmp->ppmpBudget->ppmp_est_budget, 2)}}</b>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		
		
		<div class="row">
			@php
			$office = App\Office::where('office_code', 'ADM')->first();
			$adm = App\Signatory::where('office_id', $office->id)->where('category','1')->where('is_activated',
			'1')->first();
			@endphp
			<div class="col-xs-12">
				Note: Technical Specifications for each Item/ Project being proposed shall be submitted as part of the
				PPMP
			</div>
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-3">
				Prepared by: <br><br><br>
				<div class="col-xs-12 text-center">
					@if($ppmp->signatory_id != null)
					<b>{{strtoUpper($ppmp->signatory->signatory_name)}}</b><br>
					{{$ppmp->signatory->signatory_position}}
					@else
					&nbsp;
					@endif
				</div>
			</div>
			@if($ppmp->office->office_code == "ICT")
			<div class="col-xs-3">
				Noted by: <br><br><br>
				<div class="col-xs-12 text-center">
					<b>{{strtoUpper($adm->signatory_name)}}</b><br>
					{{$adm->signatory_position}}
				</div>
			</div>
			@endif
	</div>
@endforeach
<span style="page-break-after:avoid;"></span>
</body>

</html>