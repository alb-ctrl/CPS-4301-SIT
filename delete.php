<?php
//starts session and checks if user has logged in
//if users hasnt logged in the program will be sent to the log in page
session_start();
if (!isset(($_SESSION['id']))){
	header('LOCATION:Login.html');
	die (); 
} 

//checks if a form was submitted to come to this page
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$dbc = @mysqli_connect('localhost', 'registra', 'tion', 'sit') OR 
	die('Coul not connect MySQL: ' . mysqli_connect_error () );

//set encoding 
	mysqli_set_charset($dbc, 'utf8');
	
	
	
	delete_ticket($dbc, $_POST['delete_ticket']);

}

//delete ticket by ticket id, it takes the connection to the DB as arguemtn and ticket id
function delete_ticket($dbc, $ticket_id){
	$query = "delete from tickets where ticket_id = $ticket_id";
	$result = mysqli_query ($dbc, $query);

}

?>
