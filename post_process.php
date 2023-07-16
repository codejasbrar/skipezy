<?php 
include "dbconfig.php";
include "php_functions.php";
ob_start();
?>
<?php
if (isset($_POST['new_customer_form']))
{
$table_name="customers";
$form_data = array();
$form_data['name']= $con->real_escape_string($_REQUEST['full_name']);
$form_data['phone']= $con->real_escape_string($_REQUEST['phone']);
$form_data['mobile']= $con->real_escape_string($_REQUEST['mobile']);
$form_data['email']= $con->real_escape_string($_REQUEST['email']);
$form_data['address1']= $con->real_escape_string($_REQUEST['address1']);
$form_data['address2']= $con->real_escape_string($_REQUEST['address2']);
$form_data['city']= $con->real_escape_string($_REQUEST['city']);
$form_data['post_code']= $con->real_escape_string($_REQUEST['post_code']);
$form_data['payment_terms']= $con->real_escape_string($_REQUEST['payment_term']);
$form_data['type']= $con->real_escape_string($_REQUEST['type']);

dbRowInsert($table_name, $form_data);
echo "Customer Inserted Successfully";
}
?>
<?php
   // New Vehicles Data Entry Start
if (isset($_POST['new_vehicle_form']))
{
$table_name="vehicles";
$form_data = array();
$form_data['name']= $con->real_escape_string($_REQUEST['name']);
$form_data['reg_plate']= $con->real_escape_string($_REQUEST['regplate']);
$form_data['make']= $con->real_escape_string($_REQUEST['make']);
$form_data['model']= $con->real_escape_string($_REQUEST['model']);
$form_data['mileage']= $con->real_escape_string($_REQUEST['mileage']);
$form_data['mot_date']= $con->real_escape_string($_REQUEST['motdate']);
$form_data['service_date']= $con->real_escape_string($_REQUEST['last_service_date']);
//$form_data['phone']= $con->real_escape_string($_REQUEST['phone']); 
dbRowInsert($table_name, $form_data);
echo "Vehicle Record Created Successfully";
}
?>
<?php
   // New Order Data Entry Start
   if (isset($_POST['new_order_form']))
{
$table_name="order_details";
$form_data = array();
$form_data['amount']= $con->real_escape_string($_REQUEST['amount']);
//$form_data['phone']= $con->real_escape_string($_REQUEST['phone']); 
dbRowInsert($table_name, $form_data);
echo "Vehicle Record Created Successfully";
}
?>
<?php
   // New User Data Entry Start
if (isset($_POST['new_user_form']))
{
$table_name="users";
$form_data = array();
$form_data['first_name']= $con->real_escape_string($_REQUEST['first_name']);
$form_data['last_name']= $con->real_escape_string($_REQUEST['last_name']);
$form_data['user_name']= $con->real_escape_string($_REQUEST['user_name']);
$form_data['password']= $con->real_escape_string($_REQUEST['password']); 
$form_data['email']= $con->real_escape_string($_REQUEST['email']);
$form_data['role']= $con->real_escape_string($_REQUEST['role']);
dbRowInsert($table_name, $form_data);
echo "Vehicle Record Created Successfully";
}

?>

<?php
   // New Skip Data Entry Start
if (isset($_POST['new_skip_form']))
{
  $table_name="skips";
  $form_data = array();
  $form_data['size']=$con->real_escape_string($_REQUEST['size']);
dbRowInsert($table_name, $form_data);
echo "Skip Record Created Successfully";
}

?>
<?php
   // New Employee Data Entry Start
if (isset($_POST['new_employee_form']))
{
  $table_name="employees";
  $form_data = array();
  $form_data['name']=$con->real_escape_string($_REQUEST['name']);
  $form_data['phone']=$con->real_escape_string($_REQUEST['phone']);
  $form_data['mobile']=$con->real_escape_string($_REQUEST['mobile']);
  $form_data['email']=$con->real_escape_string($_REQUEST['email']);
  $form_data['address1']=$con->real_escape_string($_REQUEST['address1']);
  $form_data['address2']=$con->real_escape_string($_REQUEST['address2']);
  $form_data['city']=$con->real_escape_string($_REQUEST['city']);
  $form_data['post_code']=$con->real_escape_string($_REQUEST['post_code']);
  $form_data['emergency_contact']=$con->real_escape_string($_REQUEST['emergency_contact']);
  $form_data['relation']=$con->real_escape_string($_REQUEST['relation']);
  $form_data['emergency_phone']=$con->real_escape_string($_REQUEST['emergency_phone']);
  $form_data['job_title']=$con->real_escape_string($_REQUEST['job_title']);
  dbRowInsert($table_name, $form_data);
echo "New Emplyee Record Created Successfully";
}

