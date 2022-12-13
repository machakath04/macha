<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();
$id1 = $_SESSION['email'];

$sql = "SELECT * FROM user WHERE email = '$id1'" ;
$ferson = $con->query($sql) or die ($con->error);
$row1 = $ferson->fetch_assoc();

$id = $_GET['Id'];

$sql = "SELECT * FROM products WHERE product_id = $id" ;
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();

$qry = "SELECT * FROM cart WHERE email = '$id1' AND product_id = $id" ;
$cart = $con->query($qry) or die ($con->error);
$row2 = $cart->fetch_assoc();
$total = $cart->num_rows;


if(isset($_POST['submit'])){


  $_SESSION['id'] = $row['product_id'];
  $_SESSION['name'] = $row['product_name'];
  $_SESSION['size'] = $row['product_size'];
  $_SESSION['price'] = $row['product_price'];
  
  $prod_id=  $_SESSION['id'];
  $name= $_SESSION['name'];
  $size=   $_SESSION['size'] ;
  $price=  $_SESSION['price'];
  $quanti=  $_POST['quantity'];

    $tot = $_POST['quantity'] * $price;

 // $_SESSION['id2'] = $row2['product_id'];
 
   

 if($total == 0){

  $sql = "INSERT INTO `cart` ( `email`,`product_id`,`product_name`,`product_size`,`product_price`,`quantity`,`total`) VALUES ('$id1', '$prod_id',' $name',' $size','$price',' $quanti',' $tot' )";
   
  $con->query($sql) or die ($con->error);

echo header("Location: cart.php");
 } else{


  $prod = $row2['product_id'];
    
    if( $id == $prod ) {
      $incart[] = $prod;
    }
 if (in_array($prod, $incart, true)) {
    $quantity= $row2['quantity'] + $_POST['quantity'];
    $tot = $quantity * $price;
$qry = "UPDATE cart SET quantity = '$quantity', total = '$tot' WHERE product_id = '$id'";
$con->query($qry) or die ($con->error);
 echo header("Location: cart.php");
}}}

if(isset($_POST['process'])) 
{
  
$sql = "SELECT * FROM products WHERE product_id = $id" ;
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();

  
  $_SESSION['quanti'] = $_POST['quantity'];
  $price=  $row['product_price'];
  $tot1 = $_POST['quantity'] * $price;

  if($tot1 > 100){
    echo header("Location: buy.php?ID=".$id);
   } else {
    echo "Minimum order should cost 100 pesos";
   }
}
?>
    
<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> Product Description </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
       
          <style>
             .form-container {
        width: 550px;
        /* padding: 2px; */
        background-color:#E1C16E;
        height: 50%;
        padding-top: 1rem;
        }
        .form-container input{
        width: 90%;
        padding: 15px;
        /* margin: 5px 0 22px 0; */
        border: 1px solid black;
        background: #814918;
        border-radius: 10px;
        color: black;
      }
      .form-container input:focus {
        background-color: white;
        outline: none;
      }
     .pictures{
      padding:5px;
     }
     /* .form-container button {
      width: 20%;
      padding: 10px;
      
     } */
     .column1, .column2, .column3 {
  float: left;
  height: 470px;
  width: 25%;
  padding: 0 10px;
}

.column1{
  position:center;
  width: 15%;
  text-align:center;
}
.column3 {
  width: 40%;
  text-align:center;
  margin-left: 3%;
}
#small button{
            width: 40%;
            height: 13%;
            font-family: 'Poppins';
            background-color: brown;
            font-size: 15px;
            border-radius: 5px ;
            color: white;
            text-align:center;
             cursor: pointer;
            }
            h2{
              letter-spacing: 3px;
            }
            h1{
              color: white;
              border: 1px solid brown;
              border-radius: 13px;
              background-color:  #814918;
              width: 50%;
              margin-left: 25%;
              
            }
            .form-popup {
        display: none;
        position:absolute;
        bottom: 0;
        margin-right: 30px;
        border: 3px solid brown;
        z-index: 1;
        
     
      }
      .form-container label{
        float: left;
        margin-left: 10px;
        /* text-indent: 5%; */
      }
      button[type="add"] {
 float: left;
 width: 8%;
 padding: 10px;
 margin-left: 5%;
 
}
button[type="close"] {
 float: right;
 width: 8%;
 padding: 10px;
 background-color: red;
 margin-right: 5%;
}
button[type = "close"]:focus{
  background-color: red;
        outline: none;
}
button[type="submit"] {
 float: left;
 width: 8%;
 padding: 10px;
 background-color: red;
 margin-left: 5%;
}
.popup {
        display: none;
        position:absolute;
        bottom: 0;
        margin-right: 30px;
        border: 3px solid brown;
        z-index: 1;
      }
     </style>
        
