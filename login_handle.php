<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//require DB
	require ("db_config.php");
	
	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR 
	die('Coul not connect MySQL: ' . mysqli_connect_error () );

	//set encoding 
	mysqli_set_charset($dbc, 'utf8');

	$user=$_POST['form-username'];
	$pass=$_POST['form-password'];
	
	//validates user name
	if (empty($user)) {
		echo "There was a problem with your username, Try again";
		//sleep(3);
		//header('LOCATION:Login.html');
		exit (); 
	 }
	else
	 	{ $u = mysqli_real_escape_string ($dbc, trim($user)); }

	//validate passwrod
	if (empty($pass)){
		echo "There was a problem with your Login, Try again";
		//sleep(3);
		//header('LOCATION:Login.html');
		exit (); 
	}
	else {
		$p=mysqli_real_escape_string($dbc, trim($pass));}
		
	$query = "SELECT * FROM users WHERE user_login='$u'  ";
	$run = @mysqli_query($dbc, $query);
	

	$num = @mysqli_num_rows($run);
	if ($num==0)
	{
		echo "<br>Username $u not found";
		//sleep(3);
		//header('LOCATION:Login.html');
		exit (); 
	}
	elseif ($num>1)
	{
		echo "<br>More than one user with $u";
		//sleep(3);
		//header('LOCATION:Login.html');
		exit (); 
	}
	

	$row =mysqli_fetch_array($run,MYSQLI_ASSOC);
	if ($u==$row['user_login'] and hash('sha256', $p) != $row['password'])
	{
		echo "<br>Password doesnt match to usernmae";
		//sleep(3);
		//header('LOCATION:Login.html');
		exit (); 
	}
	if (isset ($_SESSION['id']) || isset ($_SESSION['name']))
	{
		if ($row['id'] != $_SESSION['id'] || $row['name'] != $_SESSION['name'])
		{
			echo "<br> Something went wrong while login in. Please try again <br> <a href='Login.html' >Login</a>";
			$_SESSION = [];
 			session_destroy(); 
 			exit();
		}
	}
	
	
	
	if ($row['password']==hash('sha256', $p) and $row['user_login']==$u ){
	
		$_SESSION['id'] = $row['id'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['role'] = $row['role'];
		
		mysqli_free_result($run);
		//header('LOCATION:home_page.php');
		echo "loggedin";
		
	}

}
else {
	header('LOCATION:Login.html');
}
?>