<?php

include "dbconfig.php" ;

// Passkey that got from link 

$passkey=$_GET['passkey'];

$tbl_name1="tmp_candidates";

$sql="SELECT * FROM $tbl_name1 WHERE confirm_code ='".$passkey."'";

if (!mysqli_query($con,$sql)) 
							{ 	
								
								die('SELECT SQL SAID -Error Adding New candidate: ' . mysqli_error($con));
							}

$res= mysqli_query($con,$sql);
$r=mysqli_num_rows($res);
echo $r;
if(mysqli_num_rows($res) > 0)

{

		  while ($row = mysqli_fetch_assoc($res))
	  
		  {
	  
			  echo "enterd in while loop)";
			  
			  $name=$row['name'];
	  
			  $email=$row['email'];
	  
			  $password=$row['password']; 
	  
			  $tbl_name2="candidates";
	  
			  
			  $sql="SELECT * FROM $tbl_name2 WHERE email ='".$email."'";
	  
			  $response= mysqli_query($con,$sql);
	  
			  if(mysqli_num_rows($response) > 0)
	  
			  {
	  
				  // Delete information of this user from table "temp_members_db" that has this passkey 
	  
					  $sql3="DELETE FROM $tbl_name1 WHERE confirm_code = '$passkey'";
	  
					  $result3=mysqli_query($con,$sql3);
	  
				  	  echo "Already confirmed.";
		  
				  }
		  
				  else
		  
				  {
	  
				  $sql2="INSERT INTO $tbl_name2 (name, email, password) VALUES ('{$name}', '{$email}', '{$password}')";
	  
				  //echo $sql2;exit;
	  				if (!mysqli_query($con,$sql2)) 
							{ 	
								
								die('INSERT SQL SAID -Error Adding New candidate: ' . mysqli_error($con));
							}
				  $result2 = mysqli_query($con,$sql2);
	  
				  if($result2)
	  
				  {
	  
	  
	  
					  // Delete information of this user from table "temp_members_db" that has this passkey 
	  
					  $sql3="DELETE FROM $tbl_name1 WHERE confirm_code = '$passkey'";
	  
					  $result3=mysqli_query($con,$sql3);
	  
					  echo "Your account has been activated. Click Here to ";?><a href="login.html"> Log In</a>
	  
					  
	  
					  <?php 

						}

						else
			
						{
			
							echo "Insert Error. Please try again.";
			
						}
			
					}
			
				}

}

else

{

	echo "Your Account is already activated. Please contact Admin.";

}

?>