</head>
<body id = "small">
<div class="hyperlinks">
    <a href = "shop.php"> Shop </a>
    <a href = "purchases.php"> Orders </a>
    <a href = "cart.php"> Cart </a>
    </div> </br></br></br>     

     <div class = "column1">
    <div class="row3">
      <img src="img/pic1.png"  style="width:50%"></div></br>
    <div class="row3">
    <img src="img/pic2.png"  style="width:50%"></div></br> 
    <div class="row3">
    <img src="img/pic3.png"  style="width:50%"></div></br> 
    </div>

<div class = "column2">
    <img src="./img/<?php echo $row['picture']; ?>" style="width:300;height:310"> </br>
<!-- <img src = "img/mini.png" width = "300" height= "310" > -->
<h4> Product ID: <?php echo $row['product_id'] ?> </h4>  </div>

<div class = "column3">   
<form action =" " method = "post">    
<h2> <?php echo $row['product_name'] ?> </h2> </h1>
<h2> <?php echo $row['product_price'] ?> </h2>
<h3 style="color:white"> Description</h3>
<p > <?php echo $row['description'] ?></p> </br>

<button type ="button" name = "open" id="submit" onclick="openForm()"> ADD TO CART </button> </br> </br>
<button type = "buy" name = "buy" onclick="openForm2()" > BUY </button>
<!-- <button id="show"> ADD TO CART </button> -->
<!-- <button type = "add" name = "add" > ADD TO CART</button> -->   
</form>
     <div class = "form-popup" id = "myForm">
         <form action =" "  class = "form-container" method ="post" >    
        <!-- <label> Email: </label></br> -->
        <input type= "hidden" name = "email" id = "email" value="<?php echo $row1['email'];?>" readonly >
        <!-- <label> Product ID: </label></br> -->
        <input type= "hidden" name = "id" id = "id" value="<?php echo $row['product_id'];?>" readonly >
        <!-- <label> Item: </label></br> -->
        <input type= "hidden" name = "name" id = "name" value="<?php echo $row['product_name'];?>" readonly>
        <!-- <label> Size: </label></br> -->
        <input type= "hidden" name = "size" id = "size" value="<?php echo $row['product_size'];?>" readonly>
        <!-- <label> Price: </label></br> -->
        <input type= "hidden" name = "price" id = "price" value="<?php echo $row['product_price'];?>"readonly>
        <label>Quantity:</label></br>
        <input type="number" id="quantity" name="quantity" min="1" max="100" required> </br></br>

             <button type = "add" name = "submit" > ADD </button> 

             <button type="close"  onclick="closeForm()"> CANCEL</button> </br></br>
            

             </form>
           
            </div>
            <div class = "popup" id = "Form">
              <form action =" "  class = "form-container" method ="post" >  
                <label>Quantity:</label></br>
        <input type="number" id="quantity" name="quantity" min="1" max="100" required> </br></br>
         
             <button type = "submit"  name = "process" > Continue </button> 

             <button type="close"  onclick="closeForm2()"> CANCEL</button> </br></br>
</form> </div>
    </div>
<!-- </div> -->

  <script>
  function openForm() {
      event.preventDefault()                                                                           
    document.getElementById("myForm").style.display = "block";
  }
  function openForm2() {
      event.preventDefault()                                                                           
    document.getElementById("Form").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
  function closeForm2() {
    document.getElementById("Form").style.display = "none";
  }

</script>


</body>
</html>