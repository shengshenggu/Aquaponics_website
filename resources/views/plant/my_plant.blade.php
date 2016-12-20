@extends('layouts.plant')

@section('style')
<link rel="stylesheet" href="{{ url('css/lightbox.min.css') }}">
@endsection

@section('content')
	<div class="w3-display-middle" style="position:fixed; z-index: 9999;" id="loading"><i class="fa fa-spinner fa-spin w3-text-teal w3-jumbo"></i></div>
	<p id="other" style="text-align:center;"></p>
	<div id="showmsg" align="center" class="w3-container w3-margin-bottom">
	<h2>your plants <input  type="image"  name="submit_Btn"  id="submit_Btn" data-toggle="modal" data-target="#myModal_teach" img src="{{ url('img/536217.jpg') }}" style="width:30px;height:30px;"></h2>

		<!-- Trigger the modal with a button -->
		@foreach($myPlants as $index => $myPlant)
			<button type="button" class="btn btn-info btn-lg" onclick="document.getElementById('myModal{{ $myPlant->id }}').style.display='block'">{{ $myPlant->plantname }}</button>

			<div id="myModal{{ $myPlant->id }}" class="w3-modal">
				<div class="w3-modal-content w3-animate-top  w3-round-large">
			      <header class="w3-container w3-white w3-border-bottom w3-padding  w3-round-large"> 
			        <span onclick="document.getElementById('myModal{{ $myPlant->id }}').style.display='none'" 
			        class="w3-closebtn">&times;</span>
			        <h4 class="modal-title">種植時間</h4>
			      </header>
			      <div class="w3-container w3-padding">
			      	    <div class="form-group">
							<label for="start">開始時間：</label>
							<input class="form-control" id="time_start" readonly value="{{ $myPlant->startdate }}">
						
							<label for="end">結束時間</label>
							<input id="end{{ $myPlant->id }}" class="form-control" type="date" value="{{ $myPlant->enddate or '' }}" onchange="getDate('end{{ $myPlant->id }}')">
        					
						</div>
			      </div>
			      <footer class="w3-container w3-white w3-border-top w3-padding w3-round-large">
			          <div class=" w3-right ">
					      <button type="submit" class="btn btn-default" onclick="add_endtime({{ $myPlant->id }})">送出</button>
						  <button type="button" class="btn btn-default" onclick="document.getElementById('myModal{{ $myPlant->id }}').style.display='none'">關閉</button>
					  </div>
			      </footer>
			    </div>
			</div>
		@endforeach
	</div>

	@include('plant.gallery')

    
    <div class="modal fade" id="myModal_teach" role="dialog">
			<div class="modal-dialog">
		
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Q&A</h4>
					</div>
					<div class="modal-body"  style="text-align:left;">
						<p>Q：要怎麼結束種植？</p>
						<p>A：按下按鈕後，填入結束種植日期</p>
						<hr>
						<p>Q：要怎麼增加植物</p>
						<p>A：回到plant library即可增加植物</p>
						<hr>
						<p>Q：這些照片是什麼時候的照片？</p>
						<p>A：滑鼠移到照片上就可以知道囉！</p>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
						</div>
						
					</div>
				</div>
			</div></div>

<!-- Alert Information -->
<div id="other1" class="w3-modal">
  <div class="w3-modal-content w3-round w3-animate-zoom">
    <header class="w3-container w3-green w3-round"> 
      <span onclick="document.getElementById('other1').style.display='none'" 
      class="w3-closebtn">&times;</span>
      <h5>Alert Information</h5>
    </header>
    <div class="w3-container w3-center">
      <h4>設定結束時間成功～ <i class="fa fa-smile-o"></i></h4>
    </div>
  </div>
</div>

<div id="other2" class="w3-modal">
  <div class="w3-modal-content w3-round w3-animate-zoom">
    <header class="w3-container w3-red w3-round"> 
      <span onclick="document.getElementById('other2').style.display='none'" 
      class="w3-closebtn">&times;</span>
      <h5>Alert Information</h5>
    </header>
    <div class="w3-container w3-center">
      <h4>Oh~No! 設定結束時間失敗 <i class="fa fa-frown-o"></i></h4>
    </div>
  </div>
</div>

<script>
	$('document').ready(function () {
	    $('#loading').fadeOut();
    });

    var date;
    function getDate(id){
        date = document.getElementById('end'+id).value;
        //alert(date);
    }
    
    /**
     * 當點擊加入植物後，使用Ajax去新增my_plants資料
     */
    function add_endtime(plant_id) {
        //var date = document.getElementById('bookdate').value;
        getDate(plant_id);
        console.log(date);
      $.ajax({
          type: 'POST',
          url: '{{ url("endPlant") }}',
          dataType: 'json',
          data: {
              myPlantId: plant_id,
              endDate: date,
              _token: '{{ csrf_token() }}'
          },
          success: function(jData) {
              if (jData.result == 'ok')
                  setMessage('success', jData.msg);
              else
                  setMessage('error', jData.msg);
          },
          error: function(error) {
          	console.log(error);
              setMessage('error', '加入結束時間的Ajax 發生錯誤');
          }
      });
    }

    /**
     * 當使用ajax時, 成功或失敗都可以呼叫此function
     * 以顯示成功或錯誤訊息, 過數秒後消失
     */
    function setMessage(status = '', message = '') {
        /**
	     * 當使用ajax時, 成功或失敗都可以呼叫此function
	     * 以顯示成功或錯誤訊息, 過數秒後消失
	     */
	    if (status == 'success') {
	        document.getElementById('other1').style.display='block';
            document.getElementById('other2').style.display='none';
	    } else if (status == 'error') {
	        document.getElementById('other1').style.display='none';
	        document.getElementById('other2').style.display='block';
	    } else {
            document.getElementById('other1').style.display='none';
            document.getElementById('other2').style.display='none';
        }
    }
</script>
<script src="{{ url('js/lightbox.min.js') }}"></script>
@endsection