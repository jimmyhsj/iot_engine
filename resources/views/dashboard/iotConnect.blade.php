<script type="text/javascript" src="/js/bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="/js/bower_components/paho-mqtt-js/mqttws31.js"></script>
<script type="text/javascript" src="/js/bower_components/cryptojslib/rollups/sha256.js"></script>
<script type="text/javascript" src="/js/bower_components/cryptojslib/rollups/hmac-sha256.js"></script>
<script type="text/javascript" src="/js/iotws.js"></script>

@extends('layouts.angular')
{{-- @extends('app') --}}
@section('content')

<!-- Bootstrap Boilerplate... -->

<div class="panel-body">
	<!-- Display Validation Errors -->
	@include('common.errors')
	<!-- New Task Form -->
</div>

<div class="col-md-4 col-md-offset-1">
	<div class="form-group row">
		<label for="example-text-input" class="col-2 col-form-label">Start</label>
		<div class="col-10">
			<input class="form-control" type="text" id="start_time">
		</div>
	</div>
	<div class="form-group row">
		<label for="example-text-input" class="col-2 col-form-label">End</label>
		<div class="col-10">
			<input class="form-control" type="text" id="end_time">
		</div>
	</div>
	<div class="form-group row">
		<label for="example-search-input" class="col-2 col-form-label">State</label>
		<div class="col-10">
			<input class="form-control" type="search" id="state">
		</div>
	</div>
	<div class="form-group row">
		<button class="btn btn-primary" onclick="iotWsConnect()" class="btn-primary">Send</button>
	</div>
	<p>* Time format (eg. 2017-02-27 14:35:04)</p>
	<p>* Accepted Machine state: ON, OFF, SL (SL = Speed Loss)</p>
</div>
<div class="col-md-4 col-md-offset-1">
	<div class="form-group row">
		<label for="example-text-input" class="col-2 col-form-label">Time (minute)</label>
		<div class="col-10">
			<input class="form-control" type="text" id="count_time">
		</div>
	</div>
	<div class="form-group row">
		<label for="example-text-input" class="col-2 col-form-label">Production Count</label>
		<div class="col-10">
			<input class="form-control" type="text" id="prod_count">
		</div>
	</div>
	<div class="form-group row">
		<button class="btn btn-primary" onclick="iotCountWsConnect()" class="btn-primary">Send</button>
	</div>
</div>
@endsection
