@extends('layouts.dashboard')
@section('title', 'Setting Dashboard')

@section('content')
<div class="w3-container w3-teal">
  <h2>{{ $user->name }}</h2>
</div>

<!-- 開關的區塊, 設定樣式為switch.css -->
<div class="w3-card-4 w3-container">
    <p class="w3-xxlarge w3-margin-top w3-text-theme">Alert Switch</p>
    <label class="switch">
      <input id="switch" type="checkbox" onchange="switch_change()" {{ $user->status ? 'checked' : ''}}>
      <div class="slider"></div>
    </label>

    <p id="other"></p>
    <p id="now"></p>

    <p id="tmp" class="w3-xxlarge w3-margin-top w3-text-theme">Temperature: {{ $user->environment->tmp or 'null' }} <span id="tmp_message"></span></p>
    <p id="ph" class="w3-xxlarge w3-margin-top w3-text-theme">PH: {{ $user->environment->ph or 'null' }}  <span id="ph_message"></span></p>
</div>

@include('dashboard.main_js')

@endsection
