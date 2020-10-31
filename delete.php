<?php
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
	
	
	
	delete_ticket($dbc, $_POST['delete_ticket']);

}

function delete_ticket($dbc, $ticket_id){
	$query = "delete from tickets where ticket_id = $ticket_id";
	$result = mysqli_query ($dbc, $query);

}

?>