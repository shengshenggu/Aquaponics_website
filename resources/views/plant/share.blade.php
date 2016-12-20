@extends('layouts.plant')

@section('style')
<style>
    table
    { 
        margin-left: auto;
        margin-right: auto;
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

<div class="plant">
  <table>
        <tr>
            <td><a href="{{ url('share/11') }}"><img src="{{ url('img/sharepic/1.png') }}" width="200" height="100"></img></a></td>
            <td><a href="{{ url('share/4') }}"><img src="{{ url('img/sharepic/2.png') }}" width="200" height="100"></img></a></td>
            <td><a href="{{ url('share/3') }}"><img src="{{ url('img/sharepic/3.png') }}" width="200" height="100"></img></a></td>
        </tr>
        <tr>
            <td><a href="{{ url('share/2') }}"><img src="{{ url('img/sharepic/4.png') }}" width="200" height="100"></img></a></td>
            <td><a href="{{ url('share/7') }}"><img src="{{ url('img/sharepic/5.png') }}" width="200" height="100"></img></a></td>
            <td><a href="{{ url('share/8') }}"><img src="{{ url('img/sharepic/6.png') }}" width="200" height="100"></img></a></td>
        </tr>
        <tr>
            <td><a href="{{ url('share/6') }}"><img src="{{ url('img/sharepic/11.png') }}" width="200" height="100"></img></a></td>
            <td><a href="{{ url('share/5') }}"><img src="{{ url('img/sharepic/8.png') }}" width="200" height="100"></img></a></td>
            <td><a href="{{ url('share/9') }}"><img src="{{ url('img/sharepic/9.png') }}" width="200" height="100"></img></a></td>
        </tr>
        <tr>
            <td><a href="{{ url('share/1') }}"><img src="{{ url('img/sharepic/10.png') }}" width="200" height="100"></a></td>
            <td><a href="{{ url('share/10') }}"><img src="{{ url('img/sharepic/7.png') }}" width="200" height="100"></a></td>
        </tr>
  </table>
</div>

</body>


@endsection