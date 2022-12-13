<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();


$id = $_GET['ID'];

$sql=" SELECT * FROM cart WHERE id = '$id'";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();


if(isset($_POST['update'])){


$quan = $_POST['quantity'];
$total = $quan * $row['product_price'];


$qry = "UPDATE cart SET quantity = '$quan', total = '$total'  WHERE id = '$id'";
$con->query($qry) or die ($con->error);


echo header("Location:cart.php");
}

// echo header("Location: cart.php");
?>

<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> Update Quantity</title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    body{
        image-rendering: auto;
        background-image: url('img/logo.jpg');
        /* background-size: cover; */
        background-repeat:no-repeat;
        background-size: 100% 100%;
        /* background-attachment: fixed; */
        }
    .quantity{
        border:0.5px solid black;
        width: 30%;
        margin-left: 30%;
        background-color: #dfbe90a2 ;
        text-align:center;
        margin-top:15%;
        padding:2rem;
        box-shadow: 5px 10px 8px #888888;
        border-radius:5%;
    }
    </style>
</head>
    <body>
        <div class="quantity">
       <form action=" " method="post">
       <h2 style="color:black"> Input Quantity </h2>
       <input style="text-align:center; width:90px" type="text" name="quantity" value="<?php echo $row['quantity']?>"> </br> </br>
       <button type="submit" name="update"> <b> Update </b> </button>
</form>
</div>
</body>