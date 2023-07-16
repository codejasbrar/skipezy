<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Drivers Change</title>
<?php 
include "dbconfig.php";
include "php_functions.php";
//include "dbfunction.php";
ob_start();
?>
<!-- Java Scripti Files -->
 
</head>
<body>
<?php
   						if (ISSET($_POST['select_job_id'])) {
									//print_r($_POST);
									// -------------- add more rows and connect here to database -- all fields
									
									//$col_id=$con->real_escape_string($_POST['selected_col']);
									$order_id=$con->real_escape_string($_POST['select_job_id']);
									$customers_sql="SELECT * FROM order_status"; 
									//echo $customers_sql;
									$result=mysqli_query($con,$customers_sql);
						?>
                           
                           
 <div class="modal-dialog">
 <input type="hidden" id="order_id" value="<?php echo $order_id;?>">
 <input type="hidden" id="end_date" value="<?php echo date('Y-m-d');?>">
    
  <div class="panel panel-primary">
      <div class="panel-heading">Update Job Status</div>
      <div class="panel-body">
      
      <div class="col-md-12">
           
            
            <div class="col-md-6">
            <div class="col-md-12">
                <label class="col-sm-4">Paid?</label>
               <div class="form-group col-sm-8">
                  <select name="job_paid" id="job_paid"  class="form-control" style="font-size:13px; cursor:pointer;">
                     <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"value="1" selected>Fully Paid</option>
               <?php
                 
                  $payment_sql="SELECT * from payment_type order by id ASC";
                  $t_result=mysqli_query($con,$payment_sql);
                  while($payment=mysqli_fetch_assoc($t_result))
                  {
              ?>
                  
  <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="<?php echo $payment['id']; ?>">
     <?php echo $payment['name']; ?>
    </option>
            <?php
            
            }
            ?>
                         </select> 
                      </div>
                    </div>
                </div>
            </div>
         </form>
            <div class="modal-footer">
                 
                 <div id="confirm_button">
        	      	 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         			<input type="submit" name="allocate_job" id="modal_button" class="btn btn-primary" value="Update Job Status"/>
                </div>
           </div>
        
      </div>
    </div>

         
      
                    
                  
                  
                 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
                <?php } ?>
 
       <?php
       if(isset($_POST['job_paid']))
			{
				
				//$id=$_POST['selected_payment_status'];
				$order_id=$con->real_escape_string($_POST['order_id']);
				$payment_status=$con->real_escape_string($_POST['job_paid']);
				
					
					$sql="UPDATE order_details SET payment_status=$payment_status WHERE order_id=$order_id";
					//echo $sql;
					
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('UPDATE payment_status -Error: ' . mysqli_error($con));
		  	}
		////////////////// update stock code start here ///////////////////////////////////
			
					//Use of a Select funtinoc here caled from dbfunction file
			}
		?>
         


<div class="modal fade"  id="confirmModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Confirmation !</h4>
      </div>
      <div class="modal-body">
        <p style="color:black; background-color:#36EB34; padding:20px; font-size:20px; font-weight:bold;">Payment Status Updated Successfully.</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="closeme" data-dismiss="modal" class="btn btn-success">Close ME</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
$('#modal_button').click(function(){
	var order_id=$('#order_id').val();
	
	var job_paid=$('#job_paid').val();
	
	
	var dataString = 'job_paid=' + job_paid+'&order_id=' + order_id;
	//alert(dataString);
	
	//alert(td_id);
	$.ajax({
		type: "POST",
    url: "update_payment_status.php",
    data: dataString,
    success: function(data) {
		 
		
		$('#confirmModal').modal('show');
		}
	
	
	});
	
	
  });
  
 
$('#closeme').click(function(){
	window.location.reload();
});

</script> 
</body>
</html>