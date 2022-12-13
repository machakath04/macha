<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

// $id = $_SESSION['email'];
// $sql = "SELECT * FROM user WHERE email = '$id'";
// $tao = $con->query($sql) or die ($con->error);
// $row = $tao->fetch_assoc();


// $id = $_GET ['ID'];

$sql = "SELECT * FROM products";
$tao = $con->query($sql) or die ($con->error);
$row1 = $tao->fetch_assoc();


?>

<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900">
        <title> Shop </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
          <style>
* {
  box-sizing: border-box;
}
.column{
            margin-left: 00%;
              width: 33.33%;
            text-align: justify;
           padding:8px;
           
            /* width: 50%; */
        }
.aa{
   
  background-color: #bd9a7a;
  padding: 9px;
  width: 70%;
  height: 370px;
  border-radius: 10px;
  border: 0.5px solid black;
 
}
h4{
  color: black;
  /* border: 1px solid brown; */
  /* background-color: #814918; */
 
  
}
h1{
  color: white;
  border: 1px solid black;
  background-color: #814918;
  width: 50%;
margin-left: 25%;
/* border-radius: 20px; */
}

        a:hover{
 margin-top:  -10px;
box-shadow:5px 8px 8px 5px;
            }
.aa:hover{
  
box-shadow:10px 8px 8px 10px;
            
}
#shop{
            /* background-color: #8C7663; */
            background-color: beige;
            box-sizing: border-box;
        }
a{
  text-decoration:none;
    font-size:15px;
   
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
<body id="shop">
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

<!-- <div class= "shop-container"> -->
<!-- <h1>OUR PRODUCTS</h1> </br> </br></br> -->

<form action="search.php" method="post">
Search: <input type="text" name="search" style="width:200px">
<input type ="submit">
</form>

</br></br></br></br>
<?php do{ ?>

  <div class="column">
      <div class = "aa" onclick = "location.href = 'product_description.php?Id=<?php echo $row1['product_id'];?>'" style = "cursor: pointer;"></br>
            
              <img src="./img/<?php echo $row1['picture']; ?>" style="width:150px;margin-left:70px"> </br>
             
          <h2> <?php echo $row1['product_price'] ?></h2>
          <h4><?php echo $row1['product_name'] ?> </h4></div>  </br> 



</br> </div>
<?php } while ($row1 = $tao->fetch_assoc()) ?>

</br> </br>
<!-- </div> -->

<!-- <hr>
<section></br>
<a href = "about.php"> About </a> </br><hr>
<a href = "./agreement/terms.php"> Terms and Agreement </a> </br> </br>
</section> -->
<script>
viewportElement.setAttribute( 'content', 'initial-scale=' + ratio );
</script>
</body>
</html>