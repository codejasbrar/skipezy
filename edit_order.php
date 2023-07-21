<!DOCTYPE html>
<html>

<head>
    <style>
    body {
        font-size: 16px;
    }

    .form-group>legend {
        background-color: #10a0d1;
        color: #fcf9f9;
        padding: 15px;
    }

    .col-md-6.mar-to {
        margin-top: 30px;
    }

    #new_customer>legend {
        background-color: f0b111;
        padding: 15px;
        color: #111
    }

    .col-md-12>legend {
        padding: 15px;
    }

    #customer_id {
        display: none;
    }

    #address_id {
        display: none;
    }

    .form-control {
        box-shadow: none !impotant;
        height: 46px !impotant;
    }

    fieldset {
        min-width: 0;
        padding: 0;
        margin: 0;
        border: 0;
    }

    .well {
        min-height: 20px;
        padding: 19px;
        margin-bottom: 20px;
        background-color: #f8f8f8;
        border: 1px solid #939393;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
    }

    .well-legend {
        display: block;
        font-size: 14px;
        width: auto;
        padding: 10px 15px;
        margin-bottom: 0px;
        line-height: inherit;
        color: #111;
        background: #f0b111;
        border: 1px solid #e3e3e3;
        border-radius: 4px;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
    }

    #name-list {
        float: left;
        list-style: none;
        margin: 0;
        padding: 0;
        width: 250px;
    }

    #name-list li {
        padding: 10px;
        background: #FAFAFA;
        border-bottom: #F0F0F0 1px solid;
        width: 250px;
    }

    #name-list li:hover {
        background-color: #0A68C0;
        cursor: pointer;
        width: 250px;
    }

    #search-name {
        padding: 10px;
        border: #000000 1px solid;
        width: 250px;
    }
    </style>

    <title></title>
    <?php 
include "navbar.php";
include "dbconfig.php";

  $order_id=$_GET['job_id'];

      $query="SELECT orders.id ,orders.delivery_slot, orders.start_date,orders.customer_id,orders.address_id,customers.name,customers.mobile,orders.amount,orders.status as status_id,
	  delivery_address.address1,delivery_address.city ,delivery_address.post_code,delivery_address.site,
	  job_types.name AS job_type,skips.size,payment_type.name AS payment_type,orders.amount,skip_locations.name AS skip_location, order_status.name as status
FROM orders

LEFT JOIN customers ON orders.customer_id = customers.id
LEFT JOIN delivery_address ON orders.address_id = delivery_address.id
LEFT JOIN job_types ON orders.job_type = job_types.id
LEFT JOIN skips ON orders.skip_id = skips.id
LEFT JOIN payment_type ON orders.payment_status = payment_type.id
LEFT JOIN transactions ON orders.customer_id = transactions.source_id
LEFT JOIN location ON orders.location_id = location.id
LEFT JOIN skip_locations ON orders.location_id = skip_locations.id
LEFT JOIN order_status ON orders.status = order_status.id

