<?php
include "../dbconfig.php";
       if(isset($_POST['driver'],$_POST['selected_job'],$_POST['lorry'],$_POST['yard'],$_POST['selected_job']))
			{
				
				$id=$_POST['selected_job'];
				$yard=$_POST['yard'];
				$lorry=$_POST['lorry'];
				$driver_id=$_POST['driver'];
				$date=date("Y-m-d");
				/*echo '<pre>';
				print_r($_POST);
				echo '</pre>';
			    exit;
			   */
			  foreach($id as $key=>$ID)
				{
				    
					$order_id=$ID;
					$sql="UPDATE orders SET 
					tip_status=2, 
					tip_date='$date',
					tip_lorry_id='$lorry',
					tip_yard_id='$yard',
					tip_driver_id='$driver_id',
					driver_id='$driver_id'
					WHERE id=".$order_id;
					//
					if (!mysqli_query($con,$sql)) {
			  			echo $sql;
			  			echo 'UPDATE Error: ' . mysqli_error($con);
		  				exit;
						}
						
				}
echo 'success';
			}
			?> 