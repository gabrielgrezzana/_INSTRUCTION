<?php
	
	function get_url($exclude_script = true)
	{
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER['HTTPS'] == "on") {
			$pageURL .= "s";
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80" && preg_match('/:/', $_SERVER["HTTP_HOST"]) === false) {
			$pageURL .= $_SERVER["HTTP_HOST"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER['SCRIPT_NAME'];
		} else {
			$pageURL .= $_SERVER["HTTP_HOST"] . $_SERVER['SCRIPT_NAME'];
		}

		if ($exclude_script) {
			$pageURL = strstr($pageURL, basename($_SERVER['PHP_SELF']), true);
		}

		return rtrim($pageURL, '/');
	}
	
	/* PDO MySQL function start */
	$db = new PDO("mysql:host=".$MYSQL_HOST.";port=".$MYSQL_PORT.";dbname=".$MYSQL_DB, $MYSQL_USER, $MYSQL_PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Assign configValue value as variable
	try {
		$exchange = $db->query("SELECT configName, configValue from blog_configurations");
		while($row = $exchange->fetch()) {
			$config[$row['configName']] = $row['configValue'];
		}
	} catch(PDOException $e) {
		echo $e->getMessage();
	}

	function activelink($requestUri)
	{
		$current_file_name = basename($_SERVER['REQUEST_URI']);
		if ($current_file_name == $requestUri)
			echo 'class="active"';
	}
	
	function getRaceImg($race) {
		if ( $race == 0 || $race == 1 )	{ return "<img src='".get_url()."/assets/img/race/bcc.png' alt='RF Online Private Server'>"; }
		if ( $race == 2 || $race == 3 )	{ return "<img src='".get_url()."/assets/img/race/ccc.png' alt='RF Online Private Server'>"; }
		if ( $race == 4 )				{ return "<img src='".get_url()."/assets/img/race/acc.png' alt='RF Online Private Server'>"; }
	}
	
	function getRaceImgG($race) {
		if ( $race == 0 )	{ return "<img src='".get_url()."/assets/img/race/bcc.png' alt='RF Online Private Server'>"; }
		if ( $race == 1 )	{ return "<img src='".get_url()."/assets/img/race/ccc.png' alt='RF Online Private Server'>"; }
		if ( $race == 2 )	{ return "<img src='".get_url()."/assets/img/race/acc.png' alt='RF Online Private Server'>"; }
	}
	
	function getClassName($class) {
		if ( $class == 'BWB0' ) { return "Warrior"; }
		if ( $class == 'BRB0' ) { return "Ranger"; }
		if ( $class == 'BFB0' ) { return "Spiritualist"; }
		if ( $class == 'BSB0' ) { return "Specialist"; }
		if ( $class == 'BWS1' ) { return "Berseker"; }
		if ( $class == 'BWF1' ) { return "Commando"; }
		if ( $class == 'BWF2' ) { return "Miller"; }
		if ( $class == 'BRF1' ) { return "Desperado"; }
		if ( $class == 'BRF2' ) { return "Sniper"; }
		if ( $class == 'BFF1' ) { return "Cypher"; }
		if ( $class == 'BFF2' ) { return "Chandra"; }
		if ( $class == 'BSF1' ) { return "Driver"; }
		if ( $class == 'BSF2' ) { return "Craftman"; }
		if ( $class == 'BWS2' ) { return "Armsman"; }
		if ( $class == 'BWS3' ) { return "Shield Miller"; }
		if ( $class == 'BRS1' ) { return "Hidden Soldier"; }
		if ( $class == 'BRS2' ) { return "Sentinel"; }
		if ( $class == 'BRS3' ) { return "Infiltrator"; }
		if ( $class == 'BFS1' ) { return "Wizard"; }
		if ( $class == 'BFS2' ) { return "Astraler"; }
		if ( $class == 'BFS3' ) { return "Holy Chandra"; }
		if ( $class == 'BSS1' ) { return "Mental Smith"; }
		if ( $class == 'BSS2' ) { return "Armor Rider"; }
		if ( $class == 'CWB0' ) { return "Warrior"; }
		if ( $class == 'CRB0' ) { return "Ranger"; }
		if ( $class == 'CFB0' ) { return "Spiritualist"; }
		if ( $class == 'CSB0' ) { return "Specialist"; }
		if ( $class == 'CWF1' ) { return "Champion"; }
		if ( $class == 'CWF2' ) { return "Knight"; }
		if ( $class == 'CRF1' ) { return "Archer"; }
		if ( $class == 'CRF2' ) { return "Hunter"; }
		if ( $class == 'CFF1' ) { return "Caster"; }
		if ( $class == 'CFF2' ) { return "Summoner"; }
		if ( $class == 'CSF1' ) { return "Craftman"; }
		if ( $class == 'CWS1' ) { return "Templar"; }
		if ( $class == 'CWS2' ) { return "Guardian"; }
		if ( $class == 'CWS3' ) { return "Black Knight"; }
		if ( $class == 'CRS1' ) { return "Adventurer"; }
		if ( $class == 'CRS2' ) { return "Stealer"; }
		if ( $class == 'CRS3' ) { return "Assassin"; }
		if ( $class == 'CFS1' ) { return "Warlock"; }
		if ( $class == 'CFS2' ) { return "Dark Priest"; }
		if ( $class == 'CFS3' ) { return "Grazier"; }
		if ( $class == 'CSS1' ) { return "Artist"; }
		if ( $class == 'AWB0' ) { return "Warrior"; }
		if ( $class == 'ARB0' ) { return "Ranger"; }
		if ( $class == 'ASB0' ) { return "Specialist"; }
		if ( $class == 'AWF1' ) { return "Destroyer"; }
		if ( $class == 'AWF2' ) { return "Gladius"; }
		if ( $class == 'ARF1' ) { return "Gunner"; }
		if ( $class == 'ARF2' ) { return "Scouter"; }
		if ( $class == 'ASF1' ) { return "Engineer"; }
		if ( $class == 'AWS1' ) { return "Punisher"; }
		if ( $class == 'AWS2' ) { return "Assaulter"; }
		if ( $class == 'AWS3' ) { return "Mercenary"; }
		if ( $class == 'ARS1' ) { return "Striker"; }
		if ( $class == 'ARS2' ) { return "Dementer"; }
		if ( $class == 'ARS3' ) { return "Phantom Shadow"; }
		if ( $class == 'ASS1' ) { return "Scientist"; }
		if ( $class == 'ASS2' ) { return "Battle Leader"; }
	}
	
	function getClassImg($class) {		
		if ( $class == 'BWB0' ) { return "<img src='".get_url()."/assets/img/class/icon_BWB0.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BRB0' ) { return "<img src='".get_url()."/assets/img/class/icon_BRB0.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BFB0' ) { return "<img src='".get_url()."/assets/img/class/icon_BFB0.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BSB0' ) { return "<img src='".get_url()."/assets/img/class/icon_BSB0.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BWS1' ) { return "<img src='".get_url()."/assets/img/class/icon_BWS1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BWF1' ) { return "<img src='".get_url()."/assets/img/class/icon_BWF1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BWF2' ) { return "<img src='".get_url()."/assets/img/class/icon_BWF2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BRF1' ) { return "<img src='".get_url()."/assets/img/class/icon_BRF1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BRF2' ) { return "<img src='".get_url()."/assets/img/class/icon_BRF2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BFF1' ) { return "<img src='".get_url()."/assets/img/class/icon_BFF1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BFF2' ) { return "<img src='".get_url()."/assets/img/class/icon_BFF2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BSF1' ) { return "<img src='".get_url()."/assets/img/class/icon_BSF1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BSF2' ) { return "<img src='".get_url()."/assets/img/class/icon_BSF2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BWS2' ) { return "<img src='".get_url()."/assets/img/class/icon_BWS2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BWS3' ) { return "<img src='".get_url()."/assets/img/class/icon_BWS3.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BRS1' ) { return "<img src='".get_url()."/assets/img/class/icon_BRS1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BRS2' ) { return "<img src='".get_url()."/assets/img/class/icon_BRS2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BRS3' ) { return "<img src='".get_url()."/assets/img/class/icon_BRS3.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BFS1' ) { return "<img src='".get_url()."/assets/img/class/icon_BFS1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BFS2' ) { return "<img src='".get_url()."/assets/img/class/icon_BFS2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BFS3' ) { return "<img src='".get_url()."/assets/img/class/icon_BFS3.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BSS1' ) { return "<img src='".get_url()."/assets/img/class/icon_BSS1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'BSS2' ) { return "<img src='".get_url()."/assets/img/class/icon_BSS2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CWB0' ) { return "<img src='".get_url()."/assets/img/class/icon_CWB0.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CRB0' ) { return "<img src='".get_url()."/assets/img/class/icon_CRB0.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CFB0' ) { return "<img src='".get_url()."/assets/img/class/icon_CFB0.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CSB0' ) { return "<img src='".get_url()."/assets/img/class/icon_CSB0.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CWF1' ) { return "<img src='".get_url()."/assets/img/class/icon_CWF1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CWF2' ) { return "<img src='".get_url()."/assets/img/class/icon_CWF2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CRF1' ) { return "<img src='".get_url()."/assets/img/class/icon_CRF1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CRF2' ) { return "<img src='".get_url()."/assets/img/class/icon_CRF2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CFF1' ) { return "<img src='".get_url()."/assets/img/class/icon_CFF1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CFF2' ) { return "<img src='".get_url()."/assets/img/class/icon_CFF2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CSF1' ) { return "<img src='".get_url()."/assets/img/class/icon_CSF1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CWS1' ) { return "<img src='".get_url()."/assets/img/class/icon_CWS1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CWS2' ) { return "<img src='".get_url()."/assets/img/class/icon_CWS2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CWS3' ) { return "<img src='".get_url()."/assets/img/class/icon_CWS3.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CRS1' ) { return "<img src='".get_url()."/assets/img/class/icon_CRS1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CRS2' ) { return "<img src='".get_url()."/assets/img/class/icon_CRS2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CRS3' ) { return "<img src='".get_url()."/assets/img/class/icon_CRS3.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CFS1' ) { return "<img src='".get_url()."/assets/img/class/icon_CFS1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CFS2' ) { return "<img src='".get_url()."/assets/img/class/icon_CFS2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CFS3' ) { return "<img src='".get_url()."/assets/img/class/icon_CFS3.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'CSS1' ) { return "<img src='".get_url()."/assets/img/class/icon_CSS1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'AWB0' ) { return "<img src='".get_url()."/assets/img/class/icon_AWB0.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'ARB0' ) { return "<img src='".get_url()."/assets/img/class/icon_ARB0.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'ASB0' ) { return "<img src='".get_url()."/assets/img/class/icon_ASB0.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'AWF1' ) { return "<img src='".get_url()."/assets/img/class/icon_AWF1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'AWF2' ) { return "<img src='".get_url()."/assets/img/class/icon_AWF2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'ARF1' ) { return "<img src='".get_url()."/assets/img/class/icon_ARF1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'ARF2' ) { return "<img src='".get_url()."/assets/img/class/icon_ARF2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'ASF1' ) { return "<img src='".get_url()."/assets/img/class/icon_ASF1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'AWS1' ) { return "<img src='".get_url()."/assets/img/class/icon_AWS1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'AWS2' ) { return "<img src='".get_url()."/assets/img/class/icon_AWS2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'AWS3' ) { return "<img src='".get_url()."/assets/img/class/icon_AWS3.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'ARS1' ) { return "<img src='".get_url()."/assets/img/class/icon_ARS1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'ARS2' ) { return "<img src='".get_url()."/assets/img/class/icon_ARS2.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'ARS3' ) { return "<img src='".get_url()."/assets/img/class/icon_ARS3.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'ASS1' ) { return "<img src='".get_url()."/assets/img/class/icon_ASS1.jpg' alt='RF Online Private Server''>"; }
		if ( $class == 'ASS2' ) { return "<img src='".get_url()."/assets/img/class/icon_ASS2.jpg' alt='RF Online Private Server''>"; }
	}
?>