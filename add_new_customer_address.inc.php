 <!-- Now allocate job to selected driver -->
       <?php
	   include "dbconfig.php";
	   print_r($_POST);
		if (ISSET($_POST['address1'])) {
		// -------------- add more rows and connect here to database -- all fields
	    $address1=$con->real_escape_string($_POST['address1']);
		$city=$con->real_escape_string($_POST['city']);
		$post_code=$con->real_escape_string($_POST['post_code']);
		$customer_id=$con->real_escape_string($_POST['customer_id']);
		
		
		
		$sql = "INSERT into delivery_address (address1,city,post_code,customer_id) VALUES('$address1','$city','$post_code','$customer_id')";
		echo $sql;
		if (!mysqli_query($con,$sql)) 
					  { 	
						  echo '<p style="color:black; background-color:red; padding:20px; font-size:20px; font-weight:bold;"> error 22 Something Went Wrong, did you filled all fields?';
						  exit;
						  //echo $sql;
						  die('INSERT SQL 2 SAID -Error : ' . mysqli_error($con));
					  }//if (!mysqli
		}