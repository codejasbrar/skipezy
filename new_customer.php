<!DOCTYPE html>
<html>
<head>
	<script  src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
    <?php include "navbar.php"; ?>
    
</head>
<body>
<form id="new_customer">
         
          <input type="hidden" name="new_customer_form"/>
          
           <div class="col-md-2"></div>
           <div class="col-md-8" style="margin-top:10px;">
              <div class="row">
                  <div class="panel">
                    <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                      <div class="panel-heading">
                        <h4><center>Personal Detail</center></h4>
                      </div>
                    </div>
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
                  <div class="form-group">
                  <p style="color:#900406;"><input type="checkbox" id="check_del_address"> Delivery Address is Same as Customer Address.</p>
                  </div>
                  
                 
              </div>
              
              </div>
              
          
           </div>
           
           <div id="post"></div>
           <div class="row">
           <div class="col-md-12">
               <div class="panel">
                    <div class="panel-primary" style="box-shadow: 5px 5px 5px;">
                       <div class="panel-heading"><h4><center>Delivery Address</center></h4></div>
                    </div>
                    <div class="panel-body" style="background-color:#e9e9e9;box-shadow: 5px 5px 5px;">
                      
                      <table id="new_customer_table" class="table table-bordered table-hover">
                      <thead>
                        
                        <tr class="btn-primary">
                             <th class="col-md-2">Location</th>
                             <th class="col-md-4"><center>Address Line 1</center></th>
                             <th class="col-md-4"><center>Address Line 2</center></th>
                             <th class="col-md-1"><center>City</center></th>
                             <th class="col-md-1"><center>Post_Code</center></th>
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
                                     <input id="address1" type="text" name="del_address1[]" class="form-control">
                                  </div>
                                </td>
                                <td class="col-md-4">
                                  <div class="form-group">
                                     <input id="address2" type="text" name="del_address2[]" class="form-control">
                                  </div>
                                </td>
                                <td class="col-md-1">
                                  <div class="form-group">
                                     <input id="city"  type="text" name="del_city[]" class="form-control">
                                  </div>
                                </td>
                                <td class="col-md-1">
                                  <div class="form-group">
                                     <input id="post_code"  type="text" name="del_post_code[]" class="form-control">
                                  </div>
                                </td>
                            </tr>
                        </tbody>
                        
                       
                      </table>
                      <div class="pull-right col-md-12">
                       <div class="btn btn-danger pull-right col-md-3" id="add_row" style="cursor:pointer; padding:15px;">Add 1 More</div>
                         <div class="pull-right col-md-1"></div>
                    <div class="btn btn-success pull-right col-md-3" id="submit" style="cursor:pointer; padding:15px;">Save Customer</div>
                    </div>
											<input type="hidden" name="create_new_customer" value="true" />
                    </div>
                    </div>
                    </div>
                    </div>
</form>


<script>
$('#add_row').click(function(){
	$('#new_customer_table').append('<tbody><tr><td class="row-num col-md-2"></td><td class="col-md-4"><div class="form-group"><input type="text" name="del_address1[]" class="form-control"></div></td><td class="col-md-4"><div class="form-group"><input type="text" name="del_address2[]" class="form-control"></div></td><td class="col-md-1"><div class="form-group"><input type="text" name="del_city[]" class="form-control"></div></td><td class="col-md-1"><div class="form-group"><input type="text" name="del_post_code[]" class="form-control"></div></td></tr></tbody>');
	var i = 1;
	$('.row-num').each(function(){
		$(this).html(i);
		i++;
	});
});
$('#submit').click(function(){
	var form = $('#new_customer').serialize();
    //alert(form);
	//return false;
	$.ajax({
		type: "POST",
		url: "create_customer.php",
		data: form,
		success: function(data) {
			$('#post').html(data);
		}
	})
});

$('#check_del_address').click(function(){
		var address1=$('#customer_address1').val();
		
		$('#address1').val(address1);
	    
		var address2=$('#customer_address2').val();
		
		$('#address2').val(address2);
		
		var city=$('#customer_city').val();
		
		$('#city').val(city);
		
		var post_code=$('#customer_post_code').val();
		
		$('#post_code').val(post_code);
		
	//$('#address1').val(address1);   
	var thisCheck = $(this);
	   //alert('thisCheck');
    	
	if(this.checked) {
        var thisCheck = $(this);
		//alert(thisCheck);
    }
	});
	
	$('#full_name').keyup(function(){
		//
		var input_text=$('#full_name').val();
	//alert(input_text);
	allLetter(input_text)
	});
	
	function allLetter(input_text)  
  {  
   	//
	  
   var re = /^[\w ]+$/;

    // validation fails if the input doesn't match our regular expression
    if(!re.test(input_text)) {
      alert("Error: Input contains invalid characters!");
      
	  var empty="";
	 $('#this').val(empty);
	 return false;
    }

    // validation was successful
    return true;
	
	
  }  
	
</script>
</body>
</html>