<!doctype html>
<!--
	Template:	 Unika - Responsive One Page HTML5 Template
	Author:		 imransdesign.com
	URL:		 http://imransdesign.com/
    Designed By: https://www.behance.net/poljakova
	Version:	1.0	
-->
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aquaponics</title>
    <meta name="description" content="Aquaponics">
    <meta name="keywords" content="Aquaponics,plant,fish,NCNU"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="short icon" href="{{ url('img/header/icon.png') }}">
    <!-- Google Fonts  -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
    <!-- Body font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
    <!-- Navbar font -->

    <!-- Bootstrap core CSS -->
    <link href="{{ url('unika/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/w3.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ url('unika/css/custom-animations.css') }}" rel="stylesheet">
    <link href="{{ url('unika/css/style.css') }}" rel="stylesheet">


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ url('unika/js/ie10-viewport-bug-workaround.js') }}"></script>

    <!-- Libs and Plugins CSS -->
    <link rel="stylesheet" href="{{ url('unika/inc/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('unika/inc/animations/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('unika/inc/font-awesome/css/font-awesome.min.css') }}"> <!-- Font Icons -->
    <link rel="stylesheet" href="{{ url('unika/inc/owl-carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('unika/inc/owl-carousel/css/owl.theme.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ url('unika/css/reset.css') }}">
    <link rel="stylesheet" href="{{ url('unika/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('unika/css/mobile.css') }}">

    <!-- Skin CSS -->
<!-- <link rel="stylesheet" href="{{ url('unika/css/skin/cool-gray.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ url('unika/css/skin/ice-blue.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ url('unika/css/skin/summer-orange.css') }}"> -->
    <link rel="stylesheet" href="{{ url('unika/css/skin/fresh-lime.css') }}">
<!-- <link rel="stylesheet" href="{{ url('unika/css/skin/night-purple.css') }}"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js">1</script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js">1</script>
    <![endif]-->

</head>

