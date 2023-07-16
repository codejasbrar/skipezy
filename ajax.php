<?php
require_once 'dbconfig.php';

   
   		 if(isset($_POST['skip']))
		 {
			 $skip=$con->real_escape_string($_POST['skip']);
	$result = mysqli_query($con,"SELECT * FROM skips where size LIKE '".$skip."%'");	
	$data = array();
	
	while ($row = mysqli_fetch_assoc($result)) {
		
		array_push($data, $row['size']);	
	}	
	echo json_encode($data);
}

?>