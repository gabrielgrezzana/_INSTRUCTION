<div class="col-9 row pr-0">
	<div class="box-shadow style-right position-relative block-right-page content-block d-block c-block container p-3">
		<h5 class="heading">CONTACT US</h5>
		<?php echo file_get_contents("_admin/about-us.data"); ?>
	</div>
</div>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.21.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
	  https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.21.0/firebase-database.js"></script>

<script>
	// Your web app's Firebase configuration
	const firebaseConfig = {
		apiKey: "AIzaSyDVYXVsS4QYuSH57gdL97m9ux2E8P7Q-Bg",
		authDomain: "my-firebase-94f9d.firebaseapp.com",
		databaseURL: "https://my-firebase-94f9d.firebaseio.com",
		projectId: "my-firebase-94f9d",
		storageBucket: "my-firebase-94f9d.appspot.com",
		messagingSenderId: "485758887126",
		appId: "1:485758887126:web:6767dfa6effa4a86719577",
		measurementId: "G-3TS3VEGQ2Y"
	};
	// Initialize Firebase
	firebase.initializeApp(firebaseConfig);
	const db = firebase.database();

	firebase.database().ref('systemsave').on('value', function(snapshot) {
		console.log('systemsave', snapshot.val())
	});
</script>