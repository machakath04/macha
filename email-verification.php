<?php

if(isset($_POST["login"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    $verify=$_POST["verify"];
    // $verification_code = $_GET["verification_code"];

$con = mysqli_connect("localhost", "root", "admin", "send");

    $sql = "SELECT * FROM user WHERE email = '".$email."'";
    $result = mysqli_query($con, $sql);

    $sql2 = "UPDATE user SET verify = '$verify' WHERE email = '". $email ."' ";
    $result2 = mysqli_query($con, $sql2);


    if(mysqli_num_rows($result) == 0)
    {
        die("Email not found.");
    }

    $user = mysqli_fetch_object($result);

    if (!password_verify($password, $user->password))
    {
        die("Password is not correct");
    }

    if ($user->verification_code != $verify)
    {
        die("Please verify your email <a href='login2.php?email=" .$email . "'>from here</a>");
    }
    echo"<p>Your Login here</p>";
    exit();
}
?>
<form method="POST">
    <input type="email" name="email" placeholder="Enter email" required >
    <input type="password" name="password" placeholder="Enter password" required>
    
    <!-- <input type="hidden" name="verification_code" value="<?php echo $_GET['verification_code']; ?>" required> -->
    <input type="code" name="verify" placeholder="Verification code" required >

    <input type="submit" name="login" value="Login">
</form>