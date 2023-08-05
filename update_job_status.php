<!doctype html>
<?php 
ini_set('display_errors',1); // enable php error display for easy trouble shooting
error_reporting(E_ALL); // set error display to all

//include "admin_side_bar.php";
include "navbar.php";
include "dbconfig.php";

?>
<html>

<head>
    <meta charset="utf-8">
    <title>SkipTrak Software for Skip Hire Business</title>

</head>

<body>
    <div class="container-fluid">
        <form name="new_job_titles_form" id="new_job_titles_form">
            <input type="hidden" name="new_job_titles_form" />
            <div class="col-md-12" style="margin-top:7%;">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-primary">
                            <div class="panel-heading">Update Job Status</div>
                        </div>
                        <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px gray;">
                            <label for="skiptype">Select a Job</label>
                            <div class="form-group">
                                <select name="skip_type" style="width:70%;" id="skip_id" class="form-control">
                                    <option
                                        style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                        value="">Select a Job </option>
                                    <?php
                                       $skip_sql="SELECT orders.id, orders.status, customers.name, customers.post_code
                                          FROM orders
                                          LEFT JOIN customers ON orders.customer_id = customers.id
                                          WHERE STATUS = 'TBC'";
                                       $t_result=mysqli_query($con,$skip_sql);
                                       while($job=mysqli_fetch_assoc($t_result))
                                       {
                                    ?>
                                    <option selected
                                        style="padding:20px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                        value="<?php echo $job['id']; ?>">
                                        <?php echo $job['id']."  ".$job['name']."  ".$job['post_code']; ?>
                                    </option>
                                    <?php
                                       }
                                    ?>
                                </select>
                                <div class="col-md-1"></div>
                            </div>
                            <label for="skiptype">Job Status</label>
                            <div class="form-group">
                                <select name="skip_type" style="width:70%;" id="skip_id" class="form-control">
                                    <option
                                        style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                        value="0">Select a Job </option>
                                    <option
                                        style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                        value="1">Delivered</option>
                                    <option
                                        style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                        value="2">Cancelled</option>
                                    <option
                                        style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                        value="3">To Be Allocated</option>
                                    <option
                                        style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                        value="4">On Hold</option>
                                    <option
                                        style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                        value="5">Waiting for Payment</option>
                                </select>
                                <div class="col-md-1"></div>
                            </div>
                            <center>
                                <div id="job_created"></div>
                                <p style="cursor: pointer; font-family:Montserrat; font-size:18px; font-weight:bold; color:#FBF2F2; padding:15px; background-color:#46A818;"
                                    id="save_order" class="btn-sm pull-right">Update Status</p>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
    $('#save_job').click(function() {
        alert("Demo");
        var form = $('#new_job_titles_form');
        var dataString = $("#new_job_titles_form").serialize();
        alert(dataString);
        $.ajax({
            type: "POST",
            url: "post_process.php",
            data: form.serialize(),
            success: function(data) {
                console.log(data);
                $('#job_created').html(data);
            }
        });
    });
    </script>
</body>

</html>