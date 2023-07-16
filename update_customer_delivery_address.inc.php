 <html lang="en">
<head>
<meta charset="UTF-8">
<title>c</title>
 
<?php 
 include "navbar.php";
 include "dbconfig.php";
?>
 </head>
<body>
 
<!-- Content Section -->
<div class="container">
<div class="row">
<div class="col-md-12">
<h2></h2>
<div class="pull-right">
<button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Record</button>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<h4>List of Records:</h4>
<div class="records_content"></div>
</div>
</div>
</div>
<!-- /Content Section -->
 

     <!-- Bootstrap Modal - To Add New Record -->
<!-- Modal -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Add New Record</h4>
</div>
<div class="modal-body">
 <form id="new_address" method="post">
<div class="form-group">
<label for="first_name">Address</label>
<input type="text" id="address" placeholder="Enter Address" class="form-control" />
</div>
 
<div class="form-group">
<label for="last_name">City</label>
<input type="text" id="city" placeholder="Enter City" class="form-control" />
</div>
 
<div class="form-group">
<label for="email">Post Code</label>
<input type="text" id="post_code" placeholder="Enter Post Code" class="form-control" />
</div>
 <input type="hidden" id="customer_id" value=<?php echo $customer_id;?> class="form-control" />

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
</div>
</form>
</div>
</div>
</div>
<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">
 
                <div class="form-group">
<label for="first_name">Address</label>
<input type="text" id="update_address" placeholder="Address" class="form-control" />
</div>
 
<div class="form-group">
<label for="last_name">City</label>
<input type="text" id="update_city" placeholder="City" class="form-control" />
</div>
 
<div class="form-group">
<label for="email">Post Code</label>
<input type="text" id="update_post_code" placeholder="Post Code" class="form-control" />
</div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Update</button>
                
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

</body>
</html>
<!-- Custom JS file -->
<script type="text/javascript">
$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
});

function addRecord(){
	  alert("demo");
	  var form=$('#new_address');
      var address1=$('#address').val();
	  
	  var city=$('#city').val();
	  alert(city);
	  var post_code=$('#post_code').val();
	   var customer_id=$('#customer_id').val();
	  
	   var dataString ='address1=' + address1+ '&city=' + city + '&post_code=' + post_code+ '&customer_id=' + customer_id;
      alert(dataString);
                $.ajax({
                    type: "POST",
                    url: "add_new_customer_address.inc.php",
                    data: dataString,
                    success: function(data) {
                    //console.log(data); 
					
           $("#add_new_record_modal").modal("hide");
		   readRecords();
                }
            });
	
}
// READ records
function readRecords() {
    $.get("fetch_customer_address.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}

// functon to get the details of selected record

function GetUserDetails(id) 
{
    // Add User ID to the hidden field for furture usage
    $("#customer_id").val(id);
	//alert(id);
   var selected_address=id;
	var dataString ='selected_address=' + selected_address;
                $.ajax({
                    type: "POST",
                    url: "get_address_record.inc.php",
                    data: dataString,
                    success: function(data) {
                    //console.log(data); 
					//alert(data);
	var address_data=data;
	var address_data = address_data.split(',');
	var address1=address_data[0];
	//alert(address1);
	var city=address_data[1];
	var post_code=address_data[2];
	// now simply assign to modal
	$('#update_address').val(address1);
	$('#update_city').val(city);
	$('#update_post_code').val(post_code);
	
           $("#add_new_record_modal").modal("hide");
		   readRecords();
                }
            });
	
    // Open modal popup
    $("#update_user_modal").modal("show");
}

//Now Update this address

function UpdateUserDetails() {
    // get values
    var address1 = $("#update_address").val();
    var city = $("#update_city").val();
    var post_code = $("#update_post_code").val();
 
    // get hidden field value
    var id = $("#customer_id").val();
 	//alert(id);
     var dataString ='address1=' + address1+ '&city=' + city + '&post_code=' + post_code+ '&id=' + id;
      // alert(dataString);
                $.ajax({
                    type: "POST",
                    url: "update_customer_address.inc.php",
                    data: dataString,
                    success: function(data) {
                    //console.log(data); 
		   $("#update_user_modal").modal("hide");
		   readRecords();
                }
            });
}

//Delete the record

function DeleteUser(id) {
    var conf = confirm("Are you sure, do you really want to delete User?");
    if (conf == true) {
       var dataString ='id=' + id;
       //alert(dataString);
                $.ajax({
                    type: "POST",
                    url: "delete_customer_address.inc.php",
                    data: dataString,
                    success: function(data) {
                    //console.log(data); 
		   readRecords();
                }
            });
			
			
    }
}




</script>