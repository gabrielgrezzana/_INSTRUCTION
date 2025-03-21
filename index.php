<!--
# RF Online Website
# Copyright 2018-2022
# Author: ExDeus
# Website: https://exdeus.dev/
-->
<?php
// # Clean Index
$view = (isset($_GET['do'])) ? $_GET['do'] : '';

$adminpage = 0; include_once ('_CORE.CONFIG.php');

define('BASE_URL', get_url());

require(__DIR__.'/core/title.php');
require(__DIR__.'/core/header.php');
require(__DIR__.'/core/menu.php');
require(__DIR__.'/core/body.php');


if (empty($view)) {
	require(__DIR__."/pages/home.php");
} elseif (file_exists(__DIR__."/pages/".BASENAME($view).".php")) {
	require(__DIR__."/pages/".BASENAME($view).".php");
} else {
	// header("Location: 404");
	require("pages/_404.php");
}
require(__DIR__.'/core/footer.php');
?>
