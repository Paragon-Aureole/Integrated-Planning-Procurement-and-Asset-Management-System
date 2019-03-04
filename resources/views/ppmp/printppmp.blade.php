<!DOCTYPE html>
<html>
<head>
	<title>PPMP</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<link href="{{ asset('css/bootstrap4.min.css') }}" rel="stylesheet">
	<style type="text/css">
		*{
			font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif; 
			color:#262626;
		}
	</style>
	
</head>
<body>

	<div class="container-fluid">
		<div class="row text-center header">
			<div class="col-xs-12">Republic of the Philippines</div>
			<div class="col-xs-12">Province of La Union</div>
			<div class="col-xs-12">City of San Fernando</div>
		</div>
		<div class="row text-center header">
			<div class="col-xs-12">&nbsp;</div>
			<div class="col-xs-12"><b>Project Procurement Management Plan</b></div>
			<div class="col-xs-12">&nbsp;</div>
		</div>
		@foreach($ppmp->ppmpItem()->get() as $collection)
		<div class="row">
			<table class="table table-bordered table-hover table-sm display nowrap w-100">
				{{}}
			</table>	
		</div>		
		@endforeach
	</div>

</body>
</html>