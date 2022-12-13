<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

if(isset($_POST['login'])){

    //echo "login";

    $admin = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = '$admin' AND password = '$password'" ;

   $user = $con->query($sql) or die($con->error);
   $row = $user->fetch_assoc(); 
   $total = $user->num_rows;


   if($total > 0){
    $_SESSION['user'] = $row['username'];
    $_SESSION['access'] = $row['access'];


     echo header("Location: index.php");

   } else {
    echo " <div class='message warning'> No User found! </div>";
   }
  
   
  
}
?>
<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> MACHAKATH: HOMEMADE PEANUT BUTTER ONLINE SHOP </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
      <style>
        h1{
text-align: center;

        }
        #userlogin input{
        font-size: 15px;
        margin-top: 1rem;
        margin-bottom: 1rem;
        width: 50%;
        border-radius: 10px;
        font-family: 'Poppins';
        height: 50px;
        border: 1px solid #E1C16E;
        background-color: #E1C16E;
    }
    #userlogin button{
            width: 20%;
            height: 50px;
            font-family: 'Georgia';
            background-color: brown;
            font-size: 15px;
            border-radius: 10px ;
            color: white;
    }
    .user-container{
        background-color: #dfbe90a2 ;
        border-radius:20px;
        height: 445px;
        padding: 1rem;
        margin-left: 27%;
        margin-right: 20%;
        margin-top: 90px;
        width: 500px;
        text-align: center;
    }
        </style>
</head>
<body id = "userlogin" >
  
<div class="user-container"> 
   <h1> ADMIN </br> MANAGEMENT </h1> </br>
       
       <form action =" " method = "post"> 
       <label>Email: </label></br>
       <input type= "text" name = "username" id = "admin" placeholder = "Username" required > </br>
       <label>Password</label></br>
       <input type="password" name="password" id="password" placeholder = "password" required >
       <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
       <br/>
       <br/>
       
       <!-- <input type="button" onclick="window.location.href='edit.php?ID=<?php echo $row['email'];?>';" class="btn btn-warning btn-lg" value="LOG-IN"/>   -->

       <button type = "submit" name = "login" onclick = "getInputValue ();" > LOG-IN </button>
    
       
       </form>
    
       </div>
       <script>
        const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
        </script>

</body>
</html>



