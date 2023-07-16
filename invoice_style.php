<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php
		include("navbar.php");
		include "dbconfig.php";
$customer_id=79;

	?>
    <input type="hidden" value="<?php echo $customer_id;?>" id="customer_id"/>
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
			$('#end_date').datepicker({
			  changeMonth: true,//this option for allowing user to select month
			  changeYear: true, //this option for allowing user to select from year range
			  dateFormat: 'yy-mm-dd'
			});
		  }
		
		);
  </script>
</head>
<body>

	   	  	 	  
	<div class="container-fluid">
		<div class="col-md-12" style="margin-top: 10%;">
		   <div class="col-md-2"></div>
           
           <div class="row">
           <div class="col-md-2"></div>
		   <div class="col-md-8">
           <div class="panel">
		   	<div class="panel-body" style="background-color:#e9e9e9;">
		   	  <div class="row">
		   	  	  
                  
            <div class="form-group col-md-4">
                             <label for="area">Date From </label>
                                 <input type="text" name="start_date" class="form-control" name="start_date" id="start_date">
                            
                              </div>
                                <div class="form-group col-md-4">
                             <label for="area">Date To</label>
                                 <input type="text" name="end_date" class="form-control" id="end_date">
                            
                              </div>
                                <div class="form-group col-md-4 pull-right">
                                 <p style="padding:15px;" name="create_invoice" class="btn btn-success btn-lg" id="create_invoice">Create Invoice</p>
                            
                              </div>
               </div>
              </div>
             </div>
		   <div class="panel" id="invoice">
		  
		   </div>
		   </div>
		   	</div>
		   <div class="col-md-2"></div>
		</div>
	</div>
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
					 $('#invoice').html(data); 
					 
                }
            });
        });
	</script>
</body>
</html>