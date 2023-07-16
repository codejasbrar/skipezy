<!doctype html>
<?php 
//include "admin_side_bar.php";
include "navbar.php";

?>
<html>
<head>
<meta charset="utf-8">
<title>SkipTrak Software for Skip Hire Business</title>

</head>

<body>
   <div class="container-fluid">
   <form name="new_skip_form" id="new_skip_form">

	 <div class="container-fluid">
	 <div class="row">
	 	<div class="col-md-12">
	 		<div>&ensp;</div>
	 		<div>&ensp;</div>
	 		<div>&ensp;</div>
	 		<div>&ensp;</div>
	 		<div>&ensp;</div>
	 	</div>
	 </div>
	 	<div class="row">
	 		<div class="col-md-12">
	 		  <div class="col-md-2"></div>
	 		  <div class="col-md-8">
	 		  	  <div class="panel" style="background-color: #e9e9e9;box-shadow: 5px 5px 5px;">
	 		  	  	  <div class="panel-primary">
	 		  	  	  	<div class="panel-heading">Payment Recived</div>
	 		  	  	  </div>
	 		  	  	  <div class="panel-body">
	 		  	  	     <div class="col-md-2"></div>
	 		  	  	     <div class="col-md-8">
	 		  	  	  		<label for="customer_name" style="" class="col-sm-4">Customer Name</label>
                 <div class="form-group col-sm-8">
                 <select name="customer" style="width:60%;" id="customer" class="form-control">
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
                 <label for="amount" class="col-sm-4">Date</label>
                             <div id="gross_payment" class="form-group col-sm-8">
                                <input type="text" style="width:60%;" name="pay_date" id="pay_date" class="form-control">          
                           </div>
                           <label for="amount" class="col-sm-4">Amount</label>
                             <div id="gross_payment" class="form-group col-sm-8">
                                <input type="text" style="width:60%;" name="amount" id="amount" class="form-control">          
                           </div> 
                           <input type="hidden" name="payment_type" value="cr"/>
                           <div id="payment_status"></div>
                         <center><input type="submit" name="btn" value="Update" class="btn btn-lg btn-primary" id="create_entry"></center>
                         </div>
                         <div class="col-md-2"></div>
	 		  	  	  </div>
	 		  	  </div>
	 		  </div>
	 		  <div class="col-md-2"></div>	
	 		</div>
	 	</div>
	 </div>
     <input type="hidden" name="create_new_payment" value="true" />
      </form>
   </div>
   <!-- Script Start -->
        <script type="text/javascript">
            $('#create_entry').click(function(){
        alert("Demo");
              var form=$('#new_skip_form');
       var dataString = $("#new_skip_form").serialize();
       alert(dataString);
                $.ajax({
                    type: "POST",
                    url: "post_process.php",
              data: form.serialize(),
                    success: function(data) {
                     console.log(data); 
           $('#skip_created').html(data); 
                }
            });
        });
   
  </script>
   <!-- Script End -->
</body>
</html>