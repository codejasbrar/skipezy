<?php
	ob_start();		
    include "dbconfig.php" ;
	error_reporting(E_ALL);
	//print_r($_POST);
	//exit;
	?>
    
   <?php
			 if(isset($_POST['get_customer_address']))
				{
									$get_customer_address=$con->real_escape_string($_POST['get_customer_address']);
									$customers_sql="SELECT * FROM customers WHERE id=$get_customer_address"; 
									$t_result=mysqli_query($con,$customers_sql);
									$customer=mysqli_fetch_assoc($t_result);
	?> 
   							  <div style=" border: 2px solid Blue;border-style: dashed;
    border-radius: 5px;" class="form-group col-md-12">
                              <div>&nbsp;</div>
                              <label for="area"><?php echo $customer['name'];?></label><br>
                               <label for="area"><?php echo $customer['address1'].", ".$customer['address2'];?></label><br>
                               <label for="area"><?php echo $customer['city'];?></label><br>
                               <label for="area"><?php echo $customer['post_code'];?></label><br>
                               
           					</div>                    
               
                      <!--Now make the delivery address dropdown -->
                      
            <?php
            $customer_id=$con->real_escape_string($_POST['customer_id']);
			
			$sql="SELECT * FROM delivery_address WHERE customer_id=$customer_id"; //Select 1
			 // echo $sql;
			  if (!mysqli_query($con,$sql)) 
				  { 	
					  
					  die('SELECT 1 SQL SAID -Error: ' . mysqli_error($con));
				  }
		?>
                     <select name="delivery_address" id="delivery_address" class="form-control">
                             <option value="" style="padding:10px;">Select Delivery Location </option>
                               <?php
							   
							    	$t_result=mysqli_query($con,$sql);
									while($location=mysqli_fetch_assoc($t_result))
									{
										
									?>
           <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="<?php echo $location['id']; ?>">
              <?php echo $location['address1']." - ".$location['address2']." , ".$location['city']." , ".$location['post_code']; ?>
                           </option>
		<?php } ?>
                     </select>	
                                    
		   
	<?php
    }//if(isset
	
?>    
			<!-- editing customer -->
                
   <?php
			 if(isset($_POST['edit_customer']))
				{
									$get_customer_address=$con->real_escape_string($_POST['edit_customer']);
									$customers_sql="SELECT * FROM customers WHERE id=$get_customer_address"; 
									$t_result=mysqli_query($con,$customers_sql);
									$customer=mysqli_fetch_assoc($t_result);
	?> 
   							  <div style=" border: 2px solid Blue;border-style: dashed; background-color:#6E9DBF;
    border-radius: 5px;" class="form-group col-md-12">
                              <div>&nbsp;</div>
                              <label for="area"><?php echo $customer['name'];?></label><br>
                               <label for="area"><?php echo $customer['address1'].", ".$customer['address2'];?></label><br>
                               <label for="area"><?php echo $customer['city'];?></label><br>
                               <label for="area"><?php echo $customer['post_code'];?></label><br>
                               
           					</div>                    
               
                      <!--Now make the delivery address dropdown -->
                      
            <?php
            $customer_id=$con->real_escape_string($_POST['edit_customer']);
			
			$sql="SELECT * FROM delivery_address WHERE customer_id=$customer_id"; //Select 1
			 // echo $sql;
			  if (!mysqli_query($con,$sql)) 
				  { 	
					  
					  die('SELECT 1 SQL SAID -Error: ' . mysqli_error($con));
				  }
		?>
        <div class="form-control col-md-12">
                     <select name="delivery_address" id="delivery_address">
                             <option value="" style="padding:10px;">Select Delivery Location </option>
                               <?php
							   
							    	$t_result=mysqli_query($con,$sql);
									while($location=mysqli_fetch_assoc($t_result))
									{
										
									?>
           <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="<?php echo $location['id']; ?>">
              <?php echo $location['address1']." - ".$location['address2']." , ".$location['city']." , ".$location['post_code']; ?>
                           </option>
		<?php } ?>
                     </select>	
                  </div>                  
		   
	<?php
    }//if(isset
	//exit;
