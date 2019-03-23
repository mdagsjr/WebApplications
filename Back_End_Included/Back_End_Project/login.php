<?
session_start();

require_once('site_forms.php');
require_once('site_db.php');
require_once('site_core.php');


$user_submitted_password = $_POST['passwd'];
$userid = $_POST['userid'];
$result = run_query("select passwd, type from ma21dago_users where userid='$userid'");
$row = $result->fetch_assoc();
$hashed_password = $row['passwd'];
$type = $row['type'];

if ($_SESSION['authenticated']) {
  header("Location: control_panel.php");
}
else if ($_POST) {
  if (password_verify($user_submitted_password, $hashed_password)) {
   $_SESSION['authenticated'] = true;
   
   if($type == 1) {
	   $_SESSION['admin'] = true;

   }
   
   header("Location: control_panel.php");
  }
  else {
	  	$m = "Login failed";
  }
}

echo_head("Login");
echo '<div class="container">';        
echo $m.'
<form action="login.php" method="post">'.
 return_input_text('userid','Username',$values['userid'],true).
 return_input_text_password('passwd','Password',$values['passwd'],true).'
  <input type="submit" class="btn btn-primary">	
</form>';
echo '</div>';
echo_foot();	    




?>