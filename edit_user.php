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
	
	
	
	$pass = '';
	if (isset($_POST['new_password1'])){
		$pass = mysqli_real_escape_string($dbc, trim($_POST['new_password1']));
	}
	
	$query = "update users set password = SHA2('$pass',256) where id= ".$_POST['usr_id']."";
	
	$run = @mysqli_query($dbc, $query);
	
	if ($run){
		if (mysqli_affected_rows($dbc)>0){
			echo "success";
		}
	}
	else
	echo "failed $query";
	
mysqli_close($dbc);
?>