<?php 
        if(isset($_GET['cid']))
        {
           $cid=$_GET['cid'];
        }

	if(isset($_POST['btn']))
	{
		$name=$_POST['name'];
        $mobile=$_POST['mobile'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $address1=$_POST['address1'];
        $address2=$_POST['address2'];
        $city=$_POST['city'];
        $post_code=$_POST['post_code'];
        $emergency_contact=$_POST['emergency_contact'];
        $emergency_phone=$_POST['emergency_phone'];
        $relation=$_POST['relation'];
        $job_title=$_POST['job_title'];
        $update=mysqli_query($con,"UPDATE employees SET name='$name',mobile='$mobile',phone='$phone',email='$email',address1='$address1',address2='$address2',city='$city',post_code='$post_code',emergency_contact='$emergency_contact',emergency_phone='$emergency_phone',relation='$relation',job_title='$job_title'  WHERE id='$cid' ");
        header("location:list_employee.php");
	}
?>