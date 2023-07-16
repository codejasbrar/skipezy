<?php	
	include "dbconfig.php";
	if(isset($_POST['delivery_address']))
	{
									$delivery_address=$con->real_escape_string($_POST['delivery_address']);
									$customers_sql="SELECT * FROM delivery_address WHERE id=$delivery_address"; 
									//echo $customers_sql;
									$t_result=mysqli_query($con,$customers_sql);
									$customer=mysqli_fetch_assoc($t_result);
	?> 
     <div class="clearfix"></div>
   							   <div style=" border: 2px solid red;border-style: dashed; background-color:#F1D06D;
    border-radius: 5px;"class="form-group col-md-12">
    <div>&nbsp;</div>
					           <br>
                               <label for="area">Deliver To:</label><br>
                               <label for="area"><?php echo $customer['address1'].", ".$customer['address2'];?></label><br>
                               <label for="area"><?php echo $customer['city'];?></label><br>
                               <label for="area"><?php echo $customer['post_code'];?></label><br>
                          </div>
                               
<?php } ?>