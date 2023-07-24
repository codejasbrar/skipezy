<?php
  include('messagefile.php');
?>

<title>List of Jobs</title>
<!doctype html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <?php
include "navbar.php";
include "dbconfig.php";

//include "css_header.php";
// include "navbar_list.php";
 include ("dynamic_table.php");
//Get the order data for this order.

$sql="SELECT orders.id ,orders.start_date, orders.id AS order_id, orders.end_date,orders.skips, skips.size AS size, customers.name AS customer_name, customers.mobile, customers.address1,customers.city, customers.post_code, orders.amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type, order_status.name AS order_status, delivery_address.address1, delivery_address.city, delivery_address.post_code, employees.name as driver_name
FROM orders
LEFT JOIN customers ON orders.customer_id = customers.id
LEFT JOIN job_types ON orders.job_type = job_types.id
LEFT JOIN payment_type ON orders.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN delivery_address ON orders.address_id = delivery_address.id
LEFT JOIN employees ON employees.id = orders.driver_id
LEFT JOIN skips ON orders.skip_id = skips.id";

$res=mysqli_query($con,$sql);

//echo $sql;

?>
</head>

<body style="font-family:Montserrat; font-size:13px;">
    <div class="row" style="margin: 0">
        <div class="col-md-12" style="box-shadow: 0px 0px 10px; padding: 0">
            <div class="panel" style="margin-bottom: 0">
                <div class="panel-primary">
                    <div class="panel-heading">
                        <h4>
                            <center>Allocate Jobs to Drivers</center>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- this is end of start block and driver dropdown -->
    <div>&nbsp;</div>
    <div class="row col-md-8 col-md-offset-2">
        <form name="allocate" method="post">
            <div class="panel job-details" style="padding: 0 10px; margin-top: 15px">
                <p class="form-section-title"><span class="glyphicon glyphicon-th-list"></span>&nbsp;Select Driver</p>
                <!-- <div class="panel-primary">
                    <div class="panel-heading">Select Driver</div>
                </div> -->
                <div class="panel-body"
                    style="background-color: #f8f8f8; border: 1px solid #939393; box-shadow: 0 0 10px #999; border-radius: 4px;">
                    <div class="form-group col-md-6">
                        <select name="driver" style="width:70%;" id="exchange_skip_id" class="form-control">
                            <option style="padding:15px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                value="0" selected>Select Driver </option>
                            <?php
                              $skip_sql="SELECT * from employees where job_title='driver' order by name ASC";
                              $t_result=mysqli_query($con,$skip_sql);
                              while($skip=mysqli_fetch_assoc($t_result))
                            {
                            ?>
                            <option selected
                                style="padding:15px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"
                                value="<?php echo $skip['id']; ?>">
                                <?php echo $skip['name']; ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="allocate_job" class="btn btn-round btn-success btn-md"
                        style="float:right;" value="Allocate Jobs">
                </div>
            </div>
            <!-- this is end of button block and driver dropdown -->

            <div id="job_done"></div>
            <div>&nbsp;
                <hr class="solid">
            </div>

            <table style="font-family:Montserrat; font-size:13px;" id="jobs"
                class="table table-striped table-bordered table-hover" cellspacing="0">
                <thead>
                    <tr class="btn-primary">
                        <th>Job ID</th>
                        <th>Start Date</th>
                        <th>Skip Size</th>
                        <th>Customer</th>
                        <th>Site Address</th>
                        <th>Job Type</th>
                        <th>Driver</th>
                        <th>View</th>
                        <th>Allocate</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="btn-primary">
                        <th>Job ID</th>
                        <th>Start Date</th>
                        <th>Skip Size</th>
                        <th>Customer</th>
                        <th>Site Address</th>
                        <th>Job Type</th>
                        <th>Driver</th>
                        <th>View</th>
                        <th>Allocate</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php

                while($job=mysqli_fetch_assoc($res))

                { ?>
                    <tr>
                        <td><?php echo $job['order_id'];?></td>
                        <td>
                            <?php $start = date("d-m-Y", strtotime($job['start_date'])); 
						   
                        echo $start  ;?></td>
                        <td>
                            <?php
                        $qty=$job['skips'];
                        if($qty>'1'){
							   
                      echo $job['skips']." skips,<br> ";?><?php echo $job['size']."<br>";
                      }else{
                                    
                        echo $job['skips']." skip,<br> ";?><?php echo $job['size'];
                      }
                      ?>
                        </td>
                        <td><?php echo $job['customer_name'];?></td>
                        <td><?php echo $job['address1'].", ".$job['city'].", ".$job['post_code'];?></td>
                        <td><?php echo $job['job_type'];?></td>
                        <td><?php echo $job['driver_name'];?></td>
                        <td><a href="edit_order.php?cid=<?php echo $job['order_id'];?>"><i
                                    class="glyphicon glyphicon-check"></i></a></td>
                        <td><input type="checkbox" name="selected_driver[]" value=<?php echo $job['order_id'];?>> </td>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>

            <!-- Now allocate job to selected driver -->
            <?php
       if(isset($_POST['allocate_job'],$_POST['selected_driver']))
			{				
				$status="confirmed";
				$id=$_POST['selected_driver'];
				$driver_id=$_POST['driver'];
			foreach($id as $key=>$ID)
				{
					$order_id=$ID;
					echo $sql="UPDATE orders SET driver_id=$driver_id WHERE id=".$order_id;
					
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('INSERT 3 INTO orders -Error: ' . mysqli_error($con));
		  				} else {
							?>
            <script>
            alert("Driver assigned successfully");
            </script>
            <?php
						}
				}
			}
			?>

    </div>
    </form>

    </div>

    <script type="text/javascript">
    $('.allocate_jsob').click(function() {

        var allocate_job = "yes";

        $.ajax({
            type: "POST",
            url: 'allocate_job.php',
            data: dataString,
            success: function(data) {
                console.log(data);

                $('#job_done').html(data);
            }
        });
    });

    $(document).ready(function() {
        $('#jobs').DataTable({
            dom: 'Bfrtip',
            responsive: true,
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