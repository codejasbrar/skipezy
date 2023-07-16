<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Invoice</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <?php
	//include "dbfunction.php";
	include "../dbconfig.php";
	include "../navbar_list.php";
  $order_id = $_GET['order_id'];
$sql="SELECT orders.id , order_status.name as status, order_details.start_date,order_details.order_id AS order_id, order_details.end_date,order_details.skips,order_details.exchange_skip_id as exchanged_skip, skips.size AS skip, customers.id AS customer_id, customers.name AS name, customers.mobile, order_details.amount AS amount, order_details.skip_location, order_details.delivery_slot,payment_type.name as payment_status,
 job_types.name AS job_type, payment_type.name AS payment_type,  delivery_address.address1,delivery_address.address2,delivery_address.city,delivery_address.post_code, employees.name AS driver

FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN payment_type ON order_details.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON order_details.skip_id = skips.id
LEFT JOIN delivery_address ON order_details.location_id = delivery_address.id
LEFT JOIN employees ON order_details.driver_id = employees.id

WHERE order_details.order_id='$order_id'";

               
       //echo $sql;
       //exit();
       $res=mysqli_query($con,$sql);
       $invoice=mysqli_fetch_assoc($res);
              //echo $invoice['name'];
             //exit();
  ?>
    

</head>

<body>

<section id="container" class="print">
<!--header start-->
<!--header end-->
<!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
    <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-md-12">
               <div class='col-md-2'></div>
                <div class='col-md-8'>
                <section class="panel">
                    <div class="panel-body">
                    <div class="row">
                          <div class="col-md-4 col-xs-2">
                                <p><b>Delivery Address<?php echo $invoice['name'];?></b></p>
                               <p>
                                    <?php echo $invoice['name'];?><br>
                                    <?php echo $invoice['address1'];?><br>
                                    <?php echo $invoice['address2'];?><br>
                                    <?php echo $invoice['city'];?><br>
                                    <?php echo $invoice['post_code'];?><br>
                                    Phone: <?php echo $invoice['mobile'];?><br>
                                </p> 
                            
                           
                        </div>
                        
                            <div class="row invoice-to col-md-4 pull-left">
                                                               
                            </div>
                            <div class="col-md-4 pull-right">
                                <div class="row">
                                    <div class="col-md-5 col-sm-6 inv-label">Job No:</div>
                                    <div class="col-md-7 col-sm-6"><?php echo $invoice['order_id'];?></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 col-sm-5 inv-label">Date :</div>
                                    <div class="col-md-8 col-sm-7"><?php echo $invoice['start_date'];?></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 inv-label">
                                        <h3>Collect</h3>
                                    </div>
                                    <div class="col-md-12">
                                        <h1 class="amnt-value"><?php echo "£".$invoice['amount'];?></h1>
                                    </div>
                                </div>


                            </div>
                      </div>
                        <table class="table table-invoice" >
                            <thead>
                            <tr>
                      
                                <th class="text-center" style="text-align: left;">Job Type</th>
                                <th class="text-center">Skip Size</th>
                                <th class="text-center">Location</th>
                                <th class="text-center">Delivery Slot</th>
                                <th class="text-center">Payment Status</th>
                            </tr>
                            </thead>
                            <tbody>
                       
                           <?php 
                               foreach($res as $invoice1) { 
                             
                            
                            ?>
                            <tr>
                                
                                <td class="text-center"><?php echo $invoice1['job_type'];?></td>
                                <td class="text-center"><?php echo $invoice1['skip'];?></td>
                                <td class="text-center"><?php echo $invoice1['skip_location'];?></td>
                                <td class="text-center"><?php echo $invoice1['delivery_slot'];?></td>
                                <td class="text-center"><?php echo $invoice1['payment_status'];?></td>
                            </tr>
                              <?php 
                               }
                           ?>
                            </tbody>
                        </table>
                       <div class="row">
                       <div class="col-md-4">
                        <h4>Additional Notes:</h4>
                                  <p><?php ?></p>
                                  </div>
                      
                       
                       <div class="col-md-4 invoice-block pull-left">
                                <ul class="unstyled amounts">
                                    <li style="text-align:left">Delivered at:</li>
                                    <li style="text-align:left">Signed:</li>
                                    <li style="text-align:left">Print Name:</li>
                                </ul>
                            </div>
                       </div>
                        <div class="row">
                            <div class="col-md-8 col-xs-7 payment-method">
                               
                                <h3 class="inv-label itatic">Thank you for your business</h3>
                                <div class="invoice-btn col-md-3">
                            
                            
                        </div>
                         
                        
                                </div>
                            </div>
                          
                        </div>

                  </section>      

                    </div>
                
                </div>
               <div class='col-md-2'></div>
            </div>
       
        <!-- page end-->
    </section>
</section>
    <!--main content end-->
<!--right sidebar start-->

<!--right sidebar end-->

</section>

<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->
<script src="js/jquery.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>

<!--common script init for all pages-->
<script src="js/scripts.js"></script>
<script type="text/javascript">
    window.print();
</script>
</body>
</html>
