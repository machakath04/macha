<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();
 

$id1 = $_SESSION['email'];

$sql = "SELECT user.email, user.Fname, user.Lname, details.Phone, details.Province, details.Region,
        details.City, details.House, details.Brgy, details.Postal FROM user INNER JOIN details 
        ON user.email = details.email WHERE user.email = '$id1'" ;
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();
 
$id = $_GET ['ID'];
$sql = "SELECT cart.id, cart.product_id, cart.product_name, cart.product_size, cart.product_price, 
        cart.quantity, cart.total, products.picture FROM cart INNER JOIN products ON cart.product_id = products.product_id WHERE cart.id = '$id'";
$prod = $con->query($sql) or die ($con->error);
$row1 = $prod->fetch_assoc();



if(isset($_POST['buy']))
{

  $name = $_POST['name'];
  $price = $_POST['price'];
    $quantity=  $_POST['quantity'];
    $payment = $_POST['payment'];
$prod_id = $_POST['product_id'];
    $tot = $_POST['quantity'] * $_POST['price'] ;

     $reference = $_POST['reference'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./img/payments/". $filename;

  $sql= "INSERT INTO `orders`( `email`, `product_id`,`product_name`,`product_price`, `quantity`, `total`, `payment`, `Status`, `reference`, `image`) VALUES ('$id1', '$prod_id','$name','$price',' $quantity', ' $tot', ' $payment', 'Processing', '$reference', '$filename')";
   $con->query($sql) or die ($con->error);


   $query = "DELETE FROM cart WHERE id = '$id'";
   $con->query($query) or die ($con->error);
  
   echo header("Location: purchases.php");

   
}
?>
<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> PURCHASE </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

          <style>
            .buy-container input{
    font-size: 15px;
margin-top: 1rem;
margin-bottom: 1rem;
/* width: 100%; */
border-radius: 5px;
font-family: 'Poppins';
height: 50px;
border: 1px solid #E1C16E;
background-color: #E1C16E;
padding: 5px 10px 5px 10px;
border: solid 1px black;
margin-left: 8%;

}
.buy-container{
  background-color: #dfbe90a2 ;
        border-radius:20px;
        height: auto;
        padding: 2rem;
        margin-left: 20%;
        margin-right: 20%;
        margin-top: 5%;
        width: 60%;
        
    }
    .buy-container label{
       margin-left:5PX;
        font-size: 18px;
    }
    .column4{
            float: left;
            width: 25%;
            margin-left: 5%;
            

        }
        .row4:after{
            content: "";
            display: table;
            clear: both;
            /* width:50% */
            margin-right: 7%;
            
        }
        input[type="radio"] {
  margin-top: -1px;
  vertical-align: middle;
}
h1{
  color: white;
  border: 1px solid brown;
  background-color: #814918;
  width: 50%;
margin-left: 25%;
/* border-radius: 20px; */
}
h2{
  color: black;
}
h4{
  color: black;
}
button{
  height:50px;
  width: 20%;
  background-color: brown;
  margin-left:40%;
  color:white;

}
body{
        image-rendering: auto;
        background-image: url('img/logo.jpg');
        /* background-size: cover; */
        background-repeat:no-repeat;
        background-size: 100% 100%;
        /* background-attachment: fixed; */
        }

</style>
        
        
</head>
<body>

  <div class= "buy-container">
</br>
    <form action = " " method = "post" enctype="multipart/form-data" >
      <h1> PURCHASE A PRODUCT </h1> </br></br>
<input type= "hidden" name = "email" id = "email" style = "width:80%" value="<?php echo $row['email'];?>" readonly>
<input type= "hidden" name = "name" id = "name" style = "width:80%" value="<?php echo $row['Fname']. "  ".$row['Lname']?>" readonly>
<input type= "hidden" name = "phone" id = "phone" style = "width:80%" value="<?php echo $row['Phone'];?>" readonly>
<input type= "hidden" name = "address" id = "address" style = "width:80%" value="<?php echo $row['Region']. " , ".$row['Province']. " , ".$row['City']. " , ".$row['Brgy']. " , ".$row['Postal']?>" readonly>
<input type ="hidden" name = "id" id = "id" style = "width:80%" value="<?php echo $id?>" readonly>

 <div class = "column4">
<img src="./img/<?php echo $row1['picture']; ?>"> </div>
<div class = "row4"></br>
<h2> <?php echo $row1['product_name'];?> </h2></br>
<input type="hidden" name="product_id" value="<?php echo $row1['product_id']?>">
<input type ="hidden" name = "name" id = "name" style = "width:80%" value="<?php echo $row1['product_name'];?>" readonly>
<h2> Price: <?php echo $row1['product_price'];?></h2></br>
<input type ="hidden" name = "price" id = "price" style = "width:80%" value="<?php echo $row1['product_price'];?>" readonly>
</div>
<div class = "column4">

<label>Quantity: <?php echo $row1['quantity'];?></label></br> 
<input type= "hidden" name = "quantity" id = "quantity" value="<?php echo $row1['quantity'];?>" readonly>
<label>Total Amount: <?php echo $row1['total'];?></label></br>
<input type= "hidden" name = "total" id = "total" value="<?php echo $row1['total'];?>" readonly> 

</div>
  <div class = "row4">
<label style="margin-left: 20%"> Select Mode of Payment: </label> </br>
<label for="cod">
<input type="radio" style="margin-left: 20%" id="cod" name="payment" style = "width:2%" onclick = "show()" value="COD" > CASH ON DELIVERY  
</label>
<label for="gcash" >
<input type="radio" id="online" name="payment" style = "width:2%"  onclick = "show()"  value="GCASH"> GCASH <br/> </label>

<div id="reference" style="display: none">
<hr>
<div class="column4">    
    <h4>Gcash Information</h4>
    <h4>Name: Kharell Salvador </h4>
    <h4 >Gcash Number: 0939411662</h4> </div>
       
    <div class="row4">
<label style="margin-left:25%;height:50px">Reference Number: </br><input style="margin-left:25%" type="test" name="reference"></br>
<label style="margin-left:25%;height:50px"> Upload Screenshot of your Payment </label>
    <input type="file"  name="uploadfile"  style="margin-left:25%; width:30%;height:50px"  value="" /> </div>


  </div>

</div> </br> </br>
<button type = "submit" name = "buy"> PURCHASED </button>
 
</form>
        
</div>
<script type="text/javascript">
    function show() {
        var gcash = document.getElementById("online");
        var reference = document.getElementById("reference");
        reference.style.display = online.checked ? "block" : "none";
    }
    function view() {
      event.preventDefault()                                                                           
    document.getElementById("amount").style.display = "block";
    
  }

</script>

</body>
</html>