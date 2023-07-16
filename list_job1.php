
<meta charset="utf-8">

<title>List of Orders</title>
<!doctype html>

<html>

<head>
  
<?php

include "dbconfig.php";

//include "css_header.php";
include "navbar_list.php";
// include ("dynamic_table.php");
 $today_date= date('Y-m-d');
//*Get the order data for this order.
if (!empty($_POST['search'])) {
 $search['column'][] = $_POST['search'];
$where = '';
$query = '';
foreach($_POST as  $col=>$val) {
  //echo "POST parameter '$key' has '$value'";
  $query .= "'$col' = '$val' AND";
  
}
echo $query;
exit;
$where = rtrim($where, ' AND');
	echo $query;
	

$sql="SELECT order_details.start_date, customers.name AS customer_name, job_types.name AS job_type, delivery_address.post_code, employees.name AS driver
FROM order_details
LEFT JOIN orders ON order_details.order_id = orders.id
LEFT JOIN customers ON order_details.customer_id = customers.id
LEFT JOIN job_types ON order_details.job_type = job_types.id
LEFT JOIN delivery_address ON order_details.location_id = delivery_address.id
LEFT JOIN employees ON order_details.driver_id = employees.id

WHERE $WHERE";
echo $sql;
exit;
}
$res=mysqli_query($con,$sql);

//echo $sql;

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
	</script>
 </head>

<body style="font-family:Montserrat; font-size:13px;">

<div class="row">
      
 
 <div class="form-group col-md-8">
                      
<div class="col-md-3">
 <label>Start Date</label>
 <input id="start_date" type="text" style="width:70%;" value="<?php echo date('Y-m-d');?>" name="start_date" class="form-control"  placeholder="Select a Date">
 </div>
 <div class="col-md-3">
 <label>Customer</label>
 <input id="customer" type="text" style="width:70%;" value="" name="customer" class="form-control" placeholder="">
 </div>
 <div class="col-md-3">
 <label>Post Code</label>
 <input id="post_code" type="text" style="width:70%;" value="" name="post_code" class="form-control" placeholder="">
 </div>
 <div class="col-md-3">
 <label>Job Type</label>
 <input id="job_type" type="text" style="width:70%;" value="" name="job_type" class="form-control" placeholder="">
 </div>
 <div class="col-md-3">
 <label>Driver</label>
 <input id="driver" type="text" style="width:70%;" value="" name="driver" class="form-control" placeholder="">
 </div>
 
              </div>
                      <div class="form-group col-md-3">
  <input type="button" class="btn btn-sm btn-success" id="search_by_date" value="Search">

                      </div>
               
         
     
   </div>
 
  
  
  
  

<style type="text/css">
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 700px; /* New width for default modal */
        }
        .modal-sm {
          width: 350px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 1050px; /* New width for large modal */
        }
    }
</style>

<div class="modal fade" id="drivers_modal">
 
</div><!-- /.modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="jobs_modal">
 
</div><!-- /.modal -->


<script type="text/javascript">
$('#search_by_date').click(function(){
		
		/*
              var form=$('#search_form');
       var dataString = $("#search_form").serialize();
	   
       alert(dataString);
                $.ajax({
                    type: "POST",
                    url: "list_job1.php",
              data: form.serialize(),
                    success: function(data) {
                     console.log(data); 
           $('#search_results').html(data); 
                }
            });
        });
   
*/

var date=$('#start_date').val();
var customer=$('#customer').val();
var job_type=$('#job_type').val();

   var search_query = "order_details.start_date='" + date +"' AND customers.name='" + customer+"' AND job_types.job_type='" + "'"+job_type+"'";
   
   alert(search_query);
  $.ajax({
                    type: "POST",
                    url: "search_data.php",
                    data: search_query,
                    success: function(data) {
                     //console.log(data); 
           $('#search_results').html(data); 
           
                }
            });
			
 });










$(".table-striped").find('td[data-id]').on('click', function () {
	var select_job_id=$(this).attr('data-id');
	var select_customer_id=$(this).attr('data-id');
	var selected_col=$(this).attr('col-id');
	
	if(selected_col=='6')
	{
			var dataString = 'select_customer_id='+select_customer_id;
			  //alert(dataString);
			  $.ajax({
				  type: "POST",
			  url: "post_process.php",
			  data: dataString,
			  success: function(data) {
				  $('#jobs_modal').html(data);
				  $('#jobs_modal').modal('show');
				  }
			  });
	}
	
	if(selected_col=='11')
		{
			  var dataString = 'select_job_id='+select_job_id;
			  //alert(dataString);
			  $.ajax({
				  type: "POST",
			  url: "post_process.php",
			  data: dataString,
			  success: function(data) {
				  $('#drivers_modal').html(data);
				  $('#drivers_modal').modal('show');
				  }
			  });
		
		}
	
	

	    
});



</script>


</body>
</html>