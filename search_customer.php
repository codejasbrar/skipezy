<?php 
include "dbconfig.php";
//get search term
    $searchTerm = $_GET['term'];
   
    //get matched data from skills table
    $query = $con->query("SELECT * FROM customers WHERE name LIKE '%".$searchTerm."%' ORDER BY name ASC");
    
	while ($row = $query->fetch_assoc()) {
         $data[] = array (
            'label' => $row['name'].', '.$row['post_code'],
            
			
        );
		
    }
    
    //return json data
    echo json_encode($data);
	
?>