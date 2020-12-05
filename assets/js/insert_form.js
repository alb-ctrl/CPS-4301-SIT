$(document).ready(function(){


$('[data-toggle="tooltip"]').tooltip();

 $('#insert_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#email').val() == "")  
  {  
   alert("email is required");  
  }  
  
  else  
  {  
   $.ajax({  
    url:"insert_ticket.php",  
    method:"POST",  
    data:$('#insert_form').serialize(),  
    beforeSend:function(){  
     $('#insert').val("Inserting");  
    },  
    success:
    function(data){  
    // $('#insert_form')[0].reset();  
     $('#insertTicket').modal('hide');  
    // $('#home_page').html(data);
     view_tickets(' ');  
    },
    error: function(xhr, status, error){
         var errorMessage = xhr.status + ': ' + xhr.statusText
         alert('Error - ' + errorMessage);
     }  
   });  
  }  
 });
 
 $(document).on('click', '#view_tickets', function(){
  //$('#dataModal').modal();
 view_tickets(' ',0);
 });

//va has to be 0 for the status filter to work
function view_tickets(q, va){
  $.ajax({
   url:"view_tickets.php",
   method:"POST",
   data:{query:q},

   success:function(data){
    $('#home_page').html(data);
    if (va !=0){
    	$("#ticket_status").val(va);
    }
    
   }
  });
  

}

$(document).on("click",'.delete_ticket' ,function(event){
var delete_ticket = $(this).attr("id");
event.preventDefault(); 
$.ajax({
   url:"delete.php",
   method:"POST",
   data:{delete_ticket:delete_ticket},
   success:
   function(data){  

     //$('#home_page').html(data); 
     $('#dataModal').modal('hide'); view_tickets(' ', 0);
    }    
  
  });
  
 });


$(document).on("click",'#update' , function(event){
event.preventDefault(); 
$.ajax({
   url:"update.php",
   method:"POST",
   data:$('#update_ticket_info').serialize(),
   success:function(data){  
    
     //$('#home_page').html(data);  
     $('#dataModal').modal('hide'); 
     view_tickets(' ', 0);
    }    
  
  });
  
 });



 $(document).on('click', '.view_data', function(){
  //$('#dataModal').modal();
  var view_ticket = $(this).attr("id");
  $.ajax({
   url:"view_or_update_tickets.php",
   method:"POST",
   data:{view_ticket:view_ticket},
   success:function(data){
    $('#ticket_detail').html(data);
    $('#dataModal').modal('show');
   }
  });
 });
 
 

$(document).on('change', '#ticket_status',function(){
  //$('#dataModal').modal();
  //$( "#ticket_status" ).val();
  var x = $( "#ticket_status" ).val();
  
  var query = "where status ='"+x+"'";
  //so in order to know if the value is to filter from status or check tickets assigned to you
  //we are going to asume there will be less than 99 users
  //if there are less than 99 users we will create a query to check who is assigned to it
  //if more than 99 this needs refactoring
  if (x.length < 3){
  	query ="where assigened_to ='"+x+"'";
  }
  //because any is also <=3 we will check if the value of x is Any
  //if the value of x is Any we will pass an empty query and search for all 
  if (x==="Any"){
	query="";  
  }
  
  view_tickets(query, x);
  //$("#ticket_status option[value='New']").attr('selected', 'selected');
  //$("#ticket_status").val('On_Hold');
  //alert(query);
 
 });
 
 $(document).on('click', '#search_ticket_button', function(){
  //$('#dataModal').modal();
  var x = $("#search_ticket_name").val();
  
  var query = "where name like '%"+x+"%'";
  view_tickets(query, 0);
 
 });

 
});  

//for some reseon only $(document) works on anything thst isnt on home_page.php