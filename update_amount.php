<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Drivers Change</title>
    <?php 
include "dbconfig.php";
include "php_functions.php";
ob_start();
?>
</head>

<body>
    <?php
   						if (ISSET($_POST['select_job_id'])) {
									//print_r($_POST);
									// -------------- add more rows and connect here to database -- all fields
									$order_id=$con->real_escape_string($_POST['select_job_id']);
									$amount_sql="SELECT amount from order_details where order_id=$order_id"; 
									echo $amount_sql;
									$result=mysqli_query($con,$amount_sql);
									
									?>


    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Amount</h4>
            </div>
            <div class="modal-body">

                <form id="amount_form" method="post">
                    <input type="hidden" id="order_id" value="<?php echo $order_id;?>">
                    <table class="table table-bordered">

                        <tbody>
                            <?php
                                    $amount=mysqli_fetch_assoc($result);
									?>

                            <tr>
                                <td>Amount</td>
                                <td><input type="text" id="amount" name="amount"
                                        value="<?php echo $amount['amount'];?>">
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" name="allocate_job" id="modal_button" class="btn btn-primary"
                    value="Update Amount" />

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    <?php } ?>

    <!-- Now allocate job to selected driver -->
    <?php
       if(isset($_POST['amount']))
			{
				//$id=$_POST['selected_driver'];
				$amount=$con->real_escape_string($_POST['amount']);
				$order_id=$con->real_escape_string($_POST['order_id']);
				$sql="UPDATE order_details SET amount=$amount WHERE order_id=$order_id";
					///echo $sql;
					//exit;
				
					if (!mysqli_query($con,$sql)) {
			  			
			  			die('Update Amount error -Error: ' . mysqli_error($con));
		  				}
				
			}
			
			?>

    <div class="modal fade" id="confirmModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Confirmation !</h4>
                </div>
                <div class="modal-body">
                    <p style="color:black; background-color:#36EB34; padding:20px; font-size:20px; font-weight:bold;">
                        Amount Updated Successfully.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="closeme">Close ME</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <script type="text/javascript">
    $('#modal_button').click(function() {

        var amount = $('#amount').val();
        var order_id = $('#order_id').val();
        var dataString = 'amount=' + amount + ' & order_id=' + order_id;
        //alert(dataString);


        $.ajax({
            type: "POST",
            url: "update_amount.php",
            data: dataString,
            success: function(data) {
                $('#confirmModal').modal('show');
            }
        });


    });
    $('#closeme').click(function() {

        window.location.reload();
    });
    </script>

</body>

</html>