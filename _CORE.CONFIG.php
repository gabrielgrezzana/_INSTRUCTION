<?php
// Time Zone Settings
date_default_timezone_set("Asia/Singapore");
error_reporting(E_ALL);

// Display Error Settings
ini_set('display_errors', 'On');

// MYSQL Settings
$MYSQL_HOST					= 'localhost';
$MYSQL_PORT					= '3306';
$MYSQL_USER					= 'root';
$MYSQL_PASS					= 'xzxzxzxz';
$MYSQL_DB					= 'ex_default1';

// Extra config
$lastkillCfg				= false;

if ($adminpage != 1) { include_once '_CORE.FUNCTION.php'; }
?>