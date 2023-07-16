<!DOCTYPE html>
<html>


<head>

	<meta charset="utf-8">
  
    <?php 
	
	include "navbar.php"; 
	include "dbconfig.php"; ?>
    <!-- Java Scripti Files -->
   
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
    <?php 
	$sql="SELECT MAX(invoice_no) as invoice_no FROM invoices";
	$res=$con->query($sql);
	$inv=$res->fetch_assoc();
	$row_count=mysqli_num_rows($res);
	
	$invoice_no=$inv['invoice_no'];
	
	if($invoice_no==0 OR $invoice_no=='' ){$invoice_no=0;}
	$invoice_no++;
	//echo $invoice_no;
	?>
   
</head>
 
    
<body style="font-family:Montserrat; font-size:16px;">
<form id="new_invoice" action="ajax/create_invoice1.php" method="post">
     <div class="col-md-12" style="margin-top:1%;">
         
          <input type="hidden" name="new_invoice_form"/>
          
           <div class="col-md-1"></div>
           <div class="col-md-10">
              
                  <div class="panel">
                    <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                      <div class="panel-heading">
                        <h4><center>Customer Details</center></h4>
                      </div>
                    </div>
                    
                    <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                      
                      
                      
                 <div class="row col-md-12">
                 <div class="col-md-3">
                  <label for="full_name">Customer Name</label>
                     <select name="customer_name" style=" vertical-align: top; min-height: 150px;
  max-height: 350px;
  overflow-y: auto;
