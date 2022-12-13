<?php

session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

$email = $_SESSION['email'];

if(isset($_POST["code"]))
{

    $sql = "SELECT * FROM user WHERE email = '".$email."'";
    $result = mysqli_query($con, $sql);
    $rec = $result->fetch_assoc();
     

    if(mysqli_num_rows($result) == 0)
    {
        die("Email not found.");
    }

    $user = mysqli_fetch_object($result);

$_SESSION['info'] = "";
        $otp_code = $_POST['verify'];
        $check_code = "SELECT * FROM user WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);

        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
           header('location: new_password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
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


</head>
<body id = "userlogin" >
 
<div class="user-container"> 
   <h1> Code Verification </h1>
   

<form method="POST">
    <input type="hidden" name="email" placeholder="Enter email" value="<?php echo $email?>"  required  ></br>

    <input type="number" name="verify" placeholder="Verification code" required ></br>

    <button type="submit" name="code" > SUBMIT </button>
</form>