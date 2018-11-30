<?php

  require("./PHPMailer.php");
  require("./SMTP.php");
  require("./Exception.php");

    $mail = new PHPMailer\PHPMailer\PHPMailer();
	$mail->setLanguage('ar', './languages');
	
    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "hellocc2@gmail.com";
    $mail->Password = "";
    $mail->SetFrom("hellocc2@gmail.com");
    $mail->Subject = "Test";
    $mail->Body = "hello";
    $mail->AddAddress("hellocc2@gmail.com");

     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "Message has been sent";
     }
?>