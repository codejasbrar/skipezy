<?php 
include "dbconfig.php";
include "navbar.php";
$id=$_REQUEST['id'];
$sql = "DELETE FROM orders WHERE orders.id =$id"; 
  	
				if (!mysqli_query($con,$sql)) 
				{ 	
					//echo $sql;
					die('DELETE FROM orders-Error: ' . mysqli_error($con));
				}
				
				?>
<div class="col-md-12" style="margin-top:80px;box-shadow: 5px 5px 5px; background-color:#EDEC3D;">
      <p style="color:black; padding:20px; font-size:20px; font-weight:bold;"> Job Cancelled and Removed. <a href="list_job.php" class="btn btn-primary btn-sm pull-right">Go to Live Jobs</a></p>
          
   </div>
				
