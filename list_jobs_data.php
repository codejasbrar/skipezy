<?php

            $rowcount=mysqli_num_rows($res);



if($rowcount==0)

{

	//echo '<tr style="cursor:pointer; background-color:#F80307; color:#F3EBEB;"><td></td><td></td><td></td><td><p>You have no Jobs, Add Some Jobs.</p></td></tr>';

}

				

$today = date("d/m/y", strtotime($today));

//echo '<br><p style="text-align:center;background-color:light gray; color:#000000; padding:15px; font-size:18px;">Total '.$rowcount.' jobs found on ('.$today.'). You can see other jobs by applying filter. </p>';

?>
<form method="post" action="">
    <input type="hidden" name="status" value="2">
    <div class="form-group col-md-1 pull-right">
        <input style="margin-top:30px;" type="submit" data-target="confirmModal" name="confirm_booking"
            class="btn btn-sm btn-success" value="Update" />
    </div>
    <!--- <div class="form-group col-md-2 pull-right">
        <label>Job Status</label>
			       	   <select name="status" id="status" class="form-control">
			       	   	 <option style="padding:30px; background-color:#E7D91E; color:#F9F0F1; cursor:pointer;" value="">Select a Status </option>
                             
	<option style="padding:20px; background-color:#F50307; color:#F9F0F1; cursor:pointer;" value="1">Not Done
    <option style="padding:20px; background-color:#18E501; color:#F9F0F1; cursor:pointer;" value="2">Job Done
	  
    </option>
			       	   </select>
			       	   </div>--->
    <style>
    .badge {
        display: inline-block;
        min-width: 10px;
        padding: 3px 7px;
        font-size: 12px;
        font-weight: 500;
        color: #fff;
        line-height: 1;
        vertical-align: baseline;
        white-space: nowrap;
        text-align: center;
        background-color: #31708f;
        border-radius: 10px;
    }
    </style>

    <table style="font-family:Montserrat; font-size:13px;" id="jobs"
        class="table table list_jobs table-hover table-bordered table-striped table-info" cellspacing="0" border="1">
        <thead>
            <tr class="btn-primary" style="padding:10px;">
                <th>Job ID</th>
                <th>Start Date</th>
                <th>Total Days</th>
                <th>Skips Out</th>
                <th>Job Type</th>
                <th>Customer</th>
                <th>Delivery Address</th>
                <th>Total</th>
                <!-- <th>Driver</th>
                <th>Tip Yard</th>--->
                <th style="width:400px;">Comments</th>
                <th>Status</th>
                <th>Edit Job</th>
                <th bgcolor="#F70B0F">Delete</th>
                <th style="padding: 12px 30px;"><input class="checkbox" type="checkbox" id="select_all" /></th>
            </tr>
        </thead>
        <tfoot>
            <tr class="btn-primary">
                <th>Job ID</th>
                <th>Start Date</th>
                <th>Total Days</th>
                <th>Skips Out</th>
                <th>Job Type</th>
                <th>Customer</th>
                <th>Delivery Address</th>
                <th>Total</th>
                <!--- <th>Driver</th>
                <th>Tip Yard</th>---->
                <th style="width:400px;">Comments</th>
                <th>Status</th>
                <th>Edit Job</th>
                <th bgcolor="#F70B0F">Delete</th>
                <th style="padding: 12px 30px;"></th>
            </tr>
        </tfoot>
        <tbody>
            <?php
                while($job=mysqli_fetch_assoc($res))
                  {
                    //echo $job['payment_type'];
                    //exit;
                    if($job['status']=='Done'){?>
            <tr class="job_type <?php echo $job['job_type'] ;?>"
                style="cursor:pointer; color:#2A8AC0; font-weight:bold;">
                <?php 
				}else{?>
            <tr class="job_type <?php echo $job['job_type'] ;?>"
                style="cursor:pointer; color:#F80409; font-weight:bold;">
                <?php }?>
                <td><?php
				echo $job['id']; ?></td>
                <td>
                    <?php $start = date("d/m/y", strtotime($job['start_date'])); 
						echo $start;?></td>
                <?php

			   $from = new DateTime($job['start_date']); 

               $today = new DateTime();

               $no_of_days = $today->diff($from)->format("%a"); 

               if($no_of_days>20){?>

                <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo $no_of_days;?></td>

                <?php }else{?>

                <td><?php echo $no_of_days;?></td>

                <?php }   

			  if($no_of_days>3)

{
	//echo "This job is not done";
	}
			  ?>
                <td>
                    <?php
                        $qty=$job['skips'];
                        if($qty>'1'){
                        echo $job['skip'];
                        }else{
                        echo $job['skip'];
                        }
					?>
                </td>

                <?php if($job['job_type']=="Exchange")

							{

								// Now reterive job_type and skip_ids

					$condition = array();

					$condition['id'] = $job['exchanged_skip']; 

					$skips = selectWhere($con,'skips',$condition);

					$skip_id = $skips[0]['size'];

					?>

                <td><?php echo "<b>".$job['job_type']."<br> with ".$skip_id;?></td>

                <?php }else{?>

                <td><?php echo $job['job_type']." / ".$job['delivery_slot'];?></td>

                <?php }?>

                <!-- customer Name-->

                <td col-id="6" class="customers" data-id="<?php echo $job['customer_id'];?>">
                    <?php echo $job['customer_name'];?></td>

                <td><?php echo $job['address1'].", ".$job['city'].", <span class='badge' style='padding:10px;'>".$job['post_code']."</span>";?>
                </td>

                <td><input required name="total_amount[]" type="text" data-id=<?php echo $job['id'];?>
                        id="total_amount<?php echo $job['id'];?>" class="form-control total_amount"
                        data-amount="<?php echo $job['total_amount']; ?>" value=<?php echo $job['total_amount']; ?>>
                </td>

                <!--<td><input  name="driver[]" type="text" data-id=<?php echo $job['id'];?> id="driver<?php echo $job['id'];?>" class="form-control driver_name" data-driver="<?php echo $job['driver']; ?>" value=<?php echo $job['driver']; ?>></td>

<td><input  name="yard[]" type="text" data-id=<?php echo $job['id'];?> id="yard<?php echo $job['id'];?>" class="form-control yard" data-yard="<?php echo $job['yard']; ?>" value=<?php echo $job['yard']; ?>></td>--->

                <td><input name="comments[]" type="text" data-id=<?php echo $job['id'];?>
                        id="comments<?php echo $job['id'];?>" class="form-control comments"
                        data-comments="<?php echo $job['comments']; ?>" value="<?php echo $job['comments']; ?>"></td>

                <td col-id="13" data-id="<?php echo $job['id'];?>"><?php echo $job['status'];?></td>
                <input id="status" type="hidden" value="<?php echo $job['status'];?>" />
                <td><a href="edit_order.php?job_id=<?php echo $job['id'];?>"><i
                            class="glyphicon glyphicon-check"></i></a></td>
                <td><a href="delete_job.php?id=<?php echo $job['id'];?>"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
                <input type="hidden" name="booking_id[]" value=<?php echo $job['id'];?>>
                <td style="text-align:right; font-size:20px;padding: 12px 30px;"><input name="selected_job[]"
                        type="checkbox" class="checkbox selected_job" value=<?php echo $job['id'];?>></td>

            </tr>

            <?php } ?>

        </tbody>

    </table>