?>

<?php
/////////////////// Recieving Paymment from Customer
if (isset($_POST['create_new_payment']))
{
//print_r($_POST);
//exit;	
$table_name="transactions";
$form_data = array();
$form_data['source_id']= $con->real_escape_string($_REQUEST['source_id']);
$form_data['transaction_date']= $con->real_escape_string($_REQUEST['transaction_date']);
$form_data['amount']= $con->real_escape_string($_REQUEST['amount']);

dbRowInsert($table_name, $form_data);

echo '<div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div><p style="color:black; background-color:#36EB34; padding:20px; font-size:20px; font-weight:bold;"> Payment Entery Created Successfully. <a href="payment_recieved.php" class="btn btn-primary btn-sm pull-right">Add New Payment Entry</a></p>';
}
?>


<?php
  if(isset($_POST['customer_account']))
	{
	$customer_id=$con->real_escape_string($_POST['customer_account']);
	
                       $sql="SELECT (

SELECT sum( order_details.gross ) FROM order_details WHERE order_details.customer_id =$customer_id ) AS gross, 
(SELECT sum( transactions.amount ) FROM transactions WHERE transactions.source_id =$customer_id) AS paid";
									//echo $sql;
									$result=mysqli_query($con,$sql);
									$customer=mysqli_fetch_assoc($result);
							?>
                          
			       	   	  <table class="table table-bordered">
			       	   	  	  <thead>
			       	   	  	     <tr class="btn-primary">
			       	   	  	       <th>Total Bill</th>
			       	   	  	       <th>Total Paid</th>
			       	   	  	       <th>Blance Due</th>
			       	   	  	     </tr>
			       	   	  	  </thead>
                            <tbody>
									<tr class="info">
			       	   	  	  	   <td><?php echo "£". $customer['gross'];?></td>
			       	   	  	  	   <td><?php echo "£".$customer['paid'];?></td>
			       	   	  	  	  <?php $balance=$customer['gross']-$customer['paid'];?>
                                   <td><?php echo "£".$balance;?></td>
			       	   	  	  	 </tr>
                                 </tbody>
                                 </table>
                     <?php $customer_sql="SELECT transaction_date,amount from transactions where source_id=$customer_id order by transaction_date ASC"; 
                                 $result=mysqli_query($con,$customer_sql);
								?>
								       <table class="table table-bordered">
						<thead>
						  <tr class="btn-primary">
						    <div class="row">
						       <th>Date</th>
						    </div>
						    <div class="row">
						       <th>Amount Paid</th>
						    </div>
						  </tr>  
						</thead>
						</div>
						<div class="row">
						<tbody>	
                        <?php
									while($transaction=mysqli_fetch_assoc($result))
									{
									?>
                                 
                          <?php  $transaction_date = new DateTime($transaction['transaction_date']);
               
               
               
               
               ?>
							<tr>
							  <div class="row"><td><?php  echo $transaction_date->format("d F, Y");?></td></div>
							  <div class="row"><td><?php  echo "£".$transaction['amount'];?></td></div>
							</tr>
                            <?php }?>
						</tbody>
						</div>
					</table>
             <?php } ?>
			 


