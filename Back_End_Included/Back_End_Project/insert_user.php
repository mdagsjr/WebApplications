<?
session_start();

if($_SESSION['authenticated'] && $_SESSION['admin']){
	
require_once('site_forms.php');
require_once('site_core.php');
require_once('site_db.php');

// Set the title of the page

//session_start();

$title = "Insert user";

echo_head($title);

// Create page content
echo '
	<div class="container">
		<h2>'.$title.'</h2>';

// If data is posted and URL action is insert
if ($_POST && $_GET['action']=="insert") {
	
	insert_user($_POST);
	
	echo '
		<div class="alert alert-success" role="alert">
			The following values were submitted. 
			Enter new values and submit again, 
			or press clear to reset the form.
		</div>
		<p><a href="logout.php" class="btn btn-primary">Logout</a></p>
		<p><a href="insert_user.php" class="btn btn-success">Insert Another User</a></p>
		<p><a href="control_panel.php" class="btn btn-primary">Control Panel</a></p>';
	
	echo_user_form($_POST);
}	
else {
	// If there is no posted data or no URL insert action
	echo_user_form();
}

echo '
<br>
	<p><a href="logout.php" class="btn btn-primary">Logout</a></p>
	<p><a href="control_panel.php" class="btn btn-primary">Control Panel</a></p>
	</div> <!-- container -->';
	
	
echo_foot();
}
else
{
	header("Location: login.php");
}
	
?>