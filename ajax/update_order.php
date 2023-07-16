<?php
include "../dbconfig.php";
/*
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		exit;
	*/	
		

if(isset($_POST['order_id']))
{  
		  
	
		$customer_id=$con->real_escape_string($_POST['customer_id']);
		$order_id=$con->real_escape_string($_POST['order_id']);
		$address_id=$con->real_escape_string($_POST['address_id']);
		
		//----------------------------- Now we will follow the INSERT --------- 
		$customer_name=$con->real_escape_string($_POST['customer_name']);
		$phone=$con->real_escape_string($_POST['phone']);
		$address1=$con->real_escape_string($_POST['customer_address']);
		$site=$con->real_escape_string($_POST['site']);
		$city=$con->real_escape_string($_POST['city']);
		$post_code=$con->real_escape_string($_POST['post_code']);
		//$email=$con->real_escape_string($_POST['email']);
		
		if($customer_id==0 && $address_id==0){ // This means it is a New Customer 
		//echo 'New Customer and New Address';
		//exit;
		$email='demo@gmail.com';
		//Add a New Customer and reterieve customer id + add his address details
		$condition=array("name"=>$customer_name,"mobile"=>$phone,"email"=>$email);
		$customer_id =insert($con,"customers",$condition,true); // add another true in function to see SQL
		
		//Create a record in delivery address table as well
		$condition=array("customer_id"=>$customer_id,"address1"=>$address1,"post_code"=>$post_code,"city"=>$city,"site"=>$site);
		$new_location_id =insert($con,"delivery_address",$condition,true);
		//Update Orders with new customer id
		
		$sql="UPDATE orders set customer_id='$customer_id',address_id='$new_location_id' WHERE id=$order_id";
		if(!mysqli_query($con,$sql)){ echo "Error is ".mysqli_error($con);}	
			
		}elseif($customer_id!=0 && $address_id==0){ 
		
		//echo 'Customer Same but New Address';
		//exit;
		 //Create a record in delivery address table as well
		 $condition=array("customer_id"=>$customer_id,"address1"=>$address1,"post_code"=>$post_code,"city"=>$city,"site"=>$site);
		 $new_location_id=insert($con,"delivery_address",$condition,true);	
		 $sql="UPDATE orders set address_id='$new_location_id' WHERE id=$order_id";
		if(!mysqli_query($con,$sql)){ echo "Error is ".mysqli_error($con);}	
		
		}elseif($customer_id==0 && $address_id!=0){ // This means it is a New Customer 
		
		//echo 'Address Same Customer Changed';
		//exit;
		$email='demo@gmail.com';
		//Add a New Customer and reterieve customer id + add his address details
		$condition=array("name"=>$customer_name,"mobile"=>$phone,"email"=>$email);
		$customer_id =insert($con,"customers",$condition,true); // add another true in function to see SQL
	    $sql="UPDATE delivery_address set customer_id='$customer_id' WHERE id=$address_id";
		if(!mysqli_query($con,$sql)){ echo "Error is ".mysqli_error($con);}
		$sql="UPDATE orders set customer_id='$customer_id' WHERE id=$order_id";
		if(!mysqli_query($con,$sql)){ echo "Error is ".mysqli_error($con);}			
		}else{
		   
   		 $job_type=$con->real_escape_string($_POST['job_type']);
		 $start_date=$con->real_escape_string($_POST['start_date']);
		 $start_date = str_replace('/', '-', $start_date);
		 $start_date = str_replace('/', '-', $start_date);
		 $start_date = date("Y-m-d", strtotime($start_date));
		 $skip_id=$con->real_escape_string($_POST['skip_id']);
		 $skip_location=$con->real_escape_string($_POST['skip_location']);
		 
		
    if(isset($_POST['exchange_skip_id']))
	{
		$exchange_skip_id=$con->real_escape_string($_POST['exchange_skip_id']);
	}
	else
	{
		$exchange_skip_id=0;
	}
	     
		 // Customer Data
		 $customer_id=$con->real_escape_string($_POST['customer_id']);
		 //Payment Data
		 $amount=$con->real_escape_string($_POST['amount']);
		 $skips=$con->real_escape_string($_POST['skips']);
		
		  $payment_type=$con->real_escape_string($_POST['payment_type']);
		 $skip_location=$con->real_escape_string($_POST['skip_location']);
		 $delivery_slot=$con->real_escape_string($_POST['delivery_slot']);
		 
		 
		 $status=$con->real_escape_string($_POST['status']);
		 $stock_sql="SELECT current_stock FROM skips WHERE id = $skip_id";
		  		  if (!mysqli_query($con,$stock_sql)) {
					  echo $sql;
	  
			  die('INSERT 2 INTO ORDERS-Error: ' . mysqli_error($con));
		  }
		  $result=mysqli_query($con,$stock_sql);
		  $skip=mysqli_fetch_assoc($result);
		  $current_stock=$skip['current_stock'];

$sql = "UPDATE `orders` 
SET
customer_id=$customer_id,
address_id=$address_id,
job_type=$job_type,
start_date='$start_date',
skip_id=$skip_id,
exchange_skip_id=$exchange_skip_id,
amount=$amount,
payment_status=$payment_type,
status=$status,
location_id=$skip_location,
delivery_slot='$delivery_slot'

WHERE orders.id=".$order_id;
		 //echo $sql;
		 if (!mysqli_query($con,$sql)) {
			  echo $sql;
			  die('INSERT 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  }
	     
		
		//if(isset($_POST['create_orde
	
		}
		echo 'success';	 
}
	 
	 
	?>