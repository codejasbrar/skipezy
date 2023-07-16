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

</head>

<body>
<?php
   						if (isset($_POST['tip_job_id'])) {
									//print_r($_POST);
									// -------------- add more rows and connect here to database -- all fields
									$order_id=$con->real_escape_string($_POST['tip_job_id']);
									//$driver=getAll($con,"employees");
									$condition=array("job_title"=>1);
									$condition_string=getWhere($condition);
									//echo $condition_string;
									//exit;
									$driver=selectWhere($con,"employees",$condition);
									//$driver=insert($con,"employees",$condition);
										?>
                           
                           
 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Job Status</h4>
      </div>
      <div class="modal-body">
       <div class="panel">
                  <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                      <div class="panel-heading"><center><h4>Job Tipping Details</h4></center></div>
                  </div>
                  <div class="panel-body" style="background-color:#e9e9e9; box-shadow: 5px 5px 5px;">
                <div class="col-md-5">
                <form method="post" action="" id="tip_job">
                      
                        <label for="name">Driver Name</label>
                         <select style="width:70%;" name="driver" id="driver_id" class="form-control">
                             <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a Driver </option>
                               <?php
							   foreach($driver as $key=>$driver_data){?>
				<option style="padding:10px; background-color:#9AD8EF; color:#320607; cursor:pointer;" value="<?php echo $driver_data['id']; ?>"><?php echo $driver_data['name']; ?>
    
    </option>
								   
								   <?php }
							   ?>
                          </select>
                         
                         
                         <label for="mobile">Yard Name</label>
                         <?php
						 $yard=getAll($con,"yards");
						 ?>
                         <div class="form-group">
                           <select style="width:70%;" name="yard" id="yard" class="form-control">
                             <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a Yard </option>
                               <?php
							   foreach($yard as $key=>$yard_data){?>
				<option style="padding:10px; background-color:#9AD8EF; color:#320607; cursor:pointer;" value="<?php echo $yard_data['id']; ?>"><?php echo $yard_data['name']; ?>
    
    </option>
								   
								   <?php }
							   ?>
                          </select>
                          
                         </div>
                         <label for="mobile">Lorry Reg</label>
                         <div class="form-group">
                          <?php
						 $lorry=getAll($con,"vehicles");
						 ?>
                         <div class="form-group">
                           <select style="width:70%;" name="lorry" id="lorry" class="form-control">
                             <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a lorry </option>
                               <?php
							   foreach($lorry as $key=>$lorry_data){?>
				<option style="padding:10px; background-color:#9AD8EF; color:#320607; cursor:pointer;" value="<?php echo $lorry_data['id']; ?>"><?php echo $lorry_data['reg_plate']; ?>
    
    </option>
								   
								   <?php }
							   ?>
                          </select>
                          
                         </div>
                     
                      <!-- right side div -->
                      
                        <label for="phone">Paid</label>
                         <div class="form-group">
                          <select style="width:70%;" name="paid" id="paid" class="form-control">
                             <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="y">Yes</option>
                              <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="n">No</option>
                          </select>
                          
                         <input type="hidden" id="status" name="status" value="Tipping Done">
                         <input type="hidden" id="job_id" name="job_id" value="<?php echo $order_id;?>">
                         </div>
                   </div>
                 
        </form>
         </div>
         
                 </div>   
              </div>
              <div class="row">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <p  name="allocate_job" id="tip_job_btn" class="btn btn-primary">Update Job Status</p>
        </div>
                 
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
                <?php } ?>
 
       <?php
       if(isset($_POST['driver']))
			
			{
				
				print_r($_POST);
				$condition=$_POST;
				insert($con,"tip_jobs",$condition);
				echo "Tipped";
				}
	     ?> 


<div class="modal fade"  id="confirmModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Tipping Confirmation !</h4>
      </div>
      <div class="modal-body">
        <p style="color:black; background-color:#EFBC0D; padding:20px; font-size:20px; font-weight:bold;"> Great !! You Just Tipped a Skip !</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="closeme" class="btn btn-success">Close ME</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
$('#tip_job_btn').click(function(){
	var form = $('#tip_job').serialize();
   /// alert(form);
	$.ajax({
		type: "POST",
		url: "tip_job.php",
		data: form,
		success: function(data) {
			alert(data);
			$('#confirmModal').modal('show');
			
		}
	})
	
  });
  
  $('#closeme').click(function(){
  
 window.location.href='list_job.php';
  });
  
 </script> 
  
</body>
</html>