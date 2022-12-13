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
$sql = "SELECT completed_orders.email, completed_orders.order_id, completed_orders.date_ordered, completed_orders.date_delivered, 
         completed_orders.product_id, completed_orders.product_name, completed_orders.quantity, completed_orders.total, completed_orders.payment, 
         completed_orders.status, products.picture FROM completed_orders INNER JOIN products ON completed_orders.product_id = products.product_id WHERE completed_orders.email = '$id1'";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();
$total = $tao->num_rows;

?>

<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> PURCHASE HISTORY </title>
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
                background-color: #fcf6a7;
                color: black;
                text-align: center;
            }
            td {
                
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:nth-child(odd) {
                background-color: #f5e2e2;
            }
            h1{
  color: white;
float:left;
}
.column{
            float: left;
            width: 20%;
            margin-left: 5%;
        }
        .row:after{
            content: "";
            display: table;
            clear: both;
            text-align:left;
          
        }
        #dashboard{
            background-color: beige;
}
.cart-all{
    background-color: #bd9a7a;
border-radius:3px;
height: auto;
padding: 2rem;
margin-left: 3%;
margin-right: 5%;
margin-top: 5%;
width: 90%;
box-shadow: 8px 8px 8px 8px;
}
a:hover{
 margin-top:  -10px;
box-shadow:5px 8px 8px 5px;
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
        <h1 style="color:White"> PURCHASE HISTORY </h1> </br></br></br></br>
<table>
     
     <tr>
     <?php if($total > 0){ ?>  
        <th style="text-align:left"> Product Details</th>
         <th> Quantity </th>
         <th> Amount </th>
         
        
         
</tr>

<tr>
<?php do{ ?>
   
    <td> 
    <div class="column">
        <img src="./img/<?php echo $row['picture']; ?>" style="width:150px; float:left"></div>
    
    <div class="row">
<label style="margin-left:7%"> Order Id:<?php echo $row['order_id'] ?>  </label> </br>
<label style="margin-left:7%"> Product:Id: <?php echo $row['product_id'] ?> </label>  </br>
<label style="margin-left:7%">  <?php echo $row['product_name'] ?> </label> </br>
<label style="margin-left:7%;font-size:15px"> Date Ordered:<?php echo $row['date_ordered'] ?> </label>  </br>
<label style="margin-left:7%; font-size:15px"> Date Delivered: <?php echo $row['date_delivered'] ?>  </label></br>
 <label style="margin-left:7%; color:red"> <?php echo $row['payment'] ?> </label> </br>
 <label style="margin-left:7%;color:red"> <?php echo $row['status']  ?> </label></br>
</td>
</div>

<td style="text-align:center">  <?php echo $row['quantity'] ?> </td>
<td style="text-align:center"> <?php echo $row['total'] ?></td>

</tr>

<?php } while ($row = $tao->fetch_assoc()) ?>
</table>
</div>
<?php }else {
    
    ?> </br><h2 style="color:red"> EMPTY! </h2></br>
    <a style="margin-left:550px; color:white;font-size:25px;color:blue"href = "shop.php"> Go to Shop </a> </br><?php
} ?>
</body>
</html>       