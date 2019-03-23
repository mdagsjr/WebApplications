<?
	require_once("site_core.php");
	session_start();
	//$title = "Control Panel"
	echo_head();
	echo'<title>Control Panel</title>';
	if ($_SESSION['authenticated']) {
		
		echo'<div class="container">';
		echo'<h1>Control Panel: </h1><br>';
		
			// hyperlinks to all of the important tables
			echo'<h3>View Tables:</h3><br>';
			echo'<ul>
			<li><a href="http://ma21dago.breimer.net/project2/show_table.php?table=ma21dago_pages" class="btn btn-primary">Show Pages Table</a></li><br>
			<li><a href="http://ma21dago.breimer.net/project2/show_table.php?table=ma21dago_asides" class="btn btn-primary">Show Asides Table</a></li><br>
			<li><a href="http://ma21dago.breimer.net/project2/show_table.php?table=ma21dago_has_aside" class="btn btn-primary">Show Has Aside Table</a></li><br>';
			echo'<br>';
			
			echo'<h3>Page Operations: </h3>';
			echo'
			<li><a href="http://ma21dago.breimer.net/project2/insert_page.php" class="btn btn-success">Create Page</a></li><br>
			<li><a href="http://ma21dago.breimer.net/project2/update.php" class="btn btn-warning">Edit Page(s)</a></li><br>';
			
			echo'<br>';
			
			echo'<h3>Aside Operations: </h3>';
			echo'
			<li><a href="http://ma21dago.breimer.net/project2/insert_aside.php" class="btn btn-success">Create Aside</a></li><br>
			<li><a href="http://ma21dago.breimer.net/project2/update_aside.php" class="btn btn-warning">Edit Aside(s)</a></li><br>';
			
			echo'<br>';
			
			echo'<h3>Has Aside Operations: </h3>';
			echo'
			<li><a href="http://ma21dago.breimer.net/project2/insert_has_aside" class="btn btn-success">Create Has Aside</a></li><br>
			<li><a href="http://ma21dago.breimer.net/project2/update_has_aside.php" class="btn btn-warning">Edit Has Aside(s)</a></li><br>';
			
			
			if ($_SESSION['admin']) {
					echo'<h3>View Users table:</h3>';
					echo '<li><a href="http://ma21dago.breimer.net/project2/show_table.php?table=ma21dago_users" class="btn btn-danger">Show Users Table</a></li><br>';
					echo'<br>';
					
					echo'<h3 style="color:red;">Delete pages, asides, has aside:</h3>';
					echo '<li><a href="http://ma21dago.breimer.net/project2/basic_delete.php" class="btn btn-danger">Delete Pages</a></li><br>';
					echo '<li><a href="http://ma21dago.breimer.net/project2/delete_aside.php" class="btn btn-danger">Delete Aside</a></li><br>';
					echo '<li><a href="http://ma21dago.breimer.net/project2/delete_has_aside.php" class="btn btn-danger">Delete Has Aside</a></li><br>';
					
					echo'<br>';
					echo'<h3>User Functions: </h3>';
					echo' <li><a href="http://ma21dago.breimer.net/project2/insert_user.php" class="btn btn-success">Create User</a></li><br>';
					echo' <li><a href="http://ma21dago.breimer.net/project2/update_user.php" class="btn btn-warning">Update User</a></li><br>';
					echo '<li><a href="http://ma21dago.breimer.net/project2/delete_user.php" class="btn btn-danger">Delete User</a></li><br>';
					echo '<li><a href="http://ma21dago.breimer.net/project2/delete_user_table.php" class="btn btn-danger">Delete Users Table</a></li><br>';
					
					echo'<br>';
					echo'<h3>Create Tables: </h3>';
					echo '<li><a href="http://ma21dago.breimer.net/project2/create_tables.php" class="btn btn-success">Create Table(s)</a></li><br>';
					
					
			}
			echo '<ul/>';
			//adding in the logout button
			echo'<a href="logout.php" class="btn btn-primary">Logout</a>';
			
			echo'</div>';
			
	}
	echo_foot();
?>