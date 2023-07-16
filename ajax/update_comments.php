<?php
require_once("../dbconfig.php");
$comments=$_POST['comments'];
$id=$_POST['id'];

					$sql="UPDATE orders SET 
					 
					comments='$comments'
					WHERE id=".$id;
					echo $sql;
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('Update 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  				}
				?>