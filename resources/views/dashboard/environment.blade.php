@extends('layouts.dashboard')
@section('title', 'Environment Setting')

@section('content')
<div class="w3-container w3-teal">
  <h2>{{ $user->name }}</h2>
</div>

<form class="w3-container w3-card-4 w3-padding" method="post" action="{{ route('setEnvironment') }}">
    {{ csrf_field() }}
    <div class="w3-row">
      <div class="w3-col m6">
    <div class="w3-input-group">
      <label class="w3-label w3-text-teal"><b>溫度上限</b></label>
      <input class="w3-input w3-border w3-light-grey" type="text" value="{{ old('temp_max') ? old('temp_max') : $user->temp_max }}" name="temp_max">
      @if ($errors->has('temp_max'))
            <ul class="w3-text-red w3-ul">
                @foreach ($errors->get('temp_max') as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
      @endif
    </div>
      </div>
      <div class="w3-col m6">
    <div class="w3-input-group">
      <label class="w3-label w3-text-teal"><b>溫度下限</b></label>
      <input class="w3-input w3-border w3-light-grey" type="text" value="{{ old('temp_min') ? old('temp_min') : $user->temp_min }}" name="temp_min">
      @if ($errors->has('temp_min'))
            <ul class="w3-text-red w3-ul">
                @foreach ($errors->get('temp_min') as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
      @endif
    </div>
      </div>
    </div>

    <div class="w3-row">
      <div class="w3-col m6">
    <div class="w3-input-group">
      <label class="w3-label w3-text-teal"><b>pH上限</b></label>
      <input class="w3-input w3-border w3-light-grey" type="text" value="{{ old('pH_max') ? old('pH_max') : $user->pH_max }}" name="pH_max">
      @if ($errors->has('pH_max'))
            <ul class="w3-text-red w3-ul">
                @foreach ($errors->get('pH_max') as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
      @endif
    </div>
      </div>
      <div class="w3-col m6">
    <div class="w3-input-group">
      <label class="w3-label w3-text-teal"><b>pH下限</b></label>
      <input class="w3-input w3-border w3-light-grey" type="text" value="{{ old('pH_min') ? old('pH_min') : $user->pH_min }}" name="pH_min">
      @if ($errors->has('pH_min'))
            <ul class="w3-text-red w3-ul">
                @foreach ($errors->get('pH_min') as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
      @endif
    </div>
      </div>
    </div>
    
    <!-- <div class="w3-input-group">
      <label class="w3-label w3-text-teal"><b>提醒週期</b></label>
      <input class="w3-input w3-border w3-light-grey" type="text" value="{{ old('period') ? old('period') : $user->period }}" name="period">
      @if ($errors->has('period'))
            <ul class="w3-text-red w3-ul">
                @foreach ($errors->get('period') as $error)
                    <li><strong>{{ $error }}</li></strong>
                @endforeach
            </ul>
      @endif
    </div> -->
    <button class="w3-btn w3-theme">儲存</button>
</form>
@endsection
