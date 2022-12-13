<?php
session_start();


include_once("connections/connection.php");

connection();

$con = connection();

?>
<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> MACHAKATH: HOMEMADE PEANUT BUTTER ONLINE SHOP </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

</head>

<!-- <FRAMESET rows = "10%, 90%" frameborder="no">
    <FRAME src = "header.php" > -->

    
    <FRAMESET cols = "250px, *" frameborder = "no">
    <FRAME src = "menus.php" >
    <FRAME name = "index" src = "dashboard.php" >
            
    </frameset>




</html>
