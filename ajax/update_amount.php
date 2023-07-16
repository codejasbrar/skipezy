<?php
require_once("../dbconfig.php");
$amount=$_POST['amount'];
$id=$_POST['id'];

					$sql="UPDATE orders SET 
					 
					amount='$amount'
					WHERE id=".$id;
					echo $sql;
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('Update 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  				}
				?>