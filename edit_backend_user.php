<?php
    if(isset($_GET['cid']))
    {
        $cid=$_GET['cid'];
    }

           if(isset($_POST['btn']))
           {
              $first_name=$_POST['first_name'];
              $last_name=$_POST['last_name'];
              $user_name=$_POST['user_name'];
              $email=$_POST['email'];
              $role=$_POST['role'];
              $update=mysqli_query($con,"UPDATE users SET first_name='$first_name',last_name='$last_name',user_name='$user_name',email='$email',role='$role' WHERE id='$cid'  ");
           }
?>