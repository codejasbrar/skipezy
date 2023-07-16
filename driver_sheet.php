
<meta charset="utf-8">

<title>List of Jobs</title>
<!doctype html>

<html>

<head>
<?php
  include "dbconfig.php";

//include "css_header.php";
include "navbar_list.php";
 include ("dynamic_table.php");
//Get the order data for this order.
?>
  <!-- Now allocate job to selected driver -->
      
 </head>

<body style="font-family:Montserrat; font-size:13px;">

<div class="row">
      <div class="col-md-12" style="margin-top: 10%;box-shadow: 5px 5px 5px;">
        
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
  
  <form name="allocate" method="post">
   <div class="panel" style="box-shadow: 5px 5px 5px;">
             <div class="panel-primary">
                <div class="panel-heading">Select Driver</div>
             </div>
             <div class="panel-body" style="background-color: #e9e9e9;">
                        <div class="form-group col-md-6">
                           <select name="driver" style="width:70%;" id="exchange_skip_id" class="form-control">
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
             <input  type="submit" name="allocate_job" class="btn btn-round btn-success col-md-4" style="float:right;padding:15px;" value="Allocate Jobs">
           </div>
        </div>
       <!-- this is end of button block and driver dropdown -->
       
      
      
      
      <div id="job_done"></div>
      <div>&nbsp;<hr class="solid"></div>
       <?php
       if(isset($_POST['allocate_job']))
			{
				$driver_id=$_POST['driver'];
				//print_r($_POST);
				//echo $id;
			    //exit;
		


$sql="SELECT orders.id , order_details.start_date, order_details.id AS order_id, order_details.end_date,order_details.skips, skips.size AS size, customers.name AS customer_name, customers.mobile, customers.address1,customers.city, customers.post_code, orders.total_amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type, order_status.name AS order_status
FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN payment_type ON order_details.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON order_details.skip_id = skips.id
WHERE order_details.driver_id=$driver_id";

$res=mysqli_query($con,$sql);

//echo $sql;

?>
		<div class="col-md-12"><h2>Job Sheet of <?php 
		
		$sql1="SELECT name from employees where id=$driver_id";
		$res1=mysqli_query($con,$sql1);
		$driver=mysqli_fetch_assoc($res1);
		$name=$driver['name'];
		echo " $name</h2>";
		
		?>
		
		</div>
        
        <div>&nbsp;<hr class="solid"></div>
        
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
                           <td><?php echo $job['order_id'];?></td>
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
                           <td><a href="edit_order.php?cid=<?php echo $job['order_id'];?>"><i class="glyphicon glyphicon-check"></i></a></td>
                          <td><input type="checkbox" name="selected_driver[]" value=<?php echo $job['order_id'];?>> </td>
					</tr>
      <?php  }} ?>	
			
      </tbody>
 </table>


 

     
			
				
			
            
   

    </div>
</form>

    </div>


<script type="text/javascript">
$('.allocate_jsob').click(function(){
  
var allocate_job = "yes";
 
  $.ajax({
    type: "POST",
    url: 'allocate_job.php',
    data: dataString,
    success: function(data) {
      $('#job_done').html(data);
    }
  });
});

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