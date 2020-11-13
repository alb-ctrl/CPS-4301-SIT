<?php
//starts session and checks if user has logged in
session_start();
if (!isset(($_SESSION['id']))){
	header('LOCATION:Login.html');
	die (); 
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$dbc = @mysqli_connect('localhost', 'registra', 'tion', 'sit') OR 
	die('Coul not connect MySQL: ' . mysqli_connect_error () );

//set encoding 
	mysqli_set_charset($dbc, 'utf8');
	
	
	
	update_ticket($dbc, $_POST['update_ticket']);
}

//function to update ticket id 
function update_ticket ($dbc, $ticket_id){

	
	$output = '';

	$query = "update customers INNER JOIN tickets on tickets.customer=customers.customer_id set customers.email=";

	
		$email = mysqli_real_escape_string($dbc, $_POST["email"]);
		$query = $query . " '$email' "; 
		
	
	//checks if values are set or empty to update them in the dB
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
