<!DOCTYPE html>
<html><head>

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

                              $sql = "SELECT * FROM artic";
                              $res = mysqli_query($con,$sql);   
      
?>
<style>
   
</style>
</head>
<body>


   <form metho="post">
<div class="container-fluid">

   <div class="row">
        <div class="col-md-12" style="padding-top: 10px;margin-top:50px;box-shadow: 5px 5px 5px; background-color:#07507F;color:white;">
        <div class="col-md-2">
         <label for="entry_type" class="col-sm-5" style="margin-left: -10px;">From</label>
         <div class="form-group col-sm-7">
                      
 <input type="text" style="width:120px;margin-left: -20px;" name="from" class="form-control from" placeholder="Select a Date" id="from">
             
         </div>
        </div>
            <div class="col-md-2">
         <label for="entry_type" class="col-sm-5" style="margin-left: -15px;">To</label>
         <div class="form-group col-sm-7">
                      
 <input type="text" style="width:120px;margin-left: -40px;" name="to" class="form-control to" placeholder="Select a Date" id="to">
             
         </div>
        </div>
      <div class="col-md-2">
      <p for="vehicle_type" class="col-sm-5" style="margin-left:-40px;">Entry Type</p>
            <div class="form-group col-sm-5">
                  <input type="text" style="margin-left:-40px;" name="entry_type" id="entry_type" class="entry_type form-control">
            </div>      

        <!--
         <select name="entry_type" id="entry_type" class="form-control">
            <option select_date>Job Type</option>
            <option value="1">Delivery</option>
            <option value="2">Collection</option>
            <option value="3">Exchange</option>
            
         </select>
         -->
         
         </div>
     
      <div class="col-md-2">
           <label class="col-sm-5" style="margin-left:-100px;">Vehicle Type</label>
         <div class="form-group col-sm-7">
          <input type="text" style="margin-left:-40px;" name="vehicle_type" id="vehicle_type" class="vehicle_type entry_type form-control">
         </div>
      </div>
      <div class="col-md-1">
          <label class="col-sm-5" style="margin-left:-150px;">Size</label>
          <div class="form-group col-sm-7">
            <input type="text" style="width: 100px;margin-left:-100px;" name="size" id="size" class="size form-control">
          </div> 
      </div>
      <div class="col-md-1">
          <label class="col-sm-5" style="margin-left:-100px;">Quantity</label>
          <div class="form-group col-sm-7">
            <input type="text"  style="width: 80px;margin-left:-30px;" name="quantity" id="quantity" class="quantity form-control">
          </div> 
      </div>
      <div class="col-md-2">
           <label class="col-sm-5">Material</label>
          <div class="form-group col-sm-7">
            <input type="text" name="material" id="material" class="material form-control">
          </div>
      </div> 
      </form>
      </div>
   </div>
   
        
	<div class="row" id="filter_results">
		<table  style="font-family:Montserrat; font-size:16px;" id="jobs" class="table list_jobs" cellspacing="0" border="1" bgcolor="#B8B3B4">
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
                <tfoot>
              <tr class="btn-primary">
                        <th>Date</th>
       				    <th>Entry Type</th>
       				    <th>Vehicle Type</th>
       				    <th>Size</th>
       				    <th>Quantity</th>
       				    <th>Material</th>
              </tr>
        </tfoot>
                       
       			<tbody>
                <?php
            $rowcount=mysqli_num_rows($res);

if($rowcount==0)
{
	echo '<tr style="cursor:pointer; background-color:#F80307; color:#F3EBEB;"><td></td><td></td><td></td><td><p>You have no Jobs, Add Some Jobs.</p></td></tr>';
}
				
echo '<p style="text-align:center;background-color:#00DFD4; color:#000000; padding:15px; font-size:18px;">Total '.$rowcount.' jobs. You can see other jobs by applying filter. </p>';
?>
       				 <?php
                              while($row = mysqli_fetch_array($res))
                              {

                        ?>  <tr>
                                  
       					<td><?php 
						$date = date("d/m/y", strtotime($row['date']));
						echo $date;?></td>
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
    $('body').delegate('.size,.name,.entry_type,.vehicle_type,.to,.from,.material','keyup',function()  
{
//alert("Demo");		
  var to=$('#to').val();
  var from=$('#from').val();
  var vehicle_type=$('#vehicle_type').val();
  var size=$('#size').val();
  var material=$('#material').val();
  var filter_search="filter_search";
  var name=$('#name').val();
  var entry_type=$('#entry_type').val();
   var vehicle_type=$('#vehicle_type').val();
    var search = $(this).val();
  if (search.length > 0) {
	

   var dataString ='filter_search=' + filter_search+'&to=' + to+'&from=' + from +'&name=' + name+'&entry_type=' + entry_type+ '&vehicle_type=' + vehicle_type + '&size=' +size + '&material=' +material;

	 //alert(dataString); 
	} 
        
       
       
      else {
		   var dataString ='filter_search=' + filter_search+'&to=' + to+'&from=' + from +'&name=' + name+'&entry_type=' + entry_type+ '&vehicle_type=' + vehicle_type + '&size=' +size + '&material=' +material;


	}
	
  $.ajax({
                    type: "POST",
                    url: "search_waybridge.inc.php",
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
    $( "#to" ).datepicker();
 
      $( "#to" ).datepicker( "option", "dateFormat","d MM, y");
	  
    
  } );
	
$('.to').datepicker({
	
    	onSelect: function() {
			
			$( ".to" ).datepicker( "option", "dateFormat","dd/mm/yy");
		var to=$('#to').val();
                $( ".from" ).datepicker( "option", "dateFormat","dd/mm/yy");
		var from=$('#from').val();
		//alert(to);
  		var filter_search="filter_search";
    
  		//alert(amount);
  		 var dataString ='filter_search=' + filter_search+'&to=' + to+'&from=' + from;
			//alert(dataString);
  
  //return false;
  $.ajax({
                    type: "POST",
                    url: "search_waybridge.inc.php",
                    data: dataString,
                    success: function(data) {
                     //console.log(data); 
          // $('#gross').hide();
           $('#filter_results').html(data); 
           
                }
            });
			
    }
  
  });
  $('.from').datepicker({
	
    	onSelect: function() {
			
			$( ".from" ).datepicker( "option", "dateFormat","dd/mm/yy");
		var from=$('#from').val();
		//alert(to);
  		var filter_search="filter_search";
    
  		//alert(amount);
  		 var dataString ='filter_search=' + filter_search+'&from=' + from;
			//alert(dataString);
        }
  //return false;
 
	
});	
</script>

</body>
</html>