<?php
		   include "dbconfig.php";
//include "php_functions.php";
//include "dbfunction.php";
include "navbar.php";
   		 if(isset($_POST['new_order_form']))
							{   
		  //print_r($_POST);
	
		$old_customer_id=$con->real_escape_string($_POST['old_customer_id']);
		if($old_customer_id==0)
		{
		$customer_name=$con->real_escape_string($_POST['full_name']);
		//$mobile=$con->real_escape_string($_POST['mobile']);
		$phone=$con->real_escape_string($_POST['phone']);
		//$email=$con->real_escape_string($_POST['email']);
		$address1=$con->real_escape_string($_POST['address1']);
		//$address2=$con->real_escape_string($_POST['address2']);
		$city=$con->real_escape_string($_POST['city']);
		$post_code=$con->real_escape_string($_POST['post_code']);
		 
		  //Add a New Customer and reterieve customer id + add his address details
		 
		$condition=array("name"=>$customer_name,"mobile"=>$phone,"address1"=>$address1,"post_code"=>$post_code,);
		$new_customer_id =insert($con,"customers",$condition,true);
			 
		  //Create a record in delivery address table as well
		  $condition=array("customer_id"=>$new_customer_id,"address1"=>$address1,"post_code"=>$post_code,"city"=>$city,);
		  $new_location_id =insert($con,"delivery_address",$condition,true);		
		
		}
	    
   		// $create_order=$con->real_escape_string($_POST['create_order']);
   		 $job_type=$con->real_escape_string($_POST['job_type']);
		 
		 $start_date=$con->real_escape_string($_POST['start_date']);
		 //echo "Before format ".$start_date;
		 $start_date = str_replace('/', '-', $start_date);
		 $start_date = date("Y-m-d", strtotime($start_date));
		 //echo "<br> After Fromat ".$start_date;
		
		 $skip_id=$con->real_escape_string($_POST['skip_id']);
		 $full_name=$con->real_escape_string($_POST['full_name']);
		 $comments='No Comments';//$con->real_escape_string($_POST['comments']);
		
    if(isset($_POST['exchange_skip_id']))
	{
		$exchange_skip_id=$con->real_escape_string($_POST['exchange_skip_id']);
	}
	else
	{
		$exchange_skip_id=0;
		
	}
	
	 
	 //echo $exchange_skip_id;
	 //exit;
	     //$end_date=$con->real_escape_string($_POST['end_date']);
		 // Customer Data
		 $customer_id=$con->real_escape_string($_POST['old_customer_id']);
		 //Payment Data
		 $amount=$con->real_escape_string($_POST['amount']);
		 $skips=$con->real_escape_string($_POST['skips']);
		//if the job type is colection that means paymen is fully paid.
		 if($job_type==2){
		 $payment_type=1;
		 }else{
		 $payment_type=$con->real_escape_string($_POST['payment_type']);
		 }
		 $skip_location=$con->real_escape_string($_POST['skip_location']);
		 $delivery_slot=$con->real_escape_string($_POST['delivery_slot']);
		 
		 $stock_sql="SELECT current_stock FROM skips WHERE id = $skip_id";
		  		  if (!mysqli_query($con,$stock_sql)) {
					  echo $sql;
	  
			  die('INSERT 2 INTO ORDERS-Error: ' . mysqli_error($con));
		  }
		  $result=mysqli_query($con,$stock_sql);
		  $skip=mysqli_fetch_assoc($result);
		  $current_stock=$skip['current_stock'];
		
		 
	
		  //Now insert the order in order details
		  // This is an old customer but check if delivery address is old or new
		 
		 if(isset($_POST['delivery_address']))
		 {
		 $delivery_location=$con->real_escape_string($_POST['delivery_address']);
		 
		 if($delivery_location==0){
			 
		 $del_address=$con->real_escape_string($_POST['del_address']);
		 $del_post_code=$con->real_escape_string($_POST['del_post_code']);
		 $del_city=$con->real_escape_string($_POST['del_city']);
		 //Create a record in delivery address table as well
		  $condition=array("customer_id"=>$old_customer_id,"address1"=>$del_address,"post_code"=>$del_post_code,"city"=>$del_city,);
		  $delivery_location=insert($con,"delivery_address",$condition,true);	
		 
		 }
		 }
		  $sql = "INSERT INTO `orders` (total_amount,status) VALUES ($amount,'1')";
		 
		  if (!mysqli_query($con,$sql)) {
					  echo $sql;
	  
			  die('INSERT 2 INTO ORDERS-Error: ' . mysqli_error($con));
		  }
	     $order_id = $con->insert_id;
		//echo "new customer id".$new_customer_id;
		
		 if($old_customer_id==0){
		 $customer_id=$new_customer_id;
		 $delivery_location=$new_location_id;
		 }
		  //echo $start_date;
		  $sql = "INSERT INTO `order_details` (order_id, customer_id,job_type,start_date,skip_id,exchange_skip_id,amount,location_id,skip_location,delivery_slot,skips,payment_status,comments,tip_status) VALUES($order_id,$customer_id,$job_type,'$start_date',$skip_id,$exchange_skip_id,'$amount',$delivery_location,'$skip_location','$delivery_slot',$skips,$payment_type,'$comments','1')";
		 	//echo $sql;
	
		  if (!mysqli_query($con,$sql)) {
			  echo $sql;
			  die('INSERT 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  }
	/* if needed by client Now make the entry in transactions table
	
		  $sql = "INSERT INTO `transactions` (transaction_date, source_id,amount) VALUES('$start_date',$customer_id,$amount)";
		 
					  echo $sql;

		  if (!mysqli_query($con,$sql)) {
			  echo $sql;
			  die('Create Transaction 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  }
     */
			echo '<br><br><br><div>&nbsp;</div><p style="color:black;font-family:Montserrat; background-color:ffffff; padding:15px; font-size:20px; font-weight:bold;"> Job Created Successfully. <a href="new_order.php" class="btn btn-primary btn-sm pull-right">Add New Job</a>&nbsp;&nbsp;<a href="list_job.php" class="btn btn-success btn-sm pull-right">See List of All Jobs</a></p>';
			 
   
			
		
		}//if(isset($_POST['create_orde
	
	
	
	 
	?>