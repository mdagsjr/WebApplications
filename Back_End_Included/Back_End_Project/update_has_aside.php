<?
session_start();
if ($_SESSION['authenticated']) {
	
function return_has_aside_buttons($r) {
	var_dump($r);
	
	$out = '';
	foreach($r as $aid=>$pid) {
		$out .= '<a class="btn btn-warning" href="update_has_aside.php?aid='.$aid.'&pid='.$pid.'">'.$aid.' <--> '.$pid.'</a> <br>';
	}
	return $out;
	
}

require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');
require_once('drop_down.php');

// Set the title of the page
$title = "Update Has Aside";

// Echo the HTML head with title
echo_head($title);

// Echo Bootstrap container 
echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

// Get the page id and action
$pid = $_GET['pid'];
$aid = $_GET['aid'];

$action = $_GET['action'];

// If the id is null/blank
if ($aid == '' || $pid == '') {
	
	// Get the pageid and title of all pages
	$result = run_query("SELECT asideid, pageid FROM ma21dago_has_aside");
	
	// Transform it into an associative array
	$relationships = array();
	while ($row = $result->fetch_assoc()) {
		$relationships[ $row['asideid'] ] = $row['pageid'];
	}
	
  
	// Generate a dropdown menu of all the pages
	echo '
		<form method="get" action="update_has_aside.php">'.
			return_has_aside_buttons($relationships).'
			<input type="submit">
		</form>';
}
// If action is update
else if ($action=='update') {

	// Get the posted form data
	$aid = $_GET['aid'];
	$pid = $_GET['pid'];
	
	$asideid = $_POST['asideid'];
	$pageid = $_POST['pageid'];
	$ord = $_POST['ord'];
	
	// Form the query
	$sql = "UPDATE ma21dago_has_aside SET asideid = '$asideid', pageid = '$pageid', ord = '$ord' WHERE asideid='$aid' AND pageid='$pid'";

	// Run the query
	run_query($sql);
	
	// Echo feedback
	echo '
		<p><a href="index.php?asideid='.$id.'">'.$id.'</a> was updated from ma21dago_asides</p>
		<p><a href="logout.php" class="btn btn-primary">Logout</a></p>
		<p><a href="update_has_aside.php" class="btn btn-warning">Edit Another Has Aside</a></p>
		<p><a href="control_panel.php" class="btn btn-primary">Control Panel</a></p>';
}

// If the id is given but action is not update
else {
	
	/* // Get all the pages to generate the parent drop down
	$result = run_query("SELECT pageid, title FROM ma21dago_asides");
	$pages = array();
	while ($row = $result->fetch_assoc()) {
		$pages[ $row['asideid'] ] = $row['title'];
	}	 */
	
	// Get the data for the selected page
	$result = run_query("SELECT * FROM ma21dago_has_aside WHERE asideid='$aid' AND pageid='$pid'");
	$values = $result->fetch_assoc();
	
	
	// Ouput the edit form
	echo '
		<form action="update_has_aside.php?action=update&aid='.$aid.'&pid='.$pid.'" method="post">'.
			return_input_text('asideid','Aside ID',$values['asideid'],true).
			return_input_text('pageid','Page ID',$values['pageid'],true).				
			return_input_text('ord','Order',$values['ord']).'
			<input type="submit" class="btn btn-primary" value="Update">
		</form>';	
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