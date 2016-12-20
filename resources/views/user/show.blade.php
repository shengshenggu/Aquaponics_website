@extends('layouts.dashboard')
@section('title', 'User Information')

@section('content')
    <div class="w3-card-8 w3-round">

        <header class="w3-container w3-blue">
            <h3>{{ $user->name }}<a href="{{ route('user.index') }}" class="w3-btn w3-round w3-indigo w3-margin-left"><i class="fa fa-reply"></i></a>
                <a href="{{ route('user.edit', $user) }}" class="w3-btn w3-round w3-green"><i class="fa fa-edit"></i></a>
            </h3>
        </header>

        <div class="w3-container">
            <ul class="w3-ul">
                <li>ID: {{ $user->id }}</li>
                <li>Email: {{ $user->email }}</li>
                <li>Temp Max: {{ $user->temp_max }}</li>
                <li>Temp Min: {{ $user->temp_min }}</li>
                <li>pH Max: {{ $user->pH_max }}</li>
                <li>pH Min: {{ $user->pH_min }}</li>
                <li>Period: {{ $user->period == 0 ? '關閉提醒' : $user->period.' 秒' }}</li>
                <li>Switch: {{ $user->status == 0 ? '關閉' : '開啟' }}</li>
            </ul>
        </div>

    </div>
@endsection