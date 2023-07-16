<!DOCTYPE html>
<html>
<head>
	
   
    <?php include "navbar_list.php"; 
	include "dbconfig.php"; ?>
    <!-- Java Scripti Files -->
   
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script>
  $(document).ready(
      function () {
      $('#invoice_date').datepicker({
        changeMonth: true,//this option for allowing user to select month
        changeYear: true, //this option for allowing user to select from year range
        dateFormat: 'yy-mm-dd'
      });
      }
    
    );
	</script>
</head>
<body>
<form id="new_invoice">
     <div class="col-md-12" style="margin-top:7%;">
         
          <input type="hidden" name="new_invoice_form"/>
          
           <div class="col-md-2"></div>
           <div class="col-md-8">
              <div class="row">
                  <div class="panel">
                    <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                      <div class="panel-heading">
                        <h4><center>Personal Detail</center></h4>
                      </div>
                    </div>
                    <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                      <div class="col-md-3">
                       <label for="area">Invoice Date</label>
                      <div class="form-group">
                          <input type="text" style="width:70%;" class="form-control" placeholder="Select a Date" name="invoice_date" id="invoice_date">
                      </div></div>
                      <div id="clearfix">&nbsp;
                      </div>
                         
                          
                            <div class="form-group col-md-8"> 
                            <label for="jobtype">Select a Customer</label>
                           <select style="width:70%;" name="customer_name" id="customer_id" class="form-control">
                             <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a Customer </option>
                               <?php
                 
                  $customers_sql="SELECT * from customers order by name ASC";
                  $t_result=mysqli_query($con,$customers_sql);
                  while($customer=mysqli_fetch_assoc($t_result))
                  {
                  ?>
                  
  <option style="padding:10px; background-color:#9AD8EF; color:#320607; cursor:pointer;" value="<?php echo $customer['id']; ?>">
     <?php echo $customer['name']; ?>
    </option>
            <?php
            
            }
            ?>
                  </select> 
                  <div id="customer_details"></div>
                  </div>
                 
         
                 
                    
              
              </div>
              </div>
           </div>
           <div class="row">
           <div class="col-md-12">
               <div class="panel">
                    <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                       <div class="panel-heading"><h4><center>Invoice Details</center></h4></div>
                    </div>
                    <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                      
                      <table id="new_invoice_table" class="table table-bordered table-hover">
                      <thead>
                        
                        <tr class="btn-primary">
                             <th class="col-md-2">Sr. No.</th>
                             <th class="col-md-4"><center>Item</center></th>
                             <th class="col-md-4"><center>Quantity</center></th>
                             <th class="col-md-1"><center>Unit Price</center></th>
                             <th class="col-md-1"><center>Total</center></th>
                        </tr>     
                        </thead>
                        <tbody>
                           <tr>
                              <td class="col-md-2">&ensp;</td>
                              <td class="col-md-4">&ensp;</td>
                              <td class="col-md-4">&ensp;</td>
                              <td class="col-md-1">&ensp;</td>
                               <td class="col-md-1">&ensp;</td>
                           </tr>
                        </tbody>
                        <tbody>
                            <tr> 
                                <td class="row-num col-md-2">1</td>
                                <td class="col-md-4">
                                  <div class="form-group">
                                     
                                     <select id="item" name="item[]" class="form-control" style="width:70%;">
                             <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a Skip </option>
                               <?php
                 
                  $customers_sql="SELECT * from skips order by size ASC";
                  $t_result=mysqli_query($con,$customers_sql);
                  while($skip=mysqli_fetch_assoc($t_result))
                  {
                  ?>
                  
  <option style="padding:10px; background-color:#9AD8EF; color:#320607; cursor:pointer;" value="<?php echo $skip['id']; ?>">
     <?php echo $skip['size']; ?>
    </option>
            <?php
            
            }
            ?>
                  </select> 
                                     
                                  </div>
                                </td>
                                <td class="col-md-4">
                                  <div class="form-group">
                                     <input id="qty" type="text" name="qty[]" class="form-control">
                                  </div>
                                </td>
                                <td class="col-md-1">
                                  <div class="form-group">
                                     <input id="unit_price"  type="text" name="unit_price[]" class="form-control">
                                  </div>
                                </td>
                                <td class="col-md-1">
                                  <div class="form-group">
                                     <input id="sub_total"  type="text" name="sub_total[]" class="form-control">
                                  </div>
                                </td>
                            </tr>
                        </tbody>
                        
                       
                      </table>
                      <div class="col-md-2"></div>
                      <div class="pull-right col-md-6">
                       <p class="btn btn-danger pull-right"id="add_row" style="cursor:pointer; padding:10px;">Add 1 More Item</div>
                        <div class="pull-right col-md-6">
                    <p class="btn btn-success pull-right"id="submit" style="cursor:pointer; padding:10px;">Save Invoice</div>
                    </div>
											<input type="hidden" name="create_new_invoice" value="true" />
                    </div>
</form>

<div id="post"></div>
<script>
var jas = 1;
$('#add_row').click(function(){
	$('#new_invoice_table').append('<tbody><tr><td class="row-num col-md-2"></td><td class="col-md-4"><div class="form-group"><select style="width:70%;" name="customer_name" id="item'+jas+'" class="form-control"><option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value=""></option></select> </div></td><td class="col-md-4"><div class="form-group"><input type="text" name="qty[]" class="form-control"></div></td><td class="col-md-1"><div class="form-group"><input type="text" name="unit_price[]" class="form-control"></div></td><td class="col-md-1"><div class="form-group"><input type="text" name="sub_total[]" class="form-control"></div></td></tr></tbody>');
	var i = 1;
	$('.row-num').each(function(){
		$(this).html(i);
		i++;
	});
	$('#item option').clone().appendTo('#item'+jas);
	jas = jas + 1;
});
$('#submit').click(function(){
	var form = $('#new_invoice').serialize();
  alert(form);
	$.ajax({
		type: "POST",
		url: "post_process.php",
		data: form,
		success: function(data) {
			$('#post').html(data);
		}
	})
});

$('#customer_id').click(function(){
           alert(demo);
});

  $('#customer_id').change(function(){
           alert(demo);
        var get_customer=$(this).val();
                var dataString = 'get_customer=' + get_customer;
              alert(dataString);
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


$('#check_del_address').click(function(){
		var item=$('#customer_item').val();
		
		$('#item').val(item);
	    
		var qty=$('#customer_qty').val();
		
		$('#qty').val(qty);
		
		var unit_price=$('#customer_unit_price').val();
		
		$('#unit_price').val(unit_price);
		
		var sub_total=$('#customer_sub_total').val();
		
		$('#sub_total').val(sub_total);
		
	//$('#item').val(item);   
	var thisCheck = $(this);
	   //alert('thisCheck');
    	
	if(this.checked) {
        var thisCheck = $(this);
		//alert(thisCheck);
    }
	});
	
	$('#unit_price').keyup(function(){
  
    var unit_price=$('#unit_price').val();
    var qty=$('#qty').val();
	var sub_total=unit_price*qty;
    var sub_total=$('#sub_total').val(sub_total);
	});
	
	$('#qty').keyup(function(){
  
    var unit_price=$('#unit_price').val();
    var qty=$('#qty').val();
	var sub_total=unit_price*qty;
    var sub_total=$('#sub_total').val(sub_total);
	});
	
	
	
</script>
</body>
</html>