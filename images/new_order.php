<!DOCTYPE html>
<html>
<head>
<style>

#name-list{float:left;list-style:none;margin:0;padding:0;width:250px;}
#name-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;width:250px;}
#name-list li:hover{background:#63ABD9; cursor:pointer;width:250px;}
#search-name{padding: 10px;border:#000000 1px solid;width:250px;}
</style>

<title></title>
  <?php 
include "navbar.php";

?>

<!-- Java Scripti Files -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
<meta charset="utf-8">
<title>SkipTrak Software for Skip Hire Business</title>
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
    $(document).ready(
      function () {
      $('#payment_date').datepicker({
        changeMonth: true,//this option for allowing user to select month
        changeYear: true, //this option for allowing user to select from year range
        dateFormat: 'yy-mm-dd'
      });
      }
    
    );
      $(document).ready(function(){
         
      });
     $(document).ready(function () {
  //called when key is pressed in textbox
  $(".numeric").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
    });
});


  </script>
<script>
$(document).ready(function(){
	$("#search-name").keyup(function(){
		//$("#delivery_address").hide();
		//if any other div are open close them or hide them
		
		$.ajax({
		type: "POST",
		url: "find_customer.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-name").css("background","#000 url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-name").css("background","#green");
		}
		});
	});
});

function selectCustomer(val) {
	var data=val;
	 var data = data.split('-');
	var id=data[0];
	var name=data[1];
	//alert(id);
	$('#new_customer').hide();
	//now show the delivery div as well
	$("#delivery_address").show();
	$("#search-name").val(name);
	$("#old_customer_id").val(id);

//now fetch data based on this id 
 $.ajax({
		type: "POST",
		url: "find_address.php",
		data:'customer='+id,
		
		success: function(data){
			$("#customer_delivery_address").html(data);
			$("#delivery_address").show();
			 $("#frmSearch").hide();

			
		}
		});
		
$("#suggesstion-box").hide();
}
</script>


</head>
<body style="font-size:16px;">
    <form name="new_order_form" id="new_order_form" method="post" action="create_new_order.php">
    <input type="hidden" name="new_order_form">
    <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div>&ensp;</div>
        <div>&ensp;</div>
        <div>&ensp;</div>
        <div>&ensp;</div>
      </div>
    </div>
    <br><br>
    <div class="row">
       <div class="col-md-12">
            <div class="col-md-2"></div>
                <div class="col-md-8">
                 
                 <div class="panel" style="background-color: #e9e9e9;box-shadow: 5px 5px 5px;">
                    <div class="panel-primary">
                     <div class="panel-heading"><center>Customer Details Section</center></div>
                     </div>
                     <div class="panel-body">
                     <div class="frmSearch">
                     <label for="full_name">Customer Name</label>
<input type="text" id="search-name" class="form-control" placeholder="Customer Name" />
<input type="hidden" name="old_customer_id" id="old_customer_id" placeholder="xxx" />

<div id="suggesstion-box"></div>
</div>
<div id="clearfix"></div>
<br>
<div id="new_customer" class="col-md-12">
                        <div class="col-md-4">
                        <label for="full_name">Full Name</label>
                        <div class="input-group">
                          <input type="text" id="full_name" name="full_name" placeholder="Enter Full Name" class="form-control">
                          <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="glyphicon glyphicon-user"></i>
                  </span>  
                </span>
                       </div><br>
                       
                        <label for="post_code">Post Code</label>
                  <div class="input-group">
                    <input type="text" id="customer_post_code" name="post_code" placeholder="Enter Post Code" class="form-control">
                    <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="glyphicon glyphicon-map-marker"></i>
                  </span>  
                </span>
                  </div><br>
                      
                     </div>
                     <div class="col-md-4">
                        
                        
               <label for="phone">Phone</label>
                  <div class="input-group">
                    <input type="text" id="phone" name="phone" placeholder="Enter Phone Number" class="form-control">
                    <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="glyphicon glyphicon-phone"></i>
                  </span>  
                </span>
                  </div><br>
            
                   <label for="city">Town</label>
                       <div class="input-group">
                         <input name="city" type="text" id="customer_city" placeholder="Enter City" class="form-control">
                          <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="glyphicon glyphicon-map-marker"></i>
                  </span>  
                </span>
                      </div><br> 
                       
                  </div>
    <div class="col-md-4">
                        
                        
              <label for="address1">Address </label>
                       <div class="input-group">
                         <input name="address1" type="text" id="customer_address1" placeholder="Enter Address" class="form-control">
                         <span class="input-group-btn">
                  <span class="btn btn-default pull-right"> 
                    <i class="glyphicon glyphicon-map-marker"></i>
                  </span>  
                </span>
                       </div><br>
                       
                  </div>
                 
              </div>
