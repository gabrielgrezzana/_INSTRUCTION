<?php //include config
require_once('./includes/config.php');

//if not logged in redirect to login page
if (!$user->is_logged_in()) {
	header('Location: login.php');
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Admin - Edit Page Sample</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="/fav_rf.ico" type="image/x-icon" />
	<link href="./assets/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="./assets/css/exdeus.css" rel="stylesheet" media="screen">
	<script src="./ckeditor/ckeditor.js"></script>
</head>

<body>

	<div class="container" id="wrapper">

		<?php include('menu.php'); ?>


		<h4>Page Sample</h4>


		<?php

		$cachefile	= './page-sample.data';

		if (empty($cachefile)) {
			file_put_contents($cachefile, 'No Data');
		}

		//if form has been submitted process it
		if (isset($_POST['submit'])) {

			$_POST = array_map('stripslashes', $_POST);

			//collect form data
			extract($_POST);

			//very basic validation
			if ($postCont == '') {
				$error[] = 'Please enter the content.';
			}

			if (!isset($error)) {

				file_put_contents($cachefile, $postCont);
			}
		}

		?>


		<?php
		//check for any errors
		if (isset($error)) {
			foreach ($error as $error) {
				echo $error . '<br />';
			}
		}

		$rulesdata	=	 file_get_contents($cachefile);
		?>

		<form action='' method='post'>

			<br />
			<p><label>Content</label><br />
				<textarea name="postCont" id="postCont" rows="10" cols="80">
			<?php echo $rulesdata; ?>
			</textarea>
				<script>
					// Replace the <textarea id="editor1"> with a CKEditor
					// instance, using default configuration.
					CKEDITOR.replace('postCont');
				</script>
			</p>
			<br />
			<p><input class="btn btn-primary" type='submit' name='submit' value='Update'></p>

		</form>

	</div>

</body>

</html>