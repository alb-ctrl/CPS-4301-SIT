<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset(($_SESSION['id'])) || strtolower($_SESSION['role']) != 'admin'){
	header('LOCATION:home_page.php');
	die (); 
} 

require "assets/header.html";
require ("db_config.php");
	
	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR 
	die('Coul not connect MySQL: ' . mysqli_connect_error () );

	//set encoding 
	mysqli_set_charset($dbc, 'utf8');
	
	
	$query = "select id, name, role from users ";
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
                        <h2>User Details</h2>
                    </div>
                   
                </div>
            </div>
            <div class="table-filter">
                <div class="row">

	<div class="col-sm-2 float-right">
		<button data-dismiss="modal" data-toggle="modal" data-target="#insertUser" type="button" class="btn btn-warning" style="background-color:#C95C54; color: white;" >User <i class="fa fa-plus pr-2" aria-hidden="true"></i></button> 
	</div>
</div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                       
                        
                        <th>Name</th>
						<th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="user_body">
	
	<?php 

     $res='';
     while($row = mysqli_fetch_array($result)){
    
     echo '			<tr>
                        <td>'. $row['name'] .'</td>
                        <td>' . $row['role'] . '</td>';
  
    
    echo '
                         <td><a href="#" id='. $row["id"] .' class="view view_data" title="Edit User" data-dismiss="modal" data-toggle="modal"  data-target="#editUser"><i class="material-icons">&#xE5C8;</i></a></td>
                    </tr>';
     	
     	
     } 
     
    
      echo '</tbody>
       </table>
        <div class="clearfix">
               
        </div>
    </div>        
</div>     ';

?>
 <!-- Javascript -->
        <script src="assets/js/jquery-3.5.1.min.js"></script>
       
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script>
        $(document).ready(function(){
 			$('#insert_User').on("submit", function(event){  
  				event.preventDefault();  
  					if($('#password1').val() == "")  {  
   						alert("password is required");  
  					}
  					if ($('#password1').val() !=$('#password2').val()){
  						alert("passwords do not match");
  					}
  
  					else {  
   						$.ajax({  
   						
    						url:"insert_user.php",  
    						method:"POST",  
    						data:$('#insert_User').serialize(),  
    						beforeSend:function(){  
    							$('#insert').val("Inserting");  
    						},  
    						success: function(data){ 
    							alert("hello"); 
    							// $('#insert_User')[0].reset();  
     							$('#insertUser').modal('hide');  
    							$('.clearfix').html(data);
     						
    						},
    						error: function(xhr, status, error){
         						var errorMessage = xhr.status + ': ' + xhr.statusText
         						alert('Error - ' + errorMessage);
     						}  
   						});  
  					}  
 			});
 			
 			$(document).on('click', '.view_data', function(){
 				var x = $(this).attr("id");
 				$('#usr_id').val(x);
 				$(".delete_user").attr('id', x);
 			});
 			
 			$(document).on("click",'#update_user' , function(event){
  					event.preventDefault();
  					var pass = $('#new_password1').val();
  					var usr_id = $(this).attr("id");
  					if($('#new_password1').val() == "")  {  
   						alert("password is required");  
  					}
  					if ($('#new_password1').val() !=$('#new_password2').val()){
  						alert("passwords do not match");
  					}
  				
  					else {  
   						$.ajax({  
   						
    						url:"edit_user.php",  
    						method:"POST",  
    						data:$('#Edit_User').serialize(), 
    						success: function(data){  
    							// $('#insert_User')[0].reset();  
     							$('#editUser').modal('hide');  
    							$('.clearfix').html(data);
     						
    						},
    						error: function(xhr, status, error){
         						var errorMessage = xhr.status + ': ' + xhr.statusText
         						alert('Error - ' + errorMessage);
     						}  
   						});  
  					}  
  					
 			});
 			
 			$(document).on("click",'.delete_user' ,function(event){
				var delete_user = $(this).attr("id");
				event.preventDefault(); 
				$.ajax({
   					url:"delete_user.php",
   					method:"POST",
   					data:{delete_user:delete_user},
   					success:
   					function(data){  

     					//$('#home_page').html(data); 
     					$('#editUser').modal('hide');
     					location.reload();
    				}    
  
  				});
  
 			});
		});
        </script>
        

        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
</body>
</html>


<div id="insertUser" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Insert User</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_User">
     
     <label>Enter User Name</label>
     <input type="text" name="name" id="name" class="form-control" />
     <br />
     <label>Enter User Role</label>
     <input type="text" name="role" id="role" class="form-control"></input>
     <br />
     <label>Enter User Login ID</label>
     <input type="text" name="login_id" id="login_id" class="form-control" required />
     <br />
     <label>Enter User Password</label>
     <input type="password" name="password1" id="password1" class="form-control" required></input>
     <br />
     <label>Re-Enter User Password</label>
     <input type="password" name="password2" id="password2" class="form-control" required></input>
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

<div id="editUser" class="modal fade">
	<div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit User</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="Edit_User">
    <input type="hidden" name="usr_id" id="usr_id" value="" >
     <label>Enter New User Password</label>
     <input type="password" name="new_password1" id="new_password1" class="form-control" required></input>
     <br />
     <label>Re-Enter New User Password</label>
     <input type="password" name="new_password2" id="new_password2" class="form-control" required></input>
     <br />
     <input type="submit" name="Update" id="update_user" value="Update" class="btn btn-success" />

    </form>
    <br>
    <input type="submit" class="btn btn-danger delete_user" value="Delete" name="delete" id=""  data-dismiss="modal" /><br>
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
    <h4 class="modal-title">User Details</h4>
   </div>
   <div class="modal-body" id="ticket_detail">
    
   </div>
   <div class="modal-footer">
   
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>