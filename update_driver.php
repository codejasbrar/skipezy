<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Drivers Change</title>
<?php 
include "dbconfig.php";
include "php_functions.php";
ob_start();
?>
</head>

<body>
<?php
   						if (ISSET($_POST['select_job_id'])) {
									//print_r($_POST);
									// -------------- add more rows and connect here to database -- all fields
									$job_id=$con->real_escape_string($_POST['select_job_id']);
									$customers_sql="SELECT * FROM employees"; 
									echo $customers_sql;
									$result=mysqli_query($con,$customers_sql);
									
									?>
                           
                           
 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">List of all Drivers</h4>
      </div>
      <div class="modal-body">
     
     
							<table class="table table-bordered">
                	        <thead class="head_table">
                            <tr>
                                <th>Driver ID</th>
                                <th>Driver Name</th>
                                <th>Select</th>
                                
                           </tr>
                        </thead>
                        <tbody>
									<?php
                                    while($driver=mysqli_fetch_assoc($result))
									{?>
							
                        	<tr data-id="<?php echo $driver['id'];?>">
                                <td>
                                <?php echo $driver['id'];?>
                                </td>
                                <td>
                                <?php echo $driver['name'];?>
                                </td>
                                <td>
                <input type="radio" name="selected_driver" job_id="<?php echo $job_id;?>" class="employee_id" id="selected_driver" value=<?php echo $driver['id'];?>>
                                </td>
                                  
                             </tr>
                             <?php }?>
                         </tbody>
					</table> 
                    </div>
                 <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="allocate_job" id="modal_button" class="btn btn-primary" value="Allocate Driver"/>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
                <?php } ?>
 
 <!-- Now allocate job to selected driver -->
       <?php
       if(isset($_POST['selected_driver']))
			{
				//$id=$_POST['selected_driver'];
				$driver_id=$con->real_escape_string($_POST['selected_driver']);
				$job_id=$con->real_escape_string($_POST['job_id']);
				//$driver_id=$_POST['driver'];
				//print_r($_POST);
			
				    
					//$order_id=$ID;
					$sql="UPDATE order_details SET driver_id=$driver_id WHERE order_id=$job_id";
					///echo $sql;
					//exit;
				
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('INSERT 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  				}
				
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
        <p style="color:black; background-color:#36EB34; padding:20px; font-size:20px; font-weight:bold;"> Driver Allocated to This Job Successfully.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="closeme">Close ME</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
$('#modal_button').click(function(){
	$.each($("input[name='selected_driver']:checked"), function() {
    var selected_driver= $(this).val();
	var job_id=$('#selected_driver').attr('job_id');
	var dataString = 'selected_driver=' + selected_driver+'&job_id=' + job_id;
	//alert(dataString);
	
	
	$.ajax({
		type: "POST",
    url: "update_driver.php",
    data: dataString,
    success: function(data) {
		$('#confirmModal').modal('show');
		}
	});
	
	});
	
	
  });
  $('#closeme').click(function(){
  
  window.location.reload();
  });
 </script> 
  
</body>
</html>