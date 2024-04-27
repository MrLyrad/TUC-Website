<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'phpmailer/src/Exception.php';
  require 'phpmailer/src/PHPMailer.php';
  require 'phpmailer/src/SMTP.php';

  if(isset($_POST['send'])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'juacalla.edu@gmail.com';  //email to be used to receive the messages
    $mail->Password = 'bipssyzslhavdsdz';  //password generated when you create an app in your Google account
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('juacalla.edu@gmail.com');  //email to be used to receive the messages

    $mail->isHTML(true);
    $mail->addAddress($_POST["email"]);

    $mail->Subject = $_POST["subject"];
    $mail->Body = $_POST["message"];
    
    $mail->send();

  }

?>