</div>
</div>
					
                     <br>
                           
                       
                 
            
     </div>
            <div class="col-md-2"></div>
            </div>
    </div>
    <div class="row" id="delivery_address">
       
       
       
        <div class="col-md-12">
           <div class="col-md-2"></div>
                       <div class="col-md-8">
                        <div id="clearfix"></div>
                         
                           
                           
                  <div class="panel" style="background-color: #e9e9e9;box-shadow: 5px 5px 5px;">
                    <div class="panel-primary">
                   <div class="panel-heading"><center>Customer Delivery Details Section</center></div>
                     </div>
                     <div class="panel-body">
                     <div class="col-md-6">
                           <label for="jobtype">Select Delivery Address</label>
                           <select name="delivery_address" id="customer_delivery_address" class="form-control">
                           
                           
                           </select>
                           
                           
                           <div id="new_delivery_address">
                           <!-- for new delivery address -->
                           <div class="form-group col-md-12">
                           <div class="clearfix">&nbsp;</div>
                  <div class="panel" style="background-color: #e9e9e9;box-shadow: 5px 5px 5px 5px;">
                    <div class="panel-success">
                     <div class="panel-heading" style="background-color:#EDFB0D;"><center>New Delivery Adddress Details</center></div>
                     </div>
                     <div class="panel-body">
                  
                            
                            <label for="jobtype"></label>
                           <div id="delivery_address1"></div>
                          
                   <div class="col-md-12">
                                 
                       <div class="col-md-4">
                           <label>Address</label>
                           <input type="text" placeholder="Enter Address" name="del_address" id="name" class="form-control col-md-4">                           
                           </div>
                        <div class="col-md-4">   
                              <label>Post Code</label>
                           <input type="text" placeholder="Enter Post Code" name="del_post_code" id="name" class="form-control col-md-4">
                           
                          </div>   
                          <div class="col-md-4">   
                                    <label>Town</label>
                           <input type="text" placeholder="City" name="del_city" class="form-control col-md-4">
                          </div>
                         </div>
                         
                           </div></div>
                            </div> </div>
                  <div class="col-md-8" id="customer_details"></div>
                  <div class="col-md-8" id="delivery"></div>
                           
                     </div>
                         <div class="col-md-6"></div>
                        </div>
                        </div>
                        
                        <div class="col-md-1"></div>
                  
             </div>
         <div class="col-md-2"></div>
                       </div>
          
                 </div>
       
       
    </div>
      <div class="row" >
        <div class="col-md-12" >
             <div class="col-md-2"></div>
             <div class="col-md-8">
                <div class="panel">
                   <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                     <div class="panel-heading"><center>Enter Job Details</center></div>
                   </div>
                   <div class="panel-body" style="background-color: #e9e9e9;box-shadow: 5px 5px 5px;">
                   <div class="col-md-1"></div>
                   <div class="col-md-5">
                      <label for="area">Start Date</label>
                      <div class="form-group">
                      <?php
					 $end_date = date('Y-m-d',(strtotime('21 day', time())));
					 $start_date = date("d/m/Y", strtotime('0 day', time()));
  					?>

 <input type="text" style="width:70%;" value="<?php echo $start_date;?>" name="start_date" class="form-control" placeholder="Select a Date" name="start_date" id="start_date">
                      </div>
                      <label for="jobtype">Job Type</label>
                        <div class="form-group">
                          <select name="job_type" style="width:70%;" id="job_type" class="form-control">
                            <option value="1">Deliver</option>
                            <option id="collection" value="2">collection</option>
                            <option id="exchange" value="3">Exchange</option>
                          </select>
                        </div>
                      <label for="amount">Price Given</label>
                             <div id="gross_payment" class="form-group">
                                <input type="text" style="width:30%; height:30px;" name="amount" id="amount" value="0.00" class="form-control numeric">                                    <div style="color:red;" id="errmsg"></div>
                           </div>
                        <div id="order_created"></div> 
                      <label for="nos">No.of Skips</label>
                             <div class="form-group">
                              <input id="skips" style="width:20%;height:30px;" type="text" value="1" name="skips"class="form-control numeric" readonly>
                              <div id="errmsg"></div>
                              </div>
                     <div id="exchange_with">
                        <label for="skiptype">Exchange With</label>
                        <div class="form-group">
                           <select name="exchange_skip_id" style="width:70%;" id="exchange_skip_id" class="form-control">
                                   <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" selected value="0">Select a Skip</option>
                               <?php
                 
                    $skip_sql="SELECT * from skips order by size ASC";
                  $t_result=mysqli_query($con,$skip_sql);
                  while($skip=mysqli_fetch_assoc($t_result))
                  {
                  ?>
                  
  <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="<?php echo $skip['id']; ?>">
     <?php echo $skip['size'].", ".$skip['current_stock']." skips available"; ?>
    </option>
            <?php
            
            }
            ?>
                                </select>
                                     <!-- Retrieve the stock of selected skip -->
                   <?php
              if(isset($_POST['selected_skip']))
            {
                            $selected_skip=$con->real_escape_string($_POST['selected_skip']);
                  $skip_sql="SELECT current_stock from skips WHERE id=$selected_skip";
                  if (!mysqli_query($con,$skip_sql)) {
        echo $sql;
        die('skip 3 ORDER_Details -Error: ' . mysqli_error($con));
      }
                  $result=mysqli_query($con,$skip_sql);
                  $current_stock=mysqli_fetch_assoc($result);
                  echo $stock=$current_stock['current_stock'];
                  
            }
          ?>
                        </div>
                      </div>
                   </div>
                   
                   <div class="col-md-5">
                       
                <label for="skiptype">Skip Size</label>
                        <div class="form-group">
                           <select name="skip_id" style="width:70%;" id="skip_id" class="form-control">
                                   <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" selected value="1">6 cu yd</option>
                               <?php
                 
                  $skip_sql="SELECT * from skips order by size ASC";
                  $t_result=mysqli_query($con,$skip_sql);
                  while($skip=mysqli_fetch_assoc($t_result))
                  {
                  ?>
                  
  <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="<?php echo $skip['id']; ?>">
     <?php echo $skip['size'].", ".$skip['current_stock']." skips available"; ?>
    </option>
            <?php
            
            }
            ?>
                                </select>
                <div class="col-md-1"></div>
                </div>
                <label for="location">Location</label>
                       <div class="form-group">
                          <select id="skip_location" name="skip_location" style="width:70%;" class="form-control">
                            <option value="driveway">Driveway</option>
                            <option value="off_the_road">Off the Road</option>
                            <option value="ally_way">Ally Way</option>
                            <option value="behind_the_house">Behind the House</option>
                          </select>
                        </div>
                         <label for="delivery_slot">Delivery Slot</label>
                       <div class="form-group">
                          <select id="delivery_slot" name="delivery_slot" style="width:70%;" class="form-control">
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                          </select>
                        </div>
                         <label for="nos">Job Paid</label>
                               <div class="form-group">
                               <select style="height:30px;width: 40%;" name="payment_type" id="payment_type"  class="form-control" style="font-size:13px; cursor:pointer;">
                                <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;"value="2" selected>Not Paid</option>
                              
                               <?php
                 
                    $payment_sql="SELECT * from payment_type order by id ASC";
                  $t_result=mysqli_query($con,$payment_sql);
                  while($payment=mysqli_fetch_assoc($t_result))
                  {
                  ?>
                  
  <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="<?php echo $payment['id']; ?>">
     <?php echo $payment['name']; ?>
    </option>
            <?php
            
            }
            ?>
                             </select>
                             
                              </div>
                              <div class="clearfix"></div>
                             
                              
                              
           
             </div>
                   <div class="col-md-10"><input type="submit" style="cursor: pointer; font-family:Montserrat;height: 40px;border-radius: 0px;"  class="btn btn-success btn-large pull-right" value="Create New Job"></div>
                  </div>
              </div>
              <div class="col-md-2"></div>
      </div>  
     </div>
     
     <!--<div class="row" id="payment_panel">-->
