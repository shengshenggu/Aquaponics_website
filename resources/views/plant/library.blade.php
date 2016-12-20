@extends('layouts.plant')

@section('style')
    <link rel="stylesheet" href="{{ url('css/library.css') }}">
@endsection

@section('content')
<div style="width:100%; position:relative; height:350px;">
    <img src="{{ url('img/header/plant.jpg')}}"  style="width:100%; height:100%; position:absolute;" />
</div>

<!--本頁簡介-->
<div class="vertical-catch">
  <p class="top-lead">
    提供適合魚菜共生栽種之水耕植物種類，<br class="pc">
    以及其最佳生長環境，介紹包含：<br class="pc">
    「<b>溫度</b>」、「<b>pH值</b>」、「<b>需要日照時數</b>」、「<b>生長週期</b>」。<br class="pc">
    讓使用者建立初步的農業知識，<br class="pc">
    並隨自身喜好選擇栽種的植物。</p>
  <div class="attention-box">
    <p class="title w3-text-grey w3-medium">Tip : 若有其他想種植之作物，使用者可以自行新增其作物。</p>
  </div>
</div>
<!--本頁簡介END-->

<!--植物欄-->
<div class="upage library">
    <div class="container">         
        <div class="row-fluid">
            <div class="span9">        
                <section class="list-itm clearfix">                                   
                <div id="results-lst"><div id="plant-lst-a">
                    <h3 class="alpha-ttl w3-xxlarge"><span>Hydroponics</span></h3>
                    @foreach($plants as $index => $rs)
                    <div class="splt-itm  clearfix filter-annual filter-bloom-yellow filter-leaf-green filter-irregular">
                        <a class="button" data-toggle="modal" data-target="#myModal_{{ $rs->id }}">
                            <figure><img src="{{ url('img/plantdb/'. $rs->name .'.jpg') }}" alt="{{ $rs->chi_name }}"></figure>
                            <h4>{{ $rs->eng_name }}</h4>
                            <p class="fitalic w3-medium">{{ $rs->description }}</p>
                        </a>
                        @if(Auth::check())
                        <!--加入植物-->
                        <!--原先成功的
                        <button class="w3-btn w3-btn-floating w3-teal w3-xxlarge  w3-display-topleft" onclick="add_plant({{ $index }})">+</button>
                        -->
                        <!--以下為測試用 開Modal輸入-->
                        <button class="w3-btn w3-btn-floating w3-teal w3-xxlarge  w3-display-topleft"data-toggle="modal" data-target="#myModal2_{{ $rs->id }}">+</button>
                        @else
                        <a href="{{ url('login') }}" class="w3-btn w3-btn-floating w3-teal w3-xxlarge  w3-display-topleft" onclick="window.alert('請先登入')">+</a>
                        @endif
                    </div>
                    @endforeach
                    <!--新增其他植物-->
                    <div class="splt-itm  clearfix filter-annual filter-bloom-yellow filter-leaf-green filter-irregular">
                        <a>
                            <figure><img src="{{ url('img/plantdb/Other.png')}}" alt="其他"></figure>
                            <h4>Others</h4>
                            <p class="fitalic w3-medium">Add the plant what you want to plant !</p>
                        </a>
                        @if(Auth::check())
                        <button class="w3-btn w3-btn-floating w3-teal w3-xxlarge  w3-display-topleft"data-toggle="modal" data-target="#myModalother">+</button>
                        @else
                        <a href="{{ url('login') }}" class="w3-btn w3-btn-floating w3-teal w3-xxlarge  w3-display-topleft" onclick="window.alert('請先登入')">+</a>
                        @endif
                    </div>
                </section><!-- END: list-itm -->
            </div><!-- SPAN9 -->
        </div><!-- R COL -->          
    </div><!-- END: G MAP -->
</div>

<!--植物生長條件Modal-->
@foreach($plants as $index => $rs)
<!-- Modal -->
<div class="modal fade myModal" id="myModal_{{ $rs->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ $rs->name }}</h4>
      </div>
      <div class="modal-body w3-large">
        <b>Plant Needs</b></br>
        Temperature : {{ $rs->temp_min }} ~ {{ $rs->temp_max }}°C <br>
        pH : {{ $rs->pH_min }} ~ {{ $rs->pH_max }}<br>
        Photo Period : {{ $rs->photoperiod_min }} ~ {{ $rs->photoperiod_max }} hours <br>
        Crop cycle : {{ $rs->cropcycle_min }} ~ {{ $rs->cropcycle_max }} days <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<!--設定植物開始種植時間Modal-->