</form>
<?php
    // print_r($_POST);
       if(isset($_POST['driver_id']) && $_POST['driver_id']!='' && isset($_POST['selected_job']))
			{
				$status="confirmed";
				$id=$_POST['selected_job'];
				$driver_id=$_POST['driver_id'];
				//
				$bookingIds = $_POST;
			    $count=count($_POST['selected_job']);
				 for ($i=0;$i<$count;$i++){
			
			$index = array_search($_POST['selected_job'][$i],$bookingIds['booking_id']);
			//echo "index=".$index;
			//exit;
			$driver=$con->real_escape_string($_POST['driver_id'] ); 
			$booking_id=$con->real_escape_string($_POST['selected_job'][$i]);
			$amount=$con->real_escape_string($_POST['total_amount'][$i]);
			  
					
					$sql="UPDATE orders SET 
					driver_id=$driver_id, 
					amount='$amount'
					WHERE id=".$booking_id;
					echo $sql;
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('INSERT 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  				}
				}
			}
	
       if(isset($_POST['status']) && $_POST['status']!='' && isset($_POST['selected_job']))
			{
				//print_r($_POST);
				$id=$_POST['selected_job'];
				$status=$_POST['status'];
				
				$bookingIds = $_POST;
			    $count=count($_POST['selected_job']);
				 for ($i=0;$i<$count;$i++){
			
			$index = array_search($_POST['selected_job'][$i],$bookingIds['booking_id']);
			//echo "index=".$index;
			//exit;
			$driver=$con->real_escape_string($_POST['status'] ); 
			$booking_id=$con->real_escape_string($_POST['selected_job'][$i]);
			$amount=$con->real_escape_string($_POST['total_amount'][$i]);
			  
			
				//if the job type is done only then update the stock otherwise let them to change the job details as wanted	
				// Now check if this job is already done, so we do not update the stock levels again
				    $sql="select status from orders where id=$booking_id";
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('Select Job Status Query -Error: ' . mysqli_error($con));
		  			}
					$res=mysqli_query($con,$sql);
					$jstatus=mysqli_fetch_assoc($res);	
					$job_status = $jstatus['status'];
					if($job_status==2){echo '<script>alert("This Job id already Done, you can not change stock now");</script>';exit;}
					
					// Now reterive job_type and skip_ids
					$condition = array();
					$condition['id'] = $booking_id; 
					$skips = selectWhere($con,'orders',$condition);
					
					$skip_id = $skips[0]['skip_id'];
					$exchange_skip_id = $skips[0]['exchange_skip_id'];
					$job_type = $skips[0]['job_type'];
					$quantity = 1;
					
					// Now retrieve the stock of this old skip
					$skip_condition = '';
					$skip_condition = array();
					$skip_condition['id'] = $skip_id; 
					$skip_stock = selectWhere($con,'skips',$skip_condition);
					
					$size = $skip_stock[0]['size'];
					// on the road
					$current_stock = $skip_stock[0]['current_stock'];
				    //in yard
					$in_yard= $skip_stock[0]['owned'];
					
					switch ($job_type) {
       
	   case "1":
	   $current_stock=$current_stock+$quantity;
							$in_yard=$in_yard-$quantity;
							// Now simply update stock
							$sql="UPDATE skips SET 
							current_stock=$current_stock,
							owned=$in_yard 
							
							WHERE id=$skip_id";
							//echo $sql;
						
							if (!mysqli_query($con,$sql)) {
								
								die('UPDATE 5 INTO orders -Error: ' . mysqli_error($con));
								}
								
								echo '<script>alert("Job Updated Successfully ");</script>';
	   break;
	   case "2":
	   $current_stock=$current_stock-$quantity;
							$in_yard=$in_yard+$quantity;
							// Now simply update stock
							$sql="UPDATE skips SET 
							current_stock=$current_stock,
							owned=$in_yard 
							
							WHERE id=$skip_id";
							//echo $sql;
						
							if (!mysqli_query($con,$sql)) {
								
								die('UPDATE 6 INTO orders -Error: ' . mysqli_error($con));
								}
								
									echo '<script>alert("Job Updated Successfully ");</script>';
	   break;
	   case "3":
	   // Now retrieve the stock of this exchanged skip
						  $skip_condition = '';
						  $skip_condition = array();
						  $skip_condition['id'] = $exchange_skip_id; 
						  $skip_stock = selectWhere($con,'skips',$skip_condition);
						  
						  $size = $skip_stock[0]['size'];
						  
						  $current_stock_of_exchange_skip = $skip_stock[0]['current_stock'];
						  $exchange_in_yard=$skip_stock[0]['owned'];
						  
						  $current_stock_of_exchange_skip=$current_stock_of_exchange_skip+$quantity;
						  $exchange_in_yard=$exchange_in_yard-$quantity;
						  
						  echo 'Size is '.$size.'current_stock_of_exchange_skip='.$current_stock_of_exchange_skip.' exchange_in_yard='.$exchange_in_yard;
						  if($exchange_skip_id!=$skip_id)
						  {
						  $current_stock =$current_stock-$quantity;
						  $in_yard= $in_yard+$quantity;
						  // Now simply update stock of old skip
						  $sql="UPDATE skips SET 
						  current_stock=$current_stock,
						  owned=$in_yard 
						  
						  WHERE id=$skip_id";
						  //echo $sql;
					  
						  if (!mysqli_query($con,$sql)) {
							  
							  die('UPDATE 6 INTO orders -Error: ' . mysqli_error($con));
							  }
							  // Now simply update stock of New skip
						  
						  $sql="UPDATE skips SET 
						  current_stock=$current_stock_of_exchange_skip, 
						  owned=$exchange_in_yard
						  WHERE id=$exchange_skip_id";
						  //echo $sql;
					  
						  if (!mysqli_query($con,$sql)) {
							  
							  die('UPDATE 7 INTO orders -Error: ' . mysqli_error($con));
							  }
							  
							  	echo '<script>alert("Job Updated Successfully ");</script>';
						}
	   
}
							
					$sql="UPDATE orders SET 
					status=$status, 
					job_type = 2
					WHERE id=".$booking_id;
					//echo $sql;
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('INSERT 3 INTO ORDER_Details -Error: ' . mysqli_error($con));
		  				}
				echo '<script type="text/javascript"> window.location.href="list_job.php";</script>';

				}
			}
			
	?>

