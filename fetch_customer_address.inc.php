<?php
    // include Database connection file 
    include("dbconfig.php");
 if (ISSET($_POST['customer_id'])) {
		// --customer_id---------- add more rows and connect here to database -- all fields
	    $customer_id=$con->real_escape_string($_POST['customer_id']);
    // Design initial table header 
    $data = '<table class="table table-bordered table-striped">
                        <tr>
                            <th>No.</th>
							
                            <th>Address</th>
                            <th>City</th>
                            <th>Post Code</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>';
 
    $query = "SELECT * FROM delivery_address WHERE customer_id=$customer_id ORDER BY id DESC";
 	//echo $query;
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
 
    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
        $number = 1;
        while($row = mysqli_fetch_assoc($result))
        {
            $data .= '<tr>
                <td>'.$number.'</td>
                <td>'.$row['address1'].'</td>
                <td>'.$row['city'].'</td>
                <td>'.$row['post_code'].'</td>
                <td>
                    <button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning">Update</button>
                </td>
                <td>
                    <button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
                </td>
            </tr>';
            $number++;
        }
    }
    else
    {
        // records now found 
        $data .= '<tr><td colspan="6">Records not found!</td></tr>';
    }
 
    $data .= '</table>';
 
    echo $data;
 }
?>