@foreach($plants as $index => $rs)
<!-- Modal -->
<div class="modal fade myModal" id="myModal2_{{ $rs->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ $rs->name }}</h4>
      </div>
      <div class="modal-body w3-large">
        <b>Set Start Date</b></br>
        <label for="bookdate">Date：</label>
        <input type="date" id="bookdate_{{ $rs->id }}" placeholder="2014-09-18" onchange="getDate({{ $rs->id }})">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="add_plant('{{ $rs->id }}')">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach


<!--設定種植其他植物Modal-->
<!-- Modal -->
<div class="modal fade myModal" id="myModalother" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Others</h4>
      </div>
      <div class="modal-body w3-large">
        <form id="otherplant_form" method="POST">
          <b>Plant Name:</b><input type="text" name="pname" id="pname" /> <br/>
        </form>
          <label for="bookdate">Date：</label>
          <input type="date" id="bookdate_other" placeholder="2014-09-18" onchange="getDate_other()">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="add_otherplant()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Alert Information -->
<div id="other1" class="w3-modal">
  <div class="w3-modal-content w3-round w3-animate-zoom">
    <header class="w3-container w3-green w3-round"> 
      <span onclick="document.getElementById('other1').style.display='none'" 
      class="w3-closebtn">&times;</span>
      <h5>Alert Information</h5>
    </header>
    <div class="w3-container w3-center">
      <h4>新增植物成功～ <i class="fa fa-smile-o"></i></h4>
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
      <h4>新增植物失敗 <i class="fa fa-frown-o"></i></h4>
    </div>
  </div>
</div>

<script>
    var date;
    var date_other;
    /*
    $(function(){
        $("#bookdate").change(function(){
          date = document.getElementById('bookdate').value;
          alert(date);
        });
    });
    */
    function getDate(id){
        date = document.getElementById('bookdate_' + id).value;
        //alert(date);
    }

    function getDate_other(){
        date_other = document.getElementById('bookdate_other').value;
        //alert(date);
    }
    
    /**
     * 當點擊加入植物後，使用Ajax去新增my_plants資料
     */
    function add_plant(plant_id) {
        //var date = document.getElementById('bookdate').value;
        getDate(plant_id);
        console.log(date);
      $.ajax({
          type: 'POST',
          url: '{{ url("addPlant") }}',
          dataType: 'json',
          data: {
              plantId: plant_id,
              startDate: date,
              _token: '{{ csrf_token() }}'
          },
          success: function(jData) {
              if (jData.result == 'ok')
                  setMessage('success', jData.msg);
              else
                  setMessage('error', jData.msg);
          },
          error: function(error) {
              setMessage('error', '加入植物的Ajax 發生錯誤');
              $('body').html(error.responseText);
          }
      });
    }

    /**
     * 當點擊加入植物後，使用Ajax去新增其他植物資料
     */
    function add_otherplant() {
        //var date = document.getElementById('bookdate').value;
        getDate_other();
        console.log(date_other);
        //取得植物名稱欄位值
        var plant_name = $('#pname').val();
      $.ajax({
          type: 'POST',
          url: '{{ url("addOtherPlant") }}',
          dataType: 'json',
          data: {
              plantName: plant_name,
              startDate: date_other,
              _token: '{{ csrf_token() }}'
          },
          success: function(jData) {
              console.log(jData);
              if (jData.result == 'ok')
                  setMessage('success', jData.msg);
              else
                  setMessage('error', jData.msg);
          },
          error: function() {
              setMessage('error', '加入植物的Ajax 發生錯誤');
              $('body').html(error.responseText);
          }
      });
    }


    /**
     * 當使用ajax時, 成功或失敗都可以呼叫此function
     * 以顯示成功或錯誤訊息, 過數秒後消失
     */
    function setMessage(status = '', message = '') {
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
@endsection