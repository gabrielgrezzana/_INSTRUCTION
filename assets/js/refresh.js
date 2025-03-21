 // Simple jQuery DIV Refreshed 
 $(document).ready(function() {
	$("#topkill").load("./includes/topkill.php");
	$("#onlineuser").load("./includes/onlineuser.php");
	
	setInterval(function() {
		 $("#topkill").load("./includes/topkill.php");
		 $("#onlineuser").load("./includes/onlineuser.php");
	}, 60000);	
	$.ajaxSetup({ cache: false });
});