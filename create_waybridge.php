<?php
       include "dbconfig.php";
	   include "navbar.php";
	   if(isset($_POST['create_artic']))
			
			{
				$date=$con->real_escape_string($_POST['start_date']);
				$entry_type=$con->real_escape_string($_POST['entry_type']);
				$vehicle_type=$con->real_escape_string($_POST['vehicle_type']);
				$size=$con->real_escape_string($_POST['size']);
				$qty=1;
				$material=$con->real_escape_string($_POST['material']);
				
				
				//print_r($_POST);
				 $sql = "INSERT INTO `artic` (date, entry_type,vehicle_type,size,quantity,material) VALUES('$date','$entry_type','$vehicle_type','$size','$qty','$material')";
		 
		
		  if (!mysqli_query($con,$sql)) {
			  echo $sql;
			  die('INSERT 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  }
				
				echo '<br><br><br><div>&nbsp;</div><p style="color:black;font-family:Montserrat; background-color:ffffff; padding:15px; font-size:20px; font-weight:bold;"> Wybridge Entery Created Successfully. <a href="new_waybridge.php" class="btn btn-primary btn-sm pull-right">Add Another Waybridge</a>&nbsp;&nbsp;<a href="list_waybridge.php" class="btn btn-success btn-sm pull-right">See List of All Enteries</a></p>';
				}
				
				?> 