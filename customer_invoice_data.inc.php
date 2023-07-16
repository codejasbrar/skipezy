
<?php

$sql="SELECT invoices.invoice_no,invoices.date, invoices.customer_id, customers.name,customers.mobile, invoices.sub_total, invoices.vat, invoices.nett, invoices.permit, invoices.gross, invoices.paid, invoices.due, invoices.status
FROM invoices
LEFT JOIN customers ON invoices.customer_id = customers.id
WHERE customers.id=$customer_id order by invoices.date ASC";

$res=mysqli_query($con,$sql);

echo $sql;

?>
          
          </div>
   </div>
  <div class="row">
      <div class="col-md-12">
        <table  style="font-family:Montserrat; font-size:13px;" id="invoices" class="table table-striped table-bordered table-hover" cellspacing="0">

        <thead>

            <tr class="btn-primary">

                           <th>Invoice Number</th>
                           <th>Date</th>
                           <th>Age</th>
                           <th>Amount</th>
                           <th>VAT</th>
                           <th>Nett</th>
                           <th>Permit</th>
                           <th>Gross</th>
                           <th>Amount Paid</th>
                           <th>Balance Due</th>
                           <th>Paid</th>
                          
                           <th>Edit</th>
                           <th>View</th>
                           <th>Delete</th>
            </tr>

        </thead>

        <tfoot>

            <tr class="btn-primary">
                          <th>Invoice Number</th>
                           <th>Date</th>
                           <th>Age</th>
                           <th>Amount</th>
                           <th>VAT</th>
                           <th>Nett</th>
                           <th>Permit</th>
                           <th>Gross</th>
                           <th>Amount Paid</th>
                           <th>Balance Due</th>
                           <th>Paid</th>
                          
                           <th>Edit</th>
                           <th>View</th>
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
                           
                           
                 
               
                
                                          
                           <td><a href="edit_order.php?cid=<?php echo $invoice['order_id'];?>"><i class="glyphicon glyphicon-check"></i></a></td>
                           <td><a href="edit_customer.php?id=2&order_id=<?php echo $invoice['id'];?>"><i class="glyphicon glyphicon-user"></i></a></td>
                           <td><a href="delete_invoice.php?id=<?php echo $invoice['id'];?>"><i class="glyphicon glyphicon-trash"></i>
                </a></td>

                

            </tr>

            

      <?php           

        }

                

        ?>

            

            </tbody>

    </table>

    </div>

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

