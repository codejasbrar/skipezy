<?php
require_once("../dbconfig.php");
$amount_paid=$_POST['amount_paid'];
$id=$_POST['id'];

					$sql="UPDATE orders SET 
					 
					amount_paid='$amount_paid'
					WHERE id=".$id;
					echo $sql;
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('Update 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  				}
				?>