<!DOCTYPE html>


<html>
<meta charset="UTF-8">

<head>
    <title></title>
    <?php
      include("navbar.php");
      include "dbconfig.php";
      //include("dynamic_table.php");
      ?>

    <style>
    table#customer tbody tr {
        cursor: pointer;
    }
    </style>

</head>


<?php
   $customer_id = $_GET['customer_id'];

   $sql = "SELECT (

SELECT sum( order_details.gross )
FROM order_details
WHERE order_details.customer_id =$customer_id
) AS gross, (

SELECT sum( transactions.amount )
FROM transactions
WHERE transactions.source_id =$customer_id
) AS paid, (

SELECT name
FROM customers
WHERE customers.id =$customer_id
) AS name";

   $result = mysqli_query($con, $sql);
   $customer = mysqli_fetch_assoc($result);
   ?>

<body style="font-family:Montserrat;">

    <input type="hidden" value="<?php echo $customer_id; ?>" id="customer_id" />
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-top: 10%;">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#home">Customer Details</a>
                    </li>
                    <li><a data-toggle="tab" href="#delivery_addresses">Delivery Addresses</a></li>
                    <li><a data-toggle="tab" href="#transactions">Payments Made</a></li>
                    <li><a data-toggle="tab" href="#jobs">Jobs Done</a></li>
                    <li><a data-toggle="tab" href="#invoice">Historic Transactions </a></li>
                    <li><a data-toggle="tab" href="#list_invoice">List of Invoices</a></li>
                </ul>
                <!-- Tab Content Goes Here -->
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active col-md-12">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <h3 style="color:#6C0203;">Personal Details of - <?php echo $customer['name']; ?></h3>
                            <form method="post">
                                <?php include "customer_data.inc.php"; ?>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <!--Customers Details Here-->
                    <div id="delivery_addresses" class="tab-pane fade">
                        <!-- Content Section -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2></h2>
                                    <div class="pull-right">
                                        <button class="btn btn-success" data-toggle="modal"
                                            data-target="#add_new_record_modal">Add New Record</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>List of Records:</h4>
                                    <div class="records_content"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /Content Section -->
                        <!-- Bootstrap Modal - To Add New Record -->
                        <!-- Modal -->
                        <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="new_address" method="post">
                                            <div class="form-group">
                                                <label for="first_name">Address</label>
                                                <input type="text" id="insert_address" placeholder="Enter Address"
                                                    class="form-control" />
                                            </div>

                                            <div class="form-group">
                                                <label for="last_name">City</label>
                                                <input type="text" id="insert_city" placeholder="Enter City"
                                                    class="form-control" />
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Post Code</label>
                                                <input type="text" id="insert_post_code" placeholder="Enter Post Code"
                                                    class="form-control" />
                                            </div>
                                            <input type="hidden" id="customer_id" value=<?php echo $customer_id; ?>
                                                class="form-control" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" onclick="addRecord()">Add
                                            Record</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal - Update User details -->
                        <div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Update</h4>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="first_name">Address</label>
                                            <input type="text" id="update_address" placeholder="Address"
                                                class="form-control" />
                                        </div>

                                        <div class="form-group">
                                            <label for="last_name">City</label>
                                            <input type="text" id="update_city" placeholder="City"
                                                class="form-control" />
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Post Code</label>
                                            <input type="text" id="update_post_code" placeholder="Post Code"
                                                class="form-control" />
                                        </div>
                                        <input type="hidden" id="record_id">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary"
                                            onclick="UpdateUserDetails()">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- // Modal -->
                    </div>
                    <!--Customers Details Here-->
                    <div id="transactions" class="tab-pane fade">
                        <h3>Transactions History of <?php echo $customer['name']; ?> </h3>
                        <div class="container-fluid col-md-8">

                            <div class="panel">

                                <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                                    <div class="panel-heading">
                                        <center>Payments Made</center>
                                    </div>
                                </div>
                                <div class="panel-body" style="background-color:#e9e9e9; box-shadow: 5px 5px 5px;">

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="btn-primary">
                                                <th>Total Bill</th>
                                                <th>Total Paid</th>
                                                <th>Balance Due</th>
                                            </tr>
                                        </thead>
                                        <tbody id="transactions">
                                            <tr class="info">
                                                <td><?php echo "£" . $customer['gross']; ?></td>

                                                <?php
                                                    $gross = $customer['gross'];
                                                    $paid = $customer['paid'];
                                                    $balance = $gross - $paid;

                                                    if ($balance == $gross) {
                                                    echo'<td bgcolor="#F53235"> Nothing Recieved</td>';
                                                    } else {
                                                ?>

                                                <td><?php echo "£" . number_format($paid, 2); ?></td>
                                                <?php } ?>

                                                <td><?php echo "£" . number_format($balance, 2); ?></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php
                              $customer_sql = "SELECT transaction_date,amount from transactions where source_id=$customer_id order by transaction_date ASC";
                              $result = mysqli_query($con, $customer_sql);
                              ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="btn-primary">
                                                <div class="row">
                                                    <th>Date</th>
                                                </div>
                                                <div class="row">
                                                    <th>Amount Paid</th>
                                                </div>
                                            </tr>
                                        </thead>
                                </div>
                                <div class="row">
                                    <tbody>
                                        <?php
                                 while ($transaction = mysqli_fetch_assoc($result)) {
                                    ?>

                                        <?php $transaction_date = new DateTime($transaction['transaction_date']);
                                    ?>
                                        <tr>
                                            <div class="row">
                                                <td><?php echo $transaction_date->format("d F, Y"); ?></td>
                                            </div>
                                            <div class="row">
                                                <td><?php echo "£" . $transaction['amount']; ?></td>
                                            </div>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </div>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Transactions Tab Starts Here -->

                </div>

                <!-- jobs Done Tab Starts Here -->
                <div id="jobs" class="tab-pane fade">
                    <h3>Jobs Done for <?php echo $customer['name']; ?> </h3>
                    <?php
$customer_sql = "SELECT orders.id AS order_id, order_details.start_date as start_date, order_details.end_date , skips.size AS skip, customers.name AS customer_name, customers.mobile, customers.address1,customers.city, customers.post_code, orders.total_amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type, order_status.name AS order_status
FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN payment_type ON order_details.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON order_details.skip_id = skips.id
WHERE customers.id = $customer_id";
$result = mysqli_query($con, $customer_sql);
?>


                    <table id="customers" class="table table-striped table-bordered table-hover" cellspacing="0"
                        width="100%">

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

                        <tbody>

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
                            <td bgcolor="#0C9402" style="color:#F7F4F4;"><?php echo $job['payment_type']; ?></td>
                            <?php } else { ?><td><?php echo $job['payment_type']; ?></td><?php } ?>
                            <td><?php echo $job['order_status']; ?></td>



                            </tr>



                            <?php
                     }
                     ?>



                        </tbody>

                    </table>


                </div>

                <!-- jobs Done Tab Ends Here -->

                <!-- edit custoemr starts here -->

                <!-- edit customer ends here -->

                <!-- Create Invoice starts here -->
                <div id="invoice" class="tab-pane fade">
                    <h4>Serch Job Between Dates</h4>
                    <div class="col-md-8">
                        <div class="panel">
                            <div class="panel-body" style="background-color:#e9e9e9;">

                                <div class="form-group col-md-4">
                                    <label for="area">Date From </label>
                                    <input type="text" name="start_date" class="form-control" name="start_date"
                                        id="start_date" placeholder="Select a Date">

                                </div>
                                <div class="form-group col-md-4">
                                    <label for="area">Date To</label>
                                    <input type="text" name="end_date" class="form-control" id="end_date"
                                        placeholder="Select a Date">

                                </div>
                                <div class="form-group col-md-3 pull-right">
                                    <p style="padding:15px; margin-top:10px; font-size:16px;" name="create_invoice"
                                        class="btn btn-success btn-sm" id="create_invoice">Search Transactions</p>

                                </div>

                            </div>
                        </div>

                        <div id="invoice_details"></div>
                    </div>

                </div>

                <!-- Create Invoicer ends here -->
                <div id="list_invoice" class="tab-pane fade">
                    <h3 style="color:#6C0203;">Invoices Raised for - <?php echo $customer['name']; ?></h3>
                    <div class="col-md-6">
                        <!-- Show a list of al invoices -->

                        <div id="list_invoice" class="tab-pane fade">
                            <?php include "customer_invoice_data.inc.php" ; ?>
                        </div>
                        <!-- end of list of invoices section -->


                    </div>

                </div>



            </div>
        </div>
    </div>
    </div>



    <!--     Java Script Starts -->
    <script type="text/javascript">
    $('#customer').change(function() {
        var customer_account = $(this).val();
        var dataString = 'customer_account=' + customer_account;
        //alert(dataString);
        $(this).css('background-color', '#F0E10F');
        $.ajax({
            type: "POST",
            url: "post_process.php",
            data: dataString,
            success: function(data) {
                //console.log(data); 

                $('#customer_details').html(data);
                //$('#delivery_address').hide();
            }
        });
    });

    $(document).ready(function() {

        $('ul.tabs li').click(function() {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        });

    });
    $(document).ready(function() {

        //$('#customers').DataTable();

    });
    </script>

    <script type="text/javascript">
    $('#create_invoice').click(function() {
        var create_invoice = $('#customer_id').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var dataString = 'create_invoice=' + create_invoice + '&start_date=' + start_date + '&end_date=' +
            end_date;
        //alert(dataString);

        //return false;
        $.ajax({
            type: "POST",
            url: "post_process.php",
            data: dataString,
            success: function(data) {
                //console.log(data); 
                // $('#gross').hide();
                $('#invoice_details').html(data);

            }
        });
    });
    </script>

    <script type="text/javascript">
    $('#search_entry').click(function() {
        var search_entry = $('#customer_id').val();
        var from = $('#from').val();
        var to = $('#to').val();
        var dataString = 'search_entry=' + search_entry + '&from=' + from + '&to=' + to;
        //alert(dataString);

        //return false;
        $.ajax({
            type: "POST",
            url: "post_process.php",
            data: dataString,
            success: function(data) {
                //console.log(data); 
                // $('#gross').hide();
                $('#transactions').html(data);

            }
        });
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        //alert();
        // READ recods on page load
        readRecords(); // calling function
    });

    function addRecord() {
        //empty contents

        var form = $('#new_address');
        var address1 = $('#insert_address').val();
        var city = $('#insert_city').val();
        var post_code = $('#insert_post_code').val();
        var customer_id = $('#customer_id').val();

        var dataString = 'address1=' + address1 + '&city=' + city + '&post_code=' + post_code + '&customer_id=' +
            customer_id;
        // alert(dataString);
        $.ajax({
            type: "POST",
            url: "add_new_customer_address.inc.php",
            data: dataString,
            success: function(data) {
                //console.log(data); 

                $("#add_new_record_modal").modal("hide");
                readRecords();
            }
        });

    }
    // READ records
    function readRecords() {



        var customer_id = $('#customer_id').val();

        var dataString = 'customer_id=' + customer_id;
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: "fetch_customer_address.inc.php",
            data: dataString,
            success: function(data) {
                //console.log(data); 

                $("#add_new_record_modal").modal("hide");
                $(".records_content").html(data);
            }
        });

    }

    // functon to get the details of selected record

    function GetUserDetails(id) {
        // Add User ID to the hidden field for furture usage
        $("#record_id").val(id);
        //alert(id);
        var selected_address = id;
        var dataString = 'selected_address=' + selected_address;
        $.ajax({
            type: "POST",
            url: "get_address_record.inc.php",
            data: dataString,
            success: function(data) {
                //console.log(data); 
                //alert(data);
                var address_data = data;
                var address_data = address_data.split(',');
                var address1 = address_data[0];
                //alert(address1);
                var city = address_data[1];
                var post_code = address_data[2];
                // now simply assign to modal
                $('#update_address').val(address1);
                $('#update_city').val(city);
                $('#update_post_code').val(post_code);

                $("#add_new_record_modal").modal("hide");
                readRecords();
            }
        });

        // Open modal popup
        $("#update_user_modal").modal("show");
    }

    //Now Update this address

    function UpdateUserDetails() {
        // get values
        var address1 = $("#update_address").val();
        var city = $("#update_city").val();
        var post_code = $("#update_post_code").val();

        // get hidden field value
        var id = $("#record_id").val();
        //alert(id);
        var dataString = 'address1=' + address1 + '&city=' + city + '&post_code=' + post_code + '&id=' + id;
        // alert(dataString);
        $.ajax({
            type: "POST",
            url: "update_customer_address.inc.php",
            data: dataString,
            success: function(data) {
                //console.log(data); 
                $("#update_user_modal").modal("hide");
                readRecords();
            }
        });
    }

    //Delete the record

    function DeleteUser(id) {
        var conf = confirm("Are you sure, do you really want to delete User?");
        if (conf == true) {
            var dataString = 'id=' + id;
            //alert(dataString);
            $.ajax({
                type: "POST",
                url: "delete_customer_address.inc.php",
                data: dataString,
                success: function(data) {
                    //console.log(data); 
                    readRecords();
                }
            });


        }
    }
    </script>

</body>

</html>