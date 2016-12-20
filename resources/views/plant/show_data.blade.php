@extends('layouts.plant')
@section('style')
	<!-- amCharts javascript sources -->
	<script type="text/javascript" src="https://www.amcharts.com/lib/3/amcharts.js"></script>
	<script type="text/javascript" src="https://www.amcharts.com/lib/3/serial.js"></script>
	
	<style>
	    #time{
    	    position: fixed;
    	    z-index:99;
            padding: 0px;
    		bottom:25px;
    		right:20px;
        }
	</style>
@endsection

@section('content')
	<!--<div id="time" class='w3-display-bottomright'>-->
 <!--   	<img src="{{ url('pic/time.png') }}" width="393" height="129">-->
 <!--   </div>-->
    
    
	<div class="w3-row-padding  w3-center">
	  <div class="w3-third">
	  	 @if($share)
	     	 <input id="user" type="hidden" value="{{ $plants->user->name }}"/>
	     @else
	     	 <input id="user" type="hidden" value=""/>
	     @endif
	     
	     <select id="myPlant" class="w3-select w3-round w3-border w3-center w3-pale-green">
	     @if($share)
		     <option value="{{ $plants->plant_id }}" onclick="showPlant({{ $plants->plant_id }})" selected>{{ $plants->plantname }}</option>
	     @else
			<option value="" disabled selected>Choose your plant</option>
			@foreach($plants as $plant)
			<option value="{{ $plant->plant_id }}" onclick="showPlant({{ $plant->plant_id }})">{{ $plant->plantname }}</option>
			@endforeach
		 @endif
		</select>
	  </div>
	  <div class="w3-third w3-pale-yellow">
	  	<label for="">環境</label>
	  	@foreach($environments as $name => $environment)
	    <input class="w3-radio" type="radio" name="environment" value="{{ $name }}" onclick="showData('{{ $name }}')" {{ $name=='pH' ? 'checked' : '' }}>
		<label class="w3-validate">{{ $environment }}</label>
		@endforeach
	  </div>
	  <div class="w3-third w3-pale-blue">
	  	<label for="">時段</label>
	  	<input class="w3-radio" type="radio" name="period" value="30" onclick="changePeriod('30')" checked>
		<label class="w3-validate">30天</label>
		<input class="w3-radio" type="radio" name="period" value="24" onclick="changePeriod('24')">
		<label class="w3-validate">24hr全年無休</label>
	  </div>
	</div>
		
	<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
	
	<!-- amCharts javascript code -->
	<script src="{{ url('js/amchart.js') }}"></script>
	<script>
		function callAjax()
		{
			if(plant == null) return ;
			$.ajax({
				url: '{{ url("getEnvData") }}',
				data: {
					plant_id: plant,
					period: period,
					env: env,
					share: '{{ $share }}',
					user_id: '{{ $plants->user->id or Auth::user()->id }}'
				},
				success: function(jData) {
					// $('body').html(jData);
					console.log(jData);
					if(jData.result == 'ok') {
						data = jData.ret;
						plant_name = jData.plant_name;
						method();
					} else {
						window.alert(jData.msg);
					}
				},
				error: function(error) {
					console.log('Ajax Error: ');
					$('body').html(error.responseText);
				}
			});
		}
	</script>
@endsection