<style>
    .mySlides {display:none}
    .demo {cursor:pointer}
</style>

<div class="w3-section w3-container w3-center">
    <div class="w3-row">
        <div class="w3-col m4 w3-container"></div>        
        <div class="w3-col m4 w3-display-container">
            <img style="width: 90%" src="{{ url('pic/time.png') }}">
            <div class="w3-text-white" style="position: absolute;width: 24%;left: 8%;bottom: 4%;"><span id="time">10:55:11</span></div>
            <div class="w3-text-white" style="position: absolute;width: 24%;left: 39%;bottom: 4%;"><span id="pH">10:55:11</span></div>
            <div class="w3-text-white" style="position: absolute;width: 24%;left: 70%;bottom: 4%;"><span id="temp">10:55:11</span></div>
        </div>        
    </div>
</div>

<div class="w3-container">
    <div class="w3-row"> 
        <div class="w3-col m2 w3-container"></div>
        <div class="w3-col m6 w3-padding-bottom"> 
            @foreach($pictures as $datetime => $photo)
                <?php $index = 0; ?>
                @if($index++ < 8)
                <div class="w3-display-container mySlides w3-center">
                    <a href="{{ url($photo) }}" data-lightbox="gallery" data-title="Album - {{ $datetime }}"><img style="width: 90%" class="w3-card-16 w3-round-large w3-animate-left" src="{{ url($photo) }}"></a>
                    <div style="margin-left: 5%" class="w3-display-topleft w3-large w3-container w3-padding-16 w3-black">
                        {{ $datetime }}
                    </div>
                </div>
                @else
                    <a href="{{ url($photo) }}" data-lightbox="gallery" data-title="{{ $datetime }}"></a>
                @endif
            @endforeach
        </div>

        <div class="w3-col m3">
            <div class="w3-row-padding">
                <?php $index = 0; ?>
                @foreach($pictures as $photo)
                @if($index < 8)
                    <div class="w3-col m6 s3 w3-padding-bottom">
                        <img class="demo w3-round w3-opacity w3-hover-opacity-off" src="{{ url($photo) }}" style="width:100%" onclick="currentDiv({{ ++$index }})">
                    </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function currentDiv(n) {
        showDivs(slideIndex = n);
    }
    carousel();
    function carousel(){
        plusDivs(1);
        setTimeout(carousel, 6000);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
        }
        x[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " w3-opacity-off";
    }

    refreshEnv();
    function refreshEnv() {
        $.ajax({
            type: 'POST',
            url: '{{ url("/getEnvironment") }}',
            dataType: 'json',
            data: {
                _token: '{!! csrf_token() !!}',
            },
            success: function(jData) {
                const time = new Date();
                let timeString = time.getHours() + ':' + time.getMinutes() + ':';
                timeString += time.getSeconds() > 9 ? time.getSeconds() : '0' + time.getSeconds();
                $('#time').text(timeString);
                $('#pH').text(jData.ph);
                $('#temp').text(jData.tmp);
                setTimeout(refreshEnv, 1000);
            },
            error: function(error) {
                $('body').html(error.responseText);
            }
        });
    }
</script>