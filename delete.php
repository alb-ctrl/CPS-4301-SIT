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
	
	
	delete_ticket($dbc, $_POST['delete_ticket']);

}

function delete_ticket($dbc, $ticket_id){
	$query = "delete from tickets where ticket_id = $ticket_id";
	$result = mysqli_query ($dbc, $query);

}

?>