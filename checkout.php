<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

$id1 = $_SESSION['email'];

$sql = "SELECT * FROM cart WHERE email = '$id1'";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();
$total = $tao->num_rows;

$qry = "SELECT SUM(total) AS 'sum' FROM cart WHERE email = '$id1' ";
$res = $con->query($qry) or die ($con->error);
$rec = $res->fetch_assoc();


// if(max() > 0)  {
//   $qry = "SELECT MAX(id) AS 'id_order' FROM orders";
//   $res = $con->query($qry) or die ($con->error);
//   $order_id = $res->fetch_assoc();
  
// }else {
//   $qry = "SELECT MAX(id+1)  AS 'id_order' FROM orders";
//   $res = $con->query($qry) or die ($con->error);
//   $order_id = $res->fetch_assoc();
// }

$qry = "SELECT COALESCE(MAX(id), 0) + 1 AS 'id_order' FROM orders";
$res = $con->query($qry) or die ($con->error);
$order_id = $res->fetch_assoc();


 
  
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
.receipt{
width: 50%;
border: 1px solid black;
height:auto;
margin-left: 25%;
margin-top:10%;
padding: 10px;
background-color: #dfbe90a2 ;
border-radius:20px;
}
#edit{
        image-rendering: auto;
        background-image: url('img/logo.jpg');
        /* background-size: cover; */
        background-repeat:no-repeat;
        background-size: 100% 100%;
        /* background-attachment: fixed; */
        }

h5{
  text-align:center;
}
</style>


<body id = "edit">
<div class="receipt">
<h1> CHECK-OUT ITEMS </h1> <hr>

<form action = " " method="post" enctype="multipart/form-data" >
  <?php do{
    
    if(isset($_POST['checkout']))
  {  
   
    $prod_id = $row['product_id'];
      $name = $row['product_name'];
      $price = $row['product_price'];
       $tot = $row['total'];
       $amount = $rec['sum'];
        $quantity = $row['quantity'];
        $payment = $_POST['payment'];
    $ref = $_POST['reference'];
    $order = $_POST['order_id'];
  
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./img/payments/". $filename;

    $sql= "INSERT INTO `orders`( `order_id`,`email`, `product_id`,`product_name`,`product_price`, `quantity`, `total`,`amount`,`payment`,  `Status` ,`reference`, `image`) VALUES ('$order','$id1', '$prod_id','$name','$price',' $quantity', ' $tot', '$amount', ' $payment',  'Processing', '$ref', '$filename')";
    $con->query($sql) or die ($con->error);

    $query = "DELETE FROM cart WHERE email = '$id1'";
    $con->query($query) or die ($con->error);
  
      echo header("Location: purchases.php"); 
    }
  

    ?>

 
<label style="font-size:15px">  Product Id: <?php echo $row['product_id']?>  </label></br>
<input type="hidden"  name="id"  value="  <?php echo $row['product_id']?>">

<label style="font-size:15px"> Product Name: <?php echo $row['product_name']?> </label> <br>
<input type="hidden"  name="product_name"  value="<?php echo $row['product_name']?>"> 

<label style="font-size:15px"> Quantity: <?php echo $row['quantity'] ?> </label> </br>
<input type="hidden"  name="quantity"  value="<?php echo $row['quantity']?>"> 

<label style="font-size:15px"> Price: <?php echo $row['product_price']?>  </label> </br> 
<input type="hidden"  name="price"  value=" <?php echo $row['product_price']?>"> 

<label style="font-size:15px"> Amount: <?php echo $row['total']?>  </label></br> 
<input type="hidden"  name="total"  value="  <?php echo $row['total']?>"> 

<input type="hidden"  name="order_id"  value="  <?php echo $order_id['id_order']?>"> 
  <hr>

  
 
  <?php } while ($row = $tao->fetch_assoc()) ?>

<h3>Total Amount: <?php echo $rec['sum'] ?> </h3>

<label> Select Mode of Payment: </label> </br>
<label for="cod">
<input type="radio"  id="cod" name="payment" style = "width:8%" onclick = "show()" value="COD" > CASH ON DELIVERY  
</label>
<label for="gcash">
<input type="radio" id="online" name="payment" style = "width:13%;margin-left:25px"  onclick = "show()"  value="GCASH"> GCASH </label> </br>

<div id="reference" style="display: none">
    <h5 style="color:black">Gcash Information </br>
    Name: Meddy Hernandez </br>
    Gcash Number: 09706658857</h5>
       
<label style="height:8%">Reference Number: </br><input  type="test" name="reference"></br>
<h5> Upload Proof of Payment: </h5> 
<input type="file"  name="uploadfile"  style="width:80%;height:30px;border:1px solid black"  value="" />



 
  </div>
  </br></br> </br> </br></br>
<button style="margin-left:40%" type="submit"  name= "checkout"> Continue </button> 
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