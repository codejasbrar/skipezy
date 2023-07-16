<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include("navbar.php");
	include "dbconfig.php";
	?>
</head>
<body>
<form action="create_statement.php" method="post">
	<div class="container-fluid" style="margin-top:200x;">
				<div class="col-md-2"></div>
				<div class="panel col-md-8">
			       <div class="panel-primary"style="box-shadow: 5px 5px 5px;">
			       	   <div class="panel-heading"><center>Transaction History</center></div>
			       </div>
			       <div class="panel-body" style="background-color:#e9e9e9; box-shadow: 5px 5px 5px;">
			       	 
                       <div class="form-group col-sm-8">
                       Select Customer Name
			       	   <select name="customer_id" id="customer" class="form-control">
			       	   	 <option style="padding:10px; background-color:#E7D91E; color:#F9F0F1; cursor:pointer;" value="">Select a Customer </option>
                               <?php
							   
							        $customers_sql="SELECT * from customers order by name ASC";
									$t_result=mysqli_query($con,$customers_sql);
									while($customer=mysqli_fetch_assoc($t_result))
									{
									
									?>
	<option style="padding:20px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="<?php echo $customer['id']; ?>">
	   <?php echo $customer['name']." ,Mobile:".$customer['mobile']." ,".$customer['address1']." ".$customer['post_code']; ?>
    </option>
						<?php
						
						}
						?>
			       	   </select>
			       	   </div>
                       <div class="col-md-2">
                       <input type="submit" class="btn btn-success" value="Generate Statement"></div>
			       	   
                       <!-- now retrieve the transactions of this customer -->
                   </div>
                   <div>&nbsp;</div>
				   <div id="customer_details"></div>
			       	    
			       </div>
			    </div>
</form>
</body>
</html>