" id="customer_name" class="js-example-basic-multiple" multiple="multiple">
                      <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="">Select a Customer </option>
                               <?php
                 
                  $customers_sql="SELECT * from customers order by name ASC";
                  $t_result=mysqli_query($con,$customers_sql);
                  while($customer=mysqli_fetch_assoc($t_result))
                  {
                  ?>
                  
  <option style="padding:15px; background-color:#9AD8EF; color:#320607; cursor:pointer; font-size:16px;" value="<?php echo $customer['id']; ?>">
     <?php echo $customer['name']; ?>
    </option>
            <?php
            
            }
            ?>
                     </select>
                 <div class="col-md-12"><a data-target="#add_customer" data-toggle="modal" href="#">Add New</a></div>
                 </div>
                 
                 <div class="col-md-4"><label for="area">Invoice Date</label>
                      
                          <input type="text" style="width:70%;" class="form-control" placeholder="Select Date" name="invoice_date" id="invoice_date" value="<?php echo date("d/m/Y");?>"></div>
                 <div class="col-md-4"><label for="area">Invoice Number</label>
                           <input name="invoice_no" id="invoice_no" type="text" style="width:70%;" readonly class="form-control" value="<?php echo $invoice_no;?>"> <div id="invoice_suggesstion-box"></div></div>
                 <div class="col-md-4"></div>
                          
                      
                
                      </div>
                          <div class="col-md-12" style='padding-left: 0px;padding-right: 0px;margin-top: 20px;' >
               <div class="panel">
                    <div class="panel-primary">
                       <div class="panel-heading"><h4><center>Invoice Details</center></h4></div>
                    </div>
                    <div class="panel-body" style="background-color:#e9e9e9;">
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
                                  <div class="form-group col-md-12">
                                  <div class="col-md-12"><a data-target="#new_item" data-toggle="modal" href="#">Add New</a></div>
                                  <select style="width:200p;"" type="text" jas="0" id ="item0" name="item[]" class="js-example-basic-single item">
                      <option style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="0">Select a Product </option>
                               <?php
                 
                  $customers_sql="SELECT * from skips order by size ASC";
                  $t_result=mysqli_query($con,$customers_sql);
                  while($customer=mysqli_fetch_assoc($t_result))
                  {
                  ?>
                  
  <option style="padding:15px; background-color:#9AD8EF; color:#320607; cursor:pointer; font-size:16px;" value="<?php echo $customer['id']; ?>">
     <?php echo $customer['size']; ?>
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
<div class="col-md-3">
<label style="font-size:16px;" > Notes/Comments</label>
<label style="font-size:8px; color:#948A8A;">Max 100 Words</label> 
<textarea cols="40" rows="5" name="notes" maxlength="100">Comments</textarea>
  <div class="pull-right col-md-3" style="margin-top:20px;">
                    <input type="submit" class="btn btn-success pull-left" id="submit" style="cursor:pointer; padding:15px;" value="Save Invoice">
                    </div>
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
								<label>VAT : &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp</label>
								<div class="input-group">
                                <div class="input-group-addon currency">£</div>
									<input readonly value="" type="number" class="form-control" name="vat" id="vat" placeholder="VAT Amount">
								</div>
							</div>
                            <div>&nbsp;</div>
							<div class="form-group">
								<label>Nett : &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">£</div>
									<input readonly value="" type="number" class="form-control" name="nett" id="nett" placeholder="Sub Total">
								</div>
							</div> 
                            <div>&nbsp;</div>
                            <div class="form-group">
								<label>Permit: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
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
									<input readonly value="" type="number" class="form-control" name="gross" id="gross" placeholder="Gross">
								</div>
							</div>
                            <div>&nbsp;</div>
                            <!--
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
                    -->
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    
</div>



                      <div class="col-md-2"></div>
                        
                    </div>
											<input type="hidden" name="create_new_invoice" value="true" />
                                            
                                            
                    </div>
           <div>&nbsp;</div>
          
          
          
         
         </div>  
           
          <div class="col-md-2"></div> 
          </div>
      <!-- hidden variables for calculatin VAT and NETT -->
      
      <input type="hidden" id="sub_total" name="sub_total"/>              
                    
</form>
<<div id="add_customer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Customer Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">       
      <form method="post" action="" id="new_customer">
        <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                      <div class="col-md-6">
                        <label for="full_name">Full Name</label>
                        <div class="form-group">
                          <input type="text" id="full_name" name="full_name" placeholder="Enter Full Name" class="form-control">
                       </div>
                       <label for="mobile">Mobile</label>
                       <div class="form-group">
                         <input type="text" id="mobile" name="mobile" placeholder="Enter Mobile Number" class="form-control">
                       </div>
                       <label for="address1">Address Line1</label>
                       <div class="form-group">
                         <input name="address1" type="text" id="customer_address1" placeholder="Enter Address" class="form-control">
                       </div>
                       <label for="city">City</label>
                       <div class="form-group">
                         <input name="city" type="text" id="customer_city" placeholder="Enter City" class="form-control">
                      </div> 
                 
                     </div>
                      <div class="col-md-6">
               <label for="phone">Phone</label>
                  <div class="form-group">
                    <input type="text" id="phone" name="phone" placeholder="Enter Phone Number" class="form-control">
                  </div>
                 <label for="email">Email</label>
                  <div class="form-group">
                    <input type="Email" id="email" name="email" placeholder="Enter Email.." class="form-control">
                  </div>
                  <label for="address2">Address Line2</label>
                  <div class="form-group">
                    <input type="text" id="customer_address2" name="address2" placeholder="Enter Address" class="form-control">
                  </div>
                   <label for="post_code">Post Code</label>
                  <div class="form-group">
                    <input type="text" id="customer_post_code" name="post_code" placeholder="Enter Post Code" class="form-control">
                  </div>
                 
                  
                 
              </div>
              
              </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn-save">Save Customer</button>
      </div>
    </div>

  </div>
</div>
</div>
<!-- Products Modal -->
<div id="new_item" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Product</h4>
      </div>
      <div class="modal-body">
      <form action="" id="frm_new_skip">
        <p>Enter Skip Name</p>
        <input type="text" class="form-control" placeholder="6 CU Yard" id="size" name="size">
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn_new_item">Save Item</button>
      </div>
    </div>

  </div>
</div>
<script>
var jas = 1;
$('#add_row').click(function(){
	$('.item').select2("destroy");
	$('#new_invoice_table').append('<tbody><tr><td class="row-num col-md-2"></td><td class="col-md-4"><select type="text" jas="'+jas+'" id ="item'+jas+'" name="item[]" class="js-example-basic-single item"></td><td><input jas='+jas+' type="text" class="form-control quantity" id="qty'+jas+'" name="quantity[]"></td><td><input jas='+jas+' type="text" class="form-control price" id="price'+jas+'" name="price[]"></td><td><input type="text" class="form-control amount" id="amount'+jas+'" name="amount[]"></td><td><p style="background-color:#55CD01; cursor:pointer; font-size:20px; font-weight:bold;" class="btn btn-danger btn-sm remove">x</p></td></tr></tbody>');
	var i = 1;
	$('.row-num').each(function(){
		$(this).html(i);
		i++;
	});
	
	$('#item0 option').clone().appendTo('#item'+jas);
	jas = jas + 1;
	$('.item').select2({width: '100%'});
	
	
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

update_total();
} 
 
 function update_total()  
{
	 
	//get the figures of VAT, Nett & Gross
	calculate_vat();
	
	var nett=$('#sub_total').val();
	nett = parseFloat(nett).toFixed(2);
	$('#nett').val(nett);
	
	var permit=$('#permit').val();
	permit = parseFloat(permit).toFixed(2);
	
	
	gross=+nett + +vat + +permit;
	gross = parseFloat(gross).toFixed(2);
	$('#gross').val(nett);
	//alert(nett);
	
	//var gross=$('#gross').val();
	//gross = parseFloat(gross).toFixed(2);
	
	

}
 
 function calculate_vat()  
{
	var vat_p=$('#vat_p').val();
	var sub_total=$('#sub_total').val();
	vat=(sub_total*vat_p)/100;
	vat = parseFloat(vat).toFixed(2);
	$('#vat').val(vat);
}
 
 $('#vat_p').keyup(function(){
	var vat_p=$('#vat_p').val();
	
	
	var sub_total=$('#sub_total').val();
	vat=(sub_total*vat_p)/100;
	vat = parseFloat(vat).toFixed(2);
	
	//alert(vat);
	var nett=sub_total ;
	nett=parseFloat(nett).toFixed(2);
	
	
	var permit=$('#permit').val();
	//alert(permit);
	if(permit==''){permit=0;}
	permit = parseFloat(permit).toFixed(2);
	$('#paid').val();
	
	var gross=$('#gross').val();
	gross = parseFloat(gross).toFixed(2);
	gross=+nett+ +vat;
	
	gross=+gross+ +permit;
	$('#vat').val(vat);
	$('#nett').val(nett);
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
	if(permit==''){permit=0}
	permit=parseFloat(permit).toFixed(2);
	
	var vat= $('#vat').val();
    vat=parseFloat(vat).toFixed(2);
	
	
	
	var gross=$('#gross').val();
	gross = parseFloat(gross).toFixed(2);
	
	var nett=$('#nett').val();
	nett = parseFloat(nett).toFixed(2);
	
	gross=+nett+ +vat;
	gross=+gross+ +permit;
	$('#gross').val(gross);
	
 });
 
 $('#paid').blur(function(){
	var paid= $('#paid').val();
    paid=parseFloat(paid).toFixed(2);
	$('#paid').val(paid);
 });
 
 $('#permit').keyup(function(){
	var permit=$('#permit').val();
	permit = parseFloat(permit).toFixed(2);
	
	//alert(permit);
	
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
 
 $('#invoice_date').datepicker({
	
    	onSelect: function() {
			
			$( ".start_date" ).datepicker( "option", "dateFormat","dd/mm/yy");
		}
		});

</script>
<script type="text/javascript">
$(document).ready(function() {
  $("#invoice_no").blur(function(){
  $('#invoice_suggesstion-box').hide();
  });
  
});
</script>
<script>
$(document).ready(function(){
	$("#customer_name").keyup(function(){
		//$("#delivery_address").hide();
		//if any other div are open close them or hide them
		
		$.ajax({
		type: "POST",
		url: "ajax/find_invoice_customer.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#customer_name").css("background","#F5C211");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#customer_name").css("background","#green");
		}
		});
	});
});

function selectCustomer(val) {
	var data=val;
	 var data = data.split('-');
	var id=data[0];
	var name=data[1];
	var address1=data[2];
	var city=data[3];
	var post_code=data[4];
	//alert(id);
	$('#new_customer').hide();
	//now show the delivery div as well
	$("#delivery_address").show();
	$("#customer_name").val(name);
	$("#address1").val(address1);
	$("#city").val(city);
	$("#post_code").val(post_code);
	
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
$('.job-details').show();
}
// Now write code for keypress in invoice number box
$(document).ready(function(){
	$("#invoice_no").keyup(function(){
		//$("#delivery_address").hide();
		//if any other div are open close them or hide them
		
		$.ajax({
		type: "POST",
		url: "ajax/find_invoice_no.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#invoice_no").css("background","#F5C211");
		},
		success: function(data){
			$("#invoice_suggesstion-box").show();
			$("#invoice_suggesstion-box").html(data);
			$("#invoice_no").css("background","#green");
		}
		});
	});
	
	
});

	

</script>
<script>
        $(document).ready(function() { 
        $('#customer_name').select2({ width: 'resolve' });
        $('.item').select2({ width: '100%' });
		
		});
		$('.item').change(function(){
			var index=$(this).val();
		//alert(index);
		});
	/////////////// Save Customer When Modal Opens	
        $('#btn-save').click(function(){
	var form = $('#new_customer').serialize();
    //alert(form);
	//return false;
	$.ajax({
		type: "POST",
		url: "ajax/new_invoice_customer.php",
		data: form,
		success: function(data) {
			if(data=='success'){
		    alert("Customer Created");
			window.location.href=window.location.href;
			}
		}
	})
});
////////////////////// Add New Item
 $('#btn_new_item').click(function(){
	var form = $('#frm_new_skip').serialize();
    //alert(form);
	//return false;
	$.ajax({
		type: "POST",
		url: "ajax/create_invoice_skip.php",
		data: form,
		success: function(data) {
			if(data=='success'){
		    alert("Product Created");
			window.location.href=window.location.href;
			}
		}
	})
});

</script>
</body>
</html>