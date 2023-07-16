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
        //$invoice_no = $_GET['invoice_no'];
       $sql = "SELECT invoices.invoice_no, customers.name, invoice_details.sub_total as invoice_total,invoice_details.qty,invoice_details.unit_price,invoice_details.srno, invoices.nett,invoices.paid,invoices.vat, invoices.due,customers.address1,customers.address2,customers.city,customers.post_code,customers.mobile,customers.email,skips.size FROM invoices
               LEFT JOIN customers ON invoices.customer_id = customers.id
               LEFT JOIN invoice_details ON invoices.invoice_no = invoice_details.invoice_no
               LEFT JOIN skips ON invoice_details.item_id= skips.id
               WHERE invoices.invoice_no ='71'";
               
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
                        <div class="invoice-header">
                            <div class="invoice-title col-md-5 col-xs-2">
                                <h3>Invoice Sunrise Skips Ltd.</h3>
                            </div>
                            <div class="invoice-info col-md-7 col-xs-10">

                                <div class="pull-right">
                                    <div class="col-md-6 col-sm-6 pull-left">
                                        <p>121 King Street, Melbourne <br>
                                            Victoria 3000 Australia</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 pull-right">
                                        <p>Phone: +61 3 8376 6284 <br>
                                            Email : info@envato.com</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row invoice-to">
                            <div class="col-md-4 col-sm-4 pull-left">
                                <h4>To</h4>
                                <p>
                                    Sunrise Skips Ltd<br>
                                    <?php echo $invoice['address1'].$invoice['address2'].$invoice['city'].$invoice['post_code']?><br>
                                    Phone: <?php echo $invoice['mobile'];?><br>
                                    Email : <?php echo $invoice['email'];?>
                                </p>
                            </div>
                            <div class="col-md-4 col-sm-5 pull-right">
                                <div class="row">
                                    <div class="col-md-4 col-sm-5 inv-label">Name</div>
                                    <div class="col-md-8 col-sm-7"><?php echo $invoice['name'];?></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 col-sm-5 inv-label">Date #</div>
                                    <div class="col-md-8 col-sm-7"><?php echo date('d-m-Y');?></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 inv-label">
                                        <h3>TOTAL DUE</h3>
                                    </div>
                                    <div class="col-md-12">
                                        <h1 class="amnt-value"><?php echo "£".$invoice['due'];?></h1>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <table class="table table-invoice" >
                            <thead>
                            <tr>
                      
                                <th class="text-center">Sr.No</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                       

                            <tr>
                                
                                <td class="text-center"><?php echo $invoice['srno'];?></td>
                                <td class="text-center"><?php echo $invoice['size'];?></td>
                                <td class="text-center"><?php echo $invoice['qty'];?></td>
                                <td class="text-center"><?php echo "£".$invoice['unit_price'];?></td>
                                <td class="text-center"><?php echo "£".$invoice['invoice_total'];?></td>
                            </tr>
                            
                            </tbody>
                        </table>
                       <table class="table table-invoice" >
                            <thead>
                            <tr>
                                <th class="text-center">SubTotal</th>
                                <th class="text-center">Paid</th>
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                
                                <td class="text-center"><?php echo "£".$invoice['invoice_total'];?></td>
                                <td class="text-center"><?php echo "£".$invoice['paid'];?></td>
                                <td class="text-center"><?php echo "£".$invoice['due'];?></td>
                            </tr>
                           

                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-8 col-xs-7 payment-method">
                                <h4>Payment Terms:</h4>
                                <p>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <p>2. Pellentesque tincidunt pulvinar magna quis rhoncus.</p>
                                <p>3. Cras rhoncus risus vitae congue commodo.</p>
                                <br>
                                <h3 class="inv-label itatic">Thank you for your business</h3>
                            </div>
                            <div class="col-md-4 col-xs-5 invoice-block pull-right">
                                <ul class="unstyled amounts">
                                    <li>Sub Total amount : <?php echo "£".$invoice['invoice_total'];?></li>
                                    <li>VAT (20%) :  <?php echo "£".$invoice['vat'];?></li>
                                    <li class="grand-total">Grand Total : <?php echo "£".$invoice['nett'];?></li>
                                </ul>
                            </div>
                        </div>

                        <div class="text-center invoice-btn">
                            <a class="btn btn-success btn-lg"><i class="fa fa-check"></i> Send Email/pdf Invoice </a>
                            <a href="inovice _print.php" target="_blank" class="btn btn-primary btn-lg"><i class="fa fa-print"></i> Print Invoice </a>
                            <h5> Please only print if necessary, think about envoirnment</h5>
                        </div>

                    </div>
                </section>
                </div>
               <div class='col-md-2'></div>
            </div>
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
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--Easy Pie Chart-->
<script src="js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="js/sparkline/jquery.sparkline.js"></script>
<!--jQuery Flot Chart-->
<script src="js/flot-chart/jquery.flot.js"></script>
<script src="js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="js/flot-chart/jquery.flot.resize.js"></script>
<script src="js/flot-chart/jquery.flot.pie.resize.js"></script>

<!--common script init for all pages-->
<script src="js/scripts.js"></script>

</body>
</html>
