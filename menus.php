<?php
session_start();


include_once("connections/connection.php");

connection();

$con = connection();

?>
<html>
    <head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> MACHAKATH: HOMEMADE PEANUT BUTTER ONLINE SHOP </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
    *{
        background-color:#8C7663;
        overflow:hidden;
   
    }
    h1{
  color: white;
  /* border: 1px solid brown;
  background-color: #814918;
  width: 50%;
margin-left: 5%;
letter-spacing: 8px;
margin-top: 8%;
margin-bottom: 8%; */
text-align:center;
}
a:link{
    color: white;
    margin-bottom: 5%;
    /* border: 1px solid brown;
    background-color: violet; */
    
}
.link{
    background-color: brown;
}
h4{
    text-align:center;
}
label{
  color: white;
  font-size:20px;
  margin-top:30px;
 
}
a:hover{
    margin-left: -10px;
   font-size: 20px;
}
a{
    text-decoration:none;
  }


    </style>
</head>
<body>
</br> 
<i class="	fas fa-user" style="margin-right:5px;margin-left:40px;font-size:25px" ></i> <label style="color:#fcf7a6">Admin </label></br> </br>

<hr>
<i class="fa fa-home" style="margin-right:7px;margin-left:5px;color:#ff8d85;font-size:25px" ></i>
<a href = "dashboard.php" target = "index">Admin Dashboard </a> </br> 
<hr>
<i class="fas fa-shopping-cart" style="margin-right:5px;margin-left:5px;color:#fad000;font-size:20px" ></i>
<a href = "completed.php?page=1" target = "index"> Completed Orders </a> </br> 
<hr>

<!-- <i class="	fas fa-user-circle" style="margin-right:5px;margin-left:2px" ></i> -->
<i class="	fas fa-users" style="margin-right:5px;margin-left:5px;color:#96c3eb;font-size:20px" ></i>
<a href = "customers.php" target = "index"> List Of Customers </a></br> 
<hr>
<i class="material-icons" style="margin-right:5px;margin-left:5px;color:#ff9933;font-size:25px"  >restaurant_menu</i>
<a href = "product_manage.php" target = "index" > Manage Products </a> </br> 
<hr>


<i class="fas fa-chart-line" style="margin-right:5px;margin-left:5px;color:#158fad;font-size:20px" ></i>
<a href = "prediction.php" target = "index"> View Prediction </a> </br> 
<hr>
<i class="far fa-file-archive" style="margin-right:5px;margin-left:5px;color:#afb83b;font-size:20px" ></i>
<a href = "product_archive.php" target = "index"> Archive Products </a> </br> 
<hr>
</br> </br> </br> </br> </br></br> </br>

<hr>
<a style="margin-left:40px" href = "logout.php" target="_top"> Log-out </a> 
<i class="fa fa-sign-out" style="margin-left:15px;font-size:20px" ></i>
</br>
<hr>
<!-- <a href = "logout.php"  > Log-out</a> </br>
<hr> -->
</body>
</html>