WHERE orders.id=$order_id LIMIT 1";
            //  echo $query;
             // exit();
				if (!mysqli_query($con,$query)) 
				  { 	
					  
					  die('SELECT 1 SQL SAID -Error: ' . mysqli_error($con));
				  }
                   $result=mysqli_query($con,$query);
                   $row=mysqli_fetch_assoc($result);
	?>

    <!-- Java Scripti Files -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <meta charset="utf-8">
    <title>Skipezy Software for Skip Hire Business</title>
    <script>
    $(document).ready(
        function() {
            $('#start_date').datepicker({
                changeMonth: true, //this option for allowing user to select month
                changeYear: true, //this option for allowing user to select from year range
                dateFormat: 'dd/mm/yy'
            });
        }

    );

    $(document).ready(
        function() {
            $('#end_date').datepicker({
                changeMonth: true, //this option for allowing user to select month
                changeYear: true, //this option for allowing user to select from year range
                dateFormat: 'dd-mm-yy'
            });
        }

    );
    $(document).ready(
        function() {
            $('#payment_date').datepicker({
                changeMonth: true, //this option for allowing user to select month
                changeYear: true, //this option for allowing user to select from year range
                dateFormat: 'yy-mm-dd'
            });
        }

    );
    $(document).ready(function() {

    });
    $(document).ready(function() {
        //called when key is pressed in textbox
        $(".numeric").keypress(function(e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#errmsg").html("Digits Only").show().fadeOut("slow");
                return false;
            }
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $("#search-name").keyup(function() {
            //$("#delivery_address").hide();
            //if any other div are open close them or hide them

            $.ajax({
                type: "POST",
                url: "find_customer.php",
                data: 'keyword=' + $(this).val(),
                beforeSend: function() {
                    $("#search-name").css("background", "#F5C211");
                },
                success: function(data) {
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $("#search-name").css("background", "#green");
                }
            });
        });
    });

    function selectCustomer(val) {
        var data = val;
        var data = data.split('-');
        var id = data[0];
        var name = data[1];
        //alert(id);
        $('#new_customer').hide();
        //now show the delivery div as well
        $("#delivery_address").show();
        $("#search-name").val(name);
        $("#old_customer_id").val(id);

        //now fetch data based on this id 
        $.ajax({
            type: "POST",
            url: "find_address.php",
            data: 'customer=' + id,

            success: function(data) {
                $("#customer_delivery_address").html(data);
                $("#delivery_address").show();
                $("#frmSearch").hide();


            }
        });

        $("#suggesstion-box").hide();
        $('.job-details').show();
    }
    </script>

    <!-- This is script to disable enter key -->
    <script type="text/javascript">
    function stopRKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
        if ((evt.keyCode == 13) && (node.type == "text")) {
            return false;
        }
    }
    document.onkeypress = stopRKey;
    </script>

</head>

