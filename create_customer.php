<?php
include "dbconfig.php";
ini_set('display_errors',1); // enable php error display for easy trouble shooting
error_reporting(E_ALL); // set error display to all

	if (ISSET($_POST['create_new_customer'])) {
		// -------------- add more rows and connect here to database -- all fields
		$customer_name=$con->real_escape_string($_POST['full_name']);
		$mobile=$con->real_escape_string($_POST['mobile']);
		$phone=$con->real_escape_string($_POST['phone']);
		$email=$con->real_escape_string($_POST['email']);
		$address1=$con->real_escape_string($_POST['address1']);
		$address2=$con->real_escape_string($_POST['address2']);
		$city=$con->real_escape_string($_POST['city']);
		$post_code=$con->real_escape_string($_POST['post_code']);
		
		
		
		$sql = "INSERT into customers (name,mobile,phone,email,address1,address2,city,post_code,customer_type_id) VALUES('$customer_name','$mobile','$phone','$email','$address1','$address2','$city','$post_code','1')";
		if (!mysqli_query($con,$sql)) 
					  { 	
						  echo '<p style="color:black; background-color:red; padding:20px; font-size:20px; font-weight:bold;"> error 22 Something Went Wrong, did you filled all fields?';
						  exit;
						  //echo $sql;
						  die('INSERT SQL 2 SAID -Error : ' . mysqli_error($con));
					  }//if (!mysqli
					  
		$last_insert_id=mysqli_insert_id($con);	
		//echo $last_insert_id;
			$count = count($_POST['del_address1']);
			
				for ($i = 0; $i < $count; $i++) {
					$address1 = $con->real_escape_string($_POST['del_address1'][$i]);
					$address2 = $con->real_escape_string($_POST['del_address2'][$i]);
					$city = $con->real_escape_string($_POST['del_city'][$i]);
					$post_code = $con->real_escape_string($_POST['del_post_code'][$i]);
					$sql = "INSERT into delivery_address (customer_id,address1,address2,city,post_code) VALUES ($last_insert_id,'$address1','$address2','$city','$post_code')";
					//echo $sql.'<br />';
					//echo $sql;
					if (!mysqli_query($con,$sql)) 
					  { 	
						  echo '<p style="color:black; background-color:red; padding:20px; font-size:20px; font-weight:bold;"> error 42 Something Went Wrong, did you filled all fields?';
						  exit;
						  //echo $sql;
						  die('INSERT SQL 2 SAID -Error : ' . mysqli_error($con));
					  }//if (!mysqli
					
				}
				echo '<p style="color:black; margin-bottom:10px; background-color:#36EB34; padding:20px; font-size:20px; font-weight:bold;"> Customer Created Successfully. <a href="new_customer.php" class="btn btn-primary btn-lg pull-right">Add New Customer</a></p>';
	}
?>