?> 
            <!-- editing customer ends -->
            				



         <?php
	if(isset($_POST['delivery_address']))
	{
									$delivery_address=$con->real_escape_string($_POST['delivery_address']);
									$customers_sql="SELECT * FROM delivery_address WHERE id=$delivery_address"; 
									//echo $customers_sql;
									$t_result=mysqli_query($con,$customers_sql);
									$customer=mysqli_fetch_assoc($t_result);
	?> 
     <div class="clearfix"></div>
   							   <div style=" border: 2px solid red;border-style: dashed; background-color:#F1D06D;
    border-radius: 5px;"class="form-group col-md-12">
    <div>&nbsp;</div>
					           <br>
                               <label for="area">Deliver To:</label><br>
                               <label for="area"><?php echo $customer['address1'].", ".$customer['address2'];?></label><br>
                               <label for="area"><?php echo $customer['city'];?></label><br>
                               <label for="area"><?php echo $customer['post_code'];?></label><br>
                          </div>
                               
<?php } ?>
    
              
	    <?php
		   
   		 if(isset($_POST['create_order']))
							{   
		  print_r($_POST);
		       exit;  
		  
			    
   		 $create_order=$con->real_escape_string($_POST['create_order']);
   		 $job_type=$con->real_escape_string($_POST['job_type']);
		 $start_date=$con->real_escape_string($_POST['start_date']);
		 $skip_id=$con->real_escape_string($_POST['skip_id']);
		 $full_name=$con->real_escape_string($_POST['full_name']);
		
    if(isset($_POST['exchange_skip_id']))
	{
		$exchange_skip_id=$con->real_escape_string($_POST['exchange_skip_id']);
	}
	else
	{
		$exchange_skip_id=0;
	}
			 $end_date=$con->real_escape_string($_POST['end_date']);
		 // Customer Data
		 $customer_id=$con->real_escape_string($_POST['customer_id']);
		 //Payment Data
		 $amount=$con->real_escape_string($_POST['amount']);
		 $skips=$con->real_escape_string($_POST['skips']);
		 $vat=$con->real_escape_string($_POST['vat']);
		 $permit=$con->real_escape_string($_POST['permit']);
		 $payment_recieved=$con->real_escape_string($_POST['payment_recieved']);
		 $gross=$con->real_escape_string($_POST['gross']);
		 if($gross==''){$gross=$amount;}
		 $payment_type=$con->real_escape_string($_POST['payment_type']);
		 $location=$con->real_escape_string($_POST['location']);
		 $skip_location=$con->real_escape_string($_POST['skip_location']);
		 $delivery_slot=$con->real_escape_string($_POST['delivery_slot']);
		 
		 $nett=$con->real_escape_string($_POST['nett']);
		 if($nett==''){$nett=0;}
		 $stock_sql="SELECT current_stock FROM skips WHERE id = $skip_id";
		  		  if (!mysqli_query($con,$stock_sql)) {
					  echo $sql;
	  
			  die('INSERT 2 INTO ORDERS-Error: ' . mysqli_error($con));
		  }
		  $result=mysqli_query($con,$stock_sql);
		  $skip=mysqli_fetch_assoc($result);
		  $current_stock=$skip['current_stock'];
		
		  
		 if($create_order=='Yes')
			{
		//Insert Customer in Databse and get the customer ID
		
			 $sql = "INSERT INTO `customers` (name,mobile) VALUES ('$full_name','2')";
		 
		  if (!mysqli_query($con,$sql)) {
					  echo $sql;
	  
			  die('INSERT 2 INTO customers-Error: ' . mysqli_error($con));
		  }
		  $new_customer_id = $con->insert_id;
		  echo $new_customer_id;
		  exit;
		 $sql = "INSERT INTO `orders` (total_amount,status) VALUES ($gross,'2')";
		 
		  if (!mysqli_query($con,$sql)) {
					  echo $sql;
	  
			  die('INSERT 2 INTO ORDERS-Error: ' . mysqli_error($con));
		  }
	$order_id = $con->insert_id;
	
		  //Now insert the order in order details
		  
		  $sql = "INSERT INTO `order_details` (order_id, customer_id,job_type,start_date,end_date,skip_id,exchange_skip_id,skips,amount,vat,permit,gross,payment_status,location_id,skip_location,delivery_slot,nett) VALUES($order_id,$customer_id,$job_type,'$start_date','$end_date',$skip_id,$exchange_skip_id,$skips,$amount,$vat,$permit,$gross,$payment_type,$location,'$skip_location','$delivery_slot',$nett)";
		 
					  echo $sql;

		  if (!mysqli_query($con,$sql)) {
			  echo $sql;
			  die('INSERT 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  }
	// Now make the entry in transactions table
	
		  $sql = "INSERT INTO `transactions` (transaction_date, source_id,amount) VALUES('$transaction_date',$customer_id,$amount)";
		 
					  echo $sql;

		  if (!mysqli_query($con,$sql)) {
			  echo $sql;
			  die('Create Transaction 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  }
			echo '<p style="color:black; background-color:#36EB34; padding:20px; font-size:20px; font-weight:bold;"> Job Created Successfully. <a href="new_order.php" class="btn btn-primary btn-sm pull-right">Add New Job</a></p>';
			 
			}//if($create_order=yes
   
		}//if(isset($_POST['create_orde
	
	
	
	 
	?>
    
    
    <!-- Data for Job Update -->
    
    <?php
  if(isset($_POST['update_order']))
	{
	$order_id=$con->real_escape_string($_POST['update_order']);
	$start_date=$con->real_escape_string($_POST['start_date']);
	$end_date=$con->real_escape_string($_POST['end_date']);
    $job_type=$con->real_escape_string($_POST['job_type']);
    
	$skip_id=$con->real_escape_string($_POST['skip_id']);
	
    //Payment Data
		 $amount=$con->real_escape_string($_POST['amount']);
		 $skips=$con->real_escape_string($_POST['skips']);
		 $vat=$con->real_escape_string($_POST['vat']);
		 $permit=$con->real_escape_string($_POST['permit']);
		 $nett=$con->real_escape_string($_POST['nett']);
		 $invoice=$con->real_escape_string($_POST['invoice']);
		 $payment_recieved=$con->real_escape_string($_POST['payment_recieved']);
		 $payment_type=$con->real_escape_string($_POST['payment_type']);
		 
		 $gross=$con->real_escape_string($_POST['gross']);
		 $transaction_date=$con->real_escape_string($_POST['payment_date']);
		 
		 if($gross==''){$gross=$amount;}
		 
		 $stock_sql="SELECT order_details.skip_id,order_details.skips, skips.current_stock FROM order_details LEFT JOIN skips ON order_details.skip_id=skips.id WHERE order_details.skip_id = $skip_id AND order_details.id=$order_id";
		 //echo $sql;
		  if (!mysqli_query($con,$stock_sql)) {
					  echo $sql;
	  
			  die('INSERT 2 INTO ORDERS-Error: ' . mysqli_error($con));
		  }
		  $result=mysqli_query($con,$stock_sql);
		  $skip=mysqli_fetch_assoc($result);
		  $existing_stock=$skip['current_stock'];
		  $existing_skip=$skip['id'];
		  $existing_qty=$skip['skips'];
		  
		  $new_skip=$skip_id;
		  $new_qty=$skips;
		  
		 
		  if($existing_skip==$new_skip)
		  {
			  
			  $new_stock=$current_stock-$skips;
			  
			  }
		  else{$new_stock=$current_stock+$skips;}
		  if($job_type==1)
		  {
		  $new_stock=$current_stock-$skips;
		  }
		  elseif($job_type==3)
		  {
		  $new_stock=$current_stock+$skips;
		  }
		  $update_stock_sql="UPDATE skips SET current_stock =$new_stock wHERE id=$skip_id";
		  if (!mysqli_query($con,$update_stock_sql)) {
					  echo $sql;
	  
			  die('UPDATE 2 INTO ORDERS-Error: ' . mysqli_error($con));
		  }
		   echo "In database current skip is ".$existing_skip."and current stock is ".$existing_stock." and existing quanity is ".$existing_qty."";
		  
		  echo "New skip is ".$new_skip." and skip type is ".$skip." and quanitity ".$skips."";
		  
$sql="UPDATE order_details SET start_date='$start_date',job_type='$job_type',skip_id='$skip_id',end_date='$end_date',permanent='$permanent',driver_id='$driver_name',amount='$amount',vat='$vat',permit='$permit',gross='$gross',payment_status='$payment_type',customer_id='$customer_id' WHERE order_id='$order_id' ";
	
		  if (!mysqli_query($con,$sql)) {
			  echo $sql;
			  die('Update 3 ORDER_Details -Error: ' . mysqli_error($con));
		  }
		  
		  echo "Job has been updated successfully";
}//if(isset
	
?>

    
     <!-- java script for date picker -->
 <script type="text/javascript">
	 $('#delivery_address').change(function(){
              var delivery_address = $(this).val();
			  	
                var dataString = 'delivery_address=' + delivery_address;
               //alert(dataString);
				$(this).css('background-color','#57F019');
                $.ajax({
                    type: "POST",
                    url: "create_order.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
					
					 $('#delivery').html(data); 
					 //$('#delivery_address').hide();
                }
            });
        });
</script>