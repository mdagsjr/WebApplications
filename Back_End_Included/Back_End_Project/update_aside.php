<?
session_start();

if ($_SESSION['authenticated']) {
require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');
require_once('drop_down.php');

// Set the title of the page
$title = "Update Aside";

// Echo the HTML head with title
echo_head($title);

// Echo Bootstrap container 
echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

// Get the page id and action
$id = $_GET['id'];
$action = $_GET['action'];

// If the id is null/blank
if ($id == '') {
	
	// Get the pageid and title of all pages
	$result = run_query("SELECT asideid, title FROM ma21dago_asides");
	
	// Transform it into an associative array
	$pages = array();
	while ($row = $result->fetch_assoc()) {
		$pages[ $row['asideid'] ] = $row['title'];
	}
	
	// Generate a dropdown menu of all the pages
	echo '
		<form method="get" action="update_aside.php">'.
			return_option_select('id',$pages,'Select a page').'
			<input type="submit">
		</form>';
}
// If action is update
else if ($action=='update') {

	// Get the posted form data
	$title = $_POST['title'];
	$color = $_POST['color'];
	$content = addslashes($_POST['content']);
	
	// Form the query
	$sql = "UPDATE ma21dago_asides SET title = '$title', color = '$color', content = '$content' WHERE asideid='$id'";

	// Run the query
	run_query($sql);
	
	// Echo feedback
	echo '
		<p><a href="index.php?asideid='.$id.'">'.$id.'</a> was updated from ma21dago_asides</p>
		<p><a href="logout.php" class="btn btn-primary">Logout</a></p>
		<p><a href="update_aside.php" class="btn btn-warning">Edit Another Aside</a></p>
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
	$result = run_query("SELECT * FROM ma21dago_asides WHERE asideid='$id'");
	$values = $result->fetch_assoc();
	
	
	// Ouput the edit form
	echo '
		<form action="update_aside.php?action=update&id='.$id.'" method="post">
			<label>Aside ID: </label> <b>'.$id.'</b><br>'.
			return_input_text('title','Aside Title',$values['title'],true).
			return_input_text('color','Color',$values['color']). 	
			return_textarea('content','Aside Content',$values['content']). '
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