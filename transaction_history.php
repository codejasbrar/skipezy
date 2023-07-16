<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include("navbar.php");
	include "dbconfig.php";
	?>
</head>


<?php
							    
							        $customer_id=$_GET['id'];
									
									$sql="SELECT (

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
									
									$result=mysqli_query($con,$sql);
									$customer=mysqli_fetch_assoc($result);
							?>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12" style="margin-top: 10%;">
            	<ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#home">Customer Details</a></li>
                      <li><a data-toggle="tab" href="#transactions">Transactions</a></li>
                      <li><a data-toggle="tab" href="#jobs">Jobs Done</a></li>
                      <li><a data-toggle="tab" href="#edit_customer">Update Details</a></li>
                      
                </ul>
                <!-- Tab Content Goes Here -->
                <div class="tab-content">
                      <div id="home" class="tab-pane fade in active">
                        <h3>Customer Details</h3>
                      <div class="col-md-6">
                      <?php
                      
                      $query=mysqli_query($con,"SELECT * FROM customers where id='$customer_id' ");
                      $row=mysqli_fetch_array($query);
                      $name=$row['name'];
                      $mobile=$row['mobile'];
                      $address1=$row['address1'];
                      $address2=$row['address2'];
                      $city=$row['city'];
                      $phone=$row['phone'];
                      $email=$row['email'];
                      $post_code=$row['post_code'];
                  ?>
                        <label for="mobile"><?php echo $name;?></label>
                        <div class="form-group">
                          
                       </div>
                       <label for="mobile">Mobile</label>
                       <div class="form-group">
                         <label for="mobile"><?php echo $mobile;?></label>
                       </div>
                       <label for="address1">Address Line1</label>
                       <div class="form-group">
                         <label for="mobile"><?php echo $address1;?></label>
                       </div>
                       <label for="city">Town</label>
                       <div class="form-group">
                         <label for="mobile"><?php echo $city;?></label>
                      </div> 
                      <label for="city">Post Code</label>
                       <div class="form-group">
                         <label for="mobile"><?php echo $post_code;?></label>
                      </div> 
                 
                     </div>
                     
                      </div>
                      <!-- Transactions Tab Starts Here -->
                      
                      <div id="transactions" class="tab-pane fade">
                        <h3>Transactions History of <?php echo $customer['name'];?> </h3>
                       <div class="container-fluid col-md-8">
                       <div class="panel">
			       		<div class="panel-primary"style="box-shadow: 5px 5px 5px;">
			       	  	 <div class="panel-heading"><center>Transaction History</center></div>
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
                            <tbody>
									<tr class="info">
			       	   	  	  	   <td><?php echo "£". $customer['gross'];?></td>
			       	   	  	  	   <td><?php echo "£".$customer['paid'];?></td>
			       	   	  	  	  <?php $balance=$customer['gross']-$customer['paid'];?>
                                   <td><?php echo "£".number_format($balance,2);?></td>
			       	   	  	  	 </tr>
                                 </tbody>
                                 </table>
                      <?php $customer_sql="SELECT transaction_date,amount from transactions where source_id=$customer_id order by transaction_date ASC"; 
                                 $result=mysqli_query($con,$customer_sql);
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
									while($transaction=mysqli_fetch_assoc($result))
									{
									?>
                                 
                          <?php  $transaction_date = new DateTime($transaction['transaction_date']);
               
               
               
               
               ?>
							<tr>
							  <div class="row"><td><?php  echo $transaction_date->format("d F, Y");?></td></div>
							  <div class="row"><td><?php  echo "£".$transaction['amount'];?></td></div>
							</tr>
                            <?php }?>
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
                        <h3>Jobs Done for <?php echo $customer['name'];?> </h3>
                        <?php $customer_sql="SELECT start_date,end_date,gross from order_details where customer_id=$customer_id order by start_date ASC"; 
                                 $result=mysqli_query($con,$customer_sql);
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
									while($transaction=mysqli_fetch_assoc($result))
									{
									?>
                                 
                          <?php  $start_date = new DateTime($transaction['start_date']);
               
               
               
               
               ?>
							<tr>
							  <div class="row"><td><?php  echo $start_date->format("d F, Y");?></td></div>
							  <div class="row"><td><?php  echo "£".$transaction['gross'];?></td></div>
							</tr>
                            <?php }?>
						</tbody>
						</div>
					</table>
                    
                      </div>
                      <!-- jobs Done Tab Ends Here -->
                      
                      <!-- edit custoemr starts here -->
                      <div id="edit_customer" class="tab-pane fade">
                        <h3>Edit  Details</h3>
                      <div class="col-md-6">
                      <?php
                      
                      $query=mysqli_query($con,"SELECT * FROM customers where id='$customer_id' ");
                      $row=mysqli_fetch_array($query);
                      $name=$row['name'];
                      $mobile=$row['mobile'];
                      $address1=$row['address1'];
                      $address2=$row['address2'];
                      $city=$row['city'];
                      $phone=$row['phone'];
                      $email=$row['email'];
                      $post_code=$row['post_code'];
                  ?>
                        <label for="name">Full Name</label>
                        <div class="form-group">
                          <input type="text" id="name" name="name" value="<?php echo $name;?>" class="form-control">
                       </div>
                       <label for="mobile">Mobile</label>
                       <div class="form-group">
                         <input type="text" id="mobile" name="mobile" value="<?php echo $mobile;?>" class="form-control">
                       </div>
                       <label for="address1">Address Line1</label>
                       <div class="form-group">
                         <input type="text" name="address1" id="address1" vlaue="<?php echo $address1;?>" class="form-control">
                       </div>
                       <label for="city">City</label>
                       <div class="form-group">
                         <input type="text" name="city" id="city" value="<?php echo $city;?>" class="form-control">
                      </div> 
                 
                     </div>
                     
                      </div>
                      <!-- edit customer ends here -->
                      
                    </div>
             </div>
          </div>
       </div>
    
    
    
    <!-- Java Script Starts -->
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
		
		$(document).ready(function(){
	
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	});

});
		</script>
</body>
</html>