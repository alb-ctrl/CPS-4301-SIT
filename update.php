<?php
session_start();
if (!isset(($_SESSION['id']))){
	header('LOCATION:Login.html');
	die (); 
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

require ("db_config.php");
	
	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR 
	die('Coul not connect MySQL: ' . mysqli_connect_error () );

	//set encoding 
	mysqli_set_charset($dbc, 'utf8');
	
	
	
	update_ticket($dbc, $_POST['update_ticket']);
}


function update_ticket ($dbc, $ticket_id){

	
	$output = '';

	$query = "update customers INNER JOIN tickets on tickets.customer=customers.customer_id set customers.email=";

	
		$email = mysqli_real_escape_string($dbc, $_POST["email"]);
		$query = $query . " '$email' "; 
		
	
	
	if (!empty($_POST['name'])){
		$name = mysqli_real_escape_string($dbc, $_POST["name"]);
		$query = $query . ", customers.name = '$name'"; 
		
	}


	if (!empty($_POST['subject'])){
		$subject = mysqli_real_escape_string($dbc, $_POST["subject"]);
		$query = $query . ", tickets.subject = '$subject' "; 
	}

	if (!empty ($_POST['schedule'])){
		$schedule = mysqli_real_escape_string($dbc, $_POST["schedule"]);
		$query = $query . ", tickets.scheduled ='$schedule' "; 
	}
	if (!empty($_POST['status'])){
		$status = mysqli_real_escape_string($dbc, $_POST["status"]);
		$query = $query . ", tickets.status =  '$status' "; 
	}

	if (!empty ($_POST['description'])){
		$description = mysqli_real_escape_string($dbc, $_POST["description"]);
		$query = $query . ", tickets.description = '$description'"; 
	}
	if (!empty ($_POST['cost'])){
		$cost = mysqli_real_escape_string($dbc, $_POST["cost"]);
		$query = $query . ", tickets.cost = $cost"; 
	}
	

	$query = $query . " where ticket_id = $ticket_id " ;
	
	
	if (mysqli_query($dbc, $query)){
		//echo "tickets succesfully updated";
		
	}

}
?>