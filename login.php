<?php
include "dbconfig.php" ;
  ob_start();
   session_start();
  $uid=$_POST['email'];
$pw=$_POST['password'];
//echo $uid;
///echo $pw;
// exit;
  
    
$tbl_name1="users";
$sql="SELECT * FROM $tbl_name1 WHERE user_name ='".$uid."' AND password = '".$pw."'";
//echo $sql;
//exit;

if (!mysqli_query($con,$sql)) 
              {   
                
                die('INSERT SQL SAID -Error Adding New candidate: ' . mysqli_error($con));
              }
$res= mysqli_query($con,$sql);
$user= mysqli_fetch_assoc($res);
//echo $users=mysqli_num_users($res);
//exit;
if(mysqli_num_rows($res) > 0)
{
  $_SESSION['name']=$user['id'];
  $_SESSION['loggedin']="true";
  session_start();
  //echo $user['id'];
  $_SESSION['sid']=session_id();
  $_SESSION['id']=$user['id'];
  
           header('Location:dashboard.php');
  
}
else
{
  header('Location:re_login.html');
}
                  

?>