<?php
  if(isset($_POST['create_invoice']))
	{
	$customer_id=$con->real_escape_string($_POST['create_invoice']);
	$start_date=$con->real_escape_string($_POST['start_date']);
	$end_date=$con->real_escape_string($_POST['end_date']);
	$sql="SELECT orders.id, order_details.start_date, order_details.id AS order_id, order_details.end_date, order_details.skips, order_details.amount, order_details.vat, order_details.nett, order_details.gross, order_details.permit, customers.name AS customer_name, customers.mobile, customers.address1, customers.address2, customers.city, customers.post_code, orders.total_amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type, order_status.name AS order_status, skips.size AS size
FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN payment_type ON order_details.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON order_details.skip_id = skips.id
WHERE order_details.customer_id =$customer_id
AND order_details.invoice =1
AND start_date BETWEEN '$start_date' AND '$end_date'
";
//echo $sql;
$res=mysqli_query($con,$sql);
$invoice_result=mysqli_query($con,$sql);
?>
	
    <div class="row col-md-12">
 		<div class="panel-body" style="background-color:#e9e9e9;">
		   	  
                  <div class="col-md-4">
				  <?php
				  
				  $row=mysqli_fetch_assoc($res);
				   ?>
				  <?php echo  $row['customer_name'];?><br>
                  <?php echo  $row['address1'];?><br>
                  <?php echo  $row['address2'];?><br>
                  <?php echo  $row['city'];?><br>
                  <?php echo  $row['post_code'];?><br>
                  
                  </div>
                  <div class="col-md-4"></div>

                  <div class="col-md-4"><p>P&L Sunrise Skip Hire Limited</p>
	      		    <p>1-3 Business Park</p>
	      		    <p>Hayes</p>
	      		    <p>Ub6 7UB</p>
	      		    <p>Middlesex</p>
	      		    
	      		    <p>T: 0208-895-6969</p>
                    <p>E: info@sunriseskips.com</p>
                    </div>
                    </div>
		   	  	 
		   	  </div>
		   	  
		   	  <div class="row col-md-12">
		   	  		<table class="table table-bordered">
		   	  			<thead>
		   	  				<tr class="btn-primary">
		   	  				  <th>Job No.</th>	   	  				
		   	  				  <th>Date</th>
		   	  				  <th>Job Type</th>
		   	  				  <th>Size</th>
		   	  				  <th>Qty</th>
                              <th>Unit Price</th>
                              <th>VAT</th>
                              <th>Permit</th>
                              <th>Gross</th>
                              
		   	  				</tr>
		   	  			</thead>
		   	  			<tfoot>
		   	  				<tr class="btn-primary">
			   	  			  <th colspan="9" style="text-align:center;">Thank You for Your Business</th>
		   	  				</tr>
		   	  			</tfoot>
		   	  	<?php
				$amount=0;
				$gross=0;
				$vat=0;
                while($invoice=mysqli_fetch_array($invoice_result))
	   	  	 	  {
 						$amount+=$invoice['amount'];
						$gross+=$invoice['gross'];
						$vat+=$invoice['vat'];
						$date=$invoice['start_date'];
 						$order_detail_date=stristr($date,"00:00:00",true);
	   	  	 	   	?>
		   	  			<tbody>
		   	  			   <tr>
		   	  			     <td><?php echo $invoice['id'];?></td>
		   	  			   	 <td><?php echo $order_detail_date;?></td>
		   	  			   	 <td><?php echo $invoice['job_type'];?></td>
		   	  			   	 <td><?php echo $invoice['size'];?></td>
		   	  			   	 <td><?php echo $invoice['skips'];?></td>
		   	  			   	 <td style="text-align:right;"><?php echo "£".$invoice['amount'];?></td>
                              <td style="text-align:right;"><?php echo "£".$invoice['vat'];?></td>
                               <td style="text-align:right;"><?php echo "£".$invoice['permit'];?></td>
                                <td style="text-align:right;"><?php echo "£".$invoice['gross'];?></td>
		   	  			   </tr>
						   <?php
		   	  				}
		   	  			?>
		   	  			</tbody>
		   	  
		   	  			   <tr>
		   	  			   	 <td>&ensp;</td>
		   	  			   	 <td>&ensp;</td>
		   	  			   	 <td>&ensp;</td>
		   	  			   	 <td>&ensp;</td>
		   	  			   	 <td>&ensp;</td>
		   	  			   	 <td>&ensp;</td>
		   	  			   </tr>
		   	  			</tbody>
		   	  			<tbody style="text-align:right;">
		   	  			   <tr>
		   	  			   	 
		   	  			   	 <td colspan="4" style="background-color: white;">Total</td>
		   	  			   	 <td style="background-color: white;"><?php echo "£".number_format($amount,2);?></td>
		   	  			    <td style="background-color: white;">VAT</td>
		   	  			   	 <td style="background-color: white;"><?php echo "£".number_format($vat,2);?></td>
                              <td style="background-color: white;">Gross Total</td>
		   	  			   	 <td style="background-color: white;"><?php echo "£".number_format($gross,2);?></td>
                           </tr>
		   	  			</tbody>
		   	  		
		   	  		</table>
		   	  	</div>
<?php
	}
?>


