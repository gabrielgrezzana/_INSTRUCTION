
		</div>
	</div> <!-- /container -->
	<footer id="footer" class="fot-bg">
	<!-- simple audio coding -->
	<audio controls autoplay loop="true" hidden="true" autostart="true">
		<source src="" type="audio/mp3">
		Your browser does not support the audio element.
	</audio>
	<div class="clear-top">
		<!-- MU Footer style -->
		<div class="container page-block-footer">
			<div class="thumbs">
				<a title="<?= $config['website_title']; ?>" href="#"><div class="ico rfonline"></div></a>
				<a title="<?= $config['website_title']; ?>" href="#"><div class="ico ccr"></div></a>
			</div>
			<div class="info">
				<div class="copy">
					&copy; <?= date('Y')?> <a title="<?= $config['website_title']; ?>" href="./" style="text-decoration: uppercase;"><?= $config['website_title']; ?></a><br/>
					All rights reserved. All trademarks mentioned herein belong to their respective owners.
				</div>
			</div>
			<div class="m-auto"><p class="m-0 text-center">MATERIALS FOR PERSONS</p><p class="m-0 text-center">OVER 18 YEARS</p></div>
		</div>
	</footer>
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<!-- <script src="https://www.gstatic.com/firebasejs/7.21.0/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/7.21.0/firebase-database.js"></script> -->
	<script src="./assets/js/bootstrap.min.js" async></script>
	<script src="./assets/addons/notiflix/notiflix-2.7.0.min.js" async></script>
	<script src="./assets/addons/toast/toast.min.js" async></script>
	<!-- MU Core JavaScript -->
	<script src="./assets/js/power.js" async></script>
	<script src="./assets/js/api.js" async></script>
	<script>
		
		var count1st = new Date("Dec 31, 2030 06:00:00").getTime();
		var x = setInterval(function() {
			var now = new Date().getTime();
			var distance = count1st - now;
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			document.getElementById("1st_cw").innerHTML = "-" + hours + "h "+ minutes + "m " + seconds + "s";
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("1st_cw").innerHTML = "EXPIRED";
			}
		}, 1000);
		var count2nd = new Date("Dec 31, 2030 14:00:00").getTime();
		var x = setInterval(function() {
			var now = new Date().getTime();
			var distance = count2nd - now;
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			document.getElementById("2nd_cw").innerHTML = "-" + hours + "h "+ minutes + "m " + seconds + "s";
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("2nd_cw").innerHTML = "EXPIRED";
			}
		}, 1000);
		var count3rd = new Date("Dec 31, 2030 22:00:00").getTime();
		var x = setInterval(function() {
			var now = new Date().getTime();
			var distance = count3rd - now;
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			document.getElementById("3rd_cw").innerHTML = "-" + hours + "h "+ minutes + "m " + seconds + "s";
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("3rd_cw").innerHTML = "EXPIRED";
			}
		}, 1000);
	</script>
	<!-- Countdown script -->
	<!-- <script>
		// Set the date we're counting down to
		var countDownDate = new Date("May 21, 2021 9:00:00").getTime();

		// Update the count down every 1 second
		var x = setInterval(function() {

		// Get todays date and time
		var now = new Date().getTime();

		// Find the distance between now and the count down date
		var distance = countDownDate - now;

		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		// Display the result in the element with id="demo"
		document.getElementById("countdown").innerHTML = "<div class='countdown-container days'><span class='countdown-heading days-top'>Days</span><span class='countdown-value days-bottom'>" + days + "</span></div>" +
		"<div class='countdown-container hours'><span class='countdown-heading hours-top'>Hours</span><span class='countdown-value hours-bottom'>" + hours + "</span></div>" +
		"<div class='countdown-container minutes'><span class='countdown-heading minutes-top'>Minutes</span><span class='countdown-value minutes-bottom'>" + minutes + "</span></div>" + 
		"<div class='countdown-container seconds'><span class='countdown-heading seconds-top'>Seconds</span><span class='countdown-value seconds-bottom'>" + seconds + "</span></div>";

		// If the count down is finished, write some text 
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("countdown").innerHTML = "<div class='countdown-container days'><span class='countdown-heading days-top'>Days</span><span class='countdown-value days-bottom'>O</span></div>" +
		"<div class='countdown-container hours'><span class='countdown-heading hours-top'>Hours</span><span class='countdown-value hours-bottom'>P</span></div>" +
		"<div class='countdown-container minutes'><span class='countdown-heading minutes-top'>Minutes</span><span class='countdown-value minutes-bottom'>E</span></div>" + 
		"<div class='countdown-container seconds'><span class='countdown-heading seconds-top'>Seconds</span><span class='countdown-value seconds-bottom'>N</span></div>";
		}
		}, 1000);
	</script> -->
</body>
</html>