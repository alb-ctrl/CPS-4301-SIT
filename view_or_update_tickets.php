<?php 

session_start();
if (!isset(($_SESSION['id']))){
	header('LOCATION:Login.html');
	die (); 
} 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//require DB
	require ("db_config.php");
	
	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR 
	die('Coul not connect MySQL: ' . mysqli_connect_error () );

	//set encoding 
	mysqli_set_charset($dbc, 'utf8');
	
	
	
	 if (isset($_POST['view_ticket'])){
	 	view_data($dbc,$_POST['view_ticket'] );
	 }
	
	
	
	}
	
function view_data($dbc, $ticket_id){

	 $output = '';
	
	$query = "select * from Vtickets where ticket_id =". $ticket_id;
	$result = mysqli_query($dbc, $query);
	$output .= '  
     	   <div class="table-responsive">
     	   <form method="post" id="update_ticket_info">  
     	   <input type="hidden" name="update_ticket" value='.$ticket_id.'>
           <table class="table table-bordered">';
    
    while($row = mysqli_fetch_array($result)) {
    	$output .= "<tr>
    		<td width ='30%'><label>Name</label></td>
    		<td width ='70%'><input type='text' name='name' id='name' class='form-control' value='".$row['name']."' /></td>
    	</tr>
    	<tr>
    		<td width ='30%'><label>Email</label></td>
    		<td width ='70%'><input type='text' name='email' id='email' class='form-control' value ='".$row['email']."'></input></td>
    	</tr>
    	<tr>
    		<td width ='30%'><label>Subject</label></td>
    		<td width ='70%'><input type='text' name='subject' id='subject' class='form-control' value='".$row['subject']."' ></input></td>
    	</tr>
    	<tr>
    		<td width ='30%'><label>Status</label></td>
    		<td width ='70%'>
    		<select name='status' id='status' class='form-control'>
      <option value='".$row['status']."'>". str_replace('_', ' ', $row['status']) ."</option>  
      <option value='New'>New</option>  
      <option value='Work_In _Progress'>Work In Progress</option>
      <option value='On_Hold'>On Hold</option>
      <option value='Completed'>Completed</option>
      <option value='Canceled'>Canceled</option>
     </select>
    		
    		</td>
    	</tr>
    	<tr>
    		<td width ='30%'><label>Cost</label></td>
    		<td width ='70%'><input type='text' name='cost' id='cost' class='form-control' value='".$row['cost']."'></input></td>
    	</tr>
    	<tr>
    		<td width ='30%'><label>Description</label></td>
    		<td width ='70%'><textarea name='description' id='description' class='form-control'>".$row['description']."</textarea></td>
    	</tr>
    	<tr>
    		<td width ='30%'><label>Scheduled to</label></td>
    		<td width ='70%'><input type='date' name='schedule' id='schedule' class='form-control' value='".$row['scheduled']."'></input></td>
    	</tr>
    	<tr>
    		<td width ='30%'><label>Date Created</label></td>
    		<td width ='70%'><label>".$row['created_at']. "</td>
    	</tr>
    	<tr>
    		<td width ='30%'><label>Last Updated</label></td>
    		<td width ='70%'><label>".$row['updated_at']. "</td>
    	</tr>
    	
    	
    		";
    
    }
    
    $output .= '</table>
   
    <input type="submit" name="update" id="update" value="Update" class="btn btn-success" data-dismiss="modal" />
    <br>
    </form>
    <input type="submit" class="btn btn-danger delete_ticket" value="Delete" name="delete" id="'.$ticket_id.'"  data-dismiss="modal" /><br>
    </div>';
    echo $output;

}

//        

function delete_ticket($dbc, $ticket_id){
	$query = "delete from tickets where ticket_id = $ticket_id";
	$result = mysqli_query ($dbc, $query);
	echo "ticket  $ticket_id was deleted";

}


function update_ticket ($dbc, $ticket_id){

	
	$output = '';

	$query = "update Vtickets set email=";

	
		$email = mysqli_real_escape_string($dbc, $_POST["email"]);
		$query = $query . " '$email' "; 
		
	
	
	if (!empty($_POST['name'])){
		$name = mysqli_real_escape_string($dbc, $_POST["name"]);
		$query = $query . ",name = $name"; 
		
	}


	if (!empty($_POST['subject'])){
		$subject = mysqli_real_escape_string($dbc, $_POST["subject"]);
		$query = $query . ",subject = '$subject' "; 
	}

	if (!empty ($_POST['schedule'])){
		$schedule = mysqli_real_escape_string($dbc, $_POST["schedule"]);
		$query = $query . ",scheduled ='$schedule' "; 
	}
	if (!empty($_POST['status'])){
		$status = mysqli_real_escape_string($dbc, $_POST["status"]);
		$query = $query . ",status =  '$status' "; 
	}

	if (!empty ($_POST['description'])){
		$description = mysqli_real_escape_string($dbc, $_POST["description"]);
		$query = $query . ",description = '$description'"; 
	}
	if (!empty ($_POST['cost'])){
		$cost = mysqli_real_escape_string($dbc, $_POST["cost"]);
		$query = $query . ",cost = $cost"; 
	}
	

	$query = $query . "where ticket_id = $ticket_id " ;
	
	
	if (mysqli_query($dbc, $query)){
		echo "tickets succesfully updated";
		
	}

}
?>