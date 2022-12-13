<?php

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

if(isset($_POST['forgot']))
{
  $mail = new PHPMailer(true);


  try{
      //$mail->SMTPDebug = 0;

      $mail->isSMTP();

      $mail->Host = 'smtp.gmail.com';

      $mail->SMTPAuth = true;

      $mail->Username = 'machakath04@gmail.com';

      $mail->Password = 'aueeifgjeyatozvq';

      $mail->SMTPSecure = 'tls';

      $mail->Port = 587;

      $mail->setFrom('machakath04@gmail.com');

      $mail->addAddress($_POST["email"]);

      $mail->isHTML(true);

      $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );

      $code = substr(number_format(time() * rand(), 0, '', '',), 0, 6);

      $mail->Subject = 'Password Reset Code';
      $mail->Body = '<p>Your password reset code is:  <b style="font-size: 30px;">' .
          $code.'</b></p>';
      $mail->send();

$email = $_POST['email'];

      $qry = "UPDATE  `user` SET code = '$code' WHERE email = '$email'";
      $con->query($qry) or die($con->error);
   
     echo header("Location:sent_code.php");
      exit();
           
     }catch (Exception $e){
         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
     }
    }

?>
<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0 ,maximum-scale=1.0, user-scalable=yes">
        <title> MACHAKATH: HOMEMADE PEANUT BUTTER ONLINE SHOP </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<style>
    /* .forgot{
        width:50%;
        margin-left:25%;
        background-color:cyan;
        height:auto;
        margin-top:10%;
        padding:8px;
        text-align:center;
    } */
    </style>

</head>
<body id = "userlogin" >
<form method = "post">
<div class="user-container"> 
    <h1> Forgot Password </h1> </br>
    <label style="text-align:center"><b> Enter your email address </b></label> </br>
    <input type="text" name="email"> </br> </br>

    <button type="submit" name = "forgot"> Continue </button>
</div>
</form>
</body>
</html>