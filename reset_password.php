<?php
//error_reporting(E_ALL);

ob_start();
session_start();
include "dbconfig.php" ;
include "header.php";
include "side_bar.php";
//This code runs if the form has been submitted
if (isset($_POST) && !empty($_POST))
{
// check for valid email address
$id = $_SESSION['id'];
$cpassword = $_POST['cpassword'];
$npassword = $_POST['npassword'];
$check="SELECT email FROM candidates WHERE id = '$id' AND password = '$cpassword'";
// checks if the username is in use
$check_q = mysql_query($check)or die(mysql_error());
//echo $check;
//exit;
$check2 = mysql_num_rows($check_q);

//if the name exists it gives an error
if ($check2 == 0) {
$error[] = 'Sorry, we cannot find your account details please try another email address.';
}

// if no errors then carry on
if (!$error) {

$query = mysql_query("SELECT name,email FROM candidates WHERE id = '$id'")or die (mysql_error());
$r = mysql_fetch_object($query);

//create a new random password

$password = substr(md5(uniqid(rand(),1)),3,10);
$password = rand();
$password = $npassword;
$pass = $npassword; //encrypted version for database entry

//send email
$to = "$email";
$subject = "Dear $r->name , Password change request";
$body = "Hi $r->Name, you or someone else have recently changed your password your new password is $pass.\nYour password has been reset please login and change your password to something more rememberable. \nRegards Site Admin";
$additionalheaders = "From: <impulsecateringagency@gmail.com>rn";
$additionalheaders .= "Reply-To: impulsecateringagency@gmail.com";
mail($to, $subject, $body, $additionalheaders);

//update database
$sql = mysql_query("UPDATE candidates SET password='$pass' WHERE id = '$id'")or die (mysql_error());
$rsent = true;


}// close errors
}// close if form sent

//show any errors
if (!empty($error))
{
        $i = 0;
        while ($i < count($error)){
        echo '<div class="msg-error">'.$error[$i]."</div>";
        $i ++;}
}// close if empty errors


if ($rsent == true){
    echo "<p>Dear $r->name Your Password has been updated successfully</p>";
    }
include "footer.php";
?>
   <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-9">
                <section class="panel">
 					<div class="activity-icon terques">
                        <i class="fa fa-check"></i>
                    </div>
										 
						 <div class="activity-desk">
                            <h2>Candidate Password Reset -<?php echo" ". $row['Name'];?></h2>
                         </div>   
<table class="table table-hover" width="350" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td><form class="form-body" name="form1" method="post" action="reset_password.php">
<table width="100%" border="0" cellspacing="4" cellpadding="0">
<tr>
<td colspan="3"><strong>Re-set Password</strong></td>
</tr>
<tr>

</tr>
<tr>
<td>Current Password</td>
<td>:</td>
<td><input name="cpassword" type="text" id="email" size="30"></td>
</tr>
<tr>
<td>New Password</td>
<td>:</td>
<td><input name="npassword" type="text" id="email" size="30"></td>
</tr>
<tr>
<td>Re-type Password</td>
<td>:</td>
<td><input name="npassword" type="password" id="password" size="30"></td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Re-set Password"  class="btn btn-primary"> &nbsp;
</tr>
</table>
</form></td>
</tr>

</table>
</section>
</section>
</section>