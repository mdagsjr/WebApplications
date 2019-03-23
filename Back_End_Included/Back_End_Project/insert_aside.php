<?
session_start();

if ($_SESSION['authenticated']) {
require_once('site_forms.php');
require_once('site_core.php');
require_once('site_db.php');


function return_aside_form($values) {
	return '
		<form action="?action=insert" method="post">'.
			return_input_text('asideid','Aside ID',$values['asideid'],true).
			return_input_text('title','Aside Title',$values['title'],true).
			return_textarea('content','Aside Content',$values['content']). 	
			return_input_text('color','Aside Color',$values['color']).'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}
		function echo_aside_form($values) {
	echo return_aside_form($values);
}

function insert_aside($values) {
	$asideid = $values['asideid'];
	$title = $values['title'];
	$content = $values['content'];
	$color = $values['color'];
	$sql = "INSERT INTO ma21dago_asides (asideid, title, color, content) VALUES ('$asideid','$title' ,'$color','$content')";
	run_query($sql);
}

// Set the title of the page
$title = "Insert Aside";

echo_head($title);

// Create page content
echo '
	<div class="container">
		<h2>'.$title.'</h2>';

// If data is posted and URL action is insert
if ($_POST && $_GET['action']=="insert") {
	
	insert_aside($_POST);
	
	echo '
		<div class="alert alert-success" role="alert">
			The following values were submitted. 
			Enter new values and submit again, 
			or press clear to reset the form.
		</div>
		<p><a href="logout.php" class="btn btn-primary">Logout</a></p>
		<p><a href="insert_aside.php" class="btn btn-success">Insert Another Aside</a></p>
		<p><a href="control_panel.php" class="btn btn-primary">Control Panel</a></p>';
	
	echo_aside_form($_POST);
}	
else {
	// If there is no posted data or no URL insert action
	echo_aside_form();
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