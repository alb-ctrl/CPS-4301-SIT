<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset(($_SESSION['id'])) || strtolower($_SESSION['role']) != 'admin'){
	header('LOCATION:Login.html');
	die (); 
} 


require ("db_config.php");
	
	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR 
	die('Coul not connect MySQL: ' . mysqli_connect_error () );

	//set encoding 
	mysqli_set_charset($dbc, 'utf8');
	
	$name = '';
	if (isset($_POST['name'])){
		$name = mysqli_real_escape_string($dbc, trim($_POST['name']));
	}
	
	$role = '';
	if (isset($_POST['role'])){
		$role = mysqli_real_escape_string($dbc, trim($_POST['role']));
	}
	
	$login = '';
	if (isset($_POST['login_id'])){
		$login = mysqli_real_escape_string($dbc, trim($_POST['login_id']));
	}
	
	$pass = '';
	if (isset($_POST['password1'])){
		$pass = mysqli_real_escape_string($dbc, trim($_POST['password1']));
	}
	
	$query = "insert into users (name, password , role, user_login) values ('$name', SHA2('$pass',256), '$role', '$login' )";
	
	$run = @mysqli_query($dbc, $query);
	
	if ($run){
		if (mysqli_affected_rows($dbc)>0){
			echo "success";
		}
	}
	

?>