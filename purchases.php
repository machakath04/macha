<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

$id1 = $_SESSION['email'];

// $sql = "SELECT * FROM orders WHERE email = '$id1'";
$sql = "SELECT orders.email, orders.order_id, orders.date, orders.product_id, orders.product_name, orders.product_price, 
         orders.quantity, orders.total, orders.payment, orders.Status, orders.reference, orders.image, products.picture FROM orders INNER JOIN products ON orders.product_id = products.product_id WHERE orders.email = '$id1'";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();
$total = $tao->num_rows;


?>

<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> Purchases </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

          <style>
             table {
                border: 1px solid black;
                border-collapse: collapse;
                width: 100%;
                
            }

            th {
                padding: 8px;
                color: black;
                background-color: #fcf6a7;
                text-align: center;
            }
            td {
                
                padding: 25px 8px 8px 25px;
                
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:nth-child(odd) {
                background-color: #f5e2e2;
            }
            h1{
  color: white;
  margin-left:5%;
}
.column{
            float: left;
            width: 20%;
            /* margin-left: 5%; */
        }
        .row:after{
            content: "";
            display: table;
            clear: both;
            text-align:left;
          
        }
        button {
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 200px;
  opacity: 0.9;
  background-color: brown;
  /* margin-left:540px; */
  margin-top: 30px;
}

button:hover {
  opacity:1;
  background-color: yellow;
  
}
#dashboard{
    background-color: beige;

}
.cart-all{
    background-color: #bd9a7a;
border-radius:3px;
height: auto;
padding: 2rem;
margin-left: 8%;
margin-right: 10%;
margin-top: 5%;
width: 80%;
box-shadow: 8px 8px 8px 8px;
}
a:hover{
 margin-top:  -10px;
box-shadow:5px 8px 8px 5px;
            }
            a{
  text-decoration:none;
}
.header {
  overflow: hidden;
  background-color: #352315;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 15px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;

}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;

  }
}

            </style>
</head>
<body id = "dashboard">
<div class="header">
  <a href="#default" class="logo"><img src="./img/logo2.png" style="width:50px">  </a>
  <div class="header-right">
    <a class="active" href="shop.php">Shop</a>
     <a href="account.php">Account</a>
    <a href="cart.php">Cart</a>
    <a href="purchases.php">Orders</a>
    <a href="about.php">About</a>
    <a href="logout.php">Log-out</a>
  </div>
</div>
    <div class = "cart-all">
        <h1 style="text-align:left;color:white"> Purchased Products </h1> 
        <a style="float:right;color:white;margin-right:30px" href = "order_history.php"> View Purchase History </a> </br></br>
<table>
     
     <tr>
     <?php if($total > 0){ ?>  
     <th style="text-align:left"> Product Details </th>
         <th> Price </th>
         <th> Quantity </th>
         <th> Status </th>
         
        
         
</tr>

<tr>
<?php do{ ?>
    <td> 
    <div class=column>

          <img src="./img/<?php echo $row['picture']; ?>" style="width:120%; float:left">  </div>

    <div class="row">    
 <label style="margin-left:7%;font-size:13px">Order Id: <?php echo $row['order_id'] ?>  </label></br>
 <label style="margin-left:7%;font-size:13px">Product Id: <?php echo $row['product_id'] ?> </label></br>
 <label style="margin-left:7%"><?php echo $row['product_name'] ?> </label></br>
<label style="margin-left:7%"><b> Amount to Pay: <?php echo $row['total'] ?> </b></label></br>
 <label style="margin-left:7%; color:red"> <?php echo $row['payment'] ?> </label></br>
 <label style="margin-left:7%; font-size:13px">Date Ordered: <?php echo $row['date'] ?>  </br></br></br> </td> 

<td style="text-align:center"><?php echo $row['product_price'] ?></td>
<td style="text-align:center">  <?php echo $row['quantity'] ?> </td>
<td style="text-align:center"> <?php echo $row['Status']  ?></td>

</tr>

<?php } while ($row = $tao->fetch_assoc()) ?>
</table>
<form action = "shop.php">
<button type="submit" name="shop"> <b> Continue Shopping </b> </button> </form>

</div>
<?php }else {
    
    ?> </br></br>
    <a style="margin-left:450px; color:white;font-size:25px;color:blue"href = "shop.php"> Go to Shop </a> </br><?php
} ?>
</body>
</html>       