<?
require_once('site_core.php');

require_once('site_forms.php');

require_once('site_db.php');

require_once('drop_down.php');



function return_create_tables_form($values) 
{

	return '

		<form action="?action=insert" method="post">'.

			return_input_text('name','Table Name',$values['name'],true).

			return_input_text('primary','primary',$values['primary'],true). 	

			return_textarea('fields','Table Fields',$values['fields']).'

			<input type="submit" class="btn btn-primary" value="Submit">

			<a href="?" class="btn btn-warning">Clear</a>

		</form>';



}

function echo_create_tables_form($values)
{
	echo return_create_tables_form($values);
}
function insert_tables($values) {

	$name = $values['name'];

	$primary = $values['primary'];

	$fields = $values['fields'];

	

	$sql = "CREATE TABLE IF NOT EXISTS `$name` (
	$fields 
	
	PRIMARY KEY ($primary)
	)";

	run_query($sql);

}

// Set the title of the page
$title = "Create a Table";

echo_head($title);

// Create page content
echo '
	<div class="container">
		<h2>'.$title.'</h2>';

// If data is posted and URL action is insert
if ($_POST && $_GET['action']=="insert") {
	
	insert_tables($_POST);
	
	echo '
		<div class="alert alert-success" role="alert">
			The following values were submitted. 
			Enter new values and submit again, 
			or press clear to reset the form.
		</div>';
	
	echo_create_tables_form($_POST);
}	
else {
	// If there is no posted data or no URL insert action
	echo_create_tables_form();
}

echo '
	</div> <!-- container -->';
	
echo_foot();
	


?>