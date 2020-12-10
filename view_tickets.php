<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset(($_SESSION['id']))){
	header('LOCATION:Login.html');
	die (); 
} 


require ("db_config.php");
	
	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR 
	die('Coul not connect MySQL: ' . mysqli_connect_error () );

	//set encoding 
	mysqli_set_charset($dbc, 'utf8');
	
	$output = '';
	$where ='';
	if (isset ($_POST['query'])){
	$where = $_POST['query'];
	}
	$query = "select * from Vtickets $where order by created_at desc";
	$result = mysqli_query ($dbc, $query);
	if (!$result){
		echo "no data found";
		die();
	}
	
	
	
	?>

    
    
	
	<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Ticket Details</h2>
                    </div>
                   
                </div>
            </div>
            <div class="table-filter">
                <div class="row">
	
	<div class="col-sm-6">
		
		<div class="filter-group">
		<button type="button" id="search_ticket_button" class="btn btn-primary"><i class="fa fa-search"></i></button>
			<label>Name</label> 
			<input type="text" id="search_ticket_name" class="form-control">
		</div>
	</div>
	<div class="col-sm-3">
		<div class="filter-group">
			<label>Status</label> 
			<select name="ticket_status" id="ticket_status" class="form-control">
                                <option value="Any" >Any</option>
                                <option value="New">New</option> 
                                <?php echo "<option value='".$_SESSION['id']."'>My Tickets</option> ";?> 
      							<option value="Work_In _Progress">Work In Progress</option>
      							<option value="On_Hold">On Hold</option>
      							<option value="Completed">Completed</option>
      							<option value="Canceled">Canceled</option>
            </select>
		</div>
		<span class="filter-icon"><i class="fa fa-filter"></i></span> 
	</div>
	<div class="col-sm-2 float-right">
		<button data-dismiss="modal" data-toggle="modal" data-target="#insertTicket" type="button" class="btn btn-warning" style="background-color:#C95C54; color: white;" >Ticket <i class="fa fa-plus pr-2" aria-hidden="true"></i></button> 
	</div>
</div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width:20%">Customer</th>
                        <th>Subject</th>
						
                        <th style="width:15%">Status</th>						
                        <th style="width:10%">Cost</th>
                        <th style="width:10%">Scheduled</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="ticket_body">
	
	<?php 

     $res='';
     while($row = mysqli_fetch_array($result)){
     if (!empty($row['ticket_number'])){
        $ticket_num = $row['ticket_number']  ;   
         }
    else {
    	$ticket_num = $row['ticket_id']  ; 
    }
     echo '			<tr>
                        <td>'. $ticket_num .' </td>
                        <td>'. $row['name'] .'</td>
                        <td>' . $row['subject'] . '</td>';
                        
    if ($row['status'] == "New"){
    	$res = "info";
    }
    else if ($row['status'] == "Work_In _Progress"){
    	$res = "info";
    }
    else if ($row['status'] == "On_Hold"){
    	$res = "warning";
    }
    else if ($row['status'] == "Completed"){
    	$res = "success";
    }
    else if ($row['status'] == "Canceled"){
    	$res = "danger";
    }
    else {
    	$res = "null";
    }
    
    echo '
                        <td><span class="status text-'.$res.'">&bull;</span>'.str_replace('_', ' ', $row['status'])  . '</td>
                        <td>$'. $row['cost'] .'</td>
                        <td>'. $row['scheduled'] .'</td>
                         <td><a href="#" id='. $row["ticket_id"] .' class="view view_data" title="View Details" data-toggle="tooltip"><i class="material-icons">&#xE5C8;</i></a></td>
                    </tr>';
     	
     	
     } 
     
    
      echo '</tbody>
       </table>
            <div class="clearfix">
               
        </div>
    </div>        
</div>     ';

?>
