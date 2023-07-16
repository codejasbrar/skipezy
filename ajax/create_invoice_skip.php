<?php
include "../dbconfig.php";
ini_set('display_errors',1); // enable php error display for easy trouble shooting
error_reporting(E_ALL); // set error display to all

	
		// -------------- add more rows and connect here to database -- all fields
		$skip_name=$con->real_escape_string($_POST['size']);
		
		
		$sql = "INSERT into skips (size) VALUES('$skip_name')";
		if (!mysqli_query($con,$sql)) 
					  { 	
						  echo '<p style="color:black; background-color:red; padding:20px; font-size:20px; font-weight:bold;"> error 22 Something Went Wrong, did you filled all fields?';
						  exit;
						  //echo $sql;
						  die('INSERT SQL 2 SAID -Error : ' . mysqli_error($con));
					  }else{echo 'success';}
					  
                 ?>