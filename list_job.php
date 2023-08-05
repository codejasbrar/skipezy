<?php

include('messagefile.php');

?>
<title>List of Orders</title>
<!doctype html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
    @media screen and (min-width: 768px) {
        .modal-dialog {
            width: 700px;
            /* New width for default modal */
        }

        .modal-sm {
            width: 350px;
            /* New width for small modal */
        }
    }

    @media screen and (min-width: 992px) {
        .modal-lg {
            width: 1050px;
            /* New width for large modal */
        }
    }

    .ui-datepicker {
        margin-left: 100px;
        z-index: 1000;
    }

    div#rowIdz {
        padding: 30px 10px;
    }
    </style>
    <?php
 ob_start();

 include "navbar.php";
//  include "navbar_list.php";

?>

    <!-- Date Picker Java Scripti Files -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <?php

include "dbconfig.php";

//include "css_header.php";



$today= date('Y-m-d');
//Get the order data for this order.
if(isset($_POST['filter_search'])){
	
    
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
	
	
	
	
	
	if (!empty($_POST['name']))
	{
	  $name=$con->real_escape_string($_POST['name']);
	  $condition .= "AND customers.name LIKE '$name%'";
	 
	}
	if (!empty($_POST['driver']))
	{
	  $driver=$con->real_escape_string($_POST['driver']);
	  $condition .= "AND drivers.name LIKE '$name%'";
	}
	
	// /*
	// if (!empty($_POST['paid']))
	// {
	//   $paid=$con->real_escape_string($_POST['paid']);
	//   $condition .= "AND payment_status.name LIKE '$name%'";
	// }
	// */
	
	if (!empty($_POST['job_id']))
	{
	  $job_id=$con->real_escape_string($_POST['job_id']);
	  $condition .= "AND orders.id = '$job_id'";
	} 
	
	if (!empty($_POST['post_code']))
	{
	  $post_code=$con->real_escape_string($_POST['post_code']);
	  
	  $condition .= "AND delivery_address.post_code = '$post_code' ";
	  
	}
	
	if (!empty($_POST['name']))
	{
	  $name=$con->real_escape_string($_POST['name']);
	  
	  $condition .= "AND customers.name LIKE '$name%'";
	  
	}
	
	if (!empty($_POST['only_name']))
	{
	  $only_name=$con->real_escape_string($_POST['only_name']);
	  
	  $condition .= "AND orders.status = '$only_name'";
	  
	}
	
	/*if (!empty($_POST['driver_id']))
	{
	  $driver_id=$con->real_escape_string($_POST['driver_id']);
	  
	  $condition .= "AND customers.name LIKE '$name%'";
	  
	}*/
	
	
	
	//echo date('Y-m-d', strtotime("+30 days"));
	//echo $post_code; 
	//$_SESSION["from"]=$from;
	//$_SESSION["to"]=$to;
	//$from=$_SESSION["from"];
	//$to=$_SESSION["to"];
	
	if (!empty($_POST['from']))
	{
	  $from=$con->real_escape_string($_POST['from']);
	  $from = str_replace("/","-",$from);
	  $from = date("Y-m-d", strtotime($from));
	  
	    $to=$con->real_escape_string($_POST['to']);
	  $to = str_replace("/","-",$to);
	  $to = date("Y-m-d", strtotime($to));
	}
	
	if (!empty($from))
	{
	 
	  $condition .= " and orders.start_date BETWEEN '$from' AND '$to'";
	}
	
$sql="SELECT order_status.name as status, orders.start_date,orders.id AS id, orders.end_date,orders.skips,orders.exchange_skip_id as exchanged_skip, orders.comments,orders.delivery_slot,orders.yard,
skips.size AS skip,  skips.id AS skipid, customers.id AS customer_id, customers.name AS customer_name, customers.mobile, orders.amount AS total_amount,orders.amount_paid AS amount_paid, job_types.name AS job_type, payment_type.name AS payment_type,  delivery_address.address1,delivery_address.city,delivery_address.post_code, employees.name AS driver,tip_status.name AS tip_status, orders.driver_id as driver, orders.collected_date, orders.collected_by, yards.name as yardname FROM orders

LEFT JOIN customers ON orders.customer_id = customers.id 
LEFT JOIN job_types ON orders.job_type = job_types.id 
LEFT JOIN payment_type ON orders.payment_status = payment_type.id 
LEFT JOIN order_status ON orders.status = order_status.id 
LEFT JOIN skips ON orders.skip_id = skips.id 
LEFT JOIN delivery_address ON orders.address_id = delivery_address.id
LEFT JOIN employees ON orders.driver_id = employees.id 
LEFT JOIN tip_status ON orders.tip_status = tip_status.id
LEFT JOIN yards ON orders.tip_yard_id = yards.id
WHERE 1=1
 
".$condition."

ORDER BY orders.start_date DESC";




  if (!mysqli_query($con,$sql)) 
				  { 	
					  
					  die('SELECT 1 SQL SAID -Error: ' . mysqli_error($con));
				  }
	else
	{
$res=mysqli_query($con,$sql);
	}

} else {
    
    
    $today= date('Y-m-d');
$sql="SELECT orders.start_date,orders.id AS id, orders.end_date,orders.skips,orders.exchange_skip_id as exchanged_skip, orders.comments,orders.delivery_slot, order_status.name as status,orders.yard as yard,
skips.size AS skip, customers.id AS customer_id, customers.name AS customer_name, customers.mobile, orders.amount AS total_amount,orders.amount_paid AS amount_paid, job_types.name AS job_type, payment_type.name AS payment_type,  delivery_address.address1,delivery_address.address2,delivery_address.city,delivery_address.post_code, orders.driver_id AS driver
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

WHERE orders.start_date='$today' order by orders.start_date DESC";
if (!mysqli_query($con,$sql)) 
					  { 	
					echo '<p style="color:black; background-color:red; padding:20px; font-size:20px; font-weight:bold;"> error 497 Something Went Wrong, did you filled all fields?';				  
					echo mysqli_error($con);
						  exit;
						  die('INSERT SQL 2 SAID -Error : ' . mysqli_error($con));
					  }//if (!mysqli
$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
    
}



