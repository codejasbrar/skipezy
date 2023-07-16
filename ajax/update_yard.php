<?php
require_once("../dbconfig.php");
$yard=$_POST['yard'];
$id=$_POST['id'];

					$sql="UPDATE orders SET 
					 
					yard='$yard'
					WHERE id=".$id;
					echo $sql;
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('Update 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  				}
				?>