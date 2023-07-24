<!doctype html>
<?php 
include "navbar.php";
include('dbconfig.php');
$today= date('Y-m-d');

 $sql="SELECT orders.start_date,orders.id AS id, orders.end_date,orders.skips,orders.exchange_skip_id as exchanged_skip, orders.comments,orders.delivery_slot, order_status.name as status,orders.yard as yard,
skips.size AS skip, skips.id AS skipid, customers.id AS customer_id, customers.name AS customer_name, customers.mobile, orders.amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type,  delivery_address.address1,delivery_address.address2,delivery_address.city,delivery_address.post_code, orders.driver_id AS driver
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

WHERE orders.start_date='$today' and job_types.id = '1' order by orders.id DESC";



$deliver_jobs = mysqli_query($con, $sql );


  $rowcount_deliver = mysqli_num_rows($deliver_jobs);
  
  
   $col_sql="SELECT orders.start_date,orders.id AS id, orders.end_date,orders.skips,orders.exchange_skip_id as exchanged_skip, orders.comments,orders.delivery_slot, order_status.name as status,orders.yard as yard,
skips.size AS skip, skips.id AS skipid, customers.id AS customer_id, customers.name AS customer_name, customers.mobile, orders.amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type,  delivery_address.address1,delivery_address.address2,delivery_address.city,delivery_address.post_code, orders.driver_id AS driver
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

WHERE orders.start_date='$today' and job_types.id = '1' order by orders.id DESC";



$col_jobs = mysqli_query($con, $col_sql );


  $rowcount_dcoll = mysqli_num_rows($col_jobs);
  
  
     $col_sql_exchange="SELECT orders.start_date,orders.id AS id, orders.end_date,orders.skips,orders.exchange_skip_id as exchanged_skip, orders.comments,orders.delivery_slot, order_status.name as status,orders.yard as yard,
skips.size AS skip, skips.id AS skipid, customers.id AS customer_id, customers.name AS customer_name, customers.mobile, orders.amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type,  delivery_address.address1,delivery_address.address2,delivery_address.city,delivery_address.post_code, orders.driver_id AS driver
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

WHERE orders.start_date='$today' and job_types.id = '3' order by orders.id DESC";



$col_sql_exchange = mysqli_query($con, $col_sql_exchange );


  $rowcount_dcoll_exchange = mysqli_num_rows($col_sql_exchange);
  
       $col_sql_wait="SELECT orders.start_date,orders.id AS id, orders.end_date,orders.skips,orders.exchange_skip_id as exchanged_skip, orders.comments,orders.delivery_slot, order_status.name as status,orders.yard as yard,
skips.size AS skip, skips.id AS skipid, customers.id AS customer_id, customers.name AS customer_name, customers.mobile, orders.amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type,  delivery_address.address1,delivery_address.address2,delivery_address.city,delivery_address.post_code, orders.driver_id AS driver
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

WHERE orders.start_date='$today' and job_types.id = '4' order by orders.id DESC";



$col_sql_wait = mysqli_query($con, $col_sql_wait );


  $rowcount_dcoll_wait = mysqli_num_rows($col_sql_wait);



?>
<html>

<head>
    <meta charset="utf-8">
    <title>SkipTrak Software for Skip Hire Business</title>
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Hind|Anton|Chewy|Bangers|Montserrat:400,700'
        rel='stylesheet' type='text/css'>


</head>

<body style="font-family:Montserrat;">

    <!-- page start-->
    <div class="clearfix">&nbsp;</div>
    <div class="row" style="margin: 0">
        <section class="panel">
            <header class="panel-heading bg-info">
                <H1 style="text-align:center;"> Welcome to Skip Easy - A Software for Skip Hire Industry</H1>
            </header>
            <div class="panel-body" style="text-align:center;">
                <div class="col-sm-6">
                    <!--<img src="images/header.JPG" class="img-responsive thumbnail"/> --->
                    </center>
                </div>
                <div class="col-sm-3">
                    <div class="clearfix">&nbsp;</div>
                    <!-- <p style="cursor: pointer; padding:20px; background-color:#5BFB1A; color:000000; font-size:20px;">Total Skips Out : 23</p><div class="clearfix">&nbsp;</div>-->
                    <p style="cursor: pointer; padding:20px; background-color:#F5D70B;  font-size:20px;">Job to deliver
                        today : <?php echo $rowcount_deliver; ?> </p>
                    <div class="clearfix">&nbsp;</div>
                    <p style="cursor: pointer; padding:20px; background-color:#087F93; font-size:20px; color:#EFED0D;">
                        Jobs to collect today : <?php echo $rowcount_dcoll; ?> </p>
                    <div class="clearfix">&nbsp;</div>
                    <p style="cursor: pointer; padding:20px; background-color:#087F93; font-size:20px; color:#EFED0D;">
                        Jobs to wait & load today : <?php echo $rowcount_dcoll_wait; ?> </p>
                    <div class="clearfix">&nbsp;</div>
                    <p style="cursor: pointer; padding:20px; background-color:#087F93; font-size:20px; color:#EFED0D;">
                        Jobs to exchange today : <?php echo $rowcount_dcoll_exchange; ?> </p>
                    <div class="clearfix">&nbsp;</div>
                    <!-- <p style="cursor: pointer; padding:20px;background-color:#8E0608; font-size:20px; color:#F9F2F2;" >Total Income: £24,890.00</p>-->
                </div>
                <!---<div class="col-md-3"><img src="images/bar-chart.png" class="img-responsive thumbnail"></div>
                   <div class="col-md-3"><img src="images/charts.png" class="img-responsive thumbnail"></div>-->

            </div>

            <center>
                <header class="panel-heading bg-primary">
                    <H5 style="text-align:center; color:ffffff; font-size:16px;">Skip Easy - Skip Hire Software -
                        Support Team - M: 07792560326 </H3>
                </header>
            </center>
        </section>


    </div>

</body>

</html>