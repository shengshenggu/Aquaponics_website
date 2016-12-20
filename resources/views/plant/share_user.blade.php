@extends('layouts.plant')

@section('style')
<style>
    body{
    background-color:#FFF3DE;
    }
    
    table
    { 
        margin-left: auto;
        margin-right: auto;
        font-family: cursive;
    }
	 td{
        padding:15px 40px;
	}
</style>
@endsection

@section('content')
  <div style="width:100%; position:relative; height:350px;">
      <img src="{{ url('img/sharepic/share1.png') }}"  style="width:100%; height:100%; position:absolute;" />
  </div>

  <div class="name w3-center">
      <p id="other" style="text-align:center;"></p>
      <a href="{{ url('share') }}"><span class="w3-jumbo">{{ $plant->name }}</span></a>
      <table>
          @if(count($plant->farms) == 0)
          <div class="w3-center">
              <button class="w3-btn w3-btn-floating w3-teal w3-xxlarge" data-toggle="modal" data-target="#myModal2_{{ $plant->id }}">+</button>
              <span>目前無人分享</span>
          </div>
             <!-- Modal -->
            <div class="modal fade myModal" id="myModal2_{{ $plant->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ $plant->name }}</h4>
                  </div>
                  <div class="modal-body w3-large">
                    <b>Set Start Date</b></br>
                    <label for="bookdate">Date：</label>
                    <input type="date" id="bookdate_{{ $plant->id }}" placeholder="2014-09-18" onchange="getDate({{ $plant->id }})">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="add_plant('{{ $plant->id }}')">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          @endif
          @foreach($plant->farms as $i => $myPlant)
            @if($i %2 == 0) 
              <tr>
                <td class="w3-xxlarge"><a href="{{ url('share/'. $plant->id . '/' . $myPlant->user->id) }}"><img src="{{url('img/sharepic/0.png') }}" width="50" height="50"></img>{{ $myPlant->user->name }}</a></td>
            @else
                <td class="w3-xxlarge"><a href="{{ url('share/'. $plant->id . '/' . $myPlant->user->id) }}"><img src="{{url('img/sharepic/0.png') }}" width="50" height="50"></img>{{ $myPlant->user->name }}</a></td>
              </tr>
            @endif
          @endforeach
      </table>
  </div>
  
  <script>
    var date;
    
    function getDate(id){
        date = document.getElementById('bookdate_' + id).value;
        //alert(date);
    }

    /**
     * 當點擊加入植物後，使用Ajax去新增my_plants資料
     */
    function add_plant(plant_id) {
        //var date = document.getElementById('bookdate').value;
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
              if (jData.result)
                  setMessage('success', '加入植物成功 ');
              else
                  setMessage('error', '加入植物失敗');
          },
          error: function(error) {
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
        $('#other').text(message);
        if (status == 'success') {
            $('#other').addClass('w3-text-green');
            $('#other').removeClass('w3-text-red');
        } else if (status == 'error') {
            $('#other').addClass('w3-text-red');
            $('#other').removeClass('w3-text-green');
        } else {
            $('#other').removeClass('w3-text-red');
            $('#other').removeClass('w3-text-green');
        }
        setTimeout(function(){
          $('#other').text('');
        }, 6000);
    }
  </script>
@endsection