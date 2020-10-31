<?php 
session_start();
if (!isset(($_SESSION['id']))){
	header('LOCATION:Login.html');
	die (); 
} ?>

<!DOCTYPE html>
<html lang="en">


	<head>
	
  		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        
        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/navbar-fixed-side.css">
        <link rel="stylesheet" href="assets/css/ticket_table.css">
        
       <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
     
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar">jjj</span>
        <span class="icon-bar">nkbknkb</span>
        <span class="icon-bar">lnllllmpml</span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="home_page.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#" id ="view_tickets">Projects</a></li>
       
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  



<div class="container-fluid">
  <div class="row">
    <div class="sidenav col-sm-3 col-lg-2">
      <nav class="navbar navbar-default navbar-fixed-side">
        <!-- normal collapsible navbar markup -->
        
      <button data-dismiss="modal" data-toggle="modal" data-target="#insertTicket" type="button" class="btn btn-danger btn-lg btn-lg btn-block">Ticket <i class="fa fa-plus pr-2"
        aria-hidden="true"></i></button>
      </nav>
    </div>
    <div class="col-sm-9 col-lg-10" id="home_page">
      <!-- your page content -->
      <h1>Welcome</h1>
      
      
      
      
      

<div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalInsertTicketForm">Launch
    Modal Login Form</a>
</div>
      
      
    </div>
  </div>
</div>



 <!-- Javascript -->
        <script src="assets/js/jquery-3.5.1.min.js"></script>
       
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/insert_form.js"></script>

        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
</body>
</html>

<div id="insertTicket" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Insert Ticket</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
     <label>Enter Customer Name</label>
     <input type="text" name="name" id="name" class="form-control" />
     <br />
     <label>Enter Customer Email</label>
     <input type="text" name="email" id="email" class="form-control"></input>
     <br />
     <label>Enter Customer Phone</label>
     <input type="text" name="phone" id="phone" class="form-control"></input>
     <br />
     <label>Enter Subject</label>
     <input type="text" name="subject" id="subject" class="form-control"></input>
     <br />
     <label>Enter Schedule</label>
     <input type="date" name="schedule" id="schedule" class="form-control"></input>
     <br />
     
     <label>Select Status</label>
     <select name="status" id="status" class="form-control">
      <option value="New">New</option>  
      <option value="Work_In _Progress">Work In Progress</option>
      <option value="On_Hold">On Hold</option>
      <option value="Completed">Completed</option>
      <option value="Canceled">Canceled</option>
     </select>
     <br />  
     <label>Enter Description</label>
     <textarea name="description" id="description" class="form-control"></textarea>
     <br />  
     <label>Enter Cost</label>
     <input type="text" name="cost" id="cost" class="form-control" />
     <br />
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />

    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>



<div id="dataModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Ticket Details</h4>
   </div>
   <div class="modal-body" id="ticket_detail">
    
   </div>
   <div class="modal-footer">
   
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>


