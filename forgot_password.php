<?php
include "dbconfig.php" ;
//include "header.php";
//include "page_header.php";
//This code runs if the form has been submitted
if (isset($_POST) && !empty($_POST))
{
// check for valid email address
$email = $_POST['email'];
// checks if the username is in use
$check = mysqli_query($con,"SELECT email FROM users WHERE email = '$email'")or die(mysqli_error());
$check2 = mysqli_num_rows($check);

//if the name exists it gives an error
if ($check2 == 0) {
$error[] = 'Sorry, we cannot find your account details please try another email address.';
}
$error[] = '';
// if no errors then carry on
if (!$error)
{

$query = mysqli_query($con,"SELECT name,email FROM users WHERE email = '$email'")or die (mysqli_error());
$result = mysqli_fetch_object($query);

//create a new random password

$password = substr(md5(uniqid(rand(),1)),3,10);
$password = rand();
$pass = ($password); //encrypted version for database entry

//send email
$to = "$email";
$from="Miracle Admin";
$subject = "Account Details Recovery";

/*
$body = "Hi $result->name, You or someone else have requested a new password.Here are your acount details: Your username is $email.Your password is: $password. lease log in with this password and reset to a new password. Click Here to Log in";
*/


$body="Someone requested that the password be reset for the following account:\n\nUser name: $result->name\n\nemail: $email\n\nIf this was a mistake, just ignore this email and nothing will happen.\n\nYour new password is $pass. \n\nTo Log in to your account, visit the following address:\n\nhttp://webdynamicslondon.co.uk/miracle/login.html";



$additionalheaders = "From: Impulse Admin-";
$additionalheaders .= "Reply-To: impulsecateringagency@gmail.com";
mail($to, $subject, $body, $additionalheaders);
/*if($rsent==true)
{
	echo "mail send";
}
else
{
	echo "mail not send";
}*/
//update database
$sql = mysqli_query($con,"UPDATE users SET password='$pass' WHERE email = '$email'")or die (mysqli_error());
}// close errors
}// close if form sent
$rsent = true;

//show any errors
if (!empty($error))
{
        $i = 0;
        while ($i < count($error)){
        echo '<div class="msg-error">'.$error[$i]."</div>";
        $i ++;}
}// close if empty errors


if ($rsent == true)
{
?>
<div class="panel-body">

<center><h2>You have been sent an email with your account details to <?php echo $email;?></h2></center>
<a class="hd-title" href="login.html"> Click Here to Log In </a>

</div>

<?php 
    } else {
    ?>
    
    <h1 class="heading"> <p> Please enter your e-mail address. You will receive a new password via e-mail.</h1></p>";
    <?php 
    }
?>


<!--
<table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>

<form name="form1" method="post" action="forgot_password.php">
<table width="100%" border="0" cellspacing="4" cellpadding="0">
<tr>
<td colspan="3"><strong>Request New password</strong></td>
</tr>
<tr>
<td>E-mail</td>
<td>:</td>
<td><input name="email" type="text" id="email" size="30"></td>
</tr>


<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Send password"> &nbsp;
</tr>
</table>
</form></td>
</tr>
</table>

-->