<body style="font-size:16px;">
    <form name="new_order_form" id="new_order_form" method="post" action="">
        <input type="hidden" name="new_order_form">
        <div class="container-fluid">
            <div class="col-md-2"></div>
            <div id="new_customer" class="col-md-8 details-form-div">
                <p class="form-section-title"><span class="glyphicon glyphicon-th-list"></span>&nbsp;Customer Details
                </p>
                <fieldset class="well">
                    <!-- <legend class="well-legend"><span class="glyphicon glyphicon-th-list"> </span>&nbsp;Customer Details -->
                    </legend>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">Customer Name</label>
                            <input required type="text" name="customer_name" id="customer_name" class="form-control"
                                placeholder="Customer Name" autocomplete="off" value="<?php echo $row['name'];?>" />
                            <input type="text" name="customer_id" value="<?php echo $row['customer_id'];?>"
                                id="customer_id" placeholder="xxx" />
                            <div id="customer_suggesstion-box"></div>
                        </div>
                        <div class="form-group" id="cityz_streets">
                            <label for="address1">Address </label>
                            <input required autocomplete="off" type="text" id="customer_address" name="customer_address"
                                class="form-control" value="<?php echo $row['address1'];?>" placeholder="Address">
                            <input type="text" name="address_id" id="address_id" placeholder="Address"
                                value="<?php echo $row['address_id'];?>" />
                            <div id="suggesstion-box"></div><br>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" placeholder="Enter Phone Number"
                                class="form-control" tabindex="3" value="<?php echo $row['mobile'];?>">
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="city">Area/Town</label>
                            <input name="city" type="text" id="city" placeholder="Enter City" class="form-control"
                                tabindex="6" value="<?php echo $row['city'];?>">
                            </span>
                        </div><br>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="post_code">Post Code</label>
                            <input type="text" id="post_code" name="post_code" placeholder="Enter Post Code"
                                class="form-control" tabindex="5" value="<?php echo $row['post_code'];?>">
                            <span class="input-group-btn">
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="address1">Site Details </label>
                        <input name="site" type="text" id="site" placeholder="Enter Details" class="form-control"
                            tabindex="4" value="<?php echo $row['site'];?>">
                    </div>
                </fieldset>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="panel job-details" style="padding: 0 10px; margin-top: 15px">
                        <p class="form-section-title"><span class="glyphicon glyphicon-th-list"></span>&nbsp;Enter Job
                            Details</p>
                        <!-- <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                            <div class="panel-heading">
                                <center>Enter Job Details</center>
                            </div>
                        </div> -->
                        <div class="panel-body"
                            style="background-color: #f8f8f8; border: 1px solid #939393; box-shadow: 0 0 10px #999; border-radius: 4px;">

                            <div class="collection">
                                <div class="form-group col-md-3">
                                    <label for="area">Start Date</label>
                                    <?php
                                      $end_date = date('Y-m-d',(strtotime('21 day', time())));
                                      $start_date =$row['start_date']; 
                                      $start_date =date("d/m/Y", strtotime($start_date));
  					                        ?>
                                    <input type="text" value="<?php echo $start_date;?>" name="start_date"
                                        class="form-control" placeholder="Select a Date" name="start_date"
                                        id="start_date" tabindex="7">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="jobtype">Job Type</label>
                                    <select name="job_type" id="job_type" class="form-control">
                                        <option value="1" <?php if ($row['job_type'] == 1) { echo 'selected'; } ?>>
                                            Delivery</option>
                                        <option id="Collection" value="2"
                                            <?php if ($row['job_type'] == 'Collection') { echo 'selected'; } ?>>
                                            Collection</option>
                                        <option id="Exchange" value="3"
                                            <?php if ($row['job_type'] == 'Exchange') { echo 'selected'; } ?>>
                                            Exchange
                                        </option>
                                    </select>
                                </div>

                                <div id="exchange_with">
                                    <div class="form-group col-md-3">
                                        <label for="skiptype">Exchange With</label>
                                        <select name="exchange_skip_id"
                                            style="width:70%;background-color:#F30007; color:#ffffff;"
                                            id="exchange_skip_id" class="form-control">
                                            <?php
                                              $skip_sql="SELECT * from skips order by size ASC";
                                              $t_result=mysqli_query($con,$skip_sql);
                                              while($skip=mysqli_fetch_assoc($t_result))
                                            {
                                            ?>
                                            <option <?php if($skip['id']==1){echo 'selected';}?>
                                                style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                                value="<?php echo $skip['id']; ?>">
                                                <?php echo $skip['size']; ?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <!-- Retrieve the stock of selected skip -->
                                        <?php
                                            if(isset($_POST['selected_skip']))
                                          {
                                            $selected_skip=$con->real_escape_string($_POST['selected_skip']);
                                            $skip_sql="SELECT current_stock from skips WHERE id=$selected_skip";
                                            if (!mysqli_query($con,$skip_sql)) {
                                              echo $sql;
                                              die('skip 3 orders -Error: ' . mysqli_error($con));
                                            }
                                            $result=mysqli_query($con,$skip_sql);
                                            $current_stock=mysqli_fetch_assoc($result);
                                            echo $stock=$current_stock['current_stock'];
                                          }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="amount">Price Given</label>
                                    <div id="gross_payment">
                                        <input type="text" style="height:40px;" name="amount" id="amount"
                                            class="form-control numeric" tabindex="11"
                                            value="<?php echo $row['amount'];?>">
                                        <div style="color:red;" id="errmsg"></div>
                                    </div>
                                </div>

                                <div id="order_created"></div>

                                <div class="form-group col-md-3">
                                    <label for="nos">Skips</label>
                                    <input id="skips" style="height:40px;" type="text" value="1" name="skips"
                                        class="form-control numeric" readonly>
                                    <div id="errmsg"></div>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="skiptype" class="collection">Skip Size</label>
                                <div class="form-group">
                                    <select name="skip_id" id="skip_id" class="form-control">
                                        <?php
                                        $skip_sql="SELECT * from skips order by size ASC";
                                        $t_result=mysqli_query($con,$skip_sql);
                                        while($skip=mysqli_fetch_assoc($t_result))
                                        {
                                        ?>
                                        <option
                                            style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                            value="<?php echo $skip['id']; ?>"
                                            <?php if ($row['size'] == $skip['size']) { echo 'selected'; } ?>>
                                            <?php echo $skip['size']; ?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="location">Location</label>
                                <select id="skip_location" name="skip_location" class="form-control">
                                    <?php
                                          $skip_sql="SELECT * from skip_locations";
                                          $t_result=mysqli_query($con,$skip_sql);
                                          while($skip_location=mysqli_fetch_assoc($t_result))
                                          {
                                          ?>
                                    <option
                                        style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                        value="<?php echo $skip_location['id']; ?>"
                                        <?php if ($row['skip_location'] == $skip_location['name']) { echo 'selected'; } ?>>
                                        <?php echo $skip_location['name']; ?>
                                    </option>
                                    <?php
                                        }
                                        ?>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="delivery_slot">Delivery Slot</label>
                                <select id="delivery_slot" name="delivery_slot" class="form-control">
                                    <option value="AM" <?php if ($row['delivery_slot'] == 'AM') { echo 'selected'; } ?>>
                                        AM
                                    </option>
                                    <option value="PM" <?php if ($row['delivery_slot'] == 'PM') { echo 'selected'; } ?>>
                                        PM
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="nos">Job Paid</label>
                                <select style="height:40px;" name="payment_type" id="payment_type" class="form-control"
                                    style="font-size:13px; cursor:pointer;">
                                    <?php
                                          $payment_sql="SELECT * from payment_type order by id ASC";
                                          $t_result=mysqli_query($con,$payment_sql);
                                          while($payment=mysqli_fetch_assoc($t_result))
                                        {
                                        ?>
                                    <option
                                        style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                        value="<?php echo $payment['id']; ?>"
                                        <?php if ($row['payment_type'] == $payment['name']) { echo 'selected'; } ?>>
                                        <?php echo $payment['name']; ?>
                                    </option>
                                    <?php
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="col-md-12"><input type="submit"
                                    style="cursor: pointer; font-family:Montserrat;height: 40px;border-radius: 0px; margin: 15px 0"
                                    class="btn btn-success btn-large" value="Save Job"></div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        </div>
        </div>
        <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
        <input type="hidden" name="status" value="<?php echo $row['status_id']; ?>">
    </form>

    <script type="text/javascript">
    $(document).ready(function() {

        $('#exchange_with').hide();
        $('#exchange_skip_id').val(0);

    });

    $('#skip_id').change(function() {
        var selected_skip = $(this).val();
        var dataString = 'selected_skip=' + selected_skip;
        // alert(dataString);
        $(this).css('background-color', '#F0E10F');
        $.ajax({
            type: "POST",
            url: "new_order.php",
            data: dataString,
            success: function(data) {
                //console.log(data); 

                $('#skip_stock').html(data);
                //$('#delivery_address').hide();
            }
        });
    });

    $('#customer_id').change(function() {
        var customer_id = $(this).val();
        //$('#delivery_check').show();

        var get_customer_address = $(this).val();
        var dataString = 'customer_id=' + customer_id + '&get_customer_address=' + get_customer_address;
        // alert(dataString);
        $(this).css('background-color', '#F0E10F');
        $.ajax({
            type: "POST",
            url: "create_order.php",
            data: dataString,
            success: function(data) {
                //console.log(data); 

                $('#customer_details').html(data);
                //$('#delivery_address').hide();
            }
        });
    });
    $('#customer_id').keyup(function() {
        var customer_id = $(this).val();
        //$('#delivery_check').show();

        var get_customer_address = $(this).val();
        var dataString = 'customer_id=' + customer_id + '&get_customer_address=' + get_customer_address;
        // alert(dataString);
        $(this).css('background-color', '#F0E10F');
        $.ajax({
            type: "POST",
            url: "create_order.php",
            data: dataString,
            success: function(data) {
                //console.log(data); 

                $('#customer_details').html(data);
                //$('#delivery_address').hide();
            }
        });
    });

    $('#payment_type').click(function() {

        $('#save_order').show();
    });

    $('#find_gross').click(function() {
        //alert('demo');
        $('#gross_label').show();
        var amount = $('#amount').val();
        var vat = $('#vat').val();
        var permit = $('#permit').val();
        var skips = $('#skips').val();

        //alert(amount);
        var dataString = 'amount=' + amount + '&permit=' + permit + '&skips=' + skips + '&vat=' + vat;
        //alert(amount);
        $.ajax({
            type: "POST",
            url: "create_order.php",
            data: dataString,
            success: function(data) {
                //console.log(data); 
                $('#calculate_gross').html(data);
            }
        });

    });

    $('#job_type').change(function() {

        var exchange = $('#job_type').val();
        if (exchange == '3') {
            $('#exchange_with').show();
            $('#skips').readonly();

        } else {
            $('#exchange_with').hide();
        }
        // if the job type is collection then disable payment button and hyde others
    });


    // Now check if payment is given in full or half
    $('#payment_type').change(function() {

        //alert($('#gross').val());

        var payment_type = $(this).val();

        if (payment_type == '1')

        {
            $('#pay_date').show();
            var gross = $('#gross').val();
            if ($('#gross').val('')) {
                var gross = $('#amount').val();
            } else {
                var gross = $('#gross').val();
            }
            $('#gross').val(gross);
            $('#gross_label').show();
            $('#gross').show();
            //   alert(gross);
            $('#payment_label').show();
            $('#payment_label').html("All Cleared");
            $('#payment_recieved').show();
            $('#payment_recieved').val(gross);
            $('#payment_recieved').css('background-color', '#46F84A');
        }

        if (payment_type == '3')

        {
            $('#pay_date').show();
            var gross = $('#gross').val();
            //alert(gross);
            if ($('#gross').val('')) {
                var gross = $('#amount').val();
            } else {
                var gross = $('#gross').val();
            }
            $('#gross').val(gross);
            $('#gross_label').show();
            $('#gross').show();
            $('#payment_label').show();
            $('#payment_label').html("How Much Paid?");
            $('#payment_recieved').show();
            $('#payment_recieved').css('background-color', '#F0E10F');
            $('#payment_recieved').val(0.00);
            $('#payment_recieved').focus();
        }

        if (payment_type == 5)

        {
            $('#pay_date').show();
            var gross = $('#gross').val();
            $('#payment_label').show();
            $('#payment_label').html("All Cleared");
            $('#payment_recieved').show();

            if ($('#gross').val('')) {
                var gross = $('#amount').val();
            } else {
                var gross = $('#gross').val();
            }

            $('#gross').val(gross);
            $('#gross_label').show();
            $('#gross').show();
            $('#payment_recieved').val(gross);
            $('#payment_recieved').css('background-color', '#46F84A');
        }
        if (payment_type == 2)

        {
            $('#pay_date').hide();

            $('#payment_label').hide();

            $('#payment_recieved').hide();

            $('#payment_recieved').val(0);

        }
        if (payment_type == 4)

        {
            $('#pay_date').hide();
            $('#payment_date').val(0000 - 00 - 00);


            $('#payment_label').hide();

            $('#payment_recieved').hide();

            $('#payment_recieved').val(0);

        }

    });

    $('#save_order').click(function() {

        var create_order = "Yes";
        var job_type = $('#job_type').val();
        var skip_id = $('#skip_id').val();
        var exchange_skip_id = $('#exchange_skip_id').val();
        if (exchange_skip_id == '') {
            exchange_skip_id = 0
        }
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        // customer and delivery details

        var customer_id = $('#customer_id').val();
        var location = $('#delivery_address').val();
        var skip_location = $('#skip_location').val();
        var delivery_slot = $('#delivery_slot').val();

        // payment details

        var amount = $('#amount').val();
        var skips = $('#skips').val();
        var nett = $('#nett').val();
        var vat = $('#vat').val();
        var permit = $('#permit').val();
        var gross = $('#gross').val();

        var payment_recieved = $('#payment_recieved').val();
        var payment_type = $('#payment_type').val();
        var payment_date = $('#payment_date').val();
        var full_name = $('#full_name').val();

        if (payment_type == '0')

        {
            alert("Please select payment made or not ?");
            return false;
        }

        var old_customer_id = $("#old_customer_id").val();
        //if(old_customer_id==0){alert("Zero")};


        //alert(amount);
        var dataString = 'create_order=' + create_order + '&old_customer_id=' + old_customer_id + '&job_type=' +
            job_type + '&full_name=' + full_name + '&start_date=' + start_date + '&end_date=' + end_date +
            '&skip_id=' + skip_id + '&exchange_skip_id=' + exchange_skip_id + '&customer_id=' + customer_id +
            '&location=' + location + '&amount=' + amount + '&skips=' + skips + '&nett=' + nett + '&vat=' +
            vat + '&permit=' + permit + '&gross=' + gross + '&payment_recieved=' + payment_recieved +
            '&payment_type=' + payment_type + '&payment_date=' + payment_date + '&skip_location=' +
            skip_location + '&delivery_slot=' + delivery_slot;
        alert(dataString);

        //return false;
        $.ajax({
            type: "POST",
            url: "create_new_order.php",
            data: dataString,
            success: function(data) {
                //console.log(data); 
                // $('#gross').hide();
                $('#order_created').html(data);

            }
        });
    });

    $('#skips').keyup(function() {

        var amount = $('#amount').val();
        var skips = $('#skips').val();
        var nett = amount * skips;
        var vat = $('#vat').val();
        var vat_due = (vat * nett) / 100;
        $('#nett').val(nett);
        var permit = $('#permit').val();
        var gross;
        permit = Number(permit);
        gross = +nett + +vat_due + +permit;

        $('#gross').val(gross);
    });
    $('#amount').keyup(function() {

        var amount = $('#amount').val();
        var skips = $('#skips').val();
        var nett = amount * skips;
        var vat = $('#vat').val();
        var vat_due = (vat * nett) / 100;
        $('#nett').val(nett);
        var permit = $('#permit').val();
        var gross;
        permit = Number(permit);
        gross = +nett + +vat_due + +permit;

        $('#gross').val(gross);
    });
    $('#vat').keyup(function() {


        var amount = $('#amount').val();
        var skips = $('#skips').val();
        var nett = amount * skips;
        var vat = $('#vat').val();
        var vat_due = (vat * nett) / 100;
        $('#nett').val(nett);
        var permit = $('#permit').val();
        var gross;
        permit = Number(permit);
        gross = +nett + +vat_due + +permit;

        $('#gross').val(gross);

    });
    $('#permit').keyup(function() {

        var amount = $('#amount').val();
        var skips = $('#skips').val();
        var nett = amount * skips;
        var vat = $('#vat').val();
        var vat_due = (vat * nett) / 100;
        $('#nett').val(nett);
        var permit = $('#permit').val();
        var gross;
        permit = Number(permit);
        gross = +nett + +vat_due + +permit;

        $('#gross').val(gross);


    });

    $('#customer_delivery_address').click(function() {
        //if no address was found
        var delivery_address = $('#customer_delivery_address').val();
        if (delivery_address == '0') {
            $('#delivery').hide();
            $('#new_delivery_address').show();
        }
    });




    $('#customer_delivery_address').change(function() {


        var delivery_address = $('#customer_delivery_address').val();

        var dataString = 'delivery_address=' + delivery_address;
        //alert(dataString);
        if (delivery_address == '0') {
            $('#delivery').hide();
            $('#new_delivery_address').show();
        } else {
            $('#new_delivery_address').hide();

            var delivery_address = $(this).val();

            var dataString = 'delivery_address=' + delivery_address;
            //alert(dataString);
            $(this).css('background-color', '#57F019');
            $.ajax({
                type: "POST",
                url: "find_delivery_address.php",
                data: dataString,
                success: function(data) {
                    //console.log(data); 
                    $('#delivery').show();
                    $('#delivery').html(data);
                    //$('#delivery_address').hide();
                }
            });

        }
    });

    $('.start_date').datepicker({

        onSelect: function() {

            $(".start_date").datepicker("option", "dateFormat", "dd/mm/yy");
        }
    });

    function checkTextField(field) {
        if (field.value == '') {
            alert("Field left Blank.");
            this.focus();
        }
    }
    // check if name text box is empty then hide job details div
    function checkTextField(field) {
        if (field.value == '') {
            $('.job-details').hide();
        }
    }
    $(document).ready(function() {
        $('#loader').hide();

        $("#customer_name").keyup(function() {
            $('#customer_id').val(0);

            //$("#delivery_address").hide();
            //if any other div are open close them or hide them

            $.ajax({
                type: "POST",
                url: "ajax/find_customer.php",
                data: 'keyword=' + $(this).val(),
                beforeSend: function() {
                    $("#customer_name").css("background", "#F5C211");
                },
                success: function(data) {
                    $("#customer_suggesstion-box").show();
                    $("#customer_suggesstion-box").html(data);
                    $("#customer_name").css("background", "#green");
                }
            });
        });

        // Now show a list of customers

        $("#customer_address").keyup(function() {
            $("#suggesstion-box").hide();
            $("#address_id").val(0);

            var customer_id = $('#customer_id').val();
            var address = $(this).val();
            var dataString = 'customer_id=' + customer_id + '&address=' + address;;

            //$("#delivery_address").hide();
            //if any other div are open close them or hide them

            $.ajax({
                type: "POST",
                url: "ajax/find_address.php",
                data: dataString,
                beforeSend: function() {
                    $("#customer_name").css("background", "#F5C211");
                },
                success: function(data) {
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $("#customer_name").css("background", "#green");
                }
            });
        });
    });

    // Find Slot associated with this Lorry



    function selectCustomer(val) {
        //alert(val);
        var data = val;
        var data = data.split('-');
        var id = data[0];
        var name = data[1];
        var phone = data[2];
        $("#customer_name").val(name);
        $("#customer_id").val(id);
        $("#phone").val(phone);
        $("#customer_suggesstion-box").hide();
    }

    function selectAddress(val) {
        alert(val);
        var data = val;
        var data = data.split('-');
        var id = data[0];
        var address = data[1];
        var post_code = data[2];
        var city = data[3];
        var site = data[4];

        $("#address_id").val(id);
        $('#customer_address').val(address);
        $('#post_code').val(post_code);
        $('#city').val(city);
        $('#site').val(site);
        $("#suggesstion-box").hide();
    }
    /////////////// Now Submit this Form ////////////////////////////
    $("#new_order_form").on('submit', (function(e) {

        e.preventDefault();
        $('#loader').show();

        $.ajax({

            url: "ajax/update_order.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //alert(data);
                if (data == 'success') {

                    alert("Order Updated Successfully");
                    $('#loader').delay(500).fadeOut("slow");
                    window.location.replace("list_job.php");
                } else {
                    alert("Order was not updated");
                    $('#loader').delay(500).fadeOut("slow");
                }

            },
            error: function() {}
        });
    }));
    </script>

</body>

</html>