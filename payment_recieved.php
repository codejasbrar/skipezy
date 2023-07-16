<!DOCTYPE html>
<html>
<head>
<?php include("navbar.php");
	include "dbconfig.php";
	?>
  <!-- Java Scripti Files -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<meta charset="utf-8">
<title>SkipTrak Software for Skip Hire Business</title>
  <script>
  $(document).ready(
      function () {
      $('#transaction_date').datepicker({
        changeMonth: true,//this option for allowing user to select month
        changeYear: true, //this option for allowing user to select from year range
        dateFormat: 'yy-mm-dd'
      });
      }
    
    );
	</script>
	
</head>
<body>
   <form method="post" name="new_payment_form" id="new_payment_form">
	 <div class="container-fluid">
	 <div class="row">
	 	<div class="col-md-12">
	 		<div>&ensp;</div>
	 		
	 	</div>
	 </div>
	 	<div class="row">
	 		<div class="col-md-12">
	 		  <div class="col-md-2"></div>
	 		  <div class="col-md-8">
	 		  	  <div class="panel" style="background-color: #e9e9e9;box-shadow: 5px 5px 5px;">
	 		  	  	  <div class="panel-primary">
	 		  	  	  	<div class="panel-heading">Payment Recived</div>
	 		  	  	  </div>
	 		  	  	  <div class="panel-body">
	 		  	  	     <div class="col-md-2"></div>
	 		  	  	     <div class="col-md-8">
	 		  	  	  		<label for="customer_name" style="" class="col-sm-4">Customer Name</label>
                 <div class="form-group col-sm-8">
                 <select name="source_id" style="width:60%;" id="customer" class="form-control">
                   <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a Customer </option>
                               <?php
                 
                  $customers_sql="SELECT * from customers order by name ASC";
                  $t_result=mysqli_query($con,$customers_sql);
                  while($customer=mysqli_fetch_assoc($t_result))
                  {
                  
                  ?>
  <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="<?php echo $customer['id']; ?>">
     <?php echo $customer['name']." ,Mobile:".$customer['mobile']." ,".$customer['address1']." ".$customer['post_code']; ?>
    </option>
            <?php
            
            }
            ?>
                 </select>
                 </div>
                 <label for="amount" class="col-sm-4">Date</label>
                             <div id="gross_payment" class="form-group col-sm-8">
                                <input type="text" style="width:60%;" name="transaction_date" id="transaction_date" class="form-control">          
                           </div>
                           <label for="amount" class="col-sm-4">Amount</label>
                             <div id="gross_payment" class="form-group col-sm-8">
                                <input type="text" style="width:60%;" name="amount" id="amount" class="form-control">          
                           </div> 
                           
                         <div id="gross_payment" class="form-group col-sm-4">
                             <center>   
                                         <p style="background-color:#3699EB; cursor:pointer;" id="create_entry" class="btn-large btn-lg pull-right btn-primary" >Create Entry</p></center>
     
                           </div> 
                           
                            <div id="payment_status"></div>
                         
                         
              
                         </div>
                       
              
           
                         <div class="col-md-2"></div>
	 		  	  	  </div>
	 		  	  </div>
	 		  </div>
	 		  <div class="col-md-2"></div>	
	 		</div>
	 	</div>
	 </div>
     <input type="hidden" name="create_new_payment" value="true" />
   </form>
   <script type="text/javascript">
    
	$('#create_entry').click(function(){
        var form = $('#new_payment_form').serialize();
    alert(form);
	return false;
	$.ajax({
		type: "POST",
		url: "post_process.php",
		data: form,
                    success: function(data) {
						return false;
                     //console.log(data); 
           $('#payment_status').html(data); 
                }
            });
			
			alert("Payment Entry Created");
			window.location="http://webdynamicslondon.co.uk/skiphire/list_job.php";
        });
   
  </script>
</body>
</html>