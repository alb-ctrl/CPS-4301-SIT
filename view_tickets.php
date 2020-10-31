<?php 

session_start();
if (!isset(($_SESSION['id']))){
	header('LOCATION:Login.html');
	die (); 
} 


$dbc = @mysqli_connect('localhost', 'registra', 'tion', 'sit') OR 
	die('Coul not connect MySQL: ' . mysqli_connect_error () );

//set encoding 
	mysqli_set_charset($dbc, 'utf8');
	$output = '';
	
	$where = $_POST['query'];
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
                        <h2>Ticket <b>Details</b></h2>
                    </div>
                   
                </div>
            </div>
            <div class="table-filter">
                <div class="row">
                    
                    <div class="col-sm-9">
                        <button type="button" id="search_ticket_button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        <div class="filter-group">
                            <label>Name</label>
                            <input type="text" id="search_ticket_name" class="form-control">
                        </div>
                        
                        <div class="filter-group">
                            <label>Status</label>
                            <select name="ticket_status" id="ticket_status" class="form-control">
                                <option>Any</option>
                                <option value="New">New</option>  
      							<option value="Work_In _Progress">Work In Progress</option>
      							<option value="On_Hold">On Hold</option>
      							<option value="Completed">Completed</option>
      							<option value="Canceled">Canceled</option>
                            </select>
                        </div>
                        <span class="filter-icon"><i class="fa fa-filter"></i></span>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Subject</th>
						
                        <th>Status</th>						
                        <th>Cost</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="ticket_body">
	
	<?php 

     $res='';
     while($row = mysqli_fetch_array($result)){
     echo '			<tr>
                        <td>1</td>
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
                        <td><span class="status text-'.$res.'">&bull;</span>'. $row['status'] . '</td>
                        <td>$'. $row['cost'] .'</td>
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