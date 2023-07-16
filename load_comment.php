<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Drivers Change</title>
<?php 
include "dbconfig.php";
include "php_functions.php";
//include "dbfunction.php";
ob_start();
?>

</head>

<body>
					<?php
   						if (isset($_POST['tip_job_id'])) 
						{
									//print_r($_POST);
									// -------------- add more rows and connect here to database -- all fields
									$order_id=$con->real_escape_string($_POST['tip_job_id']);
									//$driver=getAll($con,"employees");
									$sql="SELECT comments from order_details where order_id=$order_id";
									$res=mysqli_query($con,$sql);
									$comments=mysqli_fetch_assoc($res);
									$comment=$comments['comments'];
						}

					?>
                      
   
      <?php
       if(isset($_POST['new_comment']))
			
			{
				
								print_r($_POST);
								$new_comment=$con->real_escape_string($_POST['new_comment']);
								$order_id=$con->real_escape_string($_POST['order_id']);
								
						$update_sql="UPDATE order_details SET comments='$new_comment' WHERE order_id=$order_id";
				         //echo $update_sql;
						  if (!mysqli_query($con,$update_sql)) {
							  
							  die('UPDATE 6 INTO ORDER_Details -Error: ' . mysqli_error($con));
							  }
				}
	     ?> 
                           
                           
 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Comments</h4>
      </div>
      <div class="modal-body">
      <form id="comments_form" method="post" action="">
           <input type="hidden" id="order_id" value="<?php echo $order_id;?>">

        <div class="panel">
               <div class="panel-body" style="background-color:#e9e9e9; box-shadow: 5px 5px 5px;">
                <div class="col-md-5">
                <textarea name="new_comment" id="new_comment"><?php echo $comment;?></textarea>
         </div>
         
                 </div>   
              </div>
            <div class="row">
              <button id="comments_btn" type="button" class="btn btn-success pull-right" data-dismiss="modal">Update Comments</button>
              <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
        </div>
         </form>        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
               
 
 <div class="modal fade"  id="confirmModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Confirmation !</h4>
      </div>
      <div class="modal-body">
        <p style="color:black; background-color:#EFBC0D; padding:20px; font-size:20px; font-weight:bold;"> Great !! Comments Updated !</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="closeme" class="btn btn-success">Close ME</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<!-- /.modal -->

<script type="text/javascript">

  $('#comments_btn').click(function(){
	  
	var new_comment=$('#new_comment').val();
	var order_id=$('#order_id').val();
			  var dataString = 'new_comment='+new_comment+' & order_id=' + order_id;
			  //alert(dataString);
			  $.ajax({
				  type: "POST",
			  url: "load_comment.php",
			  data: dataString,
			  success: function(data) {
			
			window.location.href='list_job.php';
			$('#confirmModal').modal('show');
		}
	})
	
  });
  
  $('#closeme').click(function(){
  
 window.location.href='list_job.php';
  });
  
 </script> 
  
</body>
</html>