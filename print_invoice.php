<?php
ob_start();
include "navbar.php";?>
    <?php
	//include "dbfunction.php";
	include "dbconfig.php";
  $invoice_no =$_GET['invoice_no'];
 $sql="SELECT invoices.invoice_no,invoices.date as invoice_date, invoices.customer_id, customers.name,customers.address1,customers.post_code,customers.mobile, invoices.sub_total, invoices.vat, invoices.nett, invoices.permit, invoices.gross, invoices.paid, invoices.due, invoices.status,skips.size as item,invoice_details.unit_price,invoice_details.qty as quantity
FROM invoices
LEFT JOIN customers ON invoices.customer_id = customers.id 
LEFT JOIN invoice_details ON invoice_details.invoice_no = invoices.invoice_no 
LEFT JOIN skips ON invoice_details.item_id = skips.id 
WHERE invoices.invoice_no=".$invoice_no;
//echo $sql;
$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
$client=mysqli_query($con,$sql);
$invoice=mysqli_fetch_assoc($client)
?>
<style>
table th{
	padding:12px;
}

</style>
<div class="col-md-2">
                       <input type="button" class="btn btn-primary btn-sm" onclick="printDiv('invoice')" value="Print" /> 
                       </div>
</head>

<body> 
  
  
  						<?php
  						$customer_name=$invoice['name'];
                        $address1=$invoice['address1'];
                        $post_code=$invoice['post_code'];
						$invoice_no=$invoice['invoice_no'];
						
                        $invoice_date=date("d/m/Y",strtotime($invoice['invoice_date']));
						$date='';
						?>
                       <?php $invoice_html=
					 '   
					 <!doctype html>
					  <html>
					  <head>
					  <meta charset="utf-8">
					  <div id="invoice">	
                      <table cellpadding="10" style="border:none;font-size:12px;" border="0" bordercolor="#F4EEEE">
					  
					  <tr>
						 <td> 
						  
							 <h2>Sunrise Skip Hire Ltd.</h2>
							 <p>89 Woodrow Ave,, </p>
							 <p>Hayes ,</p>
							 <p>UB4 8QW</p>
							 <p>Ph. +44(0)20 8848 7300</p>
							 
					      </td>
						  <td style="text-align:left;word-break:break-all;"> 
						  
					      </td>
						 
						 <td  style="text-align:left;"> 
						  <p><b>Details </b></p>
							 <p>Invoice No. '.$invoice_no.'</p>
							<p>Date: '.$invoice_date.'</p>
							 <p>VAT No. 1234569898</p>
							 <p>Payemnt Terms: 14 days</p>
					      </td>
						 
						  									   
						   <td class="bold-text">
						   <p><b>Invoice To </b></p>
							<p>'.wordwrap($customer_name,15).'</p>
							
							 <p>'.wordwrap( $address1, 10, "\r\n", true ) .'</p>
							 <p>'.$post_code.'</p>  
						   
						   </td>
						</tr>            
				   </table>
						        
                          
                  <table cellpadding="5" border="1">

        <thead style="background-color:#020651;text-align:left;font-size:10px; color:#fff; padding:12px;">
			
            <tr>
                           <th  width="2%">Sr. No.</th>
                           <th width="50%">Item</th>
						  <th width="10%">Quantity</th>
                           <th width="10%">Unit Price</th>
                           <th width="10%">Sub Total</th>
                           
                          
            </tr>

        </thead>

        <tbody style="text-align:left;font-size:12px;">
        ';?>
       
        <?php
				$total=0;
                while($job=mysqli_fetch_assoc($res))
				
                  {
					  
					 $item=$job['item'];
					 $quantity=$job['quantity'];
					 $price=$job['unit_price'];
					 $sub_total=$job['sub_total'];
					 
					 
					 $nett=$job['nett'];
					 $vat=$job['vat'];
					 $gross=$job['gross'];
					 ?>
                      
                     <?php
					 
					 $invoice_html.=
					 '
					 <tr valign="middle">
                           <td><p>1</p></td>
						   <td>'.$item.'</td>
						   <td><p>'.$quantity.'</p></td>
						   <td style="text-align:right;">£'.number_format($price,2).'</td>
						   <td style="text-align:right;"><p>£'.number_format($sub_total,2).'</p></td>
						   				   
						   
					</tr>';
				 } ?>
                 <?php 
				
				 $invoice_html.='
				  <tr valign="middle">
                     
						   <td style="text-align:right;font-size:12px;" colspan="4"><p><b>Sub Total: </b></td>
						   <td style="text-align:right;font-size:12px"><p>£'.number_format($nett,2).'</p></td>
						   
					   </tr>
					   <tr>
                     
						   <td style="text-align:right;font-size:12px;" colspan="4"><p><b>VAT: </b></td>
						   <td style="text-align:right;font-size:12px"><p>£'.number_format($vat,2).'</p></td>
						   
					   </tr>
					   <tr>
                     
						   <td style="text-align:right;font-size:12px;" colspan="4"><p><b>Grand Total: </b></td>
						   <td style="text-align:right;font-size:12px"><p>£'.number_format($gross,2).'</p></td>
						   
					   </tr>
					   <tr>
					   <td style="text-align:center;font-size:12px;" colspan="5"><p><b>Bank Details: xxxxxxxxx   Sort Code: xxxxx</td>
					   </tr>
					   
					</tbody>
				 </table>
				</div>
					 
               ';?>
			
				   <?php 
				   
				   echo 
				   '<div class="col-md-8" id="invoice_div" style="margin-left:20px;">'.$invoice_html.'</div>'
				  
				   ;?>
     <?php 
	 if(isset($_POST['make_invoice'])){
	 	echo "Invoice Created".number_format($gross,2);
	 }
	 ?>  
       
       
 
				   
                   <script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
                   </script>