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
$sql = "SELECT * FROM products WHERE product_id = '$id'" ;
$prod = $con->query($sql) or die ($con->error);
$row1 = $prod->fetch_assoc();

$amount = $_SESSION['quanti'] * $row1['product_price'] ;

$qry = "SELECT COALESCE(MAX(id), 0) + 1 AS 'id_order' FROM orders";
$res = $con->query($qry) or die ($con->error);
$order_id = $res->fetch_assoc();


if(isset($_POST['buy']))
{

  $name = $_POST['name'];
  $price = $_POST['price'];
    $quantity=  $_POST['quantity'];
    $payment = $_POST['payment'];
    $reference =$_POST['reference'];
    $tot = $_SESSION['quanti'] * $_POST['price'] ;
    $order = $_POST['order_id'];

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./img/payments/". $filename;


  $sql= "INSERT INTO `orders`(`order_id`, `email`, `product_id`,`product_name`,`product_price`, `quantity`, `total`,`amount`, `payment`, `Status`, `reference`,`image`) VALUES ('$order','$id1', '$id','$name','$price',' $quantity', ' $tot',' $tot', ' $payment', 'Processing', '$reference', '$filename')";
   $con->query($sql) or die ($con->error);

   if (move_uploaded_file($tempname, $folder)) {
		echo "<h3> Image uploaded successfully!</h3>";
	} else {
		echo "<h3> Failed to upload image!</h3>";
	}

  
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
            #buy input{
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
            width: 20%;
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
h2, h3, h4{
  color: black;
}
#buy{
        image-rendering: auto;
        background-image: url('img/logo.jpg');
        /* background-size: cover; */
        background-repeat:no-repeat;
        background-size: 100% 100%;
        /* background-attachment: fixed; */
        }
        .column3{
            float: left;
            width: 40%;
            margin-left: 5%;
            

        }
        .row3:after{
            content: "";
            display: table;
            clear: both;
            /* width:50% */
            margin-right: 7%;
        }
        input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: "textfield";
}
</style>
        
        
</head>
<body id = "buy">

  <div class= "buy-container">
</br>
    <form action = " " method = "post" enctype="multipart/form-data">
      <h1> PURCHASE A PRODUCT </h1> </br></br>
<input type= "hidden" name = "email" id = "email" style = "width:80%" value="<?php echo $row['email'];?>" readonly>
<input type= "hidden" name = "name" id = "name" style = "width:80%" value="<?php echo $row['Fname']. "  ".$row['Lname']?>" readonly>
<input type= "hidden" name = "phone" id = "phone" style = "width:80%" value="<?php echo $row['Phone'];?>" readonly>
<input type= "hidden" name = "address" id = "address" style = "width:80%" value="<?php echo $row['Region']. " , ".$row['Province']. " , ".$row['City']. " , ".$row['Brgy']. " , ".$row['Postal']?>" readonly>
<input type ="hidden" name = "id" id = "id" style = "width:80%" value="<?php echo $id?>" readonly>
<input type="hidden"  name="order_id"  value="  <?php echo $order_id['id_order']?>"> 
 <div class = "column4"> </br>
<img src="./img/<?php echo $row1['picture']; ?>"> </div>
<div class = "row4"> </br>
<h2> <?php echo $row1['product_name'];?> </h2></br>
<input type ="hidden" name = "name" id = "name" style = "width:80%" value="<?php echo $row1['product_name'];?>" readonly>
<h2> Price: <?php echo $row1['product_price'];?></h2></br>
<input type ="hidden" name = "price" id = "price" style = "width:80%" value="<?php echo $row1['product_price'];?>" readonly></br></br>
</div>
<div class = "column4">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<label>Quantity: <?php echo $_SESSION['quanti'] ?> </label></br>
<input type="hidden" name="quantity" value="<?php echo $_SESSION['quanti']?>">

 Total Amount: <?php echo $amount; ?>
</div>
  <div class = "row4">
<label style="margin-left:20%"> Select Mode of Payment: </label> </br>
<label for="cod">
<input type="radio" id="cod" name="payment" style = "margin-left:20%" onclick = "show()" value="COD" > CASH ON DELIVERY  
</label>
<label for="gcash">
<input type="radio" id="online" name="payment" style = "margin-left:10%"  onclick = "show()"  value="GCASH" > GCASH <br/> </label>

<div id="reference" style="display: none">
<hr>
<div class="column3">
    <h4 style="text-align:left">Gcash Information </br>
    Name: Meddy Hernandez</br>
    Gcash Number: 09706658857</h4>
</div>
<div class="row3">
  <label style="margin-left:5%"><b> Upload Proof of Payment </b> </label> <br> </br>
<label style="margin-left:5%">Reference Number: </br><input style="margin-left:5%;height:50px" type="number" name="reference" minlength="9" placeholder="Enter the 9 digit number"   > </br>
 
<input type="file"  name="uploadfile"  style="margin-left:50%; width:30%;height:50px" onchange="loadFile(event)" value="" />
   <p style="margin-left:10%"><img id="output" width="200"  onclick="enlargeImg()" /> <a href = "#" id ="stop"> </p>
</div>

</div></br></br>
<button style="margin-left:40%" type = "submit" name = "buy"> PURCHASED </button>
 
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

var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
}

img = document.getElementById("output");
      // Function to increase image size
     
      function enlargeImg() {
        // Set image size to 1.5 times original
        img.style.transform = "scale(1.3)";
        // Animation effect
        img.style.transition = "transform 0.25s ease";
     
      }
     
</script>

</body>
</html>