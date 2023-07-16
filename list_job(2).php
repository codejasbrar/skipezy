
<meta charset="utf-8">

<title>List of Orders</title>
<!doctype html>

<html>

<head>
<?php include("navbar_list.php");?> 
<!-- Java Scripti Files -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  <?php

include "dbconfig.php";

//include "css_header.php";

 $today= date('Y-m-d');
$sql="SELECT orders.id , order_status.name as status, order_details.start_date,order_details.order_id AS order_id, order_details.end_date,order_details.skips,order_details.exchange_skip_id as exchanged_skip, skips.size AS skip, customers.id AS customer_id, customers.name AS customer_name, customers.mobile, order_details.amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type,  delivery_address.address1,delivery_address.address2,delivery_address.city,delivery_address.post_code, employees.name AS driver,tip_jobs.status AS tip_status
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

WHERE order_details.start_date='$today' order by order_details.order_id DESC";

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);

//echo $sql;


?>



 </head>

<body>
     
   <div style="margin-top:50px;">&ensp;</div>
 

    <div class="col-md-12">
      <div class="col-md-1" style="margin-top:-80px;z-index: 999;">
      </div>
      <div class="col-md-11">
           <div class="col-md-12" style="text-align:center;color:#0000;background-color: #fff; padding:5px; font-size:18px;">
   <div class="col-md-4" style="margin-top:10px;">
   <p style="text-align:center;color:#0000; padding:10px; font-size:16px;">Filter Jobs as Your Requirement</p>
   </div>
       
       <div class="col-md-1"  style="margin-top:10px;">
          <p id="delivery_jobs"  class="btn btn-primary btn-sm">Delivery</p>
       </div>
       <div class="col-md-1" style="margin-top:10px;">
          <p id="collection_jobs"  class="btn btn-warning btn-sm">Collection</p> 
       </div>
       <div class="col-md-1" style="margin-top:10px;">
          <p id="exchange_jobs"   class="btn btn-primary btn-sm">Exchange</p>
       </div>
       <div class="col-md-1"style="margin-top:10px;">
          <p id="all_jobs" class="btn btn-primary btn-sm">See All Jobs</p>
       </div>
</div>
  <form action="" method="post">
    <input type="hidden" name="filter_search" value="yes">
     <div class="col-md-12" style="text-align:center;margin-top: 10px;">

        <center>
        <div class="col-md-2">
         <div class="form-group">
                      
 <input type="text" name="from" class="from form-control" placeholder="Date From" id="from">
             
         </div>
        </div>
       <div class="col-md-2">
         <div class="form-group">
                      
 <input type="text"  name="to" class="to form-control" placeholder="Date To" id="to">
             
         </div>
        </div>
     <div class="col-md-1">
            <div class="form-group">
                  <input type="text" name="job_id" id="job_id" class="job_id form-control" placeholder="Job ID">
            </div>      
    
         </div>
         
         <div class="col-md-1">
            <div class="form-group">
                  <input type="text" name="driver" id="driver" class="driver form-control" placeholder="Driver">
            </div>      
    
         </div>
     
      <div class="col-md-1">
         <div class="form-group">
          <input type="text" name="paid" id="paid" class="paid job_type form-control" placeholder="Type N or P">
         </div>
      </div>
      <div class="col-md-1">
          <div class="form-group">
            <input type="text" name="post_code" id="post_code" class="post_code form-control" placeholder="Post Code">
          </div> 
      </div>
      <div class="col-md-2">
          <div class="form-group">
            <input type="text" name="name" 
id="name" class="name form-control" placeholder="Customer Name">
          </div> 
      </div>
        </div>
</center>
      </form>
   			<?php
            $rowcount=mysqli_num_rows($res);

if($rowcount==0)
{
	echo '<tr style="cursor:pointer; background-color:#e9e9e9; color:#fff;"><td></td><td></td><td></td><td><p>You have no Jobs, Add Some Jobs.</p></td></tr>';
}
				
$today = date("d/m/y", strtotime($today));
echo '<p style="text-align:center;background-color:#e9e9e9; color:#fff padding:15px; font-size:18px;">Total '.$rowcount.' jobs are starting today ('.$today.'). You can see other jobs by applying filter. </p>';
?>
           <div class="row">
      <div class="col-md-12" id="filter_results">
        <table id="jobs" class="table table list_jobs table-hover table-bordered table-striped table-info" cellspacing="0" border="1">

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
                           
                           <th>Payment</th>
                           <th>Driver</th>
                           <th>Tipping</th>
                           <th>Job Status</th>
                           <th>Edit</th>
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
                           <th>Edit</th>
                           <th>Cancel</th>
            </tr>

        </tfoot>

        <tbody>

        <?php

                while($job=mysqli_fetch_assoc($res))

                  {
					  //echo $job['payment_type'];
					  //exit;
					  if($job['status']=='Job Done'){?>
                      
                        <tr class="job_type <?php echo $job['job_type'] ;?>" style="cursor:pointer; color:#2A8AC0; font-weight:bold;">
                        <?php 
					  }else{?>
							<tr class="job_type <?php echo $job['job_type'] ;?>" style="cursor:pointer; color:#F80409; font-weight:bold;">
							<?php }?>
                           <td><?php
						    echo $job['id']; ?></td>
                          
                           <td>
						   <?php $start = date("d/m/y", strtotime($job['start_date'])); 
						   
						   echo $start  ;?></td>
                           
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
	echo "This job is not done";
	
	}
			  
			  ?>
                           
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
                            
                           <td><?php echo $job['address1'].", ".$job['city'].", <span class='badge' style='padding:10px;'>".$job['post_code']."</span>";?></td>
                           <td><?php echo "£".$job['total_amount'];?></td>
                           
               <?php
                           if($job['payment_type']=='Not Paid'){?>
               <td style="cursor:pointer; background-color:#ED3B3E; color:ffffff;"><?php echo $job['payment_type'];?></td>  
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
                           
                           <?php if($job['status']=="Job Done"){?><td col-id="12"  id="<?php echo $job['order_id'];?>"><?php echo $job['status'];?></td><?php }else{?>
     <td col-id="12"  data-id="<?php echo $job['order_id'];?>"><?php echo $job['status'];?></td> <?php }?>
    
    <input id="status" type="hidden" value="<?php echo $job['status'];?>"/>
    <td><a href="edit_order.php?job_id=<?php echo $job['order_id'];?>"><i class="glyphicon glyphicon-check"></i></a></td>                       
                           <td>
                            <a href="#" data-href="delete_job.php?id=<?php echo $job['order_id'];?>" data-toggle="modal" data-target="#confirm-delete"><i class="glyphicon glyphicon-trash"></i></a><br><a>
                </a>
                </td>
                 
              </tr>
   <?php } ?>
   				 </tbody>
			   </table>
		    </div>
	    </div>
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

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="tip_job_modal">
 
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
	//alert("list_job");


