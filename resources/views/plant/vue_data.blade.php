@extends('layouts.plant')
@section('style')
	<!-- amCharts javascript sources -->
	<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
	<script src="https://www.amcharts.com/lib/3/serial.js"></script>
@endsection

@section('content')
    
	<div id="app">
		<App url="{{ url('/') }}" myplants="{{ $plants->toJson() }}" share="{{ $share }}" myuser="{{ isset($user) ? $user->toJson() : Auth::user()->toJson() }}"></App>
	</div>
	
	<script src="{{ url('js/vue.js') }}"></script>

@endsection