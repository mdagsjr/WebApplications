<?
session_start();
if($_SESSION['authenticated'] && $_SESSION['admin']){
require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');
require_once('drop_down.php');

// Set the title of the page
$title = "Update User";

// Echo the HTML head with title
echo_head($title);

// Echo Bootstrap container 
echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

// Get the user id and action
$id = $_GET['id'];
$action = $_GET['action'];

// If the id is null/blank
if ($id == '') {
	
	// Get the userid of all the users
	$result = run_query("SELECT userid FROM ma21dago_users");
	
	// Transform it into an associative array
	$users = array();
	while ($row = $result->fetch_assoc()) {
		$users[ $row['userid'] ] = $row['userid'];
	}
	
	// Generate a dropdown menu of all the users
	echo '
		<form method="get" action="update_user.php">'.
			return_option_select('id',$users,'Select a user').'
			<input type="submit">
		</form>';
}
// If action is update
else if ($action=='update') {

	// Get the posted form data
	$userid = $_POST['userid'];
	$passwd = $_POST['passwd'];
	$type = $_POST['type'];
	$new_hashed_passwd= password_hash($passwd, PASSWORD_DEFAULT);
	// Form the query
	$sql = "UPDATE ma21dago_users SET userid = '$userid', passwd = '$new_hashed_passwd', type = '$type' WHERE userid='$id'";

	// Run the query
	run_query($sql);
	
	// Echo feedback
	echo '
		<p><a href="index.php?userid='.$id.'">'.$id.'</a> was updated from ma21dago_users</p><br>
		<p><a href="logout.php" class="btn btn-primary">Logout</a></p>
		<p><a href="update_user.php" class="btn btn-warning">Edit Another User</a></p>
		<p><a href="control_panel.php" class="btn btn-primary">Control Panel</a></p>';
}

// If the id is given but action is not update
else {
	
	// Not Needed here
	/* $result = run_query("SELECT pageid, title FROM ma21dago_pages");
	$pages = array();
	while ($row = $result->fetch_assoc()) {
		$pages[ $row['pageid'] ] = $row['title'];
	}	 */
	
	// Get the data for the selected user
	// left off here!
	$result = run_query("SELECT * FROM ma21dago_users WHERE userid='$id'");
	$values = $result->fetch_assoc();
	
	
	// Ouput the edit form
	echo '
		<form action="update_user.php?action=update&id='.$id.'" method="post">
			<label>Page ID: </label> <b>'.$id.'</b><br>'.
			return_input_text('userid','Username',$values['userid'],true).
			return_input_text_password('passwd','Password',$values['passwd']). 	
			return_input_text('type','Type',$values['type']).'
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