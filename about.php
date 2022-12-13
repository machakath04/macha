<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

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
       <style>
        h1{
            color: white;
  border: 1px solid brown;
  background-color: #814918;
  width: 50%;
  margin-left: 25%;
  border-radius: 13px;
  margin-bottom: 5%;
        }
        p{
            font-size: 20px;
        }
        .about-container{
            background-color: #dfbe90a2 ;
            border-radius:20px;
            height: auto;
            padding: 1rem;
            margin-left: 20%;
            margin-right: 20%;
            margin-top: 10%;
            width: 60%;
            text-align: center;
        }
        section{
    display: block;
    text-align: left;
    background-color: #814918 ;
    text-indent: 5%;
}
* {
  box-sizing: border-box;
}

.column3 {
  float: left;
  width: 30%;
  height: auto;
  padding: 3px;
  margin-left: 3%;
}

/* Clearfix (clear floats) */
.row3::after {
  content: "";
  clear: both;
  display: table;
  
 
}
section p{
    color: white;
    font-size: 18px;
}
       </style> 
</head>
<body id = about>
<div class="about-container">
    <h1> ABOUT US </h1> </br>
     <p> <b>MACHAKATH </b>is a homemade peanut butter business that commenced on February 2020 out of passion for amazing food and service.
Mr. Diomedes Hernandez and his family, through word of mouth, a lot of hard work and commitment to producing one-of-a-kind peanut butter is now reaching out for a larger market.
With recipe passed down from generations to generations, the Machakath serves you peanut butter with taste worth toasting for!</p>

    </div>
    


</body>
</html>
