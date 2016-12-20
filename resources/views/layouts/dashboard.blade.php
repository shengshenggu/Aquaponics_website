<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/w3.css') }}">
    <link rel="stylesheet" href="{{ url('css/w3-theme-teal.css') }}">
    <link rel="stylesheet" href="{{ url('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/switch.css') }}">
    <title>Aquaponics - @yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<body style="min-width:300px;">

<nav class="w3-sidenav w3-card-2 w3-white w3-top" style="width:30%;display:none;z-index:2" id="mySidenav">
    <div class="w3-container w3-theme-d2">
        <span onclick="w3_close()" class="w3-closenav w3-right w3-xlarge">x</span>
        <br>
        <div class="w3-padding w3-center">
            <h3>{{ Auth::check() ? Auth::user()->name : 'Guest' }}</h3>
        </div>
    </div>
    <br>
    <a href="{{ url('/') }}">Home</a>
    @if(!Auth::check())
        <a href="{{ url('/login') }}">Login</a>
    @else
        <a href="{{ route('dashboard') }}">Current Environment</a>
        <a href="{{ route('environment') }}">Environment Setting</a>
        @if (Auth::user()->group == '1')
            <a href="{{ route('user.index') }}">Admin Management</a>
        @endif
        <a href="{{ url('/logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    @endif
</nav>

<header class="w3-container w3-card-4 w3-theme w3-top">
    <h1>
        <i class="w3-opennav fa fa-bars" onclick="w3_open()"></i>
        @yield('title')
    </h1>
</header>

<div class="w3-container" style="margin-top:75px; margin-bottom:45px;">
    <hr>
    <!-- 成功訊息 -->
    @if(session('success'))
        <div class="w3-round w3-pale-green">
            <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i
                        class="fa fa-close"></i></span>
            <h3><i class="fa fa-check-square-o"></i>{{ session('success') }}</h3>
        </div>
    @endif

<!-- 錯誤訊息 -->
    @if(session('error'))
        <div class="w3-round w3-pale-red">
            <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i
                        class="fa fa-close"></i></span>
            <h3><i class="fa fa-frown-o"></i>{{ session('error') }}</h3>
        </div>
    @endif

<!-- 警告訊息 -->
    @if(session('warning'))
        <div class="w3-round w3-pale-yellow">
            <span onclick="this.parentElement.style.display='none'" class="w3-closebtn"><i
                        class="fa fa-close"></i></span>
            <h3>{{ session('warning') }}</h3>
        </div>
    @endif

    @yield('content')
    <hr>
</div>

<footer class="w3-container w3-theme w3-bottom">
    <h3>NCNU - I.M.</h3>
</footer>

<script>
    function w3_open() {
        document.getElementById("mySidenav").style.display = "block";
    }
    function w3_close() {
        document.getElementById("mySidenav").style.display = "none";
    }
</script>

</body>
</html>