<!--         <div class="col-md-12">
            <div class="col-md-2"></div>
             <div class="col-md-8">
                   <div class="panel"  style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                  <div class="panel-primary">
                     <div class="panel-heading"><center>Payment Details</center></div>
                     </div>
                      <div class="panel-body">
                    
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                              
                          
                             </div>
                           <div class="col-md-5">
                               
                                                                              
                             
                             </div>
                          
                           <div id="order_added"></div>
                            
                     </div>
                     
                       <div class="col-md-1"></div>
                        
                        
                  </div>
             </div>
         </div>-->
        
     </div> 
     </div>
        
    </form>
   


    <script type="text/javascript">
 
 $( document ).ready(function() {
  $('#delivery_details').hide();
  $('#payment_label').hide();
  $('#payment_recieved').hide();
  $('#gross_label').hide();
  $('#gross').val('');
  $('#save_order').hide();
  $('#vat_details').hide();
  $('#find_gross').hide();
  $('#pay_date').hide();
  $('#exchange_with').hide();
  $('#new_delivery_address').hide();
  $('#new_customer').hide();
  	$("#delivery_address").hide();

  
  });
 
   
    $('#skip_id').change(function(){
              var selected_skip = $(this).val();
         var dataString = 'selected_skip=' + selected_skip;
              // alert(dataString);
        $(this).css('background-color', '#F0E10F');
                $.ajax({
                    type: "POST",
                    url: "new_order.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
          
           $('#skip_stock').html(data); 
           //$('#delivery_address').hide();
                }
            });
  });
        
    
    
     $('#customer_id').change(function(){
              var customer_id = $(this).val();
          //$('#delivery_check').show();
        
        var get_customer_address=$(this).val();
                var dataString = 'customer_id=' + customer_id+'&get_customer_address=' + get_customer_address;
              // alert(dataString);
        $(this).css('background-color', '#F0E10F');
                $.ajax({
                    type: "POST",
                    url: "create_order.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
          
           $('#customer_details').html(data); 
           //$('#delivery_address').hide();
                }
            });
        });
    $('#customer_id').keyup(function(){
               var customer_id = $(this).val();
          //$('#delivery_check').show();
        
        var get_customer_address=$(this).val();
                var dataString = 'customer_id=' + customer_id+'&get_customer_address=' + get_customer_address;
              // alert(dataString);
        $(this).css('background-color', '#F0E10F');
                $.ajax({
                    type: "POST",
                    url: "create_order.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
          
           $('#customer_details').html(data); 
           //$('#delivery_address').hide();
                }
            });
        });
    
   
  $('#payment_type').click(function(){
    
  $('#save_order').show();
  });
  
  
  

