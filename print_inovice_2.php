<html>
   <head>
      <meta charset="utf-8">
<title>Untitled Document</title>
      <style>
         .top
         {
           width: 100%;
           float: left;
           height: auto;
         }
         .top_heading
         {
            width:30%;
            margin-left:10%;
            float: left;
            height: auto;
            font-size:30px;
         }
         .top_date
         {
            width:20%;
            margin-left:35%;
            float: left;
            height: auto;
            font-size:20px;
         }
         .container
         {
            width: 100%;
            float: left;
            height: auto;
         }
          .container1
         {
            width: 30%;
            float: left;
            height: auto;
            margin-left: 3%;
         }
          .container2
         {
            width: 30%;
            float: left;
            height: auto;
            margin-left: 2%;
         }
          .container3
         {
            width: 30%;
            float: left;
            height: auto;
            margin-left: 3%;
         }
         .table
         {
            width: 100%;
            float: left;
            height: auto;
         }
          .table1
         {
            width: 15%;
            float: left;
            height: auto;
            margin-left:5%;
         }
          .table2
         {
            width: 15%;
            float: left;
            height: auto;
            margin-left:5%;
         }
          .table3
         {
            width: 15%;
            float: left;
            height: auto;
            margin-left:5%;
         }
          .table4
         {
            width: 15%;
            float: left;
            height: auto;
            margin-left:5%;
         }
          .table5
         {
            width: 15%;
            float: left;
            height: auto;
            margin-left:5%;
         }
          .bottom
         {
            width: 100%;
            float: left;
            height: auto;
         }
         .bottom1
         {
            width: 30%;
            float: left;
            height: auto;
            margin-left: 20%;
         }
          .bottom2
         {
            width: 20%;
            float: left;
            height: auto;
            margin-left: 10%;
            margin-right: 20%;
         }
      </style>
      
	<?php
	include "dbfunction.php";
	include "dbconfig.php";
    
	$invoice_number=$_GET['invoice_no'];
	$condition = array();

	$condition['invoice_no'] = $invoice_number; 

	$invoices = selectWhere($con,'invoices',$condition);
//print_r($invoices);
	//--------------

	$condition = array();

	$condition['invoice_no'] = $invoices[0]['invoice_no'];

	$customer = selectWhere($con,'invoices',$condition);
	//echo "<br>".$customer[0]['name'];
//print_r($customer);
	//--------

	$condition = array();

	$condition['invoice_no'] = $invoices[0]['invoice_no']; 

	$invoice_details = selectWhere($con,'invoice_details',$condition);

	//print_r($invoice_details);
	$condition = array();

	$condition['id'] = $customer[0]['customer_id'];

	$customer_details = selectWhere($con,'customers',$condition);
	//print_r($customer_details);
?>
   </head>
   <body>
   <div id="printableArea">
      <form method="post">
         <div class="top">
            <div class="top_heading"><strong>Sunrise Skips Ltd</strong></div>
            <div class="top_date">Date: <?php echo date('d-m-Y');?></div>
         </div>
         <div>&ensp;</div>
            <hr>
            <div class="container">
               <div class="container1">
                  <strong>Invoice From</strong>
                  <strong>Sunrise Skips Ltd</strong>
                  <strong>1 Uxbridge Road Hayes ub4 0ry.</strong>
                  <strong>Phone: xxxxx</strong>
                  <strong>Email: xxxxxxx</strong>
               </div>
               <div class="container2">
                  <p>Invoice To</p>
                  <p><?php echo @$customer_details[0]['name'];?></p>
                  <p><?php echo @$customer[0]['address1'];?></p>
                  <p><?php echo @$customer[0]['address2'];?></p>
                  <p><?php echo @$customer[0]['city'];?></p>
                  <p> <?php echo @$customer[0]['post_code'];?></p>
               </div>
               <div class="container3">
                  <p>Invoice Date<?php echo " ".@date('d-m-Y',strtotime(date('d-m-Y')));?></p>
                  <p>Invoice No.:</b> <?php echo " ".@$invoices[0]['invoice_no'];?></p>
                  <p>Payment Due:</b><?php echo " ".@date('d-m-Y',strtotime(date('d-m-Y'). '+15 day'));?></p>
               </div>
            </div>
            <div class="table">
               <div class="table1">Sr.No</div>
               <div class="table2">Item</div>
               <div class="table3">Quantity</div>
               <div class="table4">Price</div>
               <div class="table5">Subtotal</div>
               
            </div>
            <br>
            <?php

               $count = count($invoice_details);
                //echo $count;

               for ($i = 0; $i < $count; $i++) {

                       // -------------------Get the item name
                       //echo $invoice_details[$i]['item_id'];;
                       $condition='';
                       $condition['id'] = $invoice_details[$i]['item_id']; 
                       $skips = selectWhere($con,'skips',$condition);
                       //print_r($skips);
             ?>
            <div class="table">
               
               <div class="table1"><?php echo $invoice_details[$i]['srno'];?></div>
               <div class="table2"><?php echo $invoice_details[$i]['srno'];?></div>
               <div class="table3"><?php echo $skips[0]['size'] ;?></div>
               <div class="table4"><?php echo $invoice_details[$i]['qty'];?></div>
               <div class="table5"><?php echo "£".number_format($invoice_details[$i]['unit_price'],2);?></div>
               
            </div>
            <?php }?>
            <div class="bottom">
               <h4><center>Amount Due on:<?php echo @date('d-m-Y',strtotime(date('d-m-Y'). '+30 day'));?></center></h4><hr>
               <div class="bottom1">
                  <p>Nett:</p> 
                  <p>VAT Amt:</p>
                  <p>Gross:</p>  
               </div>
                <div class="bottom2">
                   <p><?php echo "£".number_format(@$invoices[0]['nett'],2);?></p>
                   <p><?php echo "£".number_format(@$invoices[0]['vat'],2);?></p>
                   <p><?php echo "£".number_format(@$invoices[0]['gross'],2);?></p>
                </div>
            </div>
            <p>Sunrise Skips Limited - Company Number xxxxxx</p>
<p>Reg Office - 89 Woodrow Avenue, Hayes, UB8 7JK</p>
      </form>
      
      <a href="javascript:void(0);" onclick="printPageArea('printableArea')">Print</a>

      <script type="text/jscript">
function printPageArea(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=900,height=650');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
</script>
</div>
   </body>
</html>