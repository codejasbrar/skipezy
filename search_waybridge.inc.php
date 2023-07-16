
<meta charset="utf-8">

<title>List of Orders</title>
<!doctype html>

<html>

<head>




 </head>
  <?php

include "dbconfig.php";

//include "css_header.php";
//include "navbar_list.php";
 $today_date= date('Y-m-d');
//Get the order data for this order.
if(isset($_POST['filter_search']))
   {
	//print_r($_POST);
	$condition='';
	$post_code='';
	$entry_type='';
        $vehicle_type='';
	$size='';
	$quantity='';
        $material='';
	$from='';
        $to = '';
      if (!empty($_POST['post_code']))
	{
	  $post_code=$con->real_escape_string($_POST['post_code']);
	  $condition .= " delivery_address.post_code LIKE '$post_code%'";
	}
	if (!empty($_POST['name']))
	{
	  $name=$con->real_escape_string($_POST['name']);
	  $condition .= "AND customers.name LIKE '$name%'";
	}
	if (!empty($_POST['entry_type']))
	{
	  $entry_type=$con->real_escape_string($_POST['entry_type']);
	  $condition .= "AND entry_types.name LIKE '$name%'";
	}
        if (!empty($_POST['vehicle_type']))
	{
	  $vehicle_type = $con->real_escape_string($_POST['vehicle_type']);
	  $condition .= "AND vehicle_type.name LIKE '$name%'";
	}
	if (!empty($_POST['size']))
	{
	  $size=$con->real_escape_string($_POST['size']);
	  $condition .= "AND size.name LIKE '$name%'";
	}
        if (!empty($_POST['quantity']))
	{
	  $quantity=$con->real_escape_string($_POST['quantity']);
	  $condition .= "AND quantity.name LIKE '$name%'";
	}
         if (!empty($_POST['material']))
	{
	  $material=$con->real_escape_string($_POST['material']);
	  $condition .= "AND material.name LIKE '$name%'";
	}
        
	if (!empty($_POST['from']))
	{
	  $from=$con->real_escape_string($_POST['from']);
	  $from = str_replace("/","-",$from);
	  $from = date("Y-m-d", strtotime($from));
	}
        if (!empty($_POST['to']))
	{
	  $to=$con->real_escape_string($_POST['to']);
	  $to = str_replace("/","-",$to);
	  $to = date("Y-m-d", strtotime($to));
	}

	if($to=='' OR $from=='')
	{
		$sql = " SELECT * from artic WHERE date LIKE '%' AND entry_type LIKE '$entry_type%' AND vehicle_type LIKE '$vehicle_type%' AND size LIKE '$size%' AND material LIKE '$material%'";
	}
	else{
$sql = " SELECT * from artic WHERE (date BETWEEN '$from' AND '$to') AND entry_type LIKE '$entry_type%' AND vehicle_type LIKE '$vehicle_type%' AND size LIKE '$size%' AND material LIKE '$material%'";
	}
//echo $sql;
$res=mysqli_query($con,$sql);

}
elseif($rowcount>0)
{
$sql="SELECT * from artic";

$res=mysqli_query($con,$sql);

echo $sql;

}
?>

        <table style="font-family:Montserrat; font-size:16px;" id="jobs" class="table table-hovered" cellspacing="0" border="1" bgcolor="#B8B3B4">
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
		<?php
            $rowcount=mysqli_num_rows($res);

