<!DOCTYPE html>
<html>
<head>
<?php 
 session_start();
ini_set('display_errors',1); // enable php error display for easy trouble shooting
error_reporting(E_ALL); // set error display to all
	include "dbconfig.php";

?>
	<title></title>
	<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="">
<meta name="description" content="" />



<title>Welcome to Skip Track</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  
  
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/animate.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Pacifico|Hind|Anton|Chewy|Bangers|Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
  <form method="post">
  <!-- Ajaj Row Start -->
 <div class="container-fluid"> 
   <?php include("employee_navbar.php");?>
   <div class="row">
      <div>&ensp;</div>
       <div>&ensp;</div>
        <div>&ensp;</div>
         <div>&ensp;</div>
   </div>
   <div class="row">
   	  <div class="col-md-12" style="box-shadow: 5px 5px 5px;">
   	  	 <div class="panel">
   	  	 	<div class="panel-primary">
     		  <div class="panel-heading"><center><h4>Hello&ensp;<?php echo $_SESSION['name'];?></h4></center></div>
     	      </div>
   	  	 </div>
   	  </div>
   </div>
   <div class="row">
   	  <div class="col-md-12">
   	  	  <div>&ensp;</div>
   	  </div>
   </div>
     <div class="row">
     	<div class="col-md-12">
     		
     				<!-- Ajaj Bootstrap Panel Body Start -->
						<?php 
							$driver_id=$_SESSION['id'];
							$sql="SELECT orders.id, order_details.start_date, order_details.id AS order_id, order_details.end_date,skips.size AS skip, customers.name AS customer_name, customers.mobile, customers.address1,customers.address2, customers.city, customers.post_code, orders.total_amount AS total_amount, customers.post_code, job_types.name AS job_type, payment_type.name AS payment_type, order_status.name AS order_status,delivery_address.address1 AS delivery_address1,delivery_address.address2 AS delivery_address2,delivery_address.city AS delivery_city,delivery_address.post_code AS delivery_post_code
FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN payment_type ON order_details.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON order_details.skip_id = skips.id
LEFT JOIN employees ON order_details.driver_id = employees.id
LEFT JOIN delivery_address ON order_details.customer_id=delivery_address.customer_id
WHERE employees.id = order_details.driver_id
AND order_details.driver_id =$driver_id";
//echo $sql;
						$query=mysqli_query($con,$sql);				
                         ?>
                        <div class="table-responsive"> 
                         <table  style="font-family:Montserrat; font-size:13px;" id="jobs" class="table table-striped table-bordered table-hover" cellspacing="0">

        <thead>
                <tr class="btn-primary">
                           <th>Job Id</th>
                           <th>Date</th>
                           <th>Job Type</th>
                           <th>Skip Size</th>
                           <th>Customer Detail</th>
                           <th>Post Code</th>
                           <th>Customer Name</th>
                           <th>Mobile</th>
                           <th>Delivery Address</th>
                           <th>Post Code</th>
                 </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary">
                           <th>Job Id</th>
                           <th>Date</th>
                           <th>Job Type</th>
                           <th>Skip Size</th>
                           <th>Customer Detail</th>
                           <th>Post Code</th>
                           <th>Customer Name</th>
                           <th>Mobile</th>
                           <th>Delivery Address</th>
                           <th>Post Code</th>
              </tr>

        </tfoot>

        <tbody >

        <?php
                while($job=mysqli_fetch_assoc($query))

                { ?>                         
                    <tr>
                          
                           <td><?php echo $job['id'];?></td>
                           <td>
               <?php $start = date("d-m-Y", strtotime($job['start_date'])); 
               
               echo $start  ;?></td>
                           <td><?php echo $job['job_type'];?></td>
                           <td><?php echo $job['skip'];?></td>
                           <td><?php echo $job['address1'];?><br>
                               <?php echo $job['address2'];?><br>
                               <?php echo $job['city'];?>
                           </td>
                           <td><?php echo $job['post_code'];?></td>
                           <td><?php echo $job['customer_name'];?></td>
                           <td><?php echo $job['mobile'];?></td>
                          <td><?php echo $job['delivery_address1'];?><br>
                               <?php echo $job['delivery_address2'];?><br>
                               <?php echo $job['delivery_city'];?>
                           </td>
                           <td><?php echo $job['delivery_post_code'];?></td>
          </tr>
      <?php  } ?>
      </tbody>
 </table>
 </div>

     				  


     				<!-- Ajaj Bootstrap Panel Body End -->
     		
     	</div>
     </div>
     <!-- Ajaj Row End -->
     </div>
  </form>
</body>
</html>