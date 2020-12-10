<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//require DB
	require ("db_config.php");
	
	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR 
	die('Coul not connect MySQL: ' . mysqli_connect_error () );

	//set encoding 
	mysqli_set_charset($dbc, 'utf8');
	
	
	$output = '';

	$query = "insert into customers (email";
	$values = "(";
	
	
	if (isset ($_POST['email'])){
		$email = mysqli_real_escape_string($dbc, $_POST["email"]);
		$values = $values . " '$email' ";
	}
	
	if (!empty($_POST['name'])){
		$name = mysqli_real_escape_string($dbc, $_POST["name"]);
		$query = $query . ",name"; 
		$values = $values . ", '$name' ";
	}

	
	
	$values = $values . ")";
	$query = $query . ") values" . $values;
	
	if (mysqli_query($dbc, $query)){
		$last_id = mysqli_insert_id($dbc);
		
	}
	else{
	//	echo "there was a problem insertin the users";
		die();
	} 
	
	$query = "insert into tickets (customer";
	$values = "(".$last_id ;
	if (!empty($_POST['subject'])){
		$subject = mysqli_real_escape_string($dbc, $_POST["subject"]);
		$query = $query . ",subject"; 
		$values = $values . ", '$subject' ";
	}
	
	if (!empty($_POST['status'])){
		$status = mysqli_real_escape_string($dbc, $_POST["status"]);
		$query = $query . ",status"; 
		$values = $values . ", '$status' ";
	}
	else {
		$status = 'New';
		$query = $query . ",status"; 
		$values = $values . ", '$status' ";
	}

	if (!empty ($_POST['description'])){
		$description = mysqli_real_escape_string($dbc, $_POST["description"]);
		$query = $query . ",description"; 
		$values = $values . ", '$description' ";
	}

	
	$values = $values . ")";
	$query = $query . ") values" . $values;
	echo $query;
	
	if (mysqli_query($dbc, $query)){
	//	echo "tickets succesfully created";
		
	}
	else {
	//	echo "ticket wasnt created";
		}

}
else{ 
//	echo "Someting happened here";
	}

?>