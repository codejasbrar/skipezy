
<meta charset="utf-8">

<title>List of Orders</title>
<!doctype html>

<html>

<head>
  
<?php

include "dbconfig.php";

//include "css_header.php";
include "navbar_list.php";
 include "dynamic_table.php";
//Get the order data for this order.

$sql="SELECT invoices.invoice_no,invoices.date, invoices.customer_id, customers.name,customers.mobile, invoices.sub_total, invoices.vat, invoices.nett, invoices.permit, invoices.gross, invoices.paid, invoices.due, invoices.status
FROM invoices
LEFT JOIN customers ON invoices.customer_id = customers.id 
LEFT JOIN invoice_details ON invoice_details.invoice_no = invoices.invoice_no 

";


$res=mysqli_query($con,$sql);

//echo $sql;

?>
<style>
table#invoices tbody  tr {
    cursor : pointer;
}
 </style>
 </head>

<body style="font-family:Montserrat; font-size:13px;">

               <h4><center>List Of All Invoices</center></h4>
      <div class="col-md-12" style="margin-top:50px;">
         <table style="font-family:Montserrat; font-size:13px; cursor:pointer;" id="invoices" class="table table-striped table-bordered table-hover bordered" cellspacing="0">

        <thead>

            <tr class="btn-primary">

                           <th>Invoice Number</th>
                           <th>Date</th>
                           <th>Customer</th>
                           <th>Age</th>
                           <th>Amount</th>
                           <th>VAT</th>
                           <th>Nett</th>
                           <th>Permit</th>
                           <th>Gross</th>
                           <th>Amount Paid</th>
                           <th>Balance Due</th>
                           <th>Paid</th>
                          
                           <th>View/Print</th>
                           <th>Delete</th>
            </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary">
                          <th>Invoice Number</th>
                           <th>Date</th>
                           <th>Customer</th>
                           <th>Age</th>
                           <th>Amount</th>
                           <th>VAT</th>
                           <th>Nett</th>
                           <th>Permit</th>
                           <th>Gross</th>
                          <th>Amount Paid</th>
                           <th>Balance Due</th>
                           <th>Paid</th>
                          
                           <th>View/Print</th>
                           <th>Delete</th>
            </tr>

        </tfoot>

        <tbody >

        <?php

                while($invoice=mysqli_fetch_assoc($res))

                  {

                  

                                    
  ?>               

                           <td><?php echo $invoice['invoice_no'];?></td>
                           <td>
						   <?php $start = date("d/m/y", strtotime($invoice['date'])); 
						   
						   echo $start  ;?></td>
                            <td><?php echo $invoice['name']." <br><b>M: ".$invoice['mobile']."</b>";?></td>
                           <?php
						   $start_date = new DateTime($invoice['date']); 
               
               $today = new DateTime();
               $no_of_days = $today->diff($start_date)->format("%a"); 
               if($no_of_days>20){?>
               <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo "Raised ".$no_of_days." days ago";?></td>  
               <?php }else{?>
               <td><?php echo "Raised ".$no_of_days." days ago";?></td>  
              <?php }   ?>
                        
                           <td><?php echo "£".$invoice['sub_total'];?></td>
                           <td><?php echo "£".$invoice['vat'];?></td>
                           <td><?php echo "£".$invoice['nett'];?></td>
                           <td><?php echo "£".$invoice['permit'];?></td>
                           <td><?php echo "£".$invoice['gross'];?></td>
                           <td><?php echo "£".$invoice['paid'];?></td>
						   <td><?php echo "£".$invoice['due'];?></td>
                           
                          <?php 
						   
						   
						   $status=$invoice['status'];?>
                           <?php
                           if($status=='Y'){?>
                           <td bgcolor="#0C9402" style="color:#F7F4F4;" ><?php echo $invoice['status'];?></td>
                           <?php }elseif($status=='N'){?>
                           <td style="color:#F7F4F4; background-color:#D30D11;"><?php echo $invoice['status'];}?></td>
                           
                           
                 
               
                
                                          
                           <td><a href="print_invoice.php?invoice_no=<?php echo $invoice['invoice_no'];?>"><i class="glyphicon glyphicon-print"></i></a></td>
                           <td><a href="delete_invoice.php?id=<?php echo $invoice['invoice_no'];?>"><i class="glyphicon glyphicon-trash"></i>
                </a></td>

                

            </tr>

            

      <?php           

        }

                

        ?>

            

            </tbody>

    </table>

    </div>


<script type="text/javascript">

  $(document).ready(function() {
    $('#invoices').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
			'print'
			        ]
    } );
} );

</script>


</body>
</html>