<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=1200, initial-scale=0.1, shrink-to-fit=no">
	<title><?= $title; ?></title>
	<link rel="icon" href="./fav_rf.ico" type="image/x-icon" />
	<meta name="description" content="<?= $config['website_title']; ?> - <?= $config['website_description']; ?>">
	<meta name="keywords" content="<?= $config['website_keywords']; ?>" />
	<meta http-equiv="copyright" content="<?= $config['website_title']; ?>" />
	<meta name="author" content="ExDeus">
	<meta name="robots" content="all">
	<meta property="og:site_name" content="<?= $config['website_title']; ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?= $config['website_title']; ?>" />
	<meta property="og:url" content="<?= $_SERVER['REQUEST_URI']; ?>" />
	<meta property="og:image" content="#" />
	<meta property="og:description" content="<?= $config['website_title']; ?>, Rising Force Online Private Server, RF PS. Download and Play the Ultimate Fantasy Sci-fi 3D Online MMORPG for Free." />
	<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

	<!-- Bootstrap core CSS -->
	<link href="./assets/css/bootstrap.css" rel="stylesheet">
	<!-- MU Core CSS -->
	<link href="./assets/css/style.css" rel="stylesheet">
	<link href="./assets/css/raceclass.css" rel="stylesheet">
	<link href="./assets/css/patchlogs.css" rel="stylesheet">
	<link href="./assets/css/countdown.css" rel="stylesheet">
	<link href="./assets/addons/notiflix/notiflix-2.7.0.min.css" rel="stylesheet">
	<script src="./assets/js/Class.js" async></script>
	<?php if ($config['google_analytics'] != '') { ?>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo $config['google_analytics']; ?>', 'auto');
		ga('send', 'pageview');
	</script>
	<?php } ?>
 </head>