?>

    <!-- //////////////////////// Get the Total Number of jobs ////////////////// -->

    <?php 
$count_sql="SELECT * from orders";
$count_res=mysqli_query($con,$count_sql);
$total_jobs=mysqli_num_rows($count_res);
;?>

</head>

<body style="font-family:Montserrat; font-size:16px;">
    <hr>
    <div class="col-md-12" style="text-align:center;color:#000; padding:10px; font-size:18px; text-align: left;">
        <div class="" style="">
            <p style="text-align:center;color:#000; padding:10px; font-size:16px; text-align: left; margin: 0">Filter
                Jobs as Your
                Requirement</p>
        </div>
        <div class="col-md-12" style="padding:10px;">
            <p id="delivery_jobs" class="btn btn-primary btn-sm" style="margin-bottom: 10px">Delivery</p>
            <p id="collection_jobs" class="btn btn-warning btn-sm" style="margin-bottom: 10px">Collection</p>
            <p id="exchange_jobs" class="btn btn-primary btn-sm" style="margin-bottom: 10px">Exchange</p>
            <p id="all_jobs" class="btn btn-primary btn-sm" style="margin-bottom: 10px">See All Jobs</p>
            <p id="all_jobs" class="btn btn-info btn-sm" style="margin-bottom: 10px">Total Jobs =
                <?php echo $total_jobs;?></p>
        </div>
    </div>

    <form action="" method="post">
        <input type="hidden" name="filter_search" value="yes">
        <div class="col-md-12" style="text-align:center;">

            <center>
                <div class="col-md-2" style="padding-left: 0">
                    <div class="form-group">
                        <input type="text" name="from" class="from form-control" placeholder="Date From" id="from">
                    </div>
                </div>
                <div class="col-md-2" style="padding-left: 0">
                    <div class="form-group">
                        <input type="text" name="to" class="to form-control" placeholder="Date To" id="to">
                    </div>
                </div>
                <div class="col-md-1" style="padding-left: 0">
                    <div class="form-group">
                        <input type="text" name="job_id" id="job_id" class="job_id form-control" placeholder="Job ID">
                    </div>
                </div>

                <!--- <div class="col-md-1">
            <div class="form-group">
                  <input type="text" name="driver_id" id="driver_id" class="driver_id form-control" placeholder="Driver">
            </div>      
    
         </div>
     
      <div class="col-md-1">
         <div class="form-group">
       <input type="text" name="paid" id="paid" class="paid job_type form-control" placeholder="Type N or P">
		
         </div>
      </div>-->
                <div class="col-md-2" style="padding-left: 0">
                    <div class="form-group">
                        <input type="text" name="post_code" id="post_code" class="post_code form-control"
                            placeholder="Post Code">
                    </div>
                </div>
                <div class="col-md-2" style="padding-left: 0">
                    <div class="form-group">
                        <input type="text" name="name" id="name" class="name form-control" placeholder="Customer Name">
                    </div>
                </div>
                <div class="col-md-2" style="padding-left: 0">
                    <div class="form-group">
                        <select class="form-control" name="only_name">
                            <option value="">choose</option>
                            <option value="1">Not Done</option>
                            <option value="2">Done</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1" style="padding-left: 0">
                    <div class="form-group">
                        <input type="submit" name="submit_search_data" value="Search" id="submit_search_data"
                            class="name btn btn-primary" placeholder="Customer Name">
                    </div>
                </div>
        </div>
        </center>
    </form>

    <hr>

    <div class="row" id="rowIdz" style="margin: 0">
        <div class="col-md-12" id="filter_results">

            <?php include "list_jobs_data.php";?>

        </div>
    </div>

    <div class="modal fade" id="drivers_modal">

    </div><!-- /.modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" id="jobs_modal">

    </div><!-- /.modal -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" id="tip_job_modal">

    </div><!-- /.modal -->

    <!-- Delete Modal -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Cancellation?</h4>
                </div>

                <div class="modal-body">
                    <p style="background-color:#EF0E12; color:white; font-size:20px;">Are you 100% Sure and Manager
                        has
                        Authorised?<img width="100" height="100" src="images/delete.png"
                            class="img-thumbnail responsive">
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
                    <p style="background-color:#EF0E12; color:white; font-size:20px;">This Job is Aleady Updated.
                        Please
                        check Job Again.
                    </p>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="success_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Job confirmation</h4>
                </div>

                <div class="modal-body">
                    <p style=" color:#333; font-size:20px;">Job Updated Successfully.
                    </p>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal Ends -->
    <script type="text/javascript" src="../js_files/list_jobs.js"></script>

    <script>
    $(document).ready(function() {

        $('.from').datepicker({
            dateFormat: 'dd/mm/yy'
        });

        $('.to').datepicker({
            dateFormat: 'dd/mm/yy'
        });

    });

    $("#delivery_jobs").click(function() {
        $(".Collection").hide();
        $(".Delivery").show();
        $(".Exchange").hide();
    });
    $("#collection_jobs").click(function() {
        $(".Collection").show();
        $(".Delivery").hide();
        $(".Exchange").hide();
    });
    $("#exchange_jobs").click(function() {
        $(".Collection").hide();
        $(".Delivery").hide();
        $(".Exchange").show();
    });
    $("#all_jobs").click(function() {
        $(".Collection").show();
        $(".Delivery").show();
        $(".Exchange").show();
    });
    </script>

</body>

</html>