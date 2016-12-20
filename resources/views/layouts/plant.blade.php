<!DOCTYPE html>
<html>
<head>
    <title>Aquaponics</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="short icon" href="{{ url('img/header/icon.png') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/w3.css') }}">
    <link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ url('css/slideNav.css') }}">
    <link rel="stylesheet" href="{{ url('css/plant.css') }}">
    <link rel="stylesheet" href="{{ url('css/index.css') }}">
    <link rel="stylesheet" href="{{ url('css/ripple.css') }}">

    @yield('style')

    <script src="{{url('js/jquery.min.js')}}"></script>
    
</head>
<body>
<!-- Navigation Bar -->
<nav class="w3-top w3-black">
    <!-- The overlay -->
    <div id="myNav" class="overlay">
        <!-- Button to close the overlay navigation -->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <!-- Overlay content -->
        <div class="overlay-content">
            <img src="{{ url('img/header/icon.png') }}" height="100px">
            @if(Auth::check())
                <span class="w3-xxlarge"><?= Auth::user()->name ?></span>
            @endif
        <!--
            <a href="{{ url('plant_library') }}" class="w3-hover-teal w3-round"><img src="{{ url('img/header/header1.png') }}"></a>
            -->
            <a href="{{ url('plant_library') }}" class="w3-hover-teal w3-round w3-xlarge">Plant Library</a>
            <a href="{{ url('my_plant') }}" class="w3-hover-teal w3-round w3-xlarge">My Plant</a>
            <a href="{{ url('show_data') }}" class="w3-hover-teal w3-round w3-xlarge">Data Analysis</a>
            <a href="{{ url('dashboard') }}" class="w3-hover-teal w3-round w3-xlarge">Setting</a>
            <a href="{{ url('share') }}" class="w3-hover-teal w3-round w3-xlarge">Share</a>
            <!--<a href="{{ url('/') }}" class="w3-hover-teal w3-round w3-xlarge">Contact</a>-->

            @if(Auth::check())
                <a href="{{ url('logout') }}" class="w3-hover-teal w3-round"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img
                            src="{{ url('img/header/logout.jpg') }}"></a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @else
                <a href="{{ url('login') }}" class="w3-hover-teal w3-round"><img
                            src="{{ url('img/header/login.jpg') }}"></a>
            @endif
        </div>
    </div>

    <!-- Use any element to open/show the overlay navigation menu -->
    <div>
        <a href="{{ url('/') }}"><img src="{{ url('img/header/icon1.png') }}" class="w3-round w3-padding"></a>
        <a href="javascript:void(0)" onclick="openNav()" class="w3-right w3-hover-teal w3-round"><i
                    class="fa fa-bars w3-xxlarge w3-padding-large"></i></a>
    </div>
</nav>
<div style="display: block; height: 71px;"></div>

<!-- 成功訊息 -->
@if(session('success'))
<div class="w3-container">
    <div class="w3-round w3-pale-green">
        <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
        <h3><i class="fa fa-check-square-o"></i>{{ session('success') }}</h3>
    </div>
</div>
@endif

<!-- 錯誤訊息 -->
@if(session('error'))
<div class="w3-container">
    <div class="w3-round w3-pale-red">
        <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
        <h3><i class="fa fa-frown-o"></i>{{ session('error') }}</h3>
    </div>
</div>
@endif

<!-- 警告訊息 -->
@if(session('warning'))
<div class="w3-container">
    <div class="w3-round w3-pale-yellow">
        <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i class="fa fa-close"></i></span>
        <h3>{{ session('warning') }}</h3>
    </div>
</div>
@endif

<!-- Content -->
@yield('content')

<!-- Footer -->
<footer class="container-fluid text-center w3-bottom">
    <p>We love plant</p>
</footer>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<div style="height:85px;"></div>

<script>
    function openNav() {
        document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
    }
</script>

</body>
</html>