<!DOCTYPE html>
<html>
<head>
  <title></title>
  <?php include "navbar.php";
  include "dbconfig.php";?>
  
  <!-- Java Scripti Files -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12" style="margin-top: 10%;">
            <div class="col-md-2"></div>
             <div class="col-md-8"> 
              <div class="panel"> 
                <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                
                    <div class="panel-heading"><center><h4>Transaction</h4></center></div>
                </div>
                <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;"> 
                <form method="post" name="payments" action="create_entry.php">
                  <div class="col-md-2"></div>
                    <div class="col-md-4">
                      <label for="transaction_date">Transaction Date</label>
                       <div class="form-group">
                          <div i class="input-append date form_datetime">
         <input type="text" name="transaction_date" class="form-control" id="transaction_date">
        <span class="add-on"><i class="icon-th"></i></span>
    </div>
     
        
                             </div>
                       <label for="transaction_type">Transaction Type</label>
                       <div class="form-group">
                          <select id="transaction_type" name="transaction_type" class="form-control"> 
                             <option value="" selected>Select Payment Type</option>
                             <option value="dr">Paying Money</option>
                             <option value="cr">Recieving Money</option>
                          </select>
                       </div>
                       <label for="transaction_type">Customer or Expense Name</label>
                  <select name="source" id="source" class="form-control required">  
        			<option value="" selected>Select Customer Type</option>
                  <?php 
                          $sql="SELECT * from customers";
						  $res=mysqli_query($con,$sql);
                  while($client=mysqli_fetch_assoc($res))
                      {
						  
						  
                  ?>
                  			
                  <option value=<?php echo $client['id'];?>><?php echo $client['name'];?>
                  </option>
                 
                  <?php 
				  
					  }
					  ?>
              
             
		</select>
                       
                    </div>
                    
                   
                    
                    
                   <!-- we will fetch list of all jobs of this client in this div -->
                               
                                 <div id="project"></div> 
                                 
                    <div class="col-md-4">
                     <label for="amount">Amount*</label>
                       <div class="form-group">
                          <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount...">
                       </div>
                      
                       <label for="detail_entry">Details Of Entry</label>
                       <input type="text" id="details" name="details" class="form-control">
                    </div> 
                  <div class="col-md-2"></div>
                  <div class="col-md-12"> 
                   <div class="col-md-12" id="pay_type">&ensp;</div>
                  <center><p id="new_entry" class="btn btn-primary btn-lg" >Create Entry</p></center>      
                 </form>
                 </div>
                 </div>
                
              </div>
              </div>
              <div class="col-md-2"></div>
          </div>
       </div>
    </div>
    
	   <script type="text/javascript">
 $('#transaction_type').change(function(){
              var pay_type = $(this).val();
               
                var dataString = 'pay_type=' + pay_type;
               // alert(dataString);
				$(this).css('background-color', '#F0E10F');
                $.ajax({
                    type: "POST",
                    url: "payment_type.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
					 $('#pay_type').html(data); 
                }
            });
        });
		
$('#new_entry').click(function(){
    var	transaction_date=$('#transaction_date').val();
	var	create_entry=$('#transaction_type').val();	
	var amount=$('#amount').val();
    var details=$('#details').val();
	var source=$('#source').val();
	
               
			   var dataString ='transaction_date=' + transaction_date + '&create_entry=' + create_entry + '&amount=' + amount + '&source=' + source+ '&details=' + details;
			   alert(dataString);
				$(this).css('background-color', '#F0E10F');
                $.ajax({
                    type: "POST",
                    url: "post_processs.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
					 $('#pay_type').html(data); 
                }
            });
        });
		
  $(document).ready(
		  function () {
			$('#transaction_date').datepicker({
			  changeMonth: true,//this option for allowing user to select month
			  changeYear: true, //this option for allowing user to select from year range
			  dateFormat: 'yy-mm-dd'
			});
		  }
		
		);
	</script> 
          
</body>
</html>