$(".list_jobs").find('td[data-id]').on('click', function () {
	
	////alert("Demo");
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
			 // alert(status);
			  if(status=='Job Done')
			  {
			  
			   $('#job_done').modal('show');
			  return false;
			  }
			  var select_job_id=$(this).attr('data-id');
			  var dataString = 'select_job_id='+select_job_id+'&selected_col='+selected_col;
			  //alert(dataString);
			  $.ajax({
				  type: "POST",
			  url: "update_job.php",
			  data: dataString,
			  success: function(data) {
				
			 $(this).css('backgroundColor', '#63EC62');
			   $(this).html('Job Done');
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
  var job_id=$('#job_id').val();
  var paid=$('#paid').val();  
  var post_code=$('#post_code').val(); 
  
  var from=$('#from').val();
  var to=$('#to').val();
  
  //alert(amount);
   var dataString ='filter_search=' + filter_search+ '&job_type=' + job_type + '&paid=' + paid+'&post_code=' + post_code + '&from=' + from + '&to=' + to+ '&job_id=' + job_id;
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

$('body').delegate('.post_code,.name,.driver,.paid,.from,.to,.job_id','keyup',function()  
{
		
  var from=$('#from').val();
  var to=$('#to').val();
  //alert(from);
  var filter_search="filter_search";
  var post_code=$('#post_code').val();
  var name=$('#name').val();
  var driver=$('#driver').val();
   var paid=$('#paid').val();
    var search = $(this).val();
  var job_id=$('#job_id').val();
	
  if (search.length > 0) {
	

   var dataString ='filter_search=' + filter_search+'&from=' + from+'&post_code=' + post_code+'&name=' + name+'&driver=' + driver+'&paid=' + paid +'&to=' + to+ '&job_id=' + job_id;

	
	} else {
		var dataString ='filter_search=' + filter_search+'&from=' + from +'&post_code=' + post_code+'&name=' + name+'&driver=' + driver+'&paid=' + paid +'&to=' + to+ '&job_id=' + job_id;
	}
	//alert(dataString);
  $.ajax({
                    type: "POST",
                    url: "search_by_post_code.inc.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
          // $('#gross').hide();
           $('#filter_results').html(data); 
           
                }
            });
        });
		
//When user click on Start_date execute the filter
  $('.to').datepicker({
	
    	onSelect: function() {
			
			$( ".to" ).datepicker( "option", "dateFormat","dd/mm/yy");
		var to=$('#to').val();
                $( ".from" ).datepicker( "option", "dateFormat","dd/mm/yy");
		var from=$('#from').val();
		//alert(to);
  		var filter_search="filter_search";
    
  		//alert(amount);
  		 var dataString ='filter_search=' + filter_search+'&to=' + to+'&from=' + from;
			//alert(dataString);
  //return false;
  $.ajax({
                    type: "POST",
                    url: "search_by_post_code.inc.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
          // $('#gross').hide();
           $('#filter_results').html(data); 
           
                }
            });
			
    }
  
  });

	$('#name').keyup(function(){
	
});	
$('.from').datepicker({
	
    	onSelect: function() {
			
                $( ".from" ).datepicker( "option", "dateFormat","dd/mm/yy");
		var from=$('#from').val();
		//alert(to);
  		var filter_search="filter_search";
    
  		//alert(amount);
  		 var dataString ='filter_search=' + filter_search+'&from=' + from;
			//alert(dataString);
        }
        });
		
		//Button click code to hide or show delivery and collection jobs
		
		
		$('#delivery_jobs').click(function(){
			$('.Collection').hide();
			$('.Delivery').show();
			$('.Exchange').hide();

		});
		$('#collection_jobs').click(function(){
			$('.Collection').show();
			$('.Delivery').hide();
			$('.Exchange').hide();
		});
		$('#exchange_jobs').click(function(){
			$('.Collection').hide();
			$('.Delivery').hide();
			$('.Exchange').show();
		});
		$('#all_jobs').click(function(){
			$('.Collection').show();
			$('.Delivery').show();
			$('.Exchange').show();
		});



</script>







</body>
</html>