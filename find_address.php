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
           <option selected style="padding:10px; background-color:#2977C9; color:#F9F0F1; cursor:pointer;" value="<?php echo $location['id']; ?>">
              <?php echo $location['address1']." - ".$location['address2']." , ".$location['city']." , ".$location['post_code']; ?>
                           </option>
		<?php } ?>
        <option style="padding:10px; background-color:#FCEC0A; color:#000000; cursor:pointer;" value="0">Add New Address
        </option>
                   
                     
<?php }  ?>
