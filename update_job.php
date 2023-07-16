<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Drivers Change</title>
<?php 
ob_start();
include "dbconfig.php";
include "php_functions.php";
//include "dbfunction.php";

?>
<!-- Java Scripti Files -->
 
</head>
<body>
<?php
print_r($_POST);
   						if (ISSET($_POST['select_job_id'])) {
									
									// -------------- add more rows and connect here to database -- all fields
									
									//$col_id=$con->real_escape_string($_POST['selected_col']);
									$id=$con->real_escape_string($_POST['select_job_id']);
									$customers_sql="SELECT * FROM order_status"; 
									//echo $customers_sql;
									$result=mysqli_query($con,$customers_sql);
						?>
                           
                           
 <div class="modal-dialog">
 <input type="hidden" id="id" value="<?php echo $id;?>">
 <input type="hidden" id="end_date" value="<?php echo date('Y-m-d');?>">
    
  <div class="panel panel-primary">
      <div class="panel-heading">Job Status</div>
      <div class="panel-body">
          
      Your Job Status Is Updated
      
      <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>             
                 
    </div>
           
         </div>
            </div>
            
            <div class="modal-footer">
                 
                 <div id="confirm_button">
        	      	 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         			<input type="submit" name="allocate_job" id="btn_update" class="btn btn-primary" value="Update Job Status"/>
                </div>
           </div>
        </form>
      </div>
    </div>

         
      
                    
                  
                  
                 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
                <?php } ?>
 
 <!-- Now allocate job to selected driver -->
       <?php
       	$id=$con->real_escape_string($_POST['select_job_id']);
       	$job_status1=2;
			//	$sql="UPDATE orders SET payment_status=$payment_status,status=$job_status,driver_id=$driver,amount=$amount WHERE id=$id";
					
				$sql="UPDATE orders SET status=$job_status1
				WHERE id=$id";	
					//
					
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('UPDATE 1 INTO orders -Error: ' . mysqli_error($con));
					}
       
       if(isset($_POST['selected_payment_status']))
       
			{
			    
				
				//$id=$_POST['selected_payment_status'];
				$id=$con->real_escape_string($_POST['id']);
				$payment_status=$con->real_escape_string($_POST['job_paid']);
				$job_status=$con->real_escape_string($_POST['job_status']);
				$amount=$con->real_escape_string($_POST['total']);
				$driver=$con->real_escape_string($_POST['driver_id']);
				$job_status1=2;
			//	$sql="UPDATE orders SET payment_status=$payment_status,status=$job_status,driver_id=$driver,amount=$amount WHERE id=$id";
					
				$sql="UPDATE orders SET status=$job_status1
				WHERE id=$id";	
					//
					
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('UPDATE 1 INTO orders -Error: ' . mysqli_error($con));
					}
		?>
        <?php
        		
				/* /if the job type is done only then update the stock otherwise let them to change the job details as wanted	
				// Now check if this job is already done, so we do not update the stock levels again
				    $sql="select status from orders where id=$id";
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('Select Job Status Query -Error: ' . mysqli_error($con));
		  			}
					$res=mysqli_query($con,$sql);
					$jstatus=mysqli_fetch_assoc($res);	
					$job_status = $jstatus['status'];
					echo $job_status;
					exit;
			*/ 
				
					// Now reterive job_type and skip_ids
					$condition = array();
					$condition['id'] = $id; 
					$skips = selectWhere($con,'orders',$condition);
					
					$skip_id = $skips[0]['skip_id'];
					$exchange_skip_id = $skips[0]['exchange_skip_id'];
					$job_type = $skips[0]['job_type'];
					$quantity = 1;
					
					// Now retrieve the stock of this old skip
					$skip_condition = '';
					$skip_condition = array();
					$skip_condition['id'] = $skip_id; 
					$skip_stock = selectWhere($con,'skips',$skip_condition);
					
					$size = $skip_stock[0]['size'];
					// on the road
					$current_stock = $skip_stock[0]['current_stock'];
				    //in yard
					$in_yard= $skip_stock[0]['owned'];
					
					// Now we need to check if this job is a exchange, job_type=3
					
					if($job_type==3) // Exchange Job
					{
						
						  // Now retrieve the stock of this exchanged skip
						  $skip_condition = '';
						  $skip_condition = array();
						  $skip_condition['id'] = $exchange_skip_id; 
						  $skip_stock = selectWhere($con,'skips',$skip_condition);
						  
						  $size = $skip_stock[0]['size'];
						  
						  $current_stock_of_exchange_skip = $skip_stock[0]['current_stock'];
						  $exchange_in_yard=$skip_stock[0]['owned'];
						  
						  $current_stock_of_exchange_skip=$current_stock_of_exchange_skip+$quantity;
						  $exchange_in_yard=$exchange_in_yard-$quantity;
						  
						 
						  if($exchange_skip_id!=$skip_id)
						  {
						  $current_stock =$current_stock-$quantity;
						  $in_yard= $in_yard+$quantity;
						  // Now simply update stock of old skip
						  $sql="UPDATE skips SET 
						  current_stock=$current_stock,
						  owned=$in_yard 
						  
						  WHERE id=$skip_id";
						  //echo $sql;
					  
						  if (!mysqli_query($con,$sql)) {
							  
							  die('UPDATE 6 INTO orders -Error: ' . mysqli_error($con));
							  }
							  // Now simply update stock of New skip
						  $sql="UPDATE skips SET 
						  current_stock=$current_stock_of_exchange_skip, 
						  owned=$exchange_in_yard
						  WHERE id=$exchange_skip_id";
						  //echo $sql;
					  
						  if (!mysqli_query($con,$sql)) {
							  
							  die('UPDATE 7 INTO orders -Error: ' . mysqli_error($con));
							  }
					     //Update skip entry in orders table
						  }
						 $sql="UPDATE orders SET skip_id=$exchange_skip_id WHERE id=$id";
					//echo $sql;
				
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('UPDATE 4 INTO orders -Error: ' . mysqli_error($con));
		  				}
						
					}//if
					
					//////////// Job Type is Delivery
					
					elseif($job_type==1){
						
						
							$current_stock=$current_stock+$quantity;
							$in_yard=$in_yard-$quantity;
							// Now simply update stock
							$sql="UPDATE skips SET 
							current_stock=$current_stock,
							owned=$in_yard 
							
							WHERE id=$skip_id";
							//echo $sql;
						
							if (!mysqli_query($con,$sql)) {
								
								die('UPDATE 5 INTO orders -Error: ' . mysqli_error($con));
								}
								
					
					}//else if this job is a collection job
					////// Collection job now
					
					elseif($job_type==2){
						
						
							$current_stock=$current_stock-$quantity;
							$in_yard=$in_yard+$quantity;
							// Now simply update stock
							$sql="UPDATE skips SET 
							current_stock=$current_stock,
							owned=$in_yard 
							
							WHERE id=$skip_id";
							//echo $sql;
						
							if (!mysqli_query($con,$sql)) {
								
								die('UPDATE 6 INTO orders -Error: ' . mysqli_error($con));
								}
								
					
					}//else if this job is a excahnge job
					
				            		////////////////// update stock code start here ///////////////////////////////////
				 }	
				 
				 ob_clean();
				 header('Location: list_job.php');
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
      
        <p style="color:black; background-color:#36EB34; padding:20px; font-size:20px; font-weight:bold;"> Job Status Updated Successfully.</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="closeme" data-dismiss="modal" class="btn btn-success">Close ME</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