<?php
  if(isset($_POST['search_entry']))
	{
	$customer_id=$con->real_escape_string($_POST['create_invoice']);
	$start_date=$con->real_escape_string($_POST['start_date']);
	$end_date=$con->real_escape_string($_POST['end_date']);
	$sql="SELECT (

SELECT sum( order_details.gross )
FROM order_details
WHERE order_details.customer_id =$customer_id
) AS gross, (

SELECT sum( transactions.amount )
FROM transactions
WHERE transactions.source_id =$customer_id
) AS paid, (

SELECT name
FROM customers
WHERE customers.id =$customer_id
) AS name";

			$result=mysqli_query($con,$sql);
			$customer=mysqli_fetch_assoc($result);
	?>
			<div class="panel-primary"style="box-shadow: 5px 5px 5px;">
			       	  	 <div class="panel-heading"><center>Transaction History</center></div>
			      	 </div>
			       	<div class="panel-body" style="background-color:#e9e9e9; box-shadow: 5px 5px 5px;">
                     <table class="table table-bordered">
			       	   	  	  <thead>
                              <tr class="btn-primary">
			       	   	  	       <th>Total Bill</th>
			       	   	  	       <th><input type="text" class="form-control" name="from" id="from"></th>
			       	   	  	       <th>Balance Due</th>
                                   <th><input type="text" class="form-control" name="to" id="to"></th>
                                   <th><p style="padding:15px;" name="search_entry" class="btn btn-warning btn-sm" id="search_entry">Search Entries</p></th>
			       	   	  	     </tr>
                                </thead> 
                       </table>
                                 <table class="table table-bordered">
                                  <thead>
			       	   	  	     <tr class="btn-primary">
			       	   	  	       <th>Total Bill</th>
			       	   	  	       <th>Total Paid</th>
			       	   	  	       <th>Balance Due</th>
			       	   	  	     </tr>
			       	   	  	  </thead>
                            <tbody id="transactions">
									<tr class="info">
			       	   	  	  	   <td><?php echo "£". $customer['gross'];?></td>
			       	   	  	  	   <td><?php echo "£".$customer['paid'];?></td>
			       	   	  	  	  <?php $balance=$customer['gross']-$customer['paid'];?>
                                   <td><?php echo "£".number_format($balance,2);?></td>
			       	   	  	  	 </tr>
                                 </tbody>
                                 </table>
                      <?php $customer_sql="SELECT transaction_date,amount from transactions where source_id=$customer_id order by transaction_date ASC"; 
                                 $result=mysqli_query($con,$customer_sql);
								?>
                      <table class="table table-bordered">
						<thead>
						  <tr class="btn-primary">
						    <div class="row">
						       <th>Date</th>
						    </div>
						    <div class="row">
						       <th>Amount Paid</th>
						    </div>
						  </tr>  
						</thead>
						</div>
						<div class="row">
						<tbody>	
                        <?php
									while($transaction=mysqli_fetch_assoc($result))
									{
									?>
                                 
                          <?php  $transaction_date = new DateTime($transaction['transaction_date']);
               
               
               
               
               ?>
							<tr>
							  <div class="row"><td><?php  echo $transaction_date->format("d F, Y");?></td></div>
							  <div class="row"><td><?php  echo "£".$transaction['amount'];?></td></div>
							</tr>
                            <?php }?>
						</tbody>
						</div>
					</table>
               <?php
}//if(isset
	
?>


<?php
  if(isset($_POST['create_entry']))
	{
	$transaction_date=$con->real_escape_string($_POST['transaction_date']);
	$type=$con->real_escape_string($_POST['create_entry']);
	$amount=$con->real_escape_string($_POST['amount']);
	$customer_id=$con->real_escape_string($_POST['create_invoice']);
	$details=$con->real_escape_string($_POST['details']);
	$source=$con->real_escape_string($_POST['source']);
	
 	$sql = "INSERT INTO `transactions` (transaction_date,source_id,amount,transaction_type.details) VALUES($transaction_date,$source,$amount,'$type',$details)";
		  //echo $sql;
		  if (!mysqli_query($con,$sql)) {
			  echo $sql;
			  die('INSERT 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  }
		  echo "Tansaction has been created successfully";
}//if(isset
	
?>

<?php
			 if(isset($_POST['get_customer']))
				{
									$get_customer_address=$con->real_escape_string($_POST['get_customer']);
									$customers_sql="SELECT * FROM customers WHERE id=$get_customer_address"; 
									$t_result=mysqli_query($con,$customers_sql);
									$customer=mysqli_fetch_assoc($t_result);
	?> 
   							  <div style=" border: 2px solid Blue;border-style: dashed;
    border-radius: 5px;" class="form-group col-md-8">
                              <div>&nbsp;</div>
                              <div class="col-md-8">
                              <label>Invoice Address</label>
 
							
                            
                            <input name="address1" type="text" class="form-control" value="<?php echo $con->real_escape_string($customer['address1']);?>" placeholder="Address 1">
                            <input name="address2" type="text" class="form-control" value="<?php echo $con->real_escape_string($customer['address2']);?>" placeholder="Address 2">
                             
                               <input name="city" type="text" class="form-control" value="<?php echo $con->real_escape_string($customer['city']);?>" placeholder="City">
                               <input style="margin-bottom:10px;" name="post_code" type="text" class="form-control" value="<?php echo $con->real_escape_string($customer['post_code']);?>" placeholder="Post Code">
                               
                               </div>
           					</div>                    
					  <?php } ?>
  
   <?php
   	if (ISSET($_POST['create_new_invoice'])) {
		//print_r($_POST);
		//exit;
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


 					<?php
   						if (ISSET($_POST['get_unit_price'])) {
									//print_r($_POST);
									// -------------- add more rows and connect here to database -- all fields
									$id=$con->real_escape_string($_POST['get_unit_price']);
									$customers_sql="SELECT * FROM skips WHERE id=$id"; 
									$t_result=mysqli_query($con,$customers_sql);
									$skip=mysqli_fetch_assoc($t_result);
									$price=$skip['price'];
									echo $price;
						}?>
									
					<?php
   						if (ISSET($_POST['select_job_id'])) {
									//print_r($_POST);
									// -------------- add more rows and connect here to database -- all fields
									$job_id=$con->real_escape_string($_POST['select_job_id']);
									$customers_sql="SELECT * FROM employees"; 
									echo $customers_sql;
									$result=mysqli_query($con,$customers_sql);
									
									?>
                           
                           
 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">List of all Drivers</h4>
      </div>
      <div class="modal-body">
     
     
							<table class="table table-bordered">
                	        <thead class="head_table">
                            <tr>
                                <th>Driver ID</th>
                                <th>Driver Name</th>
                                <th>Select</th>
                                
                           </tr>
                        </thead>
                        <tbody>
									<?php
                                    while($driver=mysqli_fetch_assoc($result))
									{?>
							
                        	<tr data-id="<?php echo $driver['id'];?>">
                                <td>
                                <?php echo $driver['id'];?>
                                </td>
                                <td>
                                <?php echo $driver['name'];?>
                                </td>
                                <td>
                <input type="radio" name="selected_driver" job_id="<?php echo $job_id;?>" class="employee_id" id="selected_driver" value=<?php echo $driver['id'];?>>
                                </td>
                                  
                             </tr>
                             <?php }?>
                         </tbody>
					</table> 
                    </div>
                 <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="allocate_job" id="modal_button" class="btn btn-primary" value="Allocate Driver"/>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
                <?php } ?>
 
 <!-- Now allocate job to selected driver -->
       <?php
       if(isset($_POST['selected_driver']))
			{
				//$id=$_POST['selected_driver'];
				$driver_id=$con->real_escape_string($_POST['selected_driver']);
				$job_id=$con->real_escape_string($_POST['job_id']);
				//$driver_id=$_POST['driver'];
				//print_r($_POST);
			
				    
					//$order_id=$ID;
					$sql="UPDATE order_details SET driver_id=$driver_id WHERE id=$job_id";
					//echo $sql;
					
				
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('INSERT 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  				}
				
			}
			
			?> 

		<div class="modal fade"  id="confirmModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Confirmation !</h4>
      </div>
      <div class="modal-body">
        <p style="color:black; background-color:#36EB34; padding:20px; font-size:20px; font-weight:bold;"> Driver Allocated to This Job Successfully.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Close ME</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

			<?php
// this is the Modal used for showing the list of all jobs of selected customer /////
   						
						if (ISSET($_POST['select_customer_id'])) {
									//print_r($_POST);
									// -------------- add more rows and connect here to database -- all fields
									$customer_id=$con->real_escape_string($_POST['select_customer_id']);
									$sql="SELECT orders.id , order_details.start_date, order_details.id AS order_id, order_details.end_date,order_details.skips, skips.size AS skip, orders.total_amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type, order_status.name AS order_status, customers.name AS customer_name, delivery_address.address1,delivery_address.address2,delivery_address.city,delivery_address.post_code, employees.name AS driver
FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN payment_type ON order_details.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON order_details.skip_id = skips.id
LEFT JOIN delivery_address ON order_details.location_id = delivery_address.id
LEFT JOIN employees ON order_details.driver_id = employees.id

WHERE orders.id = order_details.order_id AND order_details.customer_id=$customer_id"; 
									//echo $sql;
									//exit;
									$result=mysqli_query($con,$sql);
									$customer=mysqli_query($con,$sql);
									?>
                           
                           
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">List of all Jobs</h4>
      </div>
      <div class="modal-body">
     
     
							<table class="table table-bordered" id="jobsdone">
                            
                	     <thead>

            <tr class="btn-primary">

                           <th>Job ID</th>
                           <th>Start Date</th>
                           <th>Job Type</th>
                           <th>Total Days</th>
                           <th>Skips Out</th>
                           <th>Delivery Address</th>
                           
                           <th>Total</th>
                           
                           <th>Payment</th>
                           <th>Driver</th>
                           
            </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary">
                           <th>Job ID</th>
                           <th>Start Date</th>
                           <th>Job Type</th>
                           <th>Total Days</th>
                           <th>Skips Out</th>
                           <th>Delivery Address</th>
                           
                           <th>Total</th>
                           
                           <th>Payment</th>
                           <th>Driver</th>
                           
            </tr>

        </tfoot>

                        <tbody>
                       		<?php 
							
									$customer=mysqli_fetch_assoc($customer);
									echo "<h2>Jobs Done for ".$customer['customer_name']."</h2>"; 						
                                   
								    while($job=mysqli_fetch_assoc($result))
									{?>
							
                        	<tr>
                                <td><?php echo $job['order_id'];?></td>
                           <td>
						   <?php $start = date("d/m/y", strtotime($job['start_date'])); 
						   
						   echo $start  ;?></td>   
                           <td><?php echo $job['job_type'];?></td>
                          
                           <?php
						   $start_date = new DateTime($job['start_date']); 
               
               $today = new DateTime();
               $no_of_days = $today->diff($start_date)->format("%a"); 
               if($no_of_days>20){?>
               <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo $no_of_days;?></td>  
               <?php }else{?>
               <td><?php echo $no_of_days;?></td>  
              <?php }   ?>
                           
                           <td>
						   
						   <?php
						   $qty=$job['skips'];
						   if($qty>'1'){
							   
						   echo $job['skips']." skips, <br>";?><?php echo $job['skip'];
						   }else{
                             
						    echo $job['skips']." skip,<br> ";?><?php echo $job['skip'];
						   }
							?>
                            
                            </td>
                            <!-- customer Name-->
                            
                           
                            
                           <td><?php echo $job['address1'].", ".$job['city'].", ".$job['post_code'];?></td>
                           
                           <td bgcolor="#08E006"><?php echo "£".$job['total_amount'];?></td>
                           
                        
                           <?php
                           if($job['payment_type']=='Not Paid'){?>
               <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo $job['payment_type'];?></td>  
               <?php }elseif($job['payment_type']=='Fully Paid'){?>
               <td bgcolor="#0C9402" style="color:#F7F4F4;" ><?php echo $job['payment_type'];?></td>  
              <?php }else{?><td><?php echo $job['payment_type'];?></td><?php }?>
                 
            <?php  if($job['order_status']=='Delivered'){?>
               <td bgcolor="#0C9402" style="color:#F7F4F4;" ><?php echo $job['order_status'];?></td> 
			   
			   <?php }else{?>
               
                           <td col-id="11"  data-id="<?php echo $job['order_id'];?>"><?php echo $job['driver'];?></td> <?php }?>
                                  
          </tr>
                             <?php }?>
                         </tbody>
					</table> 
                    </div>
                 <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
                <?php } ?>
                
                
  <script type="text/javascript">
  $('#modal_button').click(function(){
	$.each($("input[name='selected_driver']:checked"), function() {
    var selected_driver= $(this).val();
	var job_id=$('#selected_driver').attr('job_id');
	var dataString = 'selected_driver=' + selected_driver+'&job_id=' + job_id;
	//alert(dataString);
	
	
	$.ajax({
		type: "POST",
    url: "post_process.php",
    data: dataString,
    success: function(data) {
		$('#confirmModal').modal('show');
		}
	});
	
	});
	
	
  });
  
  $(document).ready(function() {
    $('#jobsdone').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
			'print'
			        ]
    });
});
  </script>	
	
    
    
    