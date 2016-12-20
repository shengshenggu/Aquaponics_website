<!DOCTYPE html>
<html>
<head>
	<title>Demo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<style>
		.w3-ball {
			border-radius: 100%;
			cursor: pointer;
		}
	</style>
</head>
<body id="home">
	<div class="w3-top">
	  <ul class="w3-navbar w3-black w3-large">
	    <li><a href="#">Home</a></li>
	    <li><a href="#">Link 1</a></li>
	    <li><a href="#">Link 2</a></li>
	  </ul>
	  <div class="w3-display-container">
		<div class="w3-display-topmiddle">
			<span id="d1" class="w3-border w3-border-teal w3-white w3-text-teal w3-badge w3-ball w3-large">1</span>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span id="d2" class="w3-border w3-border-blue w3-white w3-text-blue w3-badge w3-ball w3-large">2</span>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span id="d3" class="w3-border w3-border-red w3-white w3-text-red w3-badge w3-ball w3-large">3</span>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span id="d4" class="w3-border w3-border-yellow w3-white w3-text-yellow w3-badge w3-ball w3-large">4</span>
		</div>
	  </div>
	</div>
	<ul class="w3-navbar w3-black w3-large"><li><a href="#">Home</a></li></ul>
	

	<div id="b1" class="w3-container w3-red" style="height: 400px"></div>
	<div id="b2" class="w3-container w3-yellow" style="height: 400px"></div>
	<div id="b3" class="w3-container w3-blue" style="height: 400px"></div>
	<div id="b4" class="w3-container w3-green" style="height: 400px"></div>
	<div id="b5"></div>
<script>
var b1 = $('#b1').offset().top - 43;
var b2 = $('#b2').offset().top - 43;
var b3 = $('#b3').offset().top - 43;
var b4 = $('#b4').offset().top - 43;
var b5 = $('#b5').offset().top - 43;

$(window).scroll(function(){
	//判斷整體網頁的高度   
	var BodyHeight = $(document).height();   
	//判斷所見範圍的高度   
	var ViewportHeight= $(window).height();   
	//偵測目前捲軸頂點  
	var now = $(this).scrollTop();
	
	$('#d1').addClass('w3-white');
	$('#d1').addClass('w3-text-teal');
	$('#d1').removeClass('w3-teal');
	$('#d1').removeClass('w3-text-white');
	
	$('#d2').addClass('w3-white');
	$('#d2').addClass('w3-text-blue');
	$('#d2').removeClass('w3-blue');
	$('#d2').removeClass('w3-text-white');
	
	$('#d3').addClass('w3-white');
	$('#d3').addClass('w3-text-red');
	$('#d3').removeClass('w3-red');
	$('#d3').removeClass('w3-text-white');
	
	$('#d4').addClass('w3-white');
	$('#d4').addClass('w3-text-yellow');
	$('#d4').removeClass('w3-yellow');
	$('#d4').removeClass('w3-text-white');

	if (now >= b4 || now+ViewportHeight == BodyHeight) {
		$('#d4').removeClass('w3-white');
		$('#d4').removeClass('w3-text-yellow');
		$('#d4').addClass('w3-yellow');
		$('#d4').addClass('w3-text-white');
	}
	else if (now >= b1 && now < b2) {
		$('#d1').removeClass('w3-white');
		$('#d1').removeClass('w3-text-teal');
		$('#d1').addClass('w3-teal');
		$('#d1').addClass('w3-text-white');
	} else if (now >= b2 && now < b3) {
		$('#d2').removeClass('w3-white');
		$('#d2').removeClass('w3-text-blue');
		$('#d2').addClass('w3-blue');
		$('#d2').addClass('w3-text-white');
	} else if (now >= b3 && now < b4) {
		$('#d3').removeClass('w3-white');
		$('#d3').removeClass('w3-text-red');
		$('#d3').addClass('w3-red');
		$('#d3').addClass('w3-text-white');
	}

	// console.log(BodyHeight);
	// console.log(ViewportHeight);
	// console.log(now);
});

$('#d1').click(function() {
	$('html, body').animate({
		scrollTop: b1
	});
});

$('#d2').click(function() {
	$('html, body').animate({
		scrollTop: b2
	});
});

$('#d3').click(function() {
	$('html, body').animate({
		scrollTop: b3
	});
});

$('#d4').click(function() {
	$('html, body').animate({
		scrollTop: b4
	}, 500);
});

</script>
</body>
</html>