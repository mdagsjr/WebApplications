<?
	require_once('site_db.php');
	$sql0 = "CREATE TABLE IF NOT EXISTS `ma21dago_pages` (
			`pageid` varchar(32) NOT NULL,
			`title` varchar(64) NOT NULL,
			`parent` varchar(32) Default NULL,
			`content` text,
			PRIMARY KEY (`pageid`)
	)";
	
	run_query($sql0);
	
	echo 'SUCCESS: The following query executed: <pre>'.$sql0.'</pre>';
	
	$sql2 = "CREATE TABLE IF NOT EXISTS `ma21dago_has_asides` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
			`pageid` varchar(32) NOT NULL,
			`asideid` varchar(64) NOT NULL,
			`ord` int(11) Default NULL,	
			PRIMARY KEY (`id`)
	)";
	
	run_query($sql2);
	echo 'SUCCESS: The following query executed: <pre>'.$sql2.'</pre>';
	
	$sql3 = "CREATE TABLE IF NOT EXISTS `ma21dago_asides` (
			`asideid` varchar(32) NOT NULL,
			`title` varchar(64) NOT NULL,
			`color` varchar(32) Default NULL,
			`content` text,
			PRIMARY KEY (`asideid`)
	)";
	run_query($sql3);
	echo 'SUCCESS: The following query executed: <pre>'.$sql3.'</pre>';
?>