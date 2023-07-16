<?php

if(isset($_GET['cid']))
{
	$cid=$_GET['cid'];
}
if(isset($_POST['btn']))
{

	$name=$_POST['name'];
    $make=$_POST['make'];
    $mileage=$_POST['mileage'];
    $reg_plate=$_POST['reg_plate'];
    $model=$_POST['model'];
    $mot_date=$_POST['mot_date'];
    $service_date=$_POST['service_date'];
    $update=mysqli_query($con,"UPDATE vehicles SET name='$name',make='$make',mileage='$mileage',reg_plate='$reg_plate',model='$model',mot_date='$mot_date',service_date='$service_date' WHERE id='$cid' ");
    header("location:list_vehicles.php");
}

?>