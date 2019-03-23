<?
	require_once('site_db.php');
	session_start();
	if ($_SESSION['authenticated'] && $_SESSION['admin']){ 
	
	$sql = "DROP TABLE `ma21dago_users`";
	run_query($sql);
	echo 'Success: The following query excuted: '.$sql;
	}
	else
	{
		die ('Access Denied');
	}
?>