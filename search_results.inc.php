
<?php

require_once("dbconfig.php");
if(isset($_POST['filter_search'])){
	
	$post_code=$con->real_escape_string($_POST['post_code']);
	$post_code=$con->real_escape_string($_POST['post_code']);
	$paid=$con->real_escape_string($_POST['paid']);
	$post_code=$con->real_escape_string($_POST['post_code']);
	//echo $post_code;
	
$sql="SELECT orders.id , order_status.name as status, order_details.start_date, order_details.order_id AS order_id, order_details.end_date,order_details.skips,order_details.exchange_skip_id as exchanged_skip, skips.size AS skip, customers.id AS customer_id, customers.name AS customer_name, customers.mobile, orders.total_amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type,  delivery_address.address1,delivery_address.address2,delivery_address.city,delivery_address.post_code, employees.name AS driver,tip_jobs.status AS tip_status
FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN payment_type ON order_details.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON order_details.skip_id = skips.id
LEFT JOIN delivery_address ON order_details.location_id = delivery_address.id
LEFT JOIN employees ON order_details.driver_id = employees.id
LEFT JOIN tip_jobs ON order_details.order_id = tip_jobs.job_id

WHERE  order_details.payment_status=$paid ORDER BY orders.id DESC";
//echo $sql;

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
if($rowcount==0)
{
	echo '<li style="cursor: pointer; width:250px;font-family:Montserrat; font-size:18px; font-weight:bold; color:#ffffff; padding:10px; background-color:#F30307;" id="add_customer" class="btn btn-sm" >No Results Were found.</li>';
	}

}
     ?>
 
 <table  style="font-family:Montserrat; font-size:13px;" id="jobs" class="table list_jobs" cellspacing="0" border="1" bgcolor="#B8B3B4">

        <thead>

            <tr class="btn-primary">

                           <th>Job ID</th>
                           <th>Start Date</th>
                           
                           <th>Total Days</th>
                           <th>Skips Out</th>
                           <th>Job Type</th>
                           <th>Customer</th>
                           <th>Delivery Address</th>
                           
                           <th>Total</th>
                           
                           <th>Payment</th>
                           <th>Driver</th>
                           <th>Tipping</th>
                           <th>Job Status</th>
                           <th>Cancel</th>
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
                          
                           <th>Payment</th>
                           <th>Driver</th>
                            <th>Tipping</th>
                           <th>Job Status</th>
                           <th>Cancel</th>
            </tr>

        </tfoot>

        <tbody id="filter_results">
			
        <?php

                while($job=mysqli_fetch_assoc($res))

                  {
					  //echo $job['payment_type'];
					  //exit;
					  if($job['payment_type']=='Not Paid'){?>
                      
                        <tr style="cursor:pointer; background-color:#F80307; color:#F3EBEB;">
                        <?php 
					  }else{?>
							<tr bgcolor="#63EC62"  style="cursor:pointer;">
							<?php }?>
                           <td><?php
						    echo $job['id']; ?></td>
                          
                           <td>
						   <?php $start = date("d/m/y", strtotime($job['start_date'])); 
						   
						   echo $start  ;?></td>
                           
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
								
							
                            <td><?php echo $job['job_type'];?></td>
                            <?php }?>
                            <!-- customer Name-->
                            
                            <td col-id="6" class="customers" data-id="<?php echo $job['customer_id'];?>"><?php echo $job['customer_name'];?></td>
                            
                           <td><?php echo $job['address1'].", ".$job['city'].", ".$job['post_code'];?></td>
                           <td><?php echo "£".$job['total_amount'];?></td>
                           
               <?php
                           if($job['payment_type']=='Not Paid'){?>
               <td><?php echo $job['payment_type'];?></td>  
               <?php }elseif($job['payment_type']=='Fully Paid'){?>
               <td><?php echo $job['payment_type'];?></td>  
              <?php }else{?><td><?php echo $job['payment_type'];?></td><?php }?>
              
				<?php if(is_null($job['driver']) == true)
				
				{?>
					<td col-id="11"  data-id="<?php echo $job['order_id'];?>">Assign Driver</td>
                    
                    <?php }else{?>
					
					<td col-id="11"  data-id="<?php echo $job['order_id'];?>"><?php echo $job['driver'];?></td>
					
					<?php  }?>
               </td> 
               
                         
                         
                         <?php if($job['tip_status']=="yes"){?><td col-id="13"  data-id="<?php echo $job['order_id'];?>"><?php echo $job['tip_status'];?></td><?php }else{?>
     <td col-id="13"  data-id="<?php echo $job['order_id'];?>">Not Done</td> <?php }?>  
                           
                           <?php if($job['status']=="Job Done"){?><td col-id="12"  data-id="<?php echo $job['order_id'];?>"><?php echo $job['status'];?></td><?php }else{?>
     <td col-id="12"  data-id="<?php echo $job['order_id'];?>"><?php echo $job['status'];?></td> <?php }?>
    
    <input id="status" type="hidden" value="<?php echo $job['status'];?>"/>                       
                           <td>
                            <a href="delete_job.php?id=<?php echo $job['order_id'];?>" data-href="delete_job.php?id=<?php echo $job['order_id'];?>" data-toggle="modal" data-target="#confirm-delete"><i class="glyphicon glyphicon-trash"></i></a><br><a>
                </a>
                </td>
              </tr>
   <?php } ?>
   				 </tbody>
			   </table>

   <script type="text/javascript">


$(".list_jobs").find('td[data-id]').on('click', function () {
	
	alert("serach_results");
	var selected_col=$(this).attr('col-id');
	
	if(selected_col=='6')
	{
			var select_customer_id=$(this).attr('data-id');
			var dataString = 'select_customer_id='+select_customer_id;
			 // alert(dataString);
			  $.ajax({
				  type: "POST",
			  url: "post_process.php",
			  data: dataString,
			  success: function(data) {
				  $('#jobs_modal').html(data);
				  $('#jobs_modal').modal('show');
				  }
			  });
	}
	
	if(selected_col=='11')
		{
			  var select_job_id=$(this).attr('data-id');
			  var dataString = 'select_job_id='+select_job_id;
			  //alert(dataString);
			  $.ajax({
				  type: "POST",
			  url: "update_driver.php",
			  data: dataString,
			  success: function(data) {
				  $('#drivers_modal').html(data);
				  $('#drivers_modal').modal('show');
				  }
			  });
		
		}
		
		if(selected_col=='12')
		{
			  //alert("Demo");
			  var status=$('#status').val();
			  if(status=='Do0ne')
			  {
			  
			   $('#job_done').modal('show');
			  return false;
			  }
			  var select_job_id=$(this).attr('data-id');
			  var dataString = 'select_job_id='+select_job_id;
			  //alert(dataString);
			  $.ajax({
				  type: "POST",
			  url: "update_job.php",
			  data: dataString,
			  success: function(data) {
				  $('#update_job_modal').html(data);
				  $('#update_job_modal').modal('show');
				  }
			  });
			  
		
		}
	// Tipping this job now
	if(selected_col=='13')
		{
			  //alert("Demo");
			  
			  var tip_job_id=$(this).attr('data-id');
			  var dataString = 'tip_job_id='+tip_job_id;
			  //alert(dataString);
			  $.ajax({
				  type: "POST",
			  url: "tip_job.php",
			  data: dataString,
			  success: function(data) {
				  $('#tip_job_modal').html(data);
				  $('#tip_job_modal').modal('show');
				  }
			  });
			  
		
		}

	    
});

// Delete button Request yes no

        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
        });
		
$('#filter_btn').click(function(){
    
  var filter_search="filter_search";
  var job_type=$('#job_type').val();
  var paid=$('#paid').val();  
  var post_code=$('#post_code').val(); 
  
  var start_date=$('#start_date').val();
  
  //alert(amount);
   var dataString ='filter_search=' + filter_search+ '&job_type=' + job_type + '&paid=' + paid+'&post_code=' + post_code + '&start_date=' + start_date;
  //alert(dataString);
  
  //return false;
  $.ajax({
                    type: "POST",
                    url: "search_results.inc.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
          // $('#gross').hide();
           $('#filter_results').html(data); 
           
                }
            });
        });
		
		
</script>

