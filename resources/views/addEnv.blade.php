@extends('layouts.plant')

@section('content')
    <form action="{{ url('addEnv') }}" method="post">
        {{ csrf_field() }}
        <label>User ID</label><input type="number" name="user_id" value="1"><br>
        <label>Datetime</label><input type="datetime" name="datetime" placeholder="{{ date('Y-m-d h:i:s') }}"><br>
        <label>PH</label><input type="text" name="pH" value="7.0">
        <label>Temp</label><input type="text" name="temp" value="25.5">
        <label>Light</label><input type="text" name="light" value="550">
        <button>OK</button>
    </form>
@endsection