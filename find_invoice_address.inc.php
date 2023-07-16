<?php
require_once("dbconfig.php");
if(!empty($_POST["customer"])) {
$query ="SELECT * FROM delivery_address WHERE customer_id = '" . $_POST["customer"] . "' ORDER BY post_code";
//echo $query;
//exit;
?>


                             
                               <?php
							   
							    	$t_result=mysqli_query($con,$query);
									while($location=mysqli_fetch_assoc($t_result))
									{
										
									?>
           
              <?php echo $location['id']." - ".$location['address1']." - ".$location['city']." - ".$location['post_code']; ?>
                           
		<?php } ?>
        
                   
                     
<?php }  ?>
