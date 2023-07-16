<?php
include "dbconfig.php";
ini_set('display_errors',1); // enable php error display for easy trouble shooting
error_reporting(E_ALL); // set error display to all
	if(isset($_POST['selected_address']) && isset($_POST['selected_address']) != "")
{
    // get User customer_id
    $selected_address=$con->real_escape_string($_POST['selected_address']);
 
    // Get User Details
    $query = "SELECT * FROM delivery_address WHERE id = '$selected_address'";
	$result = mysqli_query($con, $query);
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
	
	$address=mysqli_fetch_assoc($result);
	echo $address['address1'].",".$address['address1'].",".$address['address1'];
}
	
?>