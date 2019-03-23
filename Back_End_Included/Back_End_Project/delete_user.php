<?
session_start();
if($_SESSION['authenticated'] && $_SESSION['admin']){
	
require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');
require_once('drop_down.php');


// Set the title of the page
$title = "Delete User";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$id = $_GET['id'];
$action = $_GET['action'];

if ($id == '') {
		$result = run_query("SELECT userid, type FROM ma21dago_users");
		$pages = array();
		while($row = $result->fetch_assoc())
		{
			$pages[$row['userid']] = $row['userid'];
		}
		echo '
				<form method="get" action="delete_user.php">'.
					return_option_select('id', $pages, 'Pick a page').'
					<input type="submit" class="btn btn-primary" value="Submit">
				</form>';
		
}
else if ($action=='delete') {
	$sql = "DELETE FROM ma21dago_users WHERE userid='$id'";
	run_query($sql);

	// $sql = "DELETE FROM asides WHERE asideid='$id'";
	// $sql = "DELETE FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";
	
	echo '<p><b>'.$id.'</b> was deleted from <b>'.$table.'</b></p>
	<p><a href="logout.php" class="btn btn-primary">Logout</a></p>
		<p><a href="delete_user.php" class="btn btn-danger">Delete Another User</a></p>
		<p><a href="control_panel.php" class="btn btn-primary">Control Panel</a></p>';
}
else {		
	echo '
		<p>Are you sure you want to delete <b>'.$id.'</b> from <b>'.$table.'</b>?</p>
		<p>
			<a href="delete_user.php?action=delete&id='.$id.'" class="btn btn-danger">Yes</a>
			<a href="delete_user.php" class="btn btn-primary">No</a>
		</p>';
}
echo'
	<br>
	<p><a href="logout.php" class="btn btn-primary">Logout</a></p>
	<p><a href="control_panel.php" class="btn btn-primary">Control Panel</a></p>';
echo '</div>';


echo_foot();
}
else
{
	header("Location: login.php");
}
?>