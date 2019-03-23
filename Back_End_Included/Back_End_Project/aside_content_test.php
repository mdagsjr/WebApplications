<?
require_once('site_core.php');

require_once('site_forms.php');

require_once('site_db.php');

require_once('drop_down.php');


	$id = $_GET['pageid'];
	$sql = "SELECT asideid FROM ma21dago_has_aside WHERE pageid='$id'";
	$r = run_query($sql);
	while($row = $r->fetch_assoc())
	{

		
		$aid = $row['asideid'];
		$sql2= "SELECT title, content, color FROM ma21dago_asides WHERE asideid = '$aid'";
		$r2 = run_query($sql2);
		$aside_content = $r2->fetch_assoc();
		
		return '<aside>
				<h3 style="color: '.$aside_content['color'].' ">'.$aside_content['title'].'</h3>
				<p>'.$aside_content['content'].'</p>
		</aside>';
		
		
	}

	
	

?>