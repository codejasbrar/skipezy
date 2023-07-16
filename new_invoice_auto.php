<!DOCTYPE html>
<html>
<head>
<style>

#name-list{float:left;list-style:none;margin:0;padding:0;width:250px;}
#name-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;width:250px;}
#name-list li:hover{background:#63ABD9; cursor:pointer;width:250px;}
#customer_name{padding: 20px;border:#000000 1px solid;width:250px;}
.rounded-box
{
	
	padding: 10px;border:#000000 1px solid;width:250px;
	
	}
</style>
	<meta charset="utf-8">
   
    <?php include "navbar.php"; 
	include "dbconfig.php"; ?>
    <!-- Java Scripti Files -->
   
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
<body style="font-family:Montserrat; font-size:16px;">
<form id="new_invoice" method="post">
     <div class="col-md-12" style="margin-top:7%;">
         
          <input type="hidden" name="new_invoice_form"/>
          
           <div class="col-md-2"></div>
           <div class="col-md-8">
              <div class="row">
                  <div class="panel">
                    <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                      <div class="panel-heading">
                        <h4><center>Customer Details</center></h4>
                      </div>
                    </div>
                    </div>
                    <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                      
                         <div class="row col-md-12">
                          
                            <div class="form-group col-md-8"> 
                            <label for="jobtype">Invoice To</label>
                            
                            
                           
                    <div id="customer_details">
                  <div style=" border: 2px solid Blue;border-style: dashed;
    border-radius: 5px;" class="form-group col-md-8">
    <input type="text" id="customer_name" class="form-control col-md-6" placeholder="Type Customer Name" />
<input type="hidden" name="customer_id" id="customer_id" placeholder="xxx" />

<div id="suggesstion-box"></div>
<div id="clearfix"></div>
                              <div>&nbsp;</div>
                              <div class="col-md-8">
                              <br>
                              <label>Invoice Address</label>
 
							
                            
                            <input name="address1" id="address1" type="text" class="form-control rounded-box">
                             
                               <input name="city" id="city" type="text" class="form-control">
                               <input name="post_code" style="margin-bottom:10px;" id="post_code" type="text" class="form-control">
                               
                               </div>
           					</div>          
                  
                  </div>
                  
                  
                  </div>
                  
                  <div class="col-md-3 pull-right">
                       <label for="area">Invoice Date</label>
                      <div class="form-group ">
                          <input type="text" style="width:70%;" class="form-control" placeholder="Select Date" name="invoice_date" id="invoice_date">
                      </div>
                      
                      </div>
                      
                      
                 </div>
                  <div class="row">
                  
                  <div class="pull-right col-md-3" style="margin-top:20px;">
                    <p class="btn btn-success pull-right" id="submit" style="cursor:pointer; padding:15px;"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save Invoice
                    </div>
                  
         </div>
       </div>
    </div>
          
           <div>&nbsp;</div>
          <div class="col-md-1"></div> 
          
          
           <div class="col-md-12">
               <div class="panel">
                    <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                       <div class="panel-heading"><h4><center>Invoice Details</center></h4></div>
                    </div>
                    <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                      <div id="post"></div>
                      <table id="new_invoice_table" class="table table-bordered info table-striped table-hover" style="cursor:pointer;">
                      <thead>
                       
                        
                        <tr style="background-color:#4591C1; color:#F5EFEF;">
                             <th class="col-md-1">Sr. No.</th>
                             <th class="col-md-4"><center>Item Name</center></th>
                             <th class="col-md-1"><center>Quantity</center></th>
                             <th class="col-md-1"><center>Price</center></th>
                             <th class="col-md-1"><center>Total</center></th>
                             <th class="col-md-1"><p style="background-color:#55CD01; cursor:pointer; font-size:20px; font-weight:bold;" id="add_row" class="btn btn-success btn-sm">+</p></th>
                        </tr>     
                        </thead>
                        <tbody class="detail">
                          
                            <tr> 
                                <td class="row-num col-md-2 no">1</td>
                                <td class="col-md-4">
                                  <div class="form-group">
                                     
                           <select id="item0" jas="0" name="item[]" class="form-control item" style="width:70%;">
                           
                             <option style="padding:20px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a Skip </option>
                               <?php
                 
                  $customers_sql="SELECT * from skips order by size ASC";
                  $t_result=mysqli_query($con,$customers_sql);
                  while($skip=mysqli_fetch_assoc($t_result))
                  {
                  ?>
                  
  <option style="padding:15px; background-color:#9AD8EF; color:#320607; cursor:pointer;" value=<?php echo $skip['id']; ?>>
     <?php echo $skip['size']; ?>
    </option>
    
            <?php
            
            }
            ?>
                  </select> 
                                     
                                  </div>
                                </td>
                                <td><input type="text" jas="0" id ="qty0"class="form-control quantity" name="quantity[]"></td>  
                                <td><input id ="price0" jas="0" type="text" class="form-control price" name="price[]"></td>  
                                <td><input id ="amount0" jas="0" type="text" class="form-control amount" name="amount[]"></td>  
                                <td class="col-md-1"><p style="cursor:pointer; font-size:16px; font-weight:bold;" class="btn btn-danger btn-sm remove">x</p></td> 
