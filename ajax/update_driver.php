<?php
require_once("../dbconfig.php");
$driver=$_POST['driver'];
$id=$_POST['id'];

					$sql="UPDATE orders SET 
					 
					driver_id='$driver'
					WHERE id=".$id;
					echo $sql;
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('Update 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  				}
				?>