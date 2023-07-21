<?php
ini_set('display_errors',0); // enable php error display for easy trouble shooting
error_reporting(0); // set error display to all
	include "dbfunction.php";
   /* $database   = "webezy_skip";
 	$host_name  = "localhost";

    $user_name  = "webezy_skip";

    $password   = "=psHGxX8EKRF";*/
    
     $database   = "skiptrack";
 	$host_name  = "localhost";

    $user_name  = "root";

    $password   = "";

$con = new mysqli($host_name,$user_name,$password,$database) or die("Error " . mysqli_error($con));

function mysqli_real_escape_string_walker(&$item, $key) {
global $con;
if (!is_numeric($item)) {
$item = filter_var($item, FILTER_SANITIZE_STRING);
$item = $con->real_escape_string($item);
//$item = str_replace('<script>','',$item);
}
}
if (ISSET($_POST)) {
array_walk_recursive($_POST, 'mysqli_real_escape_string_walker'); 
}
if (ISSET($_GET)) {
array_walk_recursive($_GET, 'mysqli_real_escape_string_walker'); 
}
if (ISSET($_REQUEST)) {
array_walk_recursive($_REQUEST, 'mysqli_real_escape_string_walker'); 
}


?>