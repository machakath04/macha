<?php

if(isset($_POST["login"]))
{
    $email = $_POST["email"];
    // $password = $_POST["password"];
    $verify=$_POST["verify"];
    // $verification_code = $_GET["verification_code"];

$con = mysqli_connect("localhost", "root", "admin", "db_machakath");

    $sql = "SELECT * FROM user WHERE email = '".$email."'";
    $result = mysqli_query($con, $sql);
    $rec = $result->fetch_assoc();
     
    $sql2 = "UPDATE user SET verify = '$verify' WHERE email = '". $email ."' ";
    $result2 = mysqli_query($con, $sql2);


    if(mysqli_num_rows($result) == 0)
    {
        die("Email not found.");
    }

    $user = mysqli_fetch_object($result);

    // if (!password_verify($password, $user->password))
    // {
    //     die("Password is not correct");
    // }

    if ($user->verification_code != $verify)
    {
        die("Please verify your email <a href='reverify.php?email=" .$email . "'>from here</a>");
    }
    // echo"<p>Your Login here</p>";
    echo header("Location: login.php");
    exit();
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
   <h2> PLEASE VERIFY YOUR EMAIL </h2>

<form method="POST">
    <input type="email" name="email" placeholder="Enter email" required ></br>
    <!-- <input type="password" name="password" placeholder="Enter password" required> -->
    
    <!-- <input type="hidden" name="verification_code" value="<?php echo $_GET['verification_code']; ?>" required> -->
    <input type="code" name="verify" placeholder="Verification code" required ></br>

    <button type="submit" name="login" value="Login"> SUBMIT </button>
</form>