</tr>  
</tbody>  
 
  
</table>  
<div class="row">
<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
<label style="font-size:16px;" > Notes/Comments</label>
<textarea cols="40" rows="5" name="notes">Add any Notes</textarea>
 
</div>
<div class="col-xs-12 col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-sm-5 col-md-5 col-lg-5">
						<span class="form-inline">
							<div class="form-group">
								<label style="font-size:16px;" >Sub Total: £ &nbsp;</label><label style="font-size:16px;" class="total">0</label>
								
							</div>
                            
                            <div class="form-group">
                            <label>VAT%: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							
								
					<div class="input-group">
						<input value="" type="number" class="form-control" name="vat_p" id="vat_p" placeholder="Enter VAT %" >
                            <div class="input-group-addon">%</div>

								</div>
							</div>
                            <div>&nbsp;</div>
							<div class="form-group">
								<label>VAT : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp</label>
								<div class="input-group">
                                <div class="input-group-addon currency">£</div>
									<input readonly value="" type="number" class="form-control" name="vat" id="vat" placeholder="VAT Amount">
								</div>
							</div>
                            <div>&nbsp;</div>
							<div class="form-group">
								<label>Nett : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">£</div>
									<input readonly value="" type="number" class="form-control" name="nett" id="nett" placeholder="Sub Total">
								</div>
							</div> 
                            <div>&nbsp;</div>
                            <div class="form-group">
								<label class="colimd-2">Permit: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">£</div>
									<input value="" type="number" class="form-control" name="permit" id="permit" placeholder="Any Permit?">
								</div>
							</div>
                            <div>&nbsp;</div>
                            <div class="form-group">
								<label>Gross Total:&nbsp; &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">£</div>
									<input value="" type="number" class="form-control" name="gross" id="gross" placeholder="Gross">
								</div>
							</div>
                            <div>&nbsp;</div>
							<div class="form-group">
								<label>Amount Paid: </label>
								<div class="input-group">
									<div class="input-group-addon currency">£</div>
									<input value="" type="number" class="form-control" name="paid" id="paid" placeholder="Amount Paid">
								</div>
							</div>
                           <div>&nbsp;</div>
							<div class="form-group">
								<label>Amount Due: </label>
								<div class="input-group">
									<div class="input-group-addon currency">£</div>
									<input readonly value="" type="number" class="form-control danger" name="due" id="due" placeholder="Amount Due">
								</div>
							</div>
						</span>
					</div>
                    
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    
</div>



                      <div class="col-md-2"></div>
                        
                    </div>
											<input type="hidden" name="create_new_invoice" value="true" />
                                            
                                            
                    </div>
         
         </div>     
      <!-- hidden variables for calculatin VAT and NETT -->
      
      <input type="hidden" id="sub_total" name="sub_total"/>              
                    
</form>


<script>
var jas = 1;
$('#add_row').click(function(){
	$('#new_invoice_table').append('<tbody><tr><td class="row-num col-md-2"></td><td class="col-md-4"><div class="form-group"><select style="width:70%;" name="item[]" jas='+jas+' id="item'+jas+'" class="form-control item"><option selected style="padding:15px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a Skip</option></select> </div></td><td><input jas='+jas+' type="text" class="form-control quantity" id="qty'+jas+'" name="quantity[]"></td><td><input jas='+jas+' type="text" class="form-control price" id="price'+jas+'" name="price[]"></td><td><input type="text" class="form-control amount" id="amount'+jas+'" name="amount[]"></td><td><p style="background-color:#55CD01; cursor:pointer; font-size:20px; font-weight:bold;" class="btn btn-danger btn-sm remove">x</p></td></tr></tbody>');
	var i = 1;
	$('.row-num').each(function(){
		$(this).html(i);
		i++;
	});
	$('#item0 option').clone().appendTo('#item'+jas);
	jas = jas + 1;
});


