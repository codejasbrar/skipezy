<!DOCTYPE html>
<html>
<head>

   <title></title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- Java Scripti Files -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<?php



      include "dbconfig.php";
      //include "css_header.php";
     include "navbar_list.php";

      //Get the order data for this order.

      
      
?>

</head>
<body>
   <form metho="post">
<div class="container-fluid">
   <div class="row">
      <div>&ensp;</div>
      <div>&ensp;</div>
      <div>&ensp;</div>
   </div>
   <div class="row">
      <div>&ensp;</div>
      <div>&ensp;</div>
      <div>&ensp;</div>
   </div>
   <div class="row">
        <div class="col-md-12" style="padding-top: 10px;margin-top:50px;box-shadow: 5px 5px 5px; background-color:green;color:white;">
        <div class="col-md-2">
         <label for="job_type" class="col-sm-5" style="margin-left: -30px;">Start Date</label>
         <div class="form-group col-sm-7">
                      
 <input type="text" style="width:150px;" name="start_date" class="form-control start_date" placeholder="Select a Date" id="start_date">
             
         </div>
        </div>
      <div class="col-md-2">
      <p for="paid" class="col-sm-5">Job Type</p>
            <div class="form-group col-sm-7">
                  <input type="text" name="job_type" id="job_type" class="job_type form-control">
            </div>      

        <!--
         <select name="job_type" id="job_type" class="form-control">
            <option select_date>Job Type</option>
            <option value="1">Delivery</option>
            <option value="2">Collection</option>
            <option value="3">Exchange</option>
            
         </select>
         -->
         
         </div>
     
      <div class="col-md-2">
           <label class="col-sm-5">Paid</label>
         <div class="form-group col-sm-7">
          <input type="text" name="paid" id="paid" class="paid job_type form-control">
         </div>
      </div>
      <div class="col-md-2">
          <label class="col-sm-5">Post Code</label>
          <div class="form-group col-sm-7">
            <input type="text" name="post_code" id="post_code" class="post_code form-control">
          </div> 
      </div>
      <div class="col-md-2">
          <label class="col-sm-5">Customer Name</label>
          <div class="form-group col-sm-7">
            <input type="text" name="name" id="name" class="name form-control">
          </div> 
      </div>
      <div class="col-md-2">
          <input type="submit"  name="btn" class="btn btn-default btn-small" value="Search Jobs"> 
      </div> 
      </form>
      </div>
   </div>
   <div class="row">
      <div>&ensp;</div>
      <div>&ensp;</div>
      <div>&ensp;</div>
   </div>
        
	<div class="row" id="filter_results">
		<table class="table table-hover table-bordered " style="color:red;">
       			<thead>
       				<tr class="btn-primary">
       				    <th>Date</th>
       				    <th>Entry Type</th>
       				    <th>Vehicle Type</th>
       				    <th>Size</th>
       				    <th>Quantity</th>
       				    <th>Material</th>
       				</tr>
       			</thead>
                        <?php 
                              $sql = "SELECT * FROM artic";
                              $res = mysqli_query($con,$sql);
                              while($row = mysqli_fetch_array($res))
                              {

                        ?>  
       			<tbody>
       				<tr class="info">
                                  
       					<td><?php echo $row['date'];?></td>
       					<td><?php echo $row['entry_type'];?></td>
       					<td><?php echo $row['vehicle_type'];?></td>
       					<td><?php echo $row['size'];?></td>
       					<td><?php echo $row['quantity'];?></td>
       					<td><?php echo $row['material'];?></td>
       				</tr>
       				
       			</tbody>
                                 <?php 
                                     }
                                   ?>
                                  
       			</table>

       		</div>
       	</div>	
   </form>
   <script>
    $('body').delegate('.post_code,.name,.job_type,.paid,.start_date','keyup',function()  
{
alert("Demo");		
  var start_date=$('#start_date').val();
  var filter_search="filter_search";
  var post_code=$('#post_code').val();
  var name=$('#name').val();
  var job_type=$('#job_type').val();
   var paid=$('#paid').val();
    var search = $(this).val();
  if (search.length > 0) {
	

   var dataString ='filter_search=' + filter_search+'&start_date=' + start_date+'&post_code=' + post_code+'&name=' + name+'&job_type=' + job_type+'&paid=' + paid;

	
	} else {
		var dataString ='filter_search=' + filter_search+'&start_date=' + start_date+'&post_code=' + post_code+'&name=' + name+'&job_type=' + job_type+'&paid=' + paid;
	}
	
  $.ajax({
                    type: "POST",
                    url: "search_by_post_code.inc.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
          // $('#gross').hide();
           $('#filter_results').html(data); 
           
                }
            });
        });
		
//When user click on Start_date execute the filter

  $( function() {
    $( "#start_date" ).datepicker();
 
      $( "#start_date" ).datepicker( "option", "dateFormat","d MM, y");
	  
    
  } );
		
$('.start_date').datepicker({
	
    	onSelect: function() {
			
			$( ".start_date" ).datepicker( "option", "dateFormat","dd/mm/yy");
		var start_date=$('#start_date').val();
		//alert(start_date);
  		var filter_search="filter_search";
    
  		//alert(amount);
  		 var dataString ='filter_search=' + filter_search+'&start_date=' + start_date;
			alert(dataString);
  
  //return false;
  $.ajax({
                    type: "POST",
                    url: "search_artic.inc.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
          // $('#gross').hide();
           $('#filter_results').html(data); 
           
                }
            });
			
    }
  
  });

	$('#name').keyup(function(){
	
});	
</script>

</body>
</html>