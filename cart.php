<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

$id1 = $_SESSION['email'];


$sql = "SELECT cart.id, cart.email, cart.product_id, cart.product_name, cart.product_size, cart.product_price, 
        cart.quantity, cart.total, products.picture FROM cart INNER JOIN products ON cart.product_id = products.product_id WHERE email = '$id1'";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();
$total = $tao->num_rows;


$qry = "SELECT SUM(total) AS 'sum' FROM cart WHERE email = '$id1' ";
$res = $con->query($qry) or die ($con->error);
$rec = $res->fetch_assoc();

if(isset($_POST['shop'])){
    echo header("Location:shop.php");
    }

if(isset($_POST['checkout'])){
echo header("Location:checkout.php");
}
?>

<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> Shopping Cart </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
                margin-bottom:5%;
            }
            td {
                /* text-align: center; */
                padding: 8px;
                margin-top:10%;
                
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:nth-child(odd) {
                background-color: #f5e2e2;
            }
            h1{
  color: white;
  
}
i{
    color: red;
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



hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
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

            #dashboard{
                background-color: beige;

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
<body id="dashboard"> 
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
        <h1 style="float:left;color:white"> Shopping Cart </h1> </br></br>
        <h3 style="float:right;margin-right:30px"> Total Amount : <?php echo $rec['sum']; ?> </h3> 
<table>
<?php if($total > 0){ ?>  
     <tr>
     <th style="text-align:left"> Product Details </th>
         <th> Quantity </th>
         <th> Price </th>
         <th> Total </th>
       
</tr>
<?php if($total > 0){ ?>
<tr>
<?php do{ ?>
    
   
  <td>
    <div class=column>
   
          <img src="./img/<?php echo $row['picture']; ?>" style="width:100px; float:left">  </div>
    <div class="row">
      <label style="margin-left:7%"> <?php echo $row['product_id'] ?> </br>
      <label style="margin-left:7%"><?php echo $row['product_name'] ?>  </h4> </br>
      <label style="margin-left:7%"><?php echo $row['product_size'] ?></br> 
      <a style="color:gray; margin-left:7%" name = "delete" href = "cart_remove.php?ID=<?php echo $row['id']?>"> Remove </a>   
    </div>  

</td>
<td style="text-align:center">

<?php echo $row['quantity']?> </br>
<a href = "cart_quantity.php?ID=<?php echo $row['id'];?>" >Update</a>  
<!-- <button type="submit" name="update"> <b> Update </b> </button> -->
</div>


</td>


      <td style="text-align:center"> <?php echo $row['product_price'] ?></td>
<td style="text-align: center"> <?php echo $row['total'] ?></td>




</tr>

<?php } while ($row = $tao->fetch_assoc()) ?>


</table>
<form action = " " method="post">
</br> 
<button type="submit" name="checkout"> <b> Checkout </b> </button> 
</form>



 <?php }else {
        echo " <div class='message warning'> Cart is Empty </div>"; ?> </br>
        <a style="margin-left:600px; color:white"href = "shop.php"> Go to Shop </a> </br><?php
    } ?>

</form>
</div>


<?php }else {
    
    ?> </br></br>
    <a style="margin-left:450px; color:white;font-size:25px;color:blue"href = "shop.php"> Go to Shop </a> </br><?php
} ?>

</body>
</html>       