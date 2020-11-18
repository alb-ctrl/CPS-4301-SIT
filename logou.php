<?php
session_start(); // Access the existing session.


if (isset ($_SESSION['id']) || isset ($_SESSION['name']))
	{
		
			$_SESSION = [];
 			session_destroy();
 			header('LOCATION:Login.html'); 
 			exit();
		
	}
	
?>