$('#submit').click(function(){
	var form = $('#new_invoice').serialize();
  //alert(form);
	$.ajax({
		type: "POST",
		url: "post_process.php",
		data: form,
		success: function(data) {
			$('#post').html(data);
		}
	})
});


  $('#customer_id').change(function(){
     //      alert(demo);
        var get_customer=$(this).val();
                var dataString = 'get_customer=' + get_customer;
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
		
 
$('body').delegate('.item','change keyup',function()  
{  
           
		   var tr=$(this).parent().parent();  
			var get_unit_price=tr.find('.item').val();
			var dataString = 'get_unit_price=' + get_unit_price;	   
          $.ajax({   				     
		  			type: "POST",
                    url: "post_process.php",
                    data: dataString,
					success: function(data) {  
					var price = $.trim(data);
					//alert(price);
					var index=tr.find('.item').attr('jas');
					
					$('#price'+index).val(price);                   
                     }
	});

 });

/*
	$('#unit_price').blur(function(){
  
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
*/
	//remove a row
	$('body').delegate('.remove','click',function()  
	{  
	$(this).parent().parent().remove();
	Grand_Total();  
	});  
	
	// calculate sub total
$('body').delegate('.quantity,.price','keyup',function()  
{  

var tr=$(this).parent().parent();  
 
var index=tr.find('.price').attr('jas');
//alert(index);
//var qty_index=tr.find('.quantity').attr('jas');

var price=$('#price'+index).val(); 
//alert(price);

var qty=$('#qty'+index).val();
price= parseFloat(price).toFixed(2);
qty= parseFloat(qty).toFixed(2);
//alert(qty);
 
var amount=qty*price;
//alert(amount);
amount=parseFloat(amount).toFixed(2);
tr.find('#amount'+index).val(amount); 
/*
var total=0; 
subtotal=$('#subtotal').val();
//alert(subtotal);
total=+subtotal + +amount;
//alert(total);
total=parseFloat(total).toFixed(2);
$('#subtotal').val(0);

  
$('#subtotal').val(total);
*/
Grand_Total();  
});  

	// Calcualte grand total
function Grand_Total()  
{  

var t=0;  
$('.amount').each(function(i,e)   
{  
var amt =$(this).val()-0;  


t=+ t + +amt; 
//alert(t);
t=parseFloat(t).toFixed(2);
//alert(t); 
});  
$('.total').html(t);  
$('#sub_total').val(t);
} 
 
 $('#vat_p').keyup(function(){
	var vat_p=$('#vat_p').val();
	
	
	var sub_total=$('#sub_total').val();
	vat=(sub_total*vat_p)/100;
	vat = parseFloat(vat).toFixed(2);
	$('#vat').val(vat);
	
	var nett=+sub_total + +vat;
	nett=parseFloat(nett).toFixed(2);
	$('#nett').val(nett);
	
	var permit=$('#permit').val();
	if(permit=''){permit=0;}
	var gross=nett+permit;
	gross = parseFloat(gross).toFixed(2);
	$('#gross').val(gross);
 });
 $('#vat_p').blur(function(){
	
	var vat_p= $('#vat_p').val();
    vat_p=parseFloat(vat_p).toFixed(2);
	$('#vat_p').val(vat_p);
 });
 
 $('#permit').blur(function(){
	var permit= $('#permit').val();
    permit=parseFloat(permit).toFixed(2);
	$('#permit').val(permit);
 });
 
 $('#paid').blur(function(){
	var paid= $('#paid').val();
    paid=parseFloat(paid).toFixed(2);
	$('#paid').val(paid);
 });
 
 $('#permit').keyup(function(){
	var permit=$('#permit').val();
	permit = parseFloat(permit).toFixed(2);
	
	var nett=$('#nett').val();
	var gross=+nett + +permit;
	gross=parseFloat(gross).toFixed(2);
	$('#gross').val(gross);
 });
 
 $('#paid').keyup(function(){
	var paid=$('#paid').val();
	var gross=$('#gross').val();
	var a=parseFloat(gross).toFixed(2);
	var b=parseFloat(paid).toFixed(2);
	var due=a-b;
	due=parseFloat(due).toFixed(2);
	$('#due').val(due);
 });
 

</script>
<script>
//Autocomplete Custoemrs to fetch customer data

$(document).ready(function(){
	$("#customer_name").keyup(function(){
		//if any other div are open close them or hide them
		
		$.ajax({
		type: "POST",
		url: "find_customer_data.inc.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#customer_name").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#customer_name").css("background","#FFF");
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
	$("#address").show();
	$("#customer_name").val(name);
	$("#customer_id").val(id);

//now fetch data based on this id 
 $.ajax({
		type: "POST",
		url: "find_invoice_address.inc.php",
		data:'customer='+id,
		
		success: function(data){
			var data = data.split('-');
	var id=data[0];
	var address1=data[1];
	var city=data[2];
	var post_code=data[3];
	
	$('#address1').val(address1);
	$('#city').val(city);
	$('#post_code').val(post_code);
			
			
		}
		});
		
$("#suggesstion-box").hide();
}
</script>

</body>
</html>