$('#find_gross').click(function(){
  //alert('demo');
  $('#gross_label').show();
  var amount=$('#amount').val();
  var vat=$('#vat').val();
  var permit=$('#permit').val();
  var skips=$('#skips').val();
  
  //alert(amount);
   var dataString = 'amount=' + amount +'&permit=' + permit+'&skips=' + skips+'&vat=' + vat;
  //alert(amount);
  $.ajax({
                    type: "POST",
                    url: "create_order.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
           $('#calculate_gross').html(data); 
           
                }
            });
  
});

$('#job_type').change(function(){
	
	var exchange=$('#job_type').val();
	if(exchange=='3')
	{
		$('#exchange_with').show();
		$('#skips').readonly();
		}
	else
	{
		$('#exchange_with').hide();
		}
});


// Now check if payment is given in full or half
 $('#payment_type').change(function(){
             
       //alert($('#gross').val());
        
      var payment_type=$(this).val();
               
      if(payment_type=='1') 
        
        {
        $('#pay_date').show();
        var gross=$('#gross').val();
        if($('#gross').val('')){
            var gross=$('#amount').val();
            }
            else{
          var gross=$('#gross').val();
            }
          $('#gross').val(gross);
        $('#gross_label').show();
        $('#gross').show();
       //   alert(gross);
        $('#payment_label').show();
        $('#payment_label').html("All Cleared");
        $('#payment_recieved').show();
        $('#payment_recieved').val(gross);
        $('#payment_recieved').css('background-color','#46F84A');
        }
      
      if(payment_type=='3') 
        
        {
          $('#pay_date').show();
        var gross=$('#gross').val();
        //alert(gross);
        if($('#gross').val('')){
            var gross=$('#amount').val();
            }
            else{
          var gross=$('#gross').val();
            }
        $('#gross').val(gross);
        $('#gross_label').show();
        $('#gross').show();
        $('#payment_label').show(); 
        $('#payment_label').html("How Much Paid?");
        $('#payment_recieved').show();
        $('#payment_recieved').css('background-color', '#F0E10F');
        $('#payment_recieved').val(0.00);
        $('#payment_recieved').focus();
        }
        
        if(payment_type==5) 
        
        {
        $('#pay_date').show();
        var gross=$('#gross').val();
        $('#payment_label').show();
        $('#payment_label').html("All Cleared");
        $('#payment_recieved').show();
        
        if($('#gross').val('')){
            var gross=$('#amount').val();
            }
            else{
          var gross=$('#gross').val();
            }
        
        $('#gross').val(gross);
        $('#gross_label').show();
        $('#gross').show();
        $('#payment_recieved').val(gross);
        $('#payment_recieved').css('background-color', '#46F84A');
        }
        if(payment_type==2) 
        
        {
        $('#pay_date').hide();
        
        $('#payment_label').hide();
        
        $('#payment_recieved').hide();
      
        $('#payment_recieved').val(0);
        
        }
        if(payment_type==4) 
        
        {
        $('#pay_date').hide();
        $('#payment_date').val(0000-00-00);
        
        
        $('#payment_label').hide();
        
        $('#payment_recieved').hide();
      
        $('#payment_recieved').val(0);
        
        }
        
        
                
        });
    
  $('#save_order').click(function(){
    
  var create_order="Yes";
  var job_type=$('#job_type').val();
  var skip_id=$('#skip_id').val();  
  var exchange_skip_id=$('#exchange_skip_id').val(); 
  if (exchange_skip_id==''){exchange_skip_id=0}
  var start_date=$('#start_date').val();
  var end_date=$('#end_date').val();
  // customer and delivery details
  
  var customer_id=$('#customer_id').val();
  var location=$('#delivery_address').val();
  var skip_location=$('#skip_location').val();
  var delivery_slot=$('#delivery_slot').val();
  
  // payment details
  
  var amount=$('#amount').val();
  var skips=$('#skips').val();
  var nett=$('#nett').val();
  var vat=$('#vat').val();
  var permit=$('#permit').val();
  var gross=$('#gross').val();
  
  var payment_recieved=$('#payment_recieved').val();
  var payment_type=$('#payment_type').val();
  var payment_date=$('#payment_date').val();
  var full_name=$('#full_name').val();
  
  if(payment_type=='0') 
        
        {
        alert("Please select payment made or not ?");
        return false; 
        }
		
  var old_customer_id=$("#old_customer_id").val();
  //if(old_customer_id==0){alert("Zero")};
 
 
  //alert(amount);
   var dataString ='create_order=' + create_order+ '&old_customer_id=' + old_customer_id + '&job_type=' + job_type+'&full_name=' + full_name + '&start_date=' + start_date + '&end_date=' + end_date+ '&skip_id=' + skip_id +'&exchange_skip_id=' + exchange_skip_id +'&customer_id=' + customer_id +'&location=' + location + '&amount=' + amount + '&skips=' + skips + '&nett=' + nett + '&vat=' + vat + '&permit=' + permit +'&gross=' + gross +'&payment_recieved=' + payment_recieved +'&payment_type=' + payment_type+'&payment_date=' + payment_date+'&skip_location=' + skip_location+'&delivery_slot=' + delivery_slot;
  alert(dataString);
  
  //return false;
  $.ajax({
                    type: "POST",
                    url: "create_new_order.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
          // $('#gross').hide();
           $('#order_created').html(data); 
           
                }
            });
        });
      