if($rowcount==0)
{
	echo '<p style="text-align:center;background-color:RED; color:#ffffff; padding:15px; font-size:18px;">'.$rowcount.' jobs found matching your search criteria. </p>';
}
elseif($rowcount>0){
echo '<p style="text-align:center;background-color:#00DFD4; color:#000000; padding:15px; font-size:18px;">'.$rowcount.' jobs found matching your search criteria. </p>';
}
?>
                        <?php 
                              
                              while($row = mysqli_fetch_array($res))
                              {

                        ?>  
       			<tbody>
                
       				<tr class="info">
                                  
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

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="update_job_modal">
 
</div><!-- /.modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="tip_job_modal">
 
</div><!-- /.modal -->


<!-- Delete Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Cancellation?</h4>
                </div>
            
                <div class="modal-body">
                    <p style="background-color:#EF0E12; color:white; font-size:20px;">Are you 100% Sure and Manager has Authorised?<img width="100" height="100" src="images/delete.png" class="img-thumbnail responsive">
                    </p>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">I am not Sure</button>
                    <a class="btn btn-danger btn-ok">I am sure - Cancel Job </a>
                </div>
            </div>
        </div>
    </div>
<!-- Delete Modal Ends -->

<!-- Delete Modal -->
<div class="modal fade" id="job_done" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">You Sure ?</h4>
                </div>
            
                <div class="modal-body">
                    <p style="background-color:#EF0E12; color:white; font-size:20px;">This Job is Aleady Updated. Please check Job Again.
                    </p>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">close This Screen</button>
                </div>
            </div>
        </div>
    </div>
<!-- Delete Modal Ends -->
<script type="text/javascript">
	//alert("list_job");


$(".list_jobs").find('td[data-id]').on('click', function () {
	
	///alert("Demo");
	var selected_col=$(this).attr('col-id');
	
	if(selected_col=='6')
	{
			var select_customer_id=$(this).attr('data-id');
			var dataString = 'select_customer_id='+select_customer_id;
			 // alert(dataString);
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
			  var select_job_id=$(this).attr('data-id');
			  var dataString = 'select_job_id='+select_job_id;
			  //alert(dataString);
			  $.ajax({
				  type: "POST",
			  url: "update_driver.php",
			  data: dataString,
			  success: function(data) {
				  $('#drivers_modal').html(data);
				  $('#drivers_modal').modal('show');
				  }
			  });
		
		}
		
		if(selected_col=='12')
		{
			  //alert("Demo");
			  var status=$('#status').val();
			  if(status=='Do0ne')
			  {
			  
			   $('#job_done').modal('show');
			  return false;
			  }
			  var select_job_id=$(this).attr('data-id');
			  var dataString = 'select_job_id='+select_job_id;
			  //alert(dataString);
			  $.ajax({
				  type: "POST",
			  url: "update_job.php",
			  data: dataString,
			  success: function(data) {
				  $('#update_job_modal').html(data);
				  $('#update_job_modal').modal('show');
				  }
			  });
			  
		
		}
	// Tipping this job now
	if(selected_col=='13')
		{
			  //alert("Demo");
			  
			  var tip_job_id=$(this).attr('data-id');
			  var dataString = 'tip_job_id='+tip_job_id;
			  //alert(dataString);
			  $.ajax({
				  type: "POST",
			  url: "tip_job.php",
			  data: dataString,
			  success: function(data) {
				  $('#tip_job_modal').html(data);
				  $('#tip_job_modal').modal('show');
				  }
			  });
			  
		
		}

	    
});

// Delete button Request yes no

        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
        });
		
$('#filter_btn').click(function(){
    
  var filter_search="filter_search";
  var entry_type=$('#entry_type').val();
  var size=$('#size').val();  
  var post_code=$('#post_code').val(); 
  
  var from=$('#from').val();
  
  //alert(amount);
   var dataString ='filter_search=' + filter_search+ '&entry_type=' + entry_type + '&size=' + size+'&post_code=' + post_code + '&from=' + from;
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
        });
		
//When user click on Start_date execute the filter
$('.from').datepicker({
    	onSelect: function() {
			$( ".from" ).datepicker( "option", "dateFormat","dd/mm/yy");
		var from=$('#from').val();
		alert(from);
  		var filter_search="filter_search";
    
  		//alert(amount);
  		 var dataString ='filter_search=' + filter_search+'&from=' + from;
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
</script>


</html>