 <?php
 echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		exit;
   	if (ISSET($_POST['create_new_invoice'])) {
		
		// -------------- add more rows and connect here to database -- all fields
		$customer_id=$con->real_escape_string($_POST['customer_id']);
		$invoice_date=$con->real_escape_string($_POST['invoice_date']);
		$invoice_date = str_replace('/', '-', $invoice_date);
		$invoice_date = date("Y-m-d", strtotime($invoice_date));
		//echo $invoice_date;
			//	exit;
		// Now get invoice data
		$sub_total=$con->real_escape_string($_POST['sub_total']);
		$vat_p=$con->real_escape_string($_POST['vat_p']);
		$vat=$con->real_escape_string($_POST['vat']);
		$nett=$con->real_escape_string($_POST['nett']);
		$permit=$con->real_escape_string($_POST['permit']);
		$gross=$con->real_escape_string($_POST['gross']);
		$paid=$con->real_escape_string($_POST['paid']);
		$due=$con->real_escape_string($_POST['due']);
		$notes=$con->real_escape_string($_POST['notes']);
		$address1=$con->real_escape_string($_POST['address1']);
		$city=$con->real_escape_string($_POST['city']);
		$post_code=$con->real_escape_string($_POST['post_code']);
		$invoice_no=$con->real_escape_string($_POST['invoice_no']);
		$invoice_no++;
		
		//mysqli_query($con,$sql);g		//$last_insert_id=mysqli_insert_id($con);	
		//echo $last_insert_id;
		
		
		
			$sql = "INSERT INTO `invoices`(`invoice_no`,`customer_id`, `date`, `sub_total`, `vat_p`, `vat`, `nett`, `permit`,`gross`,`paid`,`due`,`notes`,status,address1,city,post_code) VALUES ($invoice_no,$customer_id,'$invoice_date','$sub_total','$vat_p','$vat','$nett','$permit','$gross','$paid','$due','$notes','N','$address1','$city','$post_code')";
				
					  
					  if (!mysqli_query($con,$sql)) 
					  { 	
						  echo '<p style="color:black; background-color:red; padding:20px; font-size:20px; font-weight:bold;"> error 478 Something Went Wrong, did you filled all fields?';
						  echo $sql;
						  exit;
						  die('INSERT SQL 2 SAID -Error : ' . mysqli_error($con));
					  }//if (!mysqli
					  
				//$invoice_number=mysqli_insert_id($con);	
				 
				 $count = count($_POST['item']);
				for ($i = 0; $i < $count; $i++) {
					$srno=$i+1;
					$item = $con->real_escape_string($_POST['item'][$i]);
					$qty = $con->real_escape_string($_POST['quantity'][$i]);
					$unit_price = $con->real_escape_string($_POST['price'][$i]);
					$sub_total = $con->real_escape_string($_POST['amount'][$i]);
					
					$sql = "INSERT into invoice_details (invoice_no,srno,item_id,qty,unit_price,sub_total) VALUES ($invoice_no,$srno,'$item','$qty','$unit_price','$sub_total')";
					//echo $sql;
					//echo $sql.'<br />';
					
					if (!mysqli_query($con,$sql)) 
					  { 	
						  echo '<p style="color:black; background-color:red; padding:20px; font-size:20px; font-weight:bold;"> error 497 Something Went Wrong, did you filled all fields?';
						  exit;
						  die('INSERT SQL 2 SAID -Error : ' . mysqli_error($con));
					  }//if (!mysqli
					  
					 	} 
					// Now save invoice summary in the invoice table
					
					
					echo '<p style="color:black; background-color:#36EB34; padding:20px; font-size:20px; font-weight:bold;"> Invoice No.'.$invoice_no.' Inserted Successfully. <a href="new_invoice.php" class="btn btn-primary btn-sm pull-right">Add New Invoice</a></p>';
			
	}
?>