 <!-- Now allocate job to selected driver -->
       <?php
	   include "dbconfig.php";
	   print_r($_POST);
		if (ISSET($_POST['id'])) {
		
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
   
    // get id
    $id = $_POST['id'];
 
    // delete User
    $query = "DELETE FROM delivery_address WHERE id = '$id'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}

		}
		
		
		?>