$(document).ready(function () {
	$('#loader').hide();
	$('#loader').style.display="none";
});
$('#confirm_button').hide();
$('#btn_update').click(function(){
	$('#loader').show();
	var id=$('#id').val();
	var selected_payment_status='Y';
	var end_date=$('#end_date').val();
	var total=$('#total').val();
	var job_status=$('#job_status').val();
	var job_paid=$('#job_paid').val();
	var driver_id=$('#driver_id').val();
	
	
	var dataString = 'selected_payment_status=' + selected_payment_status+'&id=' + id+'&job_status=' + job_status+'&end_date=' + end_date+'&total=' + total+'&job_paid=' + job_paid+'&driver_id=' + driver_id;
	//alert(dataString);
	//return false;
	var td_id=$('#td_id').val();
	//alert(td_id);
	$.ajax({
		type: "POST",
    url: "update_job.php",
    data: dataString,
    success: function(data) {
		 
		
		$('#confirmModal').modal('show');
		$('#loader').delay(500).fadeOut("slow");
		window.location.reload();
		}
	
	
	});
	
	
  });
  
  $('#closeme').click(function(){
  
 // window.location.reload();
  });
  
 
  
$('#job_status').click(function(){
	
	$('#confirm_button').show();



});

</script> 
</body>
</html>