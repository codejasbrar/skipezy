<?php

ob_start();
include "navbar.php";
include "dbconfig.php";
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<form method="post" action="">
	<div class="container-fluid" style="margin-top:200x;">
	  <label><h2> Skip Tipping Report</h2></label>
			      <div class="well col-md-12" style="background-color:#e9e9e9; box-shadow: 5px 5px 5px;">
			       	 
                       
                       <div class="col-md-2">
 						<input type="text" name="from" class="from form-control" placeholder="Date From" id="from">
                     </div>
                       <div class="col-md-2">
                        <input type="text"  name="to" class="to form-control" placeholder="Date To" id="to">
             		 </div>
        
                       <div class="col-md-1">
                       	  <input type="submit" id="select_jobs" class="btn btn-warning" value="Search Jobs">
                       </div>
                       <div class="col-md-2">
                       <input type="button" class="btn btn-primary btn-sm" onclick="printDiv('invoice')" value="Print" /> 
                       </div>
                       <!--
                       <div class="col-md-2">
                          <input type="button" name="btn" value="Print Invoices" id="filter_invoice" data-toggle="modal" data-target="#confirm-submit" class="btn btn-success btn-sm pull-right" />
                       </div>
			       	   -->
                    <!-- now retrieve the transactions of this customer -->
                   </div>
                 			
</div>
				  
			    
</form>
   <?php
$sql='';
$sql="SELECT orders.start_date, orders.id AS order_id, orders.end_date,orders.skips, skips.size AS size, customers.name AS customer_name, customers.mobile, customers.address1,customers.city, customers.post_code, orders.amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type, order_status.name AS order_status,orders.tip_date,
yards.name as yard,employees.name as driver,vehicles.reg_plate as lorry
FROM orders

LEFT JOIN customers ON orders.customer_id = customers.id
LEFT JOIN job_types ON orders.job_type = job_types.id
LEFT JOIN payment_type ON orders.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON orders.skip_id = skips.id
LEFT JOIN yards ON orders.tip_yard_id = yards.id
LEFT JOIN vehicles ON orders.tip_lorry_id = vehicles.id
LEFT JOIN employees ON orders.tip_driver_id = employees.id
left join delivery_address on orders.address_id=delivery_address.id

WHERE orders.status=2 AND orders.tip_status=2

";
$today= date('Y-m-d');
$from="";
$to="";
$company='';
if (!mysqli_query($con,$sql)) {
						echo $sql;		
								die('Tipping SQL 5 INTO orders -Error: ' . mysqli_error($con));
								}
if (!empty($_POST['from']) && !empty($_POST['to']))
	{
	  $from=$con->real_escape_string($_POST['from']);
	  $from = str_replace("/","-",$from);
	  $from = date("Y-m-d", strtotime($from));
	  $to=$con->real_escape_string($_POST['to']);
	  $to = str_replace("/","-",$to);
	  $to = date("Y-m-d", strtotime($to));
	  $sql.=" AND orders.start_date BETWEEN '$from' AND '$to'";
	}
	



$sql.=" ORDER BY orders.id DESC
";

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);

//echo $sql;


?>
<?php
$invoice_sum=mysqli_query($con,$sql);
$total_skips=mysqli_num_rows($invoice_sum);
$res=mysqli_query($con,$sql);

//echo $sql;
?>

</head>

<body> 	
                
                       <?php $invoice_html=
					 '   
					 <!doctype html>
					  <html>
					  <head>
					  <meta charset="utf-8">	
                     <div id="invoice">
					 <h2>Total Skips Tipped:'.$total_skips.'</h2>
				   <table  style="font-family:Montserrat; font-size:13px;" id="jobs" class="table table-striped table-bordered table-hover" cellspacing="0">
			    		<thead class="blue-background">
						 <tr>
                           <th>Job ID</th>
                           <th>Tip Date</th>
                           <th>Skip Size</th>
                           <th>Customer</th>
                           <th>Yard</th>
                           <th>Lorry Type</th>
                           <th>Driver</th>
                           
            </tr>

        </thead>

        <tbody style="font-size:18px;">
        ';?>
       
        <?php
				$total=0;
				$total_nett=0;
				$total_vat=0;
				$total_gross=0;
                while($job=mysqli_fetch_assoc($res))
				
                  {
					  //echo $job['payment_type'];
					  //exit;
					 $order_id=$job['order_id'];
					 $date=date("d/m/Y", strtotime($job['tip_date']));
					 $size=$job['size'];
					 $customer_name=$job['customer_name'];
					 $yard=$job['yard'];
					 $lorry=$job['lorry'];
					 $driver=$job['driver'];
					
					 ?>
                      
                     <?php
					 
					 $invoice_html.=
					 '
					 <tr>
                           <td><p>'.$order_id.'</p></td>
						   <td><p>'.$date.'</p></td>
						   <td><p>'.$size.'</p></td>
						   <td><p>'.$customer_name.'</p></td>
						   <td><p>'.$yard.'</p></td>
						   <td><p>'.$lorry.'</p></td>
						   <td><p>'.$driver.'</p></td>
						   
						   
					</tr>';
				 } ?>
                 <?php 
				
				 $invoice_html.='
			
					   
					</tbody>
				 </table>
				</div>
					 
               ';?>
			
				   <?php 
				   
				   echo 
				   '<div class="col-md-8" id="invoice_div" style="margin-left:20px;">'.$invoice_html.'</div>'
				  
				   ;?>
<script>
 	$('#to').datepicker({
	
    	onSelect: function() {
			
                $( "#to" ).datepicker( "option", "dateFormat","dd/mm/yy");
		
        }
        });
	$('#from').datepicker({
	
    	onSelect: function() {
			
                $( "#from" ).datepicker( "option", "dateFormat","dd/mm/yy");
		
        }
        });	
 </script>				  
                   <script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
                   </script>