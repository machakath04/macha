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
      background-color: #E1C16E ;
        overflow:hidden;
   
    }
    .logo{
      width:100px;
    }

    </style>
</head>
<body>
  <div class="logo">
  <div class="column" style="width:100px">
<img src = "img/logo2.png" width = "90px" height= "50px" >
</div>
<div class="row">
<label style="text-align:center; color:black"> MACHAKATH </label>
</div>
  </div>
</body>
</html>