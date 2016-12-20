@extends('layouts.plant')
@section('style')
    <link rel="stylesheet" href="{{ url('css/carousel.css') }}">
@endsection

@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="{{ url('img/index/top1.jpg') }}" alt="歡迎">
        <div class="carousel-caption">
          <h3 class="w3-hide-small">Welcome to Aquaponics</h3>
          <h4 class="w3-hide-large  w3-hide-medium">Welcome to Aquaponics</h4>
          <p>Enjoy the plant</p>
        </div>
      </div>

      <div class="item">
        <img src="{{ url('img/index/top2.jpg') }}" alt="分享">
        <div class="carousel-caption">
          <h3 class="w3-hide-small">Share your experience</h3>
          <h4 class="w3-hide-large  w3-hide-medium">Share your experience</h4>
          <p>Innovation</p>
        </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<article>
    <div id="contents">
      <div id="hospitality">
        <div id="overview">
          
        </div>

        <div id="detail" class="detail cf">
          <div class="inner">
            <div class="group cf group-fr group-t1">
              <div class="image">
                <div><img src="{{ url('img/index/title1-1.jpg') }}" alt="自給自足圖" width="675" height="425"></div>
              </div>
              <div class="txt">
                <h3 class="pc"><img src="{{ url('img/index/title1.png') }}" alt="自給自足" width="473" height="84"></h3>
                <p class="body" style="font-family:微軟正黑體;">魚菜共生系統中有一個看不見的必要元素「益細菌」。這些細菌能夠把魚池裡的一些元素解成植物可以吸收及利用的形式。利用魚本身的機能，讓植物無害的生長，也提供了無毒無農藥的菜類供大眾食用，以達到系統自給自足的目標，並提高作物的經濟價值，也讓大眾能吃的安心。</p>
                <dl class="shisetsu cfx">
                  <dt>蔬菜</dt>
                  <dd>魚</dd>
                </dl>
              </div>
            </div>
            <div class="group cf group-fl group-t1">
              <div class="image">
                <div><img src="{{ url('img/index/title2-1.jpg') }}" alt="節約能源圖" width="675" height="425"></div>
              </div>
              <div class="txt">
                <h3 class="pc"><img src="{{ url('img/index/title2.png') }}" alt="節約能源" width="473" height="84"></h3>
                <p class="body" style="font-family:微軟正黑體;">台灣位於亞熱帶氣候，未來我們將運用台灣在地充足的陽光資源，嘗試使用太陽能取代傳統供電，減少能源的消耗，創造永續的生態經營。</p>
                <dl class="shisetsu cfx">
                  <dt>水資源</dt>
                  <dd>電力</dd>
                </dl>
              </div>
            </div>
            <div class="group cf group-fr group-t1">
              <div class="image">
                <div><img src="{{ url('img/index/title3-1.jpg') }}" alt="生產高效圖" width="675" height="425"></div>
              </div>
              <div class="txt">
                <h3 class="pc"><img src="{{ url('img/index/title3.png') }}" alt="生產高效" width="473" height="84"></h3>
                <p class="body" style="font-family:微軟正黑體;">監控式的種植方式，讓我們可以減少多餘產能的消耗，也減少人力與物力成本。對於植物來說，水耕能直接吸收水中營養，使得植物生長更加茁壯，並且藉由不同的生長條件來調整生長環境，減去了植物生長適應期。</p>
                <dl class="shisetsu cfx">
                  <dt>生長快速</dt>
                  <dd>多元種植</dd>
                </dl>
              </div>
            </div>

            <div class="group cf group-fl group-t1">
              <div class="image">
                <div><img src="{{ url('img/index/title4-1.jpg') }}" alt="無土栽培圖" width="675" height="425"></div>
              </div>
              <div class="txt">
                <h3 class="pc"><img src="{{ url('img/index/title4.png') }}" alt="無土栽培"width="473" height="84"></h3>
                <p class="body" style="font-family:微軟正黑體;">水耕是近幾年來新型的耕作方式，由於採取無土栽培模式，即可節省大量的土地資源。魚菜共生也是屬於水耕的一種，將植物的根系直接泡在水中，讓魚本身釋放出的有機物質，引導至植物的水箱。</p>
                <dl class="shisetsu cfx">
                  <dt>有機</dt>
                  <dd>無農藥</dd>
                </dl>
              </div>
            </div>
            <div class="group cf group-fr group-t1">
              <div class="image">
                <div><img src="{{ url('img/index/title5-1.jpg') }}" alt="簡單種植圖" width="675" height="425"></div>
              </div>
              <div class="txt">
                <h3 class="pc"><img src="{{ url('img/index/title5.png') }}" alt="簡單種植" width="473" height="84"></h3>
                <p class="body" style="font-family:微軟正黑體;">此系統一開始的目的，就是要讓一般人都能夠自己在自家陽台建立一個魚菜共生系統，所以建置成本低、設備簡單。最基礎的設備只需要一個架子、兩個桶子、馬達以及你想養的魚跟種植的植物。</p>
                <dl class="shisetsu cfx">
                  <dt>設備簡易</dt>
                  <dd>菜箱・魚箱・樹莓派・感測器・菜苗・魚苗・抽水馬達・水管</dd>
                </dl>
              </div>
            </div>
            <div class="group cf group-fl group-t1">
              <div class="image">
                <div><img src="{{ url('img/index/title6-1.jpg') }}" alt="不限環境圖" width="675" height="425"></div>
              </div>
              <div class="txt">
                <h3 class="pc"><img src="{{ url('img/index/title6.png') }}" alt="不限環境" width="473" height="84"></h3>
                <p class="body" style="font-family:微軟正黑體;">本系統最大的特點就是佔用空間小，不管什麼地點都可以運用本系統種植植物。春天，可以種植空心菜；夏天，可以種植羅勒；秋天，可以種植迷迭香；冬天，可以種植芋頭；也有全年都可以種植的薄荷、皇宮菜提供大家參考。</p>
                <dl class="shisetsu cfx">
                  <dt>一年四季</dt>
                  <dd>適合各種魚種</dd>
                </dl>
              </div>
            </div>
            <div class="group cf group-fr group-t1">
              <div class="image">
                <div><img src="{{ url('img/index/title7-1.jpg') }}" alt="即時監控圖" width="675" height="425"></div>
              </div>
              <div class="txt">
                <h3 class="pc"><img src="{{ url('img/index/title7.png') }}" alt="即時監控" width="473" height="84"></h3>
                <p class="body" style="font-family:微軟正黑體;">本系統設定一小時回報一次植物的生長環境，溫度，濕度及光度，也會於早、中、晚紀錄植物的影像，讓使用者可以即時監控自己的系統。若生長環境的數值出現異常，也會發訊息通知使用者，讓使用者可以即時收到資訊。</p>
                <dl class="shisetsu cfx">
                  <dt>影像紀錄</dt>
                  <dd>生長圖鑑</dd>
                </dl>
              </div>
            </div>
            <div class="group cf group-fl group-t2 line">
              <div class="image">
                <div><img src="{{ url('img/index/title8-1.jpg') }}" alt="數據分析圖" width="500" height="315"></div>
              </div>
              <div class="txt">
                <h3 class="pc"><img src="{{ url('img/index/title8.png') }}" alt="數據分析" width="473" height="84"></h3>
                <p class="body" style="font-family:微軟正黑體;">運用了聯合國作物資料庫的系統，已經找出幾樣最適合種植於水耕的植物，也列出該植物在什麼溫度、酸鹼值、光度下能生長的最完美。可以運用折線圖分析自己植物的生長條件與聯合國資料庫所提供的最佳生長條件作數據分析的比對。</p>
                <dl class="shisetsu cfx">
                  <dt>環境紀錄</dt>
                  <dd>對比理想條件</dd>
                </dl>
              </div>
            </div>

            <div class="btn-top">
              <a href="#" class="link-top">Back To Top</a>
            </div>
          </div>
        </div>

      </div>
    </div>
</article>
@endsection