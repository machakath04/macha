<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

$email = $_SESSION['email'];

if(isset($_POST['change']))
{
   
    $pass = $_POST['password'];
    $confirm = $_POST['confirm'];


    $data = $_POST;
    
    if ($data['password'] !== $data['confirm'])
     {
    echo "Password and Confirm password should match!";   
    } else {
  
        $sql = "UPDATE user SET password = '$pass' WHERE email = '$email'";
        
           $con->query($sql) or die ($con->error);
        
           echo header("Location:login.php");
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
    <form method = "post">
<div class="user-container"> 
<h1> New Password </h1>
<input type="hidden" name="password" value=" <?php echo $email ?>" placeholder="Enter new password" required ></br>

<input type="text" name="password" placeholder="Enter new password" required ></br>
<input type="text" name="confirm" placeholder="Confirm your password" required ></br>
<button type="submit" name="change" > Change </button>

</div>
</form>
</body>
</html>