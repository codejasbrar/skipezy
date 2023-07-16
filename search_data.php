<?php 
  if (isset($_POST['customers.name'])) {
	  
	  $search_query=$_POST['customers.name'];
	  
	  $sql="SELECT order_details.start_date, customers.name AS customer_name, job_types.name AS job_type, delivery_address.post_code, employees.name AS driver
FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN delivery_address ON order_details.location_id = delivery_address.id
LEFT JOIN employees ON order_details.driver_id = employees.id

WHERE";
$sql=$sql+$search_query;
	  echo $sql;
	  exit;
	 $res=mysqli_query($con,$sql); 
	  ?>
	  
      
      
      
  
  
  
  <div class="row">
      <div class="col-md-12">
        <table  style="font-family:Montserrat; font-size:13px;" id="jobs" class="table table-striped" cellspacing="0">

        <thead>
				 <tr class="btn-primary">
			        <th>Start Date</th>
                          
                           <th>Customer</th>
                           <th>Post Code</th>
                            <th>Job Type</th>
                           <th>Driver</th>
             </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary">
                           <th>Start Date</th>
                          
                           <th>Customer</th>
                           <th>Post Code</th>
                            <th>Job Type</th>
                           <th>Driver</th>
            </tr>

        </tfoot>

        <tbody >
			
        <?php

                while($job=mysqli_fetch_assoc($res))

                  {              
  ?>               
<tr>
                           <td><?php echo $job['order_id'];?></td>
                           <td>
						   <?php $start = date("d/m/y", strtotime($job['start_date'])); 
						   
						   echo $start  ;?></td>
                           <!-- customer Name-->
                            
                            <td col-id="6" class="customers" data-id="<?php echo $job['customer_id'];?>"><?php echo $job['customer_name'];?></td>
                            
                           <td><?php echo $job['post_code'];?></td>
                           <td><?php echo $job['job_type'];?></td>
              
			           
               				
				<?php 
				if($job['driver']=='Allocate Driver'){?>
				
				<td col-id="11"  data-id="<?php echo $job['order_id'];?>"><?php echo "Assign Driver";?></td>
                <?php }else{?>
				<td><?php echo $job['driver'];}?></td>	
                             
                          
            </tr>

            

      <?php           

        } } ?>
        
          </tbody>

    </table>
</div>
</div>