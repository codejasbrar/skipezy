
<meta charset="utf-8">

<title>List of Tipping Jobs</title>
<!doctype html>

<html>

<head>
  
<?php

include "dbconfig.php";

//include "css_header.php";
include "navbar_list.php";
 include ("dynamic_table.php");
//Get the order data for this order.

$sql="SELECT  orders.start_date, orders.id, orders.end_date,orders.skips, skips.size AS size, customers.name AS customer_name, customers.mobile, delivery_address.address1,delivery_address.city, delivery_address.post_code, orders.amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type, order_status.name AS order_status
FROM orders
LEFT JOIN customers ON orders.customer_id = customers.id
LEFT JOIN job_types ON orders.job_type = job_types.id
LEFT JOIN payment_type ON orders.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON orders.skip_id = skips.id
left join delivery_address on orders.address_id=delivery_address.id
WHERE orders.status=2 AND orders.tip_status=1";
if (!mysqli_query($con,$sql)) {echo 'Error ' . mysqli_error($con);}
		  
$res=mysqli_query($con,$sql);

//echo $sql;

?>
 </head>

<body style="font-family:Montserrat; font-size:13px;">

<div class="row">
      <div class="col-md-12" style="margin-top: 1%;box-shadow: 5px 5px 5px;">
        
             <div class="panel">
               <div class="panel-primary">
                 <div class="panel-heading"><h4><center>Allocate Jobs to Drivers</center></h4></div>
               </div>
             </div>
         
      </div>
   </div>
          <!-- this is end of start block and driver dropdown -->
	<div>&nbsp;</div>
  <div class="row col-md-8 col-md-offset-2">
  
  
   <div class="panel" style="box-shadow: 5px 5px 5px;">
             <div class="panel-primary">
                <div class="panel-heading">Select Driver</div>
             </div>
             <form name="new_tip_form" method="post" action="ajax/tip_new_job.php" id="new_tip_form">
             <div class="panel-body" style="background-color: #e9e9e9;">
              <div class=" col-md-12">
              	 <div class="form-group col-md-6">
                        <label>Select a Driver</label>
                           <select name="driver" style="width:70%;" id="driver" class="form-control">
                                   <option style="padding:15px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="0" selected>Select Driver </option>
                               <?php
                 
                    $skip_sql="SELECT * from employees where job_title=1 order by name ASC";
                  $t_result=mysqli_query($con,$skip_sql);
                  while($skip=mysqli_fetch_assoc($t_result))
                  {
                  ?>
                  
  <option selected style="padding:15px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="<?php echo $skip['id']; ?>">
     <?php echo $skip['name']; ?>
    </option>
            <?php
            
            }
            ?>
                                </select>
             </div>
                <div class="form-group col-md-6">
                        
                         <label for="mobile">Lorry Reg</label>
                      
                          <?php
						 $lorry=getAll($con,"vehicles");
						 ?>
                        
                           <select style="width:70%;" name="lorry" id="lorry" class="form-control">
                             <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a lorry </option>
                               <?php
							   foreach($lorry as $key=>$lorry_data){?>
				<option style="padding:10px; background-color:#9AD8EF; color:#320607; cursor:pointer;" value="<?php echo $lorry_data['id']; ?>"><?php echo $lorry_data['reg_plate']; ?>
    
    </option>
								   
								   <?php }
							   ?>
                          </select>
                         </div> 
                     
              <div class="form-group col-md-6">
       <label for="mobile">Yard Name</label>
                         <?php
						 $yard=getAll($con,"yards");
						 ?>
                         <div class="form-group">
                           <select style="width:70%;" name="yard" id="yard" class="form-control">
                             <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a Yard </option>
                               <?php
							   foreach($yard as $key=>$yard_data){?>
				<option style="padding:10px; background-color:#9AD8EF; color:#320607; cursor:pointer;" value="<?php echo $yard_data['id']; ?>"><?php echo $yard_data['name']; ?>
    
    </option>
								   
								   <?php }
							   ?>
                          </select>
                          
                         </div>
                     </div>
              
                       <input type="hidden" id="tip_status" name="tip_status" value="2">
                         
               <div class="form-group col-md-6">  
                         <input  type="submit" name="allocate_job" class="btn btn-round btn-success btn-sm col-md-4" style="float:right;padding:15px;" value="Tip Selected Jobs">
                       </div>
              </div>
               
               <!-- form end here---->
               <!-- Table Startss -->        
                <div id="job_done"></div>
                <div id="loader"><img src="images/loader.gif"></div>
                <table  style="font-family:Montserrat; font-size:13px;" id="jobs" class="table table-striped table-bordered table-hover" cellspacing="0">

        <thead>
      			    <tr class="btn-primary">
 						   <th>Job ID</th>
                           <th>Start Date</th>
                           <th>Skip Size</th>
                           <th>Customer</th>
                           <th>Site Address</th>
                           <th>Job Type</th>
                           <th>View</th>
                           <th>Allocate</th>
           			 </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary">
 						   <th>Job ID</th>
                           <th>Start Date</th>
                           <th>Skip Size</th>
                           <th>Customer</th>
                           <th>Site Address</th>
                           <th>Job Type</th>
                           <th>View</th>
                           <th>Allocate</th>
           			 </tr>

        </tfoot>

        <tbody >

        <?php

                while($job=mysqli_fetch_assoc($res))

                { ?>                         
                    <tr>
                           <td><?php echo $job['id'];?></td>
                           <td>
						   <?php $start = date("d-m-Y", strtotime($job['start_date'])); 
						   
						   echo $start  ;?></td>
                           <td>  
						   <?php
						   $qty=$job['skips'];
						   if($qty>'1'){
							   
						   echo $job['skips']." skips,<br> ";?><?php echo $job['size']."<br>";
						   }else{
                             
						    echo $job['skips']." skip,<br> ";?><?php echo $job['size'];
						   }
							?>
                            </td>
                           <td><?php echo $job['customer_name'];?></td>
                           <td><?php echo $job['address1'].", ".$job['city'].", ".$job['post_code'];?></td>
                           <td><?php echo $job['job_type'];?></td>
                           <td><a href="edit_order.php?job_id=<?php echo $job['id'];?>"><i class="glyphicon glyphicon-check"></i></a></td>
                          <td><input type="checkbox" name="selected_job[]" value=<?php echo $job['id'];?>> </td>
					</tr>
      <?php  } ?>
      </tbody>
 </table>
            </div>
         </form>
      </div>
  </div>

 

       <!-- Now allocate job to selected driver -->
   
   
<script type="text/javascript">
$(document).ready(function () {
	$('#loader').hide();
});
$("#new_tip_form").on('submit',(function(e) {
		///////////////////// Validate Data First
  
 /////////////////Validation Ends //////////////////////
		e.preventDefault();
				
		$.ajax({
			
				url: "ajax/tip_new_job.php",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data)
				{ 
				//alert(data);
				if(data=='success')
				{
					  alert("Tipping Done");
					  //$('#loader').delay(500).fadeOut("slow");
					  //window.location.replace("list_tip_job.php");
					  }else{
						  alert("Tipping Done");
						  window.location.reload();
						  }				
				} 	        
	        });
	}));
	
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
    } );
} );

</script>


</body>
</html>