<body data-spy="scroll" data-target="#main-navbar">
<div class="page-loader"></div>  <!-- Display loading image while page loads -->
<div class="body">

    <!--========== BEGIN HEADER ==========-->
    <header id="header" class="header-main">

        <!-- Begin Navbar -->
        <nav id="main-navbar" class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Classes: navbar-default, navbar-inverse, navbar-fixed-top, navbar-fixed-bottom, navbar-transparent. Note: If you use non-transparent navbar, set "height: 98px;" to #header -->

            <div class="container">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="" href="{{ url('/') }}"><img src="{{ url('unika/img/index/icon1.png') }}"
                                                           style="margin-top:10px"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="page-scroll" href="body">Home</a></li>
                        <li><a class="page-scroll" href="#about-section">About</a></li>
                        <li><a class="page-scroll" href="#services-section">Services</a></li>
                        <li><a class="page-scroll" href="#testimonial-section">Steps</a></li>
                        <li><a class="page-scroll" href="#portfolio-section">Equipment</a></li>
                        <li><a class="page-scroll" href="#team-section">Team</a></li>
                        <li><a class="page-scroll" href="#contact-section">Contact</a></li>
                        <li class="dropdown"><a href="#" data-toggle="dropdown">Account<span class="glyphicon glyphicon-user"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">會員專區</li>
                                @if(Auth::check())
                                    <li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="w3-hover-lime ">Logout <span class="glyphicon glyphicon-log-out"></span></a></li>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @else
                                    <li><a href="{{ url('login') }}" class="w3-hover-lime ">LogIn <span class="glyphicon glyphicon-log-in w3-large"></span></a></li>
                                @endif
                                <li class="divider"></li>
                                <li><a href="{{ url('plant_library') }}" class="w3-hover-lime ">Plant Library</a></li>
                                <li><a href="{{ url('my_plant') }}" class="w3-hover-lime ">My Plant</a></li>
                                <li><a href="{{ url('show_data') }}" class="w3-hover-lime ">Data Analysis</a></li>
                                <li><a href="{{ url('dashboard') }}" class="w3-hover-lime ">Setting</a></li>
                                <li><a href="{{ url('share') }}" class="w3-hover-lime ">Share</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav>
        <!-- End Navbar -->

    </header>
    <!-- ========= END HEADER =========-->


    <!-- Begin text carousel intro section -->
    <section id="text-carousel-intro-section" class="parallax" data-stellar-background-ratio="0.5"
             style="background-size:100% 100% ; background-image: url({{ url('unika/img/index/top2.jpg') }});">

        <div class="container">
            <div class="caption text-center text-white" data-stellar-ratio="0.7">

                <div id="owl-intro-text" class="owl-carousel">
                    <div class="item">
                        <h1>Welcome to Aquaponics</h1>
                        <p>Enjoy the plant</p>
                        <div class="extra-space-l"></div>
                        <a class="btn btn-blank" href="javascript:void(0)" onclick="moveToAbout()" role="button">View
                            More!</a>
                    </div>
                    <div class="item">
                        <h1>Share your experience</h1>
                        <p>Innovation</p>
                        <div class="extra-space-l"></div>
                        <a class="btn btn-blank" href="javascript:void(0)" onclick="moveToAbout()" role="button">View
                            More!</a>
                    </div>
                    <div class="item">
                        <h1></h1>
                        <p></p>
                        <div class="extra-space-l"></div>
                        <a class="btn btn-blank" href="javascript:void(0)" onclick="moveToAbout()" role="button">View
                            More!</a>
                    </div>
                </div>

            </div> <!-- /.caption -->
        </div> <!-- /.container -->

    </section>
    <!-- End text carousel intro section -->


    <!-- Begin about section -->
    <section id="about-section" class="page bg-style1">
        <!-- Begin page header-->
        <div class="page-header-wrapper">
            <div class="container">
                <div class="page-header text-center wow fadeInUp" data-wow-delay="0.3s">
                    <h2>About</h2>
                    <div class="devider"></div>
                    <p class="subtitle">little information about our system</p>
                </div>
            </div>
        </div>
        <!-- End page header-->

        <!-- Begin rotate box-1 -->
        <div class="rotate-box-1-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <a href="javascript:void(0)" class="rotate-box-1 square-icon wow zoomIn" data-wow-delay="0">
                            <span class="rotate-box-icon"><i class="fa fa-users"></i></span>
                            <div class="rotate-box-info">
                                <h4>Who We Are?</h4>
                                <p>我們是暨南大學資訊管理學系106級專題第六組</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="javascript:void(0)" class="rotate-box-1 square-icon wow zoomIn" data-wow-delay="0.2s">
                            <span class="rotate-box-icon"><i class="fa fa-diamond"></i></span>
                            <div class="rotate-box-info">
                                <h4>What We Do?</h4>
                                <p>以物聯網為基礎建構魚菜共生系統暨資料分析共享平台</p>
                                <p>◇ Real Time Data</p>
                                <p>◇ Alert & Monitering</p>
                                <p>◇ Data Analysing</p>
                                <p>◇ Knowledge Sharing</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="javascript:void(0)" class="rotate-box-1 square-icon wow zoomIn" data-wow-delay="0.4s">
                            <span class="rotate-box-icon"><i class="fa fa-heart"></i></span>
                            <div class="rotate-box-info">
                                <h4>Why We Do It?</h4>
                                <p>我們希望透過此系統，讓人人皆能種出/養殖安心美味的蔬果/魚類，同時也藉由農業知識資訊共享，解決未來食物缺乏的問題及食安危機。</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="javascript:void(0)" class="rotate-box-1 square-icon wow zoomIn" data-wow-delay="0.6s">
                            <span class="rotate-box-icon"><i class="fa fa-clock-o"></i></span>
                            <div class="rotate-box-info">
                                <h4>How to Start?</h4>
                                <p>
                                    此系統一開始的目的，就是要讓一般人都能夠自己在自家陽台建立一個魚菜共生系統，所以建置成本低、設備簡單。最基礎的設備只需要一個架子、兩個桶子、馬達以及你想養的魚跟種植的植物。</p>
                            </div>
                        </a>
                    </div>

                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div>
        <!-- End rotate box-1 -->

        <div class="extra-space-l"></div>
    </section>

    <!-- Begin cta -->
    <section id="cta-section">
        <div class="cta">
            <div class="container">
                <div class="row">

                    <div class="col-md-9">
                        <h1>Choose what you want to grow</h1>
                        <p>運用了聯合國作物資料庫的系統，已經找出幾樣最適合種植於水耕的植物，也列出該植物在什麼溫度、酸鹼值、光度下能生長的最完美。可以運用折線圖分析自己植物的生長條件，與聯合國資料庫所提供的最佳生長條件作數據分析的比對。</p></br>
                        <p><b>◇ 查詢作物生長環境&nbsp;&nbsp;&nbsp;&nbsp;◇ 選擇想種植的植物</b></p>
                    </div>

                    <div class="col-md-3">
                        <div class="cta-btn wow bounceInRight" data-wow-delay="0.4s">
                            <a class="btn btn-default btn-lg" href="{{ url('plant_library') }}" target="_blank"
                               role="button">Plant Library</a>
                        </div>
                    </div>

                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div>
    </section>
    <!-- End cta -->


    <!-- Begin Services -->
    <section id="services-section" class="page text-center">
        <!-- Begin page header-->
        <div class="page-header-wrapper">
            <div class="container">
                <div class="page-header text-center wow fadeInDown" data-wow-delay="0.4s">
                    <h2>Services</h2>
                    <div class="devider"></div>
                    <p class="subtitle">what we really know how</p>
                </div>
            </div>
        </div>
        <!-- End page header-->

        <!-- Begin roatet box-2 -->
        <div class="rotate-box-2-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <a href="javascript:void(0)" class="rotate-box-2 square-icon text-center wow zoomIn"
                           data-wow-delay="0">
                            <span class="rotate-box-icon"><i class="fa fa-mobile"></i></span>
                            <div class="rotate-box-info">
                                <h4>警示監控</h4>
                                <p>當感測器監測到目前環境數據值異常，使用者將接收到警訊通知。</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="javascript:void(0)" class="rotate-box-2 square-icon text-center wow zoomIn"
                           data-wow-delay="0.2s">
                            <span class="rotate-box-icon"><i class="fa fa-pie-chart"></i></span>
                            <div class="rotate-box-info">
                                <h4>資料分析比對</h4>
                                <p>將植物生長實際環境與聯合國作物最佳生長進行比對，確保植物生長在最佳的環境下。</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="javascript:void(0)" class="rotate-box-2 square-icon text-center wow zoomIn"
                           data-wow-delay="0.4s">
                            <span class="rotate-box-icon"><i class="fa fa-cloud"></i></span>
                            <div class="rotate-box-info">
                                <h4>生長數據紀錄</h4>
                                <p>樹莓派將感測器讀取值儲存至雲端，同時並拍攝植物照片，紀錄植物的成長。</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="javascript:void(0)" class="rotate-box-2 square-icon text-center wow zoomIn"
                           data-wow-delay="0.6s">
                            <span class="rotate-box-icon"><i class="fa fa-pencil"></i></span>
                            <div class="rotate-box-info">
                                <h4>知識共享</h4>
                                <p>使用者可以分享自己種植的數據也可以搜尋其他人的相關資料，降低農業初學者的進入門檻。</p>
                            </div>
                        </a>
                    </div>

                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div>
        <!-- End rotate-box-2 -->
    </section>
    <!-- End Services -->


    <!-- Begin testimonials -->
    <section id="testimonial-section">
        <div id="testimonial-trigger" class="testimonial text-white parallax" data-stellar-background-ratio="0.5">
            <div class="cover"></div>
            <!-- Begin page header-->
            <div class="page-header-wrapper">
                <div class="container">
                    <div class="page-header text-center wow fadeInDown" data-wow-delay="0.4s">
                        <h2>Steps !</h2>
                        <div class="devider"></div>
                        <p class="subtitle">Let's start to plant !</p>
                    </div>
                </div>
            </div>
            <!-- End page header-->
            <div class="container">
                <div class="testimonial-inner center-block text-center">
                    <div id="owl-testimonial" class="owl-carousel">
                        <div class="item">
                            <blockquote>
                                <p>Step 1</p>
                                <p>進入Plant Library查詢作物最佳生長環境，並選擇想種的植物或其他，新增開始種植日期。</p>
                                <footer><cite title="Source Title">◇ Plant Library</cite></footer>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>Step 2</p>
                                <p>進入My Plant查看作物生長相簿，並設定該作物結束種植日期。</p>
                                <footer><cite title="Source Title">◇ My Plant</cite></footer>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>Step 3</p>
                                <p>進入Data Analysis查看植物的環境數據比對圖表，若目前環境超出該作物之最佳生長條件，便會寄送警告給使用者。</p>
                                <footer><cite title="Source Title">◇ Data Analysis</cite></footer>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>Step 4</p>
                                <p>使用者也可於Setting中自行設定環境警告之數據範圍。</p>
                                <footer><cite title="Source Title">◇ Setting</cite></footer>
                            </blockquote>
                        </div>
                        <div class="item">
                            <blockquote>
                                <p>Step 5</p>
                                <p>於Share中，可以看到所有使用者分享種植之數據，讓大家都能簡單種出好菜。</p>
                                <footer><cite title="Source Title">◇ Share</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End testimonials -->


    <!-- Begin Portfolio -->
    <section id="portfolio-section" class="page bg-style1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="portfolio">
                        <!-- Begin page header-->
                        <div class="page-header-wrapper">
                            <div class="container">
                                <div class="page-header text-center wow fadeInDown" data-wow-delay="0.4s">
                                    <h2>Equipment</h2>
                                    <div class="devider"></div>
                                    <p class="subtitle">All the equipments you should have..</p>
                                </div>
                            </div>
                        </div>
                        <!-- End page header-->
                        <div class="portfoloi_content_area">
                            <div class="portfolio_menu" id="filters">
                                <ul>
                                    <li class="active_prot_menu"><a href="#porfolio_menu" data-filter="*">All</a>
                                    </li>
                                    <li><a href="#porfolio_menu" data-filter=".websites">Raspberry Pi</a></li>
                                    <li><a href="#porfolio_menu" data-filter=".webDesign">Sensors</a></li>
                                    <li><a href="#porfolio_menu" data-filter=".appsDevelopment">Equipments</a></li>
                                </ul>
                            </div>
                            <div class="portfolio_content">
                                <div class="row" id="portfolio">
                                    <div class="col-xs-12 col-sm-4 websites">
                                        <div class="portfolio_single_content">
                                            <img src="{{ url('unika/img/portfolio/p1.jpg') }}" alt="title"/>
                                            <div>
                                                <a href="javascript:void(0)">Raspberry Pi</a>
                                                <span>Model B+</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 webDesign">
                                        <div class="portfolio_single_content">
                                            <img src="{{ url('unika/img/portfolio/p2.jpg') }}" alt="title"/>
                                            <div>
                                                <a href="javascript:void(0)">Pi Noir</a>
                                                <span>Camera Module</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 webDesign">
                                        <div class="portfolio_single_content">
                                            <img src="{{ url('unika/img/portfolio/p3.jpg') }}" alt="title"/>
                                            <div>
                                                <a href="javascript:void(0)">pH sensor kit</a>
                                                <span>pH Sensor</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 webDesign">
                                        <div class="portfolio_single_content">
                                            <img src="{{ url('unika/img/portfolio/p4.jpg') }}" alt="title"/>
                                            <div>
                                                <a href="javascript:void(0)">DH18B20</a>
                                                <span>Temperature Sensor</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 webDesign">
                                        <div class="portfolio_single_content">
                                            <img src="{{ url('unika/img//portfolio/p5.jpg') }}" alt="title"/>
                                            <div>
                                                <a href="javascript:void(0)">BH1750</a>
                                                <span>Light Sensor</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 appsDevelopment">
                                        <div class="portfolio_single_content">
                                            <img src="{{ url('unika/img/portfolio/p6.jpg') }}" alt="title"/>
                                            <div>
                                                <a href="javascript:void(0)">塑膠桶</a>
                                                <span>魚箱、菜箱</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 appsDevelopment">
                                        <div class="portfolio_single_content">
                                            <img src="{{ url('unika/img/portfolio/p7.jpg') }}" alt="title"/>
                                            <div>
                                                <a href="javascript:void(0)">Water Pump</a>
                                                <span>抽水馬達(依水量大小)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 appsDevelopment">
                                        <div class="portfolio_single_content">
                                            <img src="{{ url('unika/img/portfolio/p8.jpg') }}" alt="title"/>
                                            <div>
                                                <a href="javascript:void(0)">水管</a>
                                                <span>依孔徑大小決定</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 appsDevelopment">
                                        <div class="portfolio_single_content">
                                            <img src="{{ url('unika/img/portfolio/p9.jpg') }}" alt="title"/>
                                            <div>
                                                <a href="javascript:void(0)">過濾盒</a>
                                                <span>濾材:白棉、火山岩、多孔濾材</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End portfolio -->


    <!-- ********** BLUE SECTION - CURIOUS ********** -->
    <div id="curious">
        <div class="row nopadding">
            <div class="col-md-5 col-md-offset-1 mt">
                <h4>不限環境</h4>
                <p>There is no restriction for environment.</p>
                <p>
                    本系統最大的特點就是佔用空間小，不管什麼地點都可以運用本系統種植植物。春天，可以種植空心菜；夏天，可以種植羅勒；秋天，可以種植迷迭香；冬天，可以種植芋頭；也有全年都可以種植的薄荷、皇宮菜提供大家參考。</p>
                <br/>
                <p>◇ 一年四季</p>
                <p>◇ 適合各種蔬菜/魚種</p>

            </div>

            <div class="col-md-6 pull-right">
                <img src="{{ url('unika/img/shot001.jpg') }}" class="img-responsive alignright" alt=""
                     data-effect="slide-right">
            </div>
        </div><!--/row -->
    </div><!--/curious -->

    <!-- ********** BLUE SECTION - PICTON ********** -->
    <div id="picton">
        <div class="row nopadding">
            <div class="col-md-6 pull-left">
                <div id="picton1">
                    <img src="{{ url('unika/img/shot2.png') }}" class="img-responsive alignleft" alt=""
                         data-effect="slide-left"></div>
            </div>
            <div class="col-md-5 mt">
                <h4>即時監控</h4>
                <p>Real Time Data Monitering</p>
                <p>
                    本系統設定一小時回報一次植物的生長環境，溫度，濕度及光度，也會於早、中、晚紀錄植物的影像，讓使用者可以即時監控自己的系統。若生長環境的數值出現異常，也會發訊息通知使用者，讓使用者可以即時收到資訊。</p>
                <br/>
                <p>◇ 環境紀錄</p>
                <p>◇ 生長圖鑑</p>
            </div>

        </div><!--row -->
    </div><!--/Picton -->


    <!-- ********** BLUE SECTION - CURIOUS ********** -->
    <div id="curious">
        <div class="row nopadding">
            <div class="col-md-5 col-md-offset-1 mt">
                <h4>數據分析</h4>
                <p>Data Analysing</p>
                <p>
                    運用了聯合國作物資料庫的系統，已經找出幾樣最適合種植於水耕的植物，也列出該植物在什麼溫度、酸鹼值、光度下能生長的最完美。可以運用折線圖分析自己植物的生長條件與聯合國資料庫所提供的最佳生長條件作數據分析的比對。</p>
                <p>◇ 生長紀錄</p>
                <p>◇ 理想條件比對</p>

            </div>

            <div class="col-md-6 pull-right">
                <img src="{{ url('unika/img/shot_3.png') }}" class="img-responsive alignright" alt=""
                     data-effect="slide-right">
            </div>
        </div><!--/row -->
    </div><!--/curious -->

    <div id="picton">
        <div class="row nopadding">
            <div class="col-md-6 pull-left">
                <div id="picton1">
                    <img src="{{ url('unika/img/shot4.png') }}" class="img-responsive alignleft" alt=""
                         data-effect="slide-left"></div>
            </div>
            <div class="col-md-5 mt">
                <h4>自給自足</h4>
                <p>Autarkic</p>
                <p>
                    魚菜共生系統中有一個看不見的必要元素「益細菌」。這些細菌能夠把魚池裡的一些元素解成植物可以吸收及利用的形式。利用魚本身的機能，讓植物無害的生長，也提供了無毒無農藥的菜類供大眾食用，以達到系統自給自足的目標，並提高作物的經濟價值，也讓大眾能吃的安心。</p>
                <br/>
                <p>◇ 有機蔬果</p>
                <p>◇ 無食安疑慮</p>
            </div>

        </div><!--row -->
    </div><!--/Picton -->


    <!-- Begin team-->
    <section id="team-section" class="page" style="background-color: #72a603;">
        <!-- Begin page header-->
        <div class="page-header-wrapper">
            <div class="container">
                <div class="page-header text-center wow fadeInDown" data-wow-delay="0.4s">
                    <h2>Our Team</h2>
                    <div class="devider"></div>
                    <p class="subtitle">Meat our experts</p>
                </div>
            </div>
        </div>
        <!-- End page header-->
        <div class="container">
            <div class="row">
                <div class="team-items">
                    <div class="col-md-2">
                        <div class="team-container wow bounceIn" data-wow-delay="0.2s">
                            <div class="team-item">
                                <div class="team-triangle">
                                    <div class="content">
                                        <img src="{{ url('unika/img/team/01.jpg') }}" alt="title"/>
                                        <div class="team-hover text-center">
                                            <i class="fa fa-male"></i>
                                            <p>簡宏宇</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="team-container wow bounceIn" data-wow-delay="0.3s">
                            <div class="team-item">
                                <div class="team-triangle">
                                    <div class="content">
                                        <img src="{{ url('unika/img/team/02.jpg') }}" alt="title"/>
                                        <div class="team-hover text-center">
                                            <i class="fa fa-female"></i>
                                            <p>顧晨生</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="team-container wow bounceIn" data-wow-delay="0.4s">
                            <div class="team-item">
                                <div class="team-triangle">
                                    <div class="content">
                                        <img src="{{ url('unika/img/team/03.jpg') }}" alt="title"/>
                                        <div class="team-hover text-center">
                                            <i class="fa fa-male"></i>
                                            <p>陳淯凡</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="team-container wow bounceIn" data-wow-delay="0.5s">
                            <div class="team-item">
                                <div class="team-triangle">
                                    <div class="content">
                                        <img src="{{ url('unika/img/team/04.jpg') }}" alt="title"/>
                                        <div class="team-hover text-center">
                                            <i class="fa fa-male"></i>
                                            <p>吳婉廷</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="team-container wow bounceIn" data-wow-delay="0.6s">
                            <div class="team-item">
                                <div class="team-triangle">
                                    <div class="content">
                                        <img src="{{ url('unika/img/team/05.jpg') }}" alt="title"/>
                                        <div class="team-hover text-center">
                                            <i class="fa fa-male"></i>
                                            <p>戴郁庭</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="team-container wow bounceIn" data-wow-delay="0.7s">
                            <div class="team-item">
                                <div class="team-triangle">
                                    <div class="content">
                                        <img src="{{ url('unika/img/team/06.jpg') }}" alt="title"/>
                                        <div class="team-hover text-center">
                                            <i class="fa fa-male"></i>
                                            <p>劉建毅</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="team-container wow bounceIn" data-wow-delay="0.8s">
                            <div class="team-item">
                                <div class="team-triangle">
                                    <div class="content">
                                        <img src="{{ url('unika/img/team/07.jpg') }}" alt="title"/>
                                        <div class="team-hover text-center">
                                            <i class="fa fa-female"></i>
                                            <p>NCNU IM</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </section>
    <!-- End team-->


    <!-- Begin social section -->
    <section id="social-section">

        <!-- Begin page header-->
        <div class="page-header-wrapper">
            <div class="container">
                <div class="page-header text-center wow fadeInDown" data-wow-delay="0.4s">
                    <h2>Join Us</h2>
                    <div class="devider"></div>
                    <p class="subtitle">Follow us on social networks</p>
                </div>
            </div>
        </div>
        <!-- End page header-->

        <div class="container">
            <ul class="social-list">
                <li><a href="javascript:void(0)" class="rotate-box-1 square-icon text-center wow zoomIn"
                       data-wow-delay="0.3s"><span class="rotate-box-icon"><i class="fa fa-facebook"></i></span></a>
                </li>
                <li><a href="javascript:void(0)" class="rotate-box-1 square-icon text-center wow zoomIn"
                       data-wow-delay="0.4s"><span class="rotate-box-icon"><i class="fa fa-twitter"></i></span></a>
                </li>
                <li><a href="javascript:void(0)" class="rotate-box-1 square-icon text-center wow zoomIn"
                       data-wow-delay="0.5s"><span class="rotate-box-icon"><i class="fa fa-google-plus"></i></span></a>
                </li>
                <li><a href="javascript:void(0)" class="rotate-box-1 square-icon text-center wow zoomIn"
                       data-wow-delay="0.6s"><span class="rotate-box-icon"><i class="fa fa-pinterest-p"></i></span></a>
                </li>
                <li><a href="javascript:void(0)" class="rotate-box-1 square-icon text-center wow zoomIn"
                       data-wow-delay="0.7s"><span class="rotate-box-icon"><i class="fa fa-tumblr"></i></span></a>
                </li>
                <li><a href="javascript:void(0)" class="rotate-box-1 square-icon text-center wow zoomIn"
                       data-wow-delay="0.8s"><span class="rotate-box-icon"><i class="fa fa-dribbble"></i></span></a>
                </li>
            </ul>
        </div>

    </section>
    <!-- End social section -->


    <!-- Begin contact section -->
    <section id="contact-section" class="page text-white parallax" data-stellar-background-ratio="0.5"
             style="background-image: url({{ url('unika/img/map-bg.jpg') }});">
        <div class="cover"></div>

        <!-- Begin page header-->
        <div class="page-header-wrapper">
            <div class="container">
                <div class="page-header text-center wow fadeInDown" data-wow-delay="0.4s">
                    <h2>Contacts</h2>
                    <div class="devider"></div>
                    <p class="subtitle">All to contact us</p>
                </div>
            </div>
        </div>
        <!-- End page header-->

        <div class="contact wow bounceInRight" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">

                    <div class="col-sm-6">
                        <div class="contact-info">
                            <h4>Our Address</h4>
                            <ul class="contact-address">
                                <li><i class="fa fa-map-marker fa-lg"></i>&nbsp; 545 University Road, 54561 Puli,
                                    Nantou Taiwan.<br></li>
                                <li><i class="fa fa-phone"></i>&nbsp; +886-049-2910960 ext. 4543</li>
                                <li><i class="fa fa-print"></i>&nbsp; +886-049-2910960 ext. 4543</li>
                                <li><i class="fa fa-envelope"></i> im@mail.ncnu.edu.tw</li>
                                <li><i class="fa fa-skype"></i> Aquaponics</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="contact-form">
                            <h4>Write to us</h4>
                            <h4 id="welcome" class="w3-yellow"></h4><h4 id="notwelcome" class="w3-yellow"></h4>
                            <form name="contactForm" onsubmit="return saveContact()">
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control input-lg"
                                           placeholder="Your Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control input-lg"
                                           placeholder="E-mail" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control input-lg"
                                           placeholder="Subject" required>
                                </div>
                                <div class="form-group">
                                        <textarea name="message" class="form-control input-lg" rows="5"
                                                  placeholder="Message" required></textarea>
                                </div>
                                <button type="submit" class="btn wow bounceInRight" data-wow-delay="0.8s">Send<i
                                            class="fa fa-spinner fa-spin w3-text-teal w3-large w3-hide"
                                            id="contactLoading"></i></button>
                            </form>
                        </div>
                    </div>

                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div>
    </section>
    <!-- End contact section -->

    <div class="footer">
        <div class="container text-center wow fadeIn" data-wow-delay="0.4s">
            <p class="copyright">Copyright &copy; 2016 </p>
        </div>
    </div>

    <!-- End footer -->

    <a href="javascript:void(0)" class="scrolltotop"><i class="fa fa-arrow-up"></i></a>
    <!-- Scroll to top button -->

