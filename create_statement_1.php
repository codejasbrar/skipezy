
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

$customer_id=$con->real_escape_string($_POST['customer_id']);

$customer_sql = "SELECT orders.id AS order_id, order_details.start_date as start_date, order_details.end_date , skips.size AS skip, customers.name AS customer_name, customers.mobile, customers.address1,customers.city, customers.post_code, orders.total_amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type, order_status.name AS order_status
FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN payment_type ON order_details.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON order_details.skip_id = skips.id
WHERE customers.id = $customer_id";
//echo $customer_sql;
$result = mysqli_query($con, $customer_sql);

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
         <table id="customers" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">

                     <thead>

                        <tr class="btn-primary">

                           <th>Job ID</th>
                           <th>Start Date</th>
                           <th>End Date</th>
                           <th>Total Days</th>
                           <th>Skip Size</th>

                           <th>Total</th>
                           <th>Job Type</th>
                           <th>Payment</th>
                           <th>Status</th>

                        </tr>

                     </thead>

                     <tfoot>

                        <tr class="btn-primary">
                           <th>Job ID</th>
                           <th>Start Date</th>
                           <th>End Date</th>
                           <th>Total Days</th>
                           <th>Skip Size</th>

                           <th>Total</th>
                           <th>Job Type</th>
                           <th>Payment</th>
                           <th>Status</th>

                        </tr>

                     </tfoot>

                     <tbody >

<?php
while ($job = mysqli_fetch_assoc($result)) {
   ?>               

                        <td><?php echo $job['order_id']; ?></td>
                        <td><?php
                           $start_date = new DateTime($job['start_date']);

                           echo $start_date->format("d F, Y")
                           ?></td>
                        <td><?php
                           $end_date = new DateTime($job['end_date']);

                           echo $end_date->format("d F, Y")
                           ?></td>
   <?php
   $today = new DateTime();
   $no_of_days = $today->diff($start_date)->format("%a");
   if ($no_of_days > 30) {
      ?>
                           <td bgcolor="#F30105"><?php echo $no_of_days; ?></td>  
                           <?php } else { ?>
                           <td><?php echo $no_of_days; ?></td>  
                           <?php } ?>

                        <td><?php echo $job['skip']; ?></td>

                        <td bgcolor="#08E006"><?php echo "£" . $job['total_amount']; ?></td>
                        <td><?php echo $job['job_type']; ?></td>
                        <?php if ($job['payment_type'] == 'Not Paid') { ?>
                           <td bgcolor="#F30105" style="color:#F7F4F4;"><?php echo $job['payment_type']; ?></td>  
                        <?php } elseif ($job['payment_type'] == 'Fully Paid') { ?>
                           <td bgcolor="#0C9402" style="color:#F7F4F4;" ><?php echo $job['payment_type']; ?></td>  
                        <?php } else { ?><td><?php echo $job['payment_type']; ?></td><?php } ?>
                        <td><?php echo $job['order_status']; ?></td>



                        </tr>



                        <?php
                     }
                     ?>



                     </tbody>

                  </table>

    </div>


<script type="text/javascript">

  $(document).ready(function() {
    $('#customers').DataTable( {
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