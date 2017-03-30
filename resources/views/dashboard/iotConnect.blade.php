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

<div class="col-md-6 col-offset-md-3">
	<div class="form-group row">
		<label for="example-text-input" class="col-2 col-form-label">Time</label>
		<div class="col-10">
			<input class="form-control" type="text" id="time_stamp">
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
</div>
@endsection
