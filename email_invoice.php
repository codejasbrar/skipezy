<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$invoice= file_get_contents("http://webdynamicslondon.co.uk/skiptrack12/print_invoice.php?invoice_no=80");

	 require 'PHPMailerAutoload.php';
	 require 'class.phpmailer.php';

    $mail = new PHPMailer;   
    $mail->setFrom('jaspinder32@gmail.com', 'Jas Brar'); // Sender
	$mail->addAddress('jaspinder32@gmail.com', 'Jas Brar'); // recipient
	
	$mail->addStringAttachment($invoice,'invoice.docx');
	$mail->isHTML(true); // Enable HTML

    $mail->Subject = 'Demonstration';
    // $message is gotten from the form
    $message = "Hi Jas ! Hope you'll love this demonstration. <br /> This is how we can send an attachment.";
    
    $mail->msgHTML($message);
    
    if (!$mail->send()) {
	    echo 'Cant send';
    } else {
        echo "Your message was successfully delivered";
    }
?>
</body>
</html>