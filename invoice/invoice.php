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
  $invoice_no = $_GET['invoice_no'];
  $sql = "SELECT invoices.invoice_no, customers.name,customers.address1,customers.address2,customers.city,customers.post_code,customers.mobile,customers.email,
  invoice_details.sub_total as sub_total,invoice_details.qty,invoice_details.unit_price,invoice_details.srno, invoices.nett,invoices.paid,invoices.vat,     invoices.notes,invoices.due,invoices.gross,invoices.address1 as invoice_address1,invoices.address2 as invoice_address2,invoices.city as invoice_city,invoices.post_code as invoice_post_code,
  
  skips.size 
  FROM invoices
               LEFT JOIN customers ON invoices.customer_id = customers.id
               LEFT JOIN invoice_details ON invoices.invoice_no = invoice_details.invoice_no
               LEFT JOIN skips ON invoice_details.item_id= skips.id
               WHERE invoices.invoice_no =$invoice_no";
               
       //echo $sql;
       //exit();
       $res=mysqli_query($con,$sql);
       $invoice=mysqli_fetch_assoc($res);
              //echo $invoice['name'];
             //exit();
  ?>
    

</head>

<body>

<section id="container">
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
                    <div class="panel-body invoice">
                        
                            <div class="row invoice col-md-10 col-xs-2">
                                <h2>Invoice</h2>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row invoice-info col-md-7 col-xs-10">

                                <div class="pull-right">
                                    <div class="col-md-6 col-sm-6 pull-left">
                                    <p>From </p>
                                    <p><b>Skip Hire Ltd. </b></p>
                                        <p>89 Uxbridge Avenue </p><p>Uxbridge</p>
                                            UB4 8QW</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 pull-right">
                                        <p>Phone: 0208 848 xx <br>
                                            Email : abc@hotmail.com</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row invoice-to">
                            <div class="col-md-4 col-sm-4 pull-left">
                                <h4>To</h4>
                                <p>
                                    <?php echo $invoice['name'];?></p><p>
                                    <?php 
									if($invoice['address1']==""){
										echo $invoice['invoice_address1'];
										}
										else
										{
									echo $invoice['address1'];
                                    }?></p><p>
                                    <?php 
									if($invoice['address2']==""){
										echo $invoice['invoice_address2'];
										}
										else
										{
									echo $invoice['address2'];
                                    }?></p><p>
                                    <?php 
									if($invoice['city']==""){
										echo $invoice['invoice_city'];
										}
										else
										{
									echo $invoice['city'];
                                    }?>
                                    </p><p>
									<?php 
									if($invoice['post_code']==""){
										echo $invoice['invoice_post_code'];
										}
										else
										{
									echo $invoice['post_code'];
                                    }?>
                                    
                                </p>
                            </div>
                            <div class="col-md-4 col-sm-5 pull-right">
                                <div class="row">
                                    <div class="col-md-5 col-sm-6 inv-label">Invoice No:</div>
                                    <div class="col-md-7 col-sm-6"><?php echo $invoice['invoice_no'];?></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 col-sm-5 inv-label">Date :</div>
                                    <div class="col-md-8 col-sm-7"><?php echo date('d-m-Y');?></div>
                                </div>
                                <br>
                            </div>
                        </div>
                        <table class="table table-invoice" border="1" >
                            <thead>
                            <tr>
                      
                                <th class="text-center" style="text-align: left;">Sr.No</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                       
                           <?php 
                               foreach($res as $invoice1) { 
                             
                            
                            ?>
                            <tr>
                                
                                <td class="text-center"><?php echo $invoice1['srno'];?></td>
                                <td class="text-center"><?php echo $invoice1['size'];?></td>
                                <td class="text-center"><?php echo $invoice1['qty'];?></td>
                                <td class="text-center"><?php echo "£".$invoice1['unit_price'];?></td>
                                <td class="text-center"><?php echo "£".$invoice1['nett'];?></td>
                            </tr>
                              <?php 
                               }
                           ?>
                            </tbody>
                        </table>
                       
                        <div class="row">
                            <div class="col-md-8 col-xs-7 payment-method">
                                <h4>Additional Notes:</h4>
                                  <p><?php echo $invoice['notes'];?></p>
                                <br>
                                <center>
                                <div class="col-md-4">
                       <a id="print" href="invoice_print.php?invoice_no=<?php echo $invoice_no;?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice </a>
                            <h5> Please only print if necessary, think about envoirnment</h5>
                       
                       </div>
                                <h3 class="inv-label itatic">Thank you for your business</h3>
                                </center>
                            </div>
                          <div class="col-md-4 col-xs-5 invoice-block pull-right">
                                <ul class="unstyled amounts">
                                    <li>Nett : <?php echo "£".$invoice['nett'];?></li>
                                    <li>VAT @ 20% : <?php echo "£".$invoice['vat'];?></li>
                                    <li class="grand-total">Gross Total : <?php echo "£".$invoice['gross'];?></li>
                                </ul>
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

</body>
</html>
