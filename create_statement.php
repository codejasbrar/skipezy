<meta charset="utf-8">

<title>List of Orders</title>
<!doctype html>

<html>

<head>

    <?php

include "dbconfig.php";

//include "css_header.php";
// include "navbar_list.php";
include "navbar.php";
 include "dynamic_table.php";
//Get the order data for this order.

$customer_id=$con->real_escape_string($_POST['customer_id']);

$customer_sql = "SELECT orders.id AS order_id, orders.start_date as start_date, orders.end_date , skips.size AS skip, customers.name AS customer_name, customers.mobile, customers.address1,customers.city, customers.post_code, orders.amount AS total_amount,orders.amount_paid AS amount_paid, job_types.name AS job_type, payment_type.name AS payment_type, order_status.name AS order_status
from orders
LEFT JOIN customers ON orders.customer_id = customers.id
LEFT JOIN job_types ON orders.job_type = job_types.id
LEFT JOIN payment_type ON orders.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON orders.skip_id = skips.id
WHERE customers.id = $customer_id";


$result = mysqli_query($con, $customer_sql);
$result1 = mysqli_query($con, $customer_sql);
/////////// we extract the variable for writing customer name ///////////////////
$customer = mysqli_fetch_assoc($result1)
?>
    <style>
    table#invoices tbody tr {
        cursor: pointer;
    }
    </style>
</head>

<body style="font-family:Montserrat; font-size:13px;">


    <div class="col-md-12" style="margin-top:50px;">

        <table id="customers" class="table table-bordered" cellspacing="0" width="100%">

            <thead>

                <tr class="btn-primary">

                    <th>Job ID</th>
                    <th>Date</th>
                    <th>Job</th>
                    <th>Days</th>
                    <th>Skip Size</th>

                    <th>Total</th>
                    <th>Total Paid</th>
                    <th>Payment</th>
                    <th>Status</th>

                </tr>
                <tr>
                    <td colspan="9">
                        <h4>
                            <center>Statement of <?php echo $customer['customer_name'] ;?> </center>
                        </h4>
                    </td>
                </tr>
            </thead>

            <tfoot>

                <tr class="btn-primary">
                    <th>Job ID</th>
                    <th>Date</th>
                    <th>Job</th>
                    <th>Days</th>
                    <th>Skip Size</th>

                    <th>Total</th>
                    <th>Total Paid</th>
                    <th>Payment</th>
                    <th>Status</th>

                </tr>

            </tfoot>

            <tbody>

                <?php
while ($job = mysqli_fetch_assoc($result)) {
   ?>

                <td><?php echo $job['order_id']; ?></td>
                <td><?php
                           $start_date = new DateTime($job['start_date']);

                           echo $start_date->format("d F, Y")
                           ?></td>
                <td><?php echo $job['job_type']; ?></td>

                <?php
   $today = new DateTime();
   $no_of_days = $today->diff($start_date)->format("%a");
   if ($no_of_days > 30) {
      ?>
                <td><?php echo $no_of_days; ?></td>
                <?php } else { ?>
                <td><?php echo $no_of_days; ?></td>
                <?php } ?>

                <td><?php echo $job['skip']; ?></td>

                <td><?php echo "" . $job['total_amount']; ?></td>
                <td><?php echo "" . $job['amount_paid']; ?></td>

                <?php if ($job['total_amount'] == $job['amount_paid']) { ?>
                <td bgcolor="green" style="color: #f7f7f7; font-weight: 600">Fully Paid</td>
                <?php } elseif ($job['amount_paid'] == 0) { ?>
                <td bgcolor="red" style="color: #f7f7f7; font-weight: 600">Not Paid</td>
                <?php } else { ?>
                <td bgcolor="orange" style="color: #f7f7f7; font-weight: 600">Part Paid</td>
                <?php } ?>

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
        $('#customers').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'print'
            ]
        });
    });
    </script>


</body>

</html>