</div><!-- body ends -->


<!-- Plugins JS -->
<script src="{{ url('unika/inc/jquery/jquery-1.11.1.min.js') }}"></script>
<script src="{{ url('unika/inc/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ url('unika/inc/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('unika/inc/stellar/js/jquery.stellar.min.js') }}"></script>
<script src="{{ url('unika/inc/animations/js/wow.min.js') }}"></script>
<script src="{{ url('unika/inc/waypoints.min.js') }}"></script>
<script src="{{ url('unika/inc/isotope.pkgd.min.js') }}"></script>
<script src="{{ url('unika/inc/classie.js') }}"></script>
<script src="{{ url('unika/inc/jquery.easing.min.js') }}"></script>
<script src="{{ url('unika/inc/jquery.counterup.min.js') }}"></script>
<script src="{{ url('unika/inc/smoothscroll.js') }}"></script>

<!-- Theme JS -->
<script src="{{ url('unika/js/theme.js') }}"></script>

<script>
    function moveToAbout() {
        var navHeight = $('#main-navbar').height();
        var position = $('#about-section').offset().top - navHeight;
        $('html, body').animate({
            scrollTop: position
        });
    }

    function saveContact() {
        var myform = document.contactForm;
        console.log('Name: ' + myform.name.value);
        console.log('E-mail: ' + myform.email.value);
        console.log('Subject: ' + myform.subject.value);
        console.log('Message: ' + myform.message.value);

        $('#contactLoading').removeClass('w3-hide');
        $('#welcome').text('');
        $('#notwelcome').text('');

        $.ajax({
            url: '{{ url("contact") }}',
            data: {
                name: myform.name.value,
                email: myform.email.value,
                subject: myform.subject.value,
                message: myform.message.value,
                _token: '{{ csrf_token() }}'
            },
            type: 'POST',
            dataType: 'JSON',
            success: function (res) {
                if (res.result === 'ok') {
                    $('#welcome').text(res.msg);
                } else {
                    $('#notwelcome').text(res.msg);
                }
            },
            error: function (xhr) {
                $('notwelcome').text('Network Happen Problem');
            },
            complete: function () {
                $('#contactLoading').addClass('w3-hide');
            }
        });
        return false;
    }
</script>

</body>


</html>
