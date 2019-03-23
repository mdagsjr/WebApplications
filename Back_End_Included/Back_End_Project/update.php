<?
session_start();

if ($_SESSION['authenticated']) {
require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');
require_once('drop_down.php');

// Set the title of the page
$title = "Update Page";

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
	$result = run_query("SELECT pageid, title FROM ma21dago_pages");
	
	// Transform it into an associative array
	$pages = array();
	while ($row = $result->fetch_assoc()) {
		$pages[ $row['pageid'] ] = $row['title'];
	}
	
	// Generate a dropdown menu of all the pages
	echo '
		<form method="get" action="update.php">'.
			return_option_select('id',$pages,'Select a page').'
			<input type="submit">
		</form>';
}
// If action is update
else if ($action=='update') {

	// Get the posted form data
	$title = $_POST['title'];
	$content = addslashes($_POST['content']);
	$parent = $_POST['parent'];
	
	// Form the query
	$sql = "UPDATE ma21dago_pages SET title = '$title', content = '$content', parent = '$parent' WHERE pageid='$id'";

	// Run the query
	run_query($sql);
	
	// Echo feedback
	echo '
		<p><a href="index.php?pageid='.$id.'">'.$id.'</a> was updated from pages</p>
		<p><a href="logout.php" class="btn btn-primary">Logout</a></p>
		<p><a href="update.php" class="btn btn-warning">Edit Another Page</a></p>
		<p><a href="conrol_panel.php" class="btn btn-primary">Control</a></p>';
}

// If the id is given but action is not update
else {
	
	// Get all the pages to generate the parent drop down
	$result = run_query("SELECT pageid, title FROM ma21dago_pages");
	$pages = array();
	while ($row = $result->fetch_assoc()) {
		$pages[ $row['pageid'] ] = $row['title'];
	}	
	
	// Get the data for the selected page
	$result = run_query("SELECT * FROM ma21dago_pages WHERE pageid='$id'");
	$values = $result->fetch_assoc();
	
	
	// Ouput the edit form
	echo '
		<form action="update.php?action=update&id='.$id.'" method="post">
			<label>Page ID: </label> <b>'.$id.'</b><br>'.
			return_input_text('title','Page Title',$values['title'],true).
			return_textarea('content','Page Content',$values['content']). 	
			return_option_select('parent',$pages,'Parent Page',$values['parent']).'
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
else{
	header("Location: login.php");
}

?>