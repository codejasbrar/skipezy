<?php

	include "dbconfig.php" ;
	error_reporting(E_ALL);
	//print_r($_POST);
	$amount=$_POST['amount'];
	//$transaction_date = date("Y-m-d",strtotime($_POST['transaction_date']));
	//echo "date coming from data picker is ".$_POST['transaction_date']."<br> Amount:";
	$transaction_date=$_POST['transaction_date'];
	//echo $transaction_date;
	$source_id=$_POST['source_id'];
	$transaction_type="'".$_POST['transaction_type']."'";
	$details=$_POST['details'];
	$pay_type=$_POST['transaction_type'];
	//$project_id=$_POST['event'];
	global $sql;

//create a transaction for this client
?>
<?php  
			if($pay_type=="cr")//This means money is recieved and entery is like money in
			{
			
			$sql="SELECT current_bal FROM transactions WHERE source_id=$source_id AND transaction_type='nw'"; //Select 1
			//echo $sql;
			if (!mysqli_query($con,$sql)) 
				{ 	
					
					die('SELECT 1 SQL SAID -Error: ' . mysqli_error($con));
				}
				
				$a=mysqli_query($con,$sql);
				$result=mysqli_fetch_assoc($a);
				
				
				$total_bill=$result['current_bal'];
				//$row_cnt = mysqli_num_rows($a);
				//echo $total_bill;
				
				if($total_bill==0) //if there is no entery for this client on this project then... this logic
				{
					
					//echo "Zero";
					
					$sql="INSERT INTO `transactions`
					(`source_id`,'transaction_date', `transaction_type`,`amount`,`current_bal`)
				    VALUES 
					($source_id,'$transaction_date','nw',$amount,'$amount')";
					echo $sql;
					    if (!mysqli_query($con,$sql)) 
					  { 	
						  echo $sql;
						  die('INSERT SQL 2 SAID -Error : ' . mysqli_error($con));
					  }//if (!mysqli
					}
				else //if($total_bill==0) if there is already an entry then... this logic
				{
					$sql="SELECT sum(amount) as total_amount FROM transactions WHERE source_id=$source_id AND transaction_type='cr'";
			        //echo $sql;
					if (!mysqli_query($con,$sql)) 
						{ 	
							 echo $sql;
							die('SELECT SQL 4 SAID -Error: ' . mysqli_error($con));
						}
						
					$a=mysqli_query($con,$sql);
					$result=mysqli_fetch_assoc($a);
				    $total_amount=$result['total_amount'];
					//echo $total_amount;
					//exit;
						if($total_amount==0)// he has not paid anything yet
						{
							$final_bal=$total_bill-$amount; // blance is same as the amount or total bill pending
							echo $total_bill;
							}
					    else //if($total_amount==0) . if he has paid something
							{
								$final_bal=$total_bill-($total_amount+$amount); // £1000 -(amount paid+ now what he is paying)
								
								}
								
								//echo $final_bal;
					if($final_bal<0)// if he has already cleared his balance but clerk is still making an entry then stop
						{
							$f_bal=$total_bill-($total_amount);
							$amount_paid=$total_bill-$f_bal;
							echo "<h1 color=red> Current Balance of this cilent is £$f_bal & Total Amount Paid is £$amount_paid. You are paying £$amount, so please check your amount and make a new entry. </h1>";
							echo date("d/m/y");
							exit;
							}
					$sql="INSERT INTO `transactions`
					(`source_id`,'transaction_date', `transaction_type`,`amount`,`current_bal`)
				    VALUES 
				    ($source_id,'$transaction_date',$transaction_type,'$amount',$final_bal)";
					echo $sql;
						  if (!mysqli_query($con,$sql)) 
					  { 	
						   echo $sql;
						  die('INSERT 5 SQL SAID -: ' . mysqli_error($con));
					  }
					
					} //else if($total_bill==0)
				
					
				
				exit;
				
		
			
			} //if($pay_type=="cr")
			
			
			// ---------------------------------paying money, type is dr ------------------------------------------
			
			elseif($pay_type=="dr")
			{
				
				$sql="SELECT current_bal FROM transactions WHERE source_id=$source_id AND transaction_type='nwp'";
			
			if (!mysqli_query($con,$sql)) 
				{ 	 echo $sql;
					
					die('SELECT SQL SAID -Error Adding New Product: ' . mysqli_error($con));
				}
				
				$a=mysqli_query($con,$sql);
				$result=mysqli_fetch_assoc($a);
				
				
				$total_bill=$result['current_bal'];
				//$row_cnt = mysqli_num_rows($a);
				//echo $total_bill;
				
				if($total_bill==0)
				{
					
					//echo "Zero";
					
					$sql="INSERT INTO `transactions`
					(`source_id`,`transaction_date`, `transaction_type`,`amount`,`current_bal`)
				    VALUES 
					($source_id,'$transaction_date','nwp',$amount,'$amount')";
					echo $sql;
					    if (!mysqli_query($con,$sql)) 
					  { 	
						  
						  die('INSERT 7 SQL SAID -Error: ' . mysqli_error($con));
					  }//if (!mysqli
					}
				else //if($total_bill==0)
				{
					$sql="SELECT sum(amount) as total_amount FROM transactions WHERE source_id=$source_id AND transaction_type='dr'";
			        //echo $sql;
					if (!mysqli_query($con,$sql)) 
						{ 	
							 echo $sql;
							die('SELECT SQL SAID -Error Adding New Product: ' . mysqli_error($con));
						}
						
					$a=mysqli_query($con,$sql);
					$result=mysqli_fetch_assoc($a);
				    $total_amount=$result['total_amount'];
					//echo $total_amount;
					//exit;
						if($total_amount==0)
						{
							$final_bal=$total_bill-$amount;
							echo $total_bill;
							}
					    else //if($total_amount==0)
							{
								$final_bal=$total_bill-($total_amount+$amount);
								
								}
								
								echo $final_bal;
					if($final_bal<0)
						{
							$f_bal=$total_bill-($total_amount);
							$amount_paid=$total_bill-$f_bal;
							echo "<h1 color=red> Current Balance of this cilent is £$f_bal & Total Amount Paid is £$amount_paid. You are paying £$amount, so please check your amount and make a new entry. </h1>";
							echo date("d/m/y");
							exit;
							}
					$sql="INSERT INTO `transactions`
					(`source_id`,'transaction_date', `transaction_type`,`amount`,`current_bal`)
				    VALUES 
				    ($source_id,'$transaction_date','$transaction_type','$amount',$final_bal)";
					echo $sql;
						  if (!mysqli_query($con,$sql)) 
					  { 	
						   echo $sql;
						  die('INSERT 6 SQL SAID -Error : ' . mysqli_error($con));
					  }
					
					} //else if($total_bill==0)
				
					
				
				exit;
				
				
				
				
				}//elseif($pay_type=="dr")
			
			
;?>