<?php 
//include "dbconfig.php";
function dbRowInsert($table_name, $form_data){
global $con;
//echo $table_name;
    // retrieve the keys of the array (column titles)
    $fields = array_keys($form_data);

    // build the query
    $sql = "INSERT INTO ".$table_name."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $form_data)."')";
	
	echo $sql;
	return mysqli_query($con,$sql);			


}
function dbSELECT($con,$tblName, $select='*', $where_clause='')
 {
  // check for optional where clause
  $whereSQL = '';
  if(!empty($where_clause))
  {
   // check to see if the 'where' keyword exists
   if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
   {
    // not found, add key word
    $whereSQL = " WHERE ".$where_clause;
   } else
   {
    $whereSQL = " ".trim($where_clause);
   }
  }
  // start the actual SQL statement
  $sql = "SELECT ".$select." FROM ".$tblName." ";
 
  // append the where statement
  $sql .= $whereSQL;
 
  // run and return the query result
  return mysqli_query($sql);
 }
 
 function dbRowUpdate($table_name, $form_data, $where_clause='')
{
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);

    // append the where statement
    $sql .= $whereSQL;
	echo "<br>".$sql;
    // run and return the query result
    return mysqli_query($con,$sql);	
}

	// get details of a partiuclar product or item 
	//How to use this function $product_detail = get_detail($product_id);
	
function get_detail($table_name,$id) {
			global $con;
			$id = $product_id;
			$query = "SELECT * from WHERE `id` = $id";
			//echo $query;
			if ($result = $con->query($query))
{
				if ($result->num_rows == 1) {
					$row = $result->fetch_array();
					return $row;
				}
			}
		}




?>