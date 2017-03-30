<script type="text/javascript" src="/app/controllers/ReportsController.js"></script>
<script src="https://sdk.amazonaws.com/js/aws-sdk-2.7.16.min.js"></script>

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
	
</div>

@endsection
