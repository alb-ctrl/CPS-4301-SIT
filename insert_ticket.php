<?php
//checks if user has legged in, if not is sent to the login page
session_start();
if (!isset(($_SESSION['id']))){
	header('LOCATION:Login.html');
	die (); 
	}

//if user has subbmited a form to get here
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//require DB
	//require ("dbconfig.php");
	
	$dbc = @mysqli_connect('localhost', 'registra', 'tion', 'sit') OR 
	die('Coul not connect MySQL: ' . mysqli_connect_error () );

//set encoding 
	mysqli_set_charset($dbc, 'utf8');
	$output = '';
	
	//sets a query and values and creates a query from the values that exists
	//if a value is empty or is not set the value is not added into the querry
	$query = "insert into customers (email";
	$values = "(";
	
	//if email exists
	if (isset ($_POST['email'])){
		$email = mysqli_real_escape_string($dbc, $_POST["email"]);
		$values = $values . " '$email' ";
	}
	
	//if name is not empty
	if (!empty($_POST['name'])){
		$name = mysqli_real_escape_string($dbc, $_POST["name"]);
		$query = $query . ",name"; 
		$values = $values . ", '$name' ";
	}

	
	
	$values = $values . ")";
	$query = $query . ") values" . $values;
	
	// finishes the query and inserts the customer into the customer table
	if (mysqli_query($dbc, $query)){
		$last_id = mysqli_insert_id($dbc);
		
	}
	else{
	//	echo "there was a problem insertin the users";
		die();
	} 
	
	//creates a query and the values to insert into from user input
	//if a value is empty or is not set the value is not added into the query
	$query = "insert into tickets (customer";
	$values = "(".$last_id ;
	if (!empty($_POST['subject'])){
		$subject = mysqli_real_escape_string($dbc, $_POST["subject"]);
		$query = $query . ",subject"; 
		$values = $values . ", '$subject' ";
	}

	if (!empty ($_POST['schedule'])){
		$schedule = mysqli_real_escape_string($dbc, $_POST["schedule"]);
		$query = $query . ",scheduled"; 
		$values = $values . ", '$schedule' ";
	}
	if (!empty($_POST['status'])){
		$status = mysqli_real_escape_string($dbc, $_POST["status"]);
		$query = $query . ",status"; 
		$values = $values . ", '$status' ";
	}

	if (!empty ($_POST['description'])){
		$description = mysqli_real_escape_string($dbc, $_POST["description"]);
		$query = $query . ",description"; 
		$values = $values . ", '$description' ";
	}
	if (!empty ($_POST['cost'])){
		$cost = mysqli_real_escape_string($dbc, $_POST["cost"]);
		$query = $query . ",cost"; 
		$values = $values . ", $cost ";
	}
	
	$values = $values . ")";
	$query = $query . ") values" . $values;
	
	//creates a ticket and inserts it into the ticket table
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
