<!DOCTYPE html>

 
<html>
<meta charset="UTF-8"> 
<head>
	<title></title>
	<?php 
	include("navbar_list.php");
	include "dbconfig.php";
	include("dynamic_table.php");
	?>
  
<style>
table#customer tbody  tr {
    cursor : pointer;
}
 </style>
 
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
     <script>
  $(document).ready(
		  function () {
			$('#start_date').datepicker({
			  changeMonth: true,//this option for allowing user to select month
			  changeYear: true, //this option for allowing user to select from year range
			  dateFormat: 'yy-mm-dd'
			});
		  }
		
		);
		$(document).ready(
		  function () {
			$('#from').datepicker({
			  changeMonth: true,//this option for allowing user to select month
			  changeYear: true, //this option for allowing user to select from year range
			  dateFormat: 'yy-mm-dd'
			});
		  }
		
		);
		
		$(document).ready(
		  function () {
			$('#end_date').datepicker({
			  changeMonth: true,//this option for allowing user to select month
			  changeYear: true, //this option for allowing user to select from year range
			  dateFormat: 'yy-mm-dd'
			});
		  }
		
		);
		
		$(document).ready(
		  function () {
			$('#to').datepicker({
			  changeMonth: true,//this option for allowing user to select month
			  changeYear: true, //this option for allowing user to select from year range
			  dateFormat: 'yy-mm-dd'
			});
		  }
		
		);
  </script>
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
<body style="font-family:Montserrat;">
<input type="hidden" value="<?php echo $customer_id;?>" id="customer_id"/>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12" style="margin-top: 10%;">
            	<ul class="nav nav-tabs">
                      <li class="active">
                      <a data-toggle="tab" href="#home">Customer Details</a></li>
                      <li><a data-toggle="tab" href="#transactions">Transactions</a></li>
                      <li><a data-toggle="tab" href="#jobs">Jobs Done</a></li>
                      <li><a data-toggle="tab" href="#invoice">Create Invoice</a></li>
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
                            <tbody id="transactions">
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
                        <?php 
			$customer_sql="SELECT orders.id AS order_id, order_details.start_date as start_date, order_details.end_date , skips.size AS skip, customers.name AS customer_name, customers.mobile, customers.address1,customers.city, customers.post_code, orders.total_amount AS total_amount, job_types.name AS job_type, payment_type.name AS payment_type, order_status.name AS order_status
FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN payment_type ON order_details.payment_status = payment_type.id
LEFT JOIN order_status ON orders.status = order_status.id
LEFT JOIN skips ON order_details.skip_id = skips.id
WHERE customers.id = $customer_id"; 
                                 $result=mysqli_query($con,$customer_sql);
								?>
                                
               
                      <table id="customers" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">

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

        <tbody >

        <?php

                while($job=mysqli_fetch_assoc($result))

                  {

                  

                                    
  ?>               

                           <td><?php echo $job['order_id'];?></td>
                           <td><?php  $start_date = new DateTime($job['start_date']);
               
               echo $start_date->format("d F, Y")
               
               
               ?></td>
                           <td><?php  $end_date = new DateTime($job['end_date']);
               
               echo $end_date->format("d F, Y")
               
               
               ?></td>
                           <?php 
               
               $today = new DateTime();
               $no_of_days = $today->diff($start_date)->format("%a"); 
               if($no_of_days>30){?>
               <td bgcolor="#F30105"><?php echo $no_of_days;?></td>  
               <?php }else{?>
               <td><?php echo $no_of_days;?></td>  
              <?php }   ?>
                           
                           <td><?php echo $job['skip'];?></td>
                           
                           <td bgcolor="#08E006"><?php echo "£".$job['total_amount'];?></td>
                           <td><?php echo $job['job_type'];?></td>
                           <?php
                           if($job['payment_type']=='Not Paid'){?>
               <td bgcolor="#F30105" style="color:#F7F4F4;"><?php echo $job['payment_type'];?></td>  
               <?php }elseif($job['payment_type']=='Fully Paid'){?>
               <td bgcolor="#0C9402" style="color:#F7F4F4;" ><?php echo $job['payment_type'];?></td>  
              <?php }else {?><td><?php echo $job['payment_type'];?></td><?php }  ?>
                           <td><?php echo $job['order_status'];?></td>
   
                

            </tr>

            

      <?php           

        }

                

        ?>

            

            </tbody>

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
                      
                      <!-- Create Invoice starts here -->
                      <div id="invoice" class="tab-pane fade">
                        <h3>Create Invoice</h3>
                      <div class="col-md-6">
                       <div class="panel">
		   	<div class="panel-body" style="background-color:#e9e9e9;">
		   	  <div class="row">
		   	  	  
                  
            <div class="form-group col-md-4">
                             <label for="area">Date From </label>
                                 <input type="text" name="start_date" class="form-control" name="start_date" id="start_date" placeholder="Select a Date">
                            
                              </div>
                                <div class="form-group col-md-4">
                             <label for="area">Date To</label>
                                 <input type="text" name="end_date" class="form-control" id="end_date" placeholder="Select a Date">
                            
                              </div>
                                <div class="form-group col-md-4 pull-right">
                                 <p style="padding:15px;" name="create_invoice" class="btn btn-success btn-sm" id="create_invoice">Create Invoice</p>
                            
                              </div>
               </div>
              </div>
             </div>
		   
                 
                     </div>
                     <div id="invoice_details"></div>
<form action="" method="POST">
<button type="submit" name="btn-crtinvoice">Create Invoice (PDF)</button>
</form>
                     
<?php
ob_start();
if(isset($_POST['btn-crtinvoice']))
{
require('WriteHTML.php');

$pdf=new PDF_HTML();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();

$pdf->SetFont('Arial','B',7);
$pdf->WriteHTML("Invoice<hr/>
$name<br/>
                      $mobile<br/>
                      $address1<br/>
                      $address2<br/>
                      $city<br/>
                      $phone<br/>
                      $email<br/>
                      $post_code<br/>");

$pdf->SetFont('Arial','B',7); 
$pdf->Output(); 
ob_end_flush();
}
?>
                      
                      </div>
                      
                      <!-- Create Invoicer ends here -->
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
 $(document).ready(function() {

    $('#customers').DataTable();

} );
		</script>
        
         <script type="text/javascript">
    
	$('#create_invoice').click(function(){
				 var create_invoice = $('#customer_id').val();
				 var start_date=$('#start_date').val();
				 var end_date=$('#end_date').val();
		var dataString ='create_invoice=' + create_invoice + '&start_date=' + start_date + '&end_date=' + end_date; 
	alert(dataString);
	
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
    
	$('#search_entry').click(function(){
				 var search_entry = $('#customer_id').val();
				 var from=$('#from').val();
				 var to=$('#to').val();
		var dataString ='search_entry=' + search_entry + '&from=' + from + '&to=' + to; 
	alert(dataString);
	
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
</body>
</html>
