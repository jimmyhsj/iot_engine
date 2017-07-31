

<script src="https://sdk.amazonaws.com/js/aws-sdk-2.7.16.min.js"></script>

<script src="/js/amcharts/amcharts.js"></script>
<script src="/js/amcharts/serial.js"></script>
<script src="/js/amcharts/gantt.js"></script>
<script src="/js/amcharts/pie.js"></script>
<script src="/js/amcharts/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="/js/amcharts/plugins/export/export.css" type="text/css" media="all" />
<script src="/js/amcharts/themes/light.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<style>
#chartdiv {
  width: 100%;
  height: 300px;
}

#piediv {
  width: 100%;
  height: 400px;
  font-size: 11px;
}
#prod_div {
	width		: 100%;
	height		: 300px;
	font-size	: 11px;
}	

.amcharts-pie-slice {
  transform: scale(1);
  transform-origin: 50% 50%;
  transition-duration: 0.3s;
  transition: all .3s ease-out;
  -webkit-transition: all .3s ease-out;
  -moz-transition: all .3s ease-out;
  -o-transition: all .3s ease-out;
  cursor: pointer;
  box-shadow: 0 0 30px 0 #000;
}

.amcharts-pie-slice:hover {
  transform: scale(1.1);
  filter: url(#shadow);
}							

</style>

@extends('layouts.angular')
{{-- @extends('app') --}}
@section('content')

<!-- Bootstrap Boilerplate... -->

<div class="panel-body">
	<!-- Display Validation Errors -->
	@include('common.errors')
	<!-- New Task Form -->

</div>

<div ng-controller="ReportsController" class="" id="chronReport">
	{{-- <div id="calendar_basic" style="width: 100%; height: 350px;"></div> --}}
	{{-- <hr> --}}
	<div id="piediv"></div>
	<div id="chartdiv"></div>
	<div id="prod_div"></div>
	<br><br><hr>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-condensed table-hover table-striped">
				<caption>Production Summary</caption>
				<thead>
					<tr>
						<th>State</th>
						<th>Duration (seconds)</th>
						<th>Start</th>
						<th>End</th>
						<th>Count</th>
					</tr>
				</thead>
				<tbody id="statesBody">
					
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection
