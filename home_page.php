<?php 
session_start();
if (!isset(($_SESSION['id']))){
	header('LOCATION:Login.html');
	die (); 
} 

require "assets/header.html";
?>



<div class="container-fluid">
  <div class="row">
    
    <div class="col-lg-12" id="home_page" onload="view_tickets();" >
      <!-- your page content -->
      
      <?php include 'view_tickets.php';
      		
	$us = view_users($dbc);
	
function view_users($dbc){
	$output = '';
	$query = "select name, id from users ";
	$result = mysqli_query($dbc, $query);
	if ($result){
		$output.= "<select name ='users' class='form-control' >
					<option value=''></option>";
		 while($row = mysqli_fetch_array($result)) {
		 	
		 		$output.= "<option value='".$row['id']."'>".$row['name']."</option>";
		 }
		 $output.= "</select>";
	
	}
	return $output;
}
       ?>
      
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
     <input type="email" name="email" id="email" class="form-control"></input>
     <br />
     <label>Enter Ticket Number</label>
     <input type="text" name="number" id="number" class="form-control" />
     <br />
     <label>Enter Customer Phone</label>
     <input type="text" name="phone" id="phone" class="form-control"></input>
     <br />
     <label>Enter Subject</label>
     <input type="text" name="subject" id="subject" class="form-control"></input>
     <br />
     <label>Assign to</label>
     <?php echo $us ?>
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