<script type="text/javascript">
$('#select_all').on('click', function() {
    if (this.checked) {
        $('.checkbox').each(function() {
            this.checked = true;
        });
    } else {
        $('.checkbox').each(function() {
            this.checked = false;
        });
    }
});

$('.checkbox').on('click', function() {
    if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('#select_all').prop('checked', true);
    } else {
        $('#select_all').prop('checked', false);
    }
});

$('.total_amount').blur(function() {
    var tr = $(this).parent().parent();
    var index = tr.find('.total_amount').attr('data-id');

    var total_amount = $('#total_amount' + index).val();

    var dataString = 'amount=' + total_amount + '&id=' + index;
    $.ajax({
        type: "POST",
        url: "ajax/update_amount.php",
        data: dataString,
        beforeSend: function() {
            $("#contact_name").css("background", "#F5C211");
        },
        success: function(data) {

            $(this).css("background", "#green");
        }
    });
    alert(amount);
});


$('.driver_name').blur(function() {
    var tr = $(this).parent().parent();
    var index = tr.find('.driver_name').attr('data-id');

    var driver = $('#driver' + index).val();

    var dataString = 'driver=' + driver + '&id=' + index;
    $.ajax({
        type: "POST",
        url: "ajax/update_driver.php",
        data: dataString,
        beforeSend: function() {
            $("#contact_name").css("background", "#F5C211");
        },
        success: function(data) {

            $(this).css("background", "#green");
        }
    });

});

$('.yard').blur(function() {
    var tr = $(this).parent().parent();
    var index = tr.find('.yard').attr('data-id');

    var yard = $('#yard' + index).val();

    var dataString = 'yard=' + yard + '&id=' + index;
    $.ajax({
        type: "POST",
        url: "ajax/update_yard.php",
        data: dataString,
        beforeSend: function() {
            $("#contact_name").css("background", "#F5C211");
        },
        success: function(data) {

            $(this).css("background", "#green");
        }
    });

});

$('.comments').blur(function() {
    var tr = $(this).parent().parent();
    var index = tr.find('.comments').attr('data-id');

    var comments = $('#comments' + index).val();

    var dataString = 'comments=' + comments + '&id=' + index;
    $.ajax({
        type: "POST",
        url: "ajax/update_comments.php",
        data: dataString,
        beforeSend: function() {
            $("#contact_name").css("background", "#F5C211");
        },
        success: function(data) {

            $(this).css("background", "#green");
        }
    });

});
</script>