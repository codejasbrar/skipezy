<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include("navbar.php");
	include "dbconfig.php";
	?>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12" style="margin-top: 10%;">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="panel">
			       <div class="panel-primary"style="box-shadow: 5px 5px 5px;">
			       	   <div class="panel-heading"><center>Transaction History</center></div>
			       </div>
			       <div class="panel-body" style="background-color:#e9e9e9; box-shadow: 5px 5px 5px;">
			           <div class="col-sm-2"></div>
			       	   <label for="sjobid" style="margin-right: -10%;" class="col-sm-3">Customer Name</label>
			       	   <div class="form-group col-sm-4">
			       	   <select name="customers" id="customer" class="form-control">
			       	   	 <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a Customer </option>
                               <?php
							   
							        $customers_sql="SELECT * from customers order by name ASC";
									$t_result=mysqli_query($con,$customers_sql);
									while($customer=mysqli_fetch_assoc($t_result))
									{
									
									?>
	<option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="<?php echo $customer['id']; ?>">
	   <?php echo $customer['name']." ,Mobile:".$customer['mobile']." ,".$customer['address1']." ".$customer['post_code']; ?>
    </option>
						<?php
						
						}
						?>
			       	   </select>
			       	   </div>
			       	   <div class="col-sm-3"></div>
                       <!-- now retrieve the transactions of this customer -->
                   
				   <div id="customer_details"></div>
			       	    
			       </div>
			    </div>
				</div>
				<div class="col-md-2"></div>
			</div>
		  </div>
					  <div class="row">
					  <div class="col-md-12">
					   <div class="col-md-2"></div>
					   <div class="col-md-8">
					  
						</div>
					
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</div>
    <script type="text/javascript">
     $('#customer').change(function(){
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
		</script>
</body>
</html>