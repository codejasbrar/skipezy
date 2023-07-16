<?php
session_start();
error_reporting(0);
?>
<meta charset="utf-8">

<title>List of Orders</title>
<!doctype html>

<html>

<head>




 </head>
  <?php
//session_start();
include "dbconfig.php";
 $today= date('Y-m-d');
//Get the order data for this order.

	

	$job_id  = '';
	$condition='';
	$post_code='';
	$driver='';
	$paid='';
	$name='';
	$start_date="";
	$from="";
	$to="";
/*	$_SESSION["from"]='2017-08-13';
$_SESSION["to"]='2017-08-14';
$_COOKIE["from"]='2017-08-13';
$_COOKIE["to"]='2017-08-14';*/
	
	
	if (!empty($_POST['job_id']))
	{
	  $job_id=$con->real_escape_string($_POST['job_id']);
	 
	}
	
	//echo date('Y-m-d', strtotime("+30 days"));
	//echo $post_code; 
	$_SESSION["from"]=$from;
	$_SESSION["to"]=$to;
	$from=$_SESSION["from"];
	$to=$_SESSION["to"];
 $sql="SELECT order_status.name as status, orders.start_date,orders.id AS id, orders.end_date,orders.skips,orders.exchange_skip_id as exchanged_skip, orders.comments,orders.delivery_slot,orders.yard,
 skips.size AS skip,  skips.id AS skipid,  customers.id AS customer_id, customers.name AS customer_name, customers.mobile, orders.amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type,  delivery_address.address1,delivery_address.city,delivery_address.post_code, employees.name AS driver,tip_status.name AS tip_status, orders.driver_id as driver, orders.collected_date, orders.collected_by, yards.name as yardname
FROM orders

LEFT JOIN customers ON orders.customer_id = customers.id 
LEFT JOIN job_types ON orders.job_type = job_types.id 
LEFT JOIN payment_type ON orders.payment_status = payment_type.id 
LEFT JOIN order_status ON orders.status = order_status.id 
LEFT JOIN skips ON orders.skip_id = skips.id 
LEFT JOIN delivery_address ON orders.address_id = delivery_address.id
LEFT JOIN employees ON orders.driver_id = employees.id 
LEFT JOIN tip_status ON orders.tip_status = tip_status.id
LEFT JOIN yards ON orders.tip_yard_id = yards.id
WHERE 
orders.id = '$job_id' ORDER BY orders.id DESC";
//echo $sql;
  if (!mysqli_query($con,$sql)) 
				  { 	
					  
					  die('SELECT 1 SQL SAID -Error: ' . mysqli_error($con));
				  }
	else
	{
$res=mysqli_query($con,$sql);
	}



?>
<body style="font-family:Montserrat; font-size:16px;">


   <?php  include "list_jobs_data.php"; ?>
   
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
<script type="text/javascript" src="js_files/list_jobs.js"></script>
</body>
</html>