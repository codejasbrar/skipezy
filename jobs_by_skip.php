
<meta charset="utf-8">

<title>List of Orders</title>
<!doctype html>

<html>

<head>
  
<?php

include "dbconfig.php";
$skip_id=$_REQUEST['id'];
//include "css_header.php";
include "navbar_list.php";
 include ("dynamic_table.php");
 $today_date= date('Y-m-d');
//Get the order data for this order.

$sql="SELECT orders.id , order_status.name as status, order_details.start_date, order_details.order_id AS order_id, order_details.end_date,order_details.skips, skips.size AS skip, customers.id AS customer_id, customers.name AS customer_name, customers.mobile, orders.total_amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type, delivery_address.address1,delivery_address.address2,delivery_address.city,delivery_address.post_code, employees.name AS driver
FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN payment_type ON order_details.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON order_details.skip_id = skips.id
LEFT JOIN delivery_address ON order_details.location_id = delivery_address.id
LEFT JOIN employees ON order_details.driver_id = employees.id

WHERE orders.id = order_details.order_id AND order_details.skip_id=$skip_id ORDER BY id DESC";

$res=mysqli_query($con,$sql);

//echo $sql;
 // Return the number of rows in result set
  $rowcount=mysqli_num_rows($res);
?>

 </head>

<body style="font-family:Montserrat; font-size:16px;">
 <div class="col-md-12" style="margin-top:80px;box-shadow: 5px 5px 5px; background-color:#EDEC3D;">
 		<?php if($rowcount>0){?>
        <h1><center>Live Jobs</center></h1>
        <?php }else{?>
        <h1><center>No Jobs for this Skip - <a href="list_skips.php">Go Back to List of Skips</a></center></h1>
		<?php } ?>
   </div>
   <div>&nbsp;</div>
  <div class="row">
      <div class="col-md-12">
        <table  style="font-family:Montserrat; font-size:13px;" id="jobs" class="table table-striped" cellspacing="0">

        <thead>

            <tr class="btn-primary">

                           <th>Job ID</th>
                           <th>Start Date</th>
                           
                           <th>Total Days</th>
                           <th>Skips Out</th>
                           <th>Customer</th>
                           <th>Delivery Address</th>
                           
                           <th>Total</th>
                           <th>Job Type</th>
                           <th>Payment</th>
                           <th>Driver</th>
                           <th>Job Status</th>
                           <th>Edit</th>
                           <th>View</th>
                           <th>Cancel</th>
            </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary">
                           <th>Job ID</th>
                           <th>Start Date</th>
                           
                           <th>Total Days</th>
                           <th>Skips Out</th>
                           <th>Customer</th>
                           <th>Delivery Address</th>
                           
                           <th>Total</th>
                           <th>Job Type</th>
                           <th>Payment</th>
                           <th>Driver</th>
                           <th>Job Status</th>
                           <th>Edit</th>
                           <th>View</th>
                           <th>Cancel</th>
            </tr>

        </tfoot>

        <tbody >
			
        <?php

                while($job=mysqli_fetch_assoc($res))

                  {

                  

                                    
  ?>               
<tr>
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
                            <!-- customer Name-->
                            
                            <td col-id="6" class="customers" data-id="<?php echo $job['customer_id'];?>"><?php echo $job['customer_name'];?></td>
                            
                           <td><?php echo $job['address1'].", ".$job['city'].", ".$job['post_code'];?></td>
                           <td bgcolor="#08E006"><?php echo "£".$job['total_amount'];?></td>
                           <td><?php echo $job['job_type'];?></td>
               <?php
                           if($job['payment_type']=='Not Paid'){?>
               <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo $job['payment_type'];?></td>  
               <?php }elseif($job['payment_type']=='Fully Paid'){?>
               <td bgcolor="#0C9402" style="color:#F7F4F4;" ><?php echo $job['payment_type'];?></td>  
              <?php }else{?><td><?php echo $job['payment_type'];?></td><?php }?>
              
				<?php if(is_null($job['driver']) == true)
				
				{?>
					<td col-id="11"  data-id="<?php echo $job['order_id'];?>" style="background-color:#EDB614;">Assign Driver</td>
                    
                    <?php }else{?>
					
					<td col-id="11"  data-id="<?php echo $job['order_id'];?>"><?php echo $job['driver'];?></td>
					
					<?php  }?>
               </td> 
               <?php if($job['status']=="Done"){?><td bgcolor="#44EC1B" col-id="12"  data-id="<?php echo $job['order_id'];?>"><?php echo $job['status'];?></td><?php }else{?>
     <td col-id="12"  data-id="<?php echo $job['order_id'];?>"><?php echo $job['status'];?></td> <?php }?>
    <input id="status" type="hidden" value="<?php echo $job['status'];?>"/>                       
                           
                           <td><a href="edit_order.php?cid=<?php echo $job['order_id'];?>"><i class="glyphicon glyphicon-check"></i></a></td>
                           <td><a href="edit_customer.php?id=2&order_id=<?php echo $job['id'];?>"><i class="glyphicon glyphicon-user"></i></a></td>
                           <td>
                            <a href="delete_job.php?id=<?php echo $job['id'];?>" data-href="delete_job.php?id=<?php echo $job['id'];?>" data-toggle="modal" data-target="#confirm-delete"><i class="glyphicon glyphicon-trash"></i></a><br><a>
                </a>
                </td>
              </tr>
   <?php } ?>
   				 </tbody>
			   </table>
		    </div>
	    </div>

<style type="text/css">
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 700px; /* New width for default modal */
        }
        .modal-sm {
          width: 350px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 1050px; /* New width for large modal */
        }
    }
</style>

<div class="modal fade" id="drivers_modal">
 
</div><!-- /.modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="jobs_modal">
 
</div><!-- /.modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="update_job_modal">
 
</div><!-- /.modal -->



<!-- Delete Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Cancellation?</h4>
                </div>
            
                <div class="modal-body">
                    <p style="background-color:#EF0E12; color:white; font-size:20px;">Are you 100% Sure and Manager has Authorised?<img width="100" height="100" src="images/delete.png" class="img-thumbnail responsive">
                    </p>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">I am not Sure</button>
                    <a class="btn btn-danger btn-ok">I am sure - Cancel Job </a>
                </div>
            </div>
        </div>
    </div>
<!-- Delete Modal Ends -->

<!-- Delete Modal -->
<div class="modal fade" id="job_done" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">You Sure ?</h4>
                </div>
            
                <div class="modal-body">
                    <p style="background-color:#EF0E12; color:white; font-size:20px;">This Job is Aleady Updated. Please check Job Again.
                    </p>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">close This Screen</button>
                </div>
            </div>
        </div>
    </div>
<!-- Delete Modal Ends -->
<script type="text/javascript">

  $(document).ready(function() {
    $('#jobs').DataTable( {
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

$(".table-striped").find('td[data-id]').on('click', function () {
	
	
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
	
	

	    
});

// Delete button Request yes no

        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
        });
    

</script>


</body>
</html>