$('#skips').keyup(function(){
  
    
    var amount=$('#amount').val();
    var skips=$('#skips').val();
    var nett=amount*skips;
    var vat=$('#vat').val();
    var vat_due=(vat*nett)/100;
    $('#nett').val(nett);
    var permit=$('#permit').val();
    var gross;
    permit=Number(permit);
    gross=+nett + +vat_due + +permit;
    
    $('#gross').val(gross);
});
$('#amount').keyup(function(){
  
    var amount=$('#amount').val();
    var skips=$('#skips').val();
    var nett=amount*skips;
    var vat=$('#vat').val();
    var vat_due=(vat*nett)/100;
    $('#nett').val(nett);
    var permit=$('#permit').val();
    var gross;
    permit=Number(permit);
    gross=+nett + +vat_due + +permit;
    
    $('#gross').val(gross);
});
$('#vat').keyup(function(){
  
    
    var amount=$('#amount').val();
    var skips=$('#skips').val();
    var nett=amount*skips;
    var vat=$('#vat').val();
    var vat_due=(vat*nett)/100;
    $('#nett').val(nett);
    var permit=$('#permit').val();
    var gross;
    permit=Number(permit);
    gross=+nett + +vat_due + +permit;
    
    $('#gross').val(gross);

});
$('#permit').keyup(function(){
  
    var amount=$('#amount').val();
    var skips=$('#skips').val();
    var nett=amount*skips;
    var vat=$('#vat').val();
    var vat_due=(vat*nett)/100;
    $('#nett').val(nett);
    var permit=$('#permit').val();
    var gross;
    permit=Number(permit);
    gross=+nett + +vat_due + +permit;
    
    $('#gross').val(gross);
    

});

$('#customer_delivery_address').click(function(){
	//if no address was found
	var delivery_address = $('#customer_delivery_address').val();
	if(delivery_address=='0'){
					 $('#delivery').hide();
	$('#new_delivery_address').show();
	}
});




$('#customer_delivery_address').change(function(){
	
	
	var delivery_address = $('#customer_delivery_address').val();
			  	
                var dataString = 'delivery_address=' + delivery_address;
				//alert(dataString);
				if(delivery_address=='0'){
					 $('#delivery').hide();
	$('#new_delivery_address').show();
	}
       else{$('#new_delivery_address').hide();
	   
	   var delivery_address = $(this).val();
			  	
                var dataString = 'delivery_address=' + delivery_address;
               //alert(dataString);
				$(this).css('background-color','#57F019');
                $.ajax({
                    type: "POST",
                    url: "find_delivery_address.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
					 $('#delivery').show();
					 $('#delivery').html(data); 
					 //$('#delivery_address').hide();
                }
            });
	   
	   }       
});


 
  </script>

</body>
</html>