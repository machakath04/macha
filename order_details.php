<?php

    session_start();

if(isset($_SESSION['access']) && $_SESSION['access'] == "admin")
{
 

include_once("connections/connection.php");
connection();
$con = connection();

    $id = $_GET['ID']; 
 
$sql="SELECT orders.order_id, orders.amount, orders.date, orders.email, orders.date, orders.product_id, orders.product_name, 
orders.product_price,orders.quantity, orders.total,orders.reference,orders.image, orders.payment,orders.Status, user.Fname, user.Lname, details.Province, 
details.Region, details.City, details.Brgy, details.Postal, details.House FROM ((orders INNER JOIN details ON orders.email = details.email) INNER JOIN user ON user.email = details.email) WHERE orders.order_id = '$id'";
$orders = $con->query($sql) or die ($con->error);
$row1 = $orders->fetch_assoc();


 if(isset($_POST['receipt']))
 { 
    echo header("Location: order_receipt.php?ID=".$id);
 }
?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> ORDERS </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
         
         <style>
           
            h1{
  color: black;
  
border-radius: 20px;
}
.details-container{
    background-color:#dfbe90a2 ; 
    border-radius:3px;
    height: auto;
    padding: 2rem;
    margin-left: 20%;
    margin-right: 20%;
    margin-top: 5%;
    width: 60%;
    box-shadow:8px 5px 5px 8px;
    }
    button{
            width: 30%;
            height: 50px;
            
            background-color: brown;
            font-size: 15px;
            /* letter-spacing: 20px; */
            border-radius: 10px ;
            color: white;
            margin-top: 5%;
    }
    select{
        font-size:15px;
            width: 30%;
            height: 50px;
            border-radius: 10px;
            border: 1px solid black;
            
            float:left;
            /* color: black; */
            background-color:#E1C16E ;
        
        }
        button[name="deliver"]{
            float: right;
            margin-right: 10%;
        }
        #dashboard{
  /* background-color:#8C7663; */
  background-color:#f2edd7ff;
  
 
}
            </style>
</head>
<body id="dashboard">
<div class="details-container">
<form method = "post" action = " " >
<h1> ORDER DETAILS </h1>


<h4 style="color:black"> Date and Time: <?php echo $row1['date'];?> </h4>
<input type= "hidden" name = "date"  value=" <?php echo $row1['date'];?>">
<h4 style="color:black"> Order ID: <?php echo $id;?></h4>
<input type= "hidden" name = "id"  value="<?php echo $id;?>"readonly>


<hr>
<label> Full Name: <b> <?php echo $row1['Fname']. "  ".$row1['Lname']?> </b></label>
<input type= "hidden" name = "name" id = "name"value="<?php echo $row1['Fname']. "  ".$row1['Lname']?>" readonly></br>
<label>  Address: <b>  <?php echo $row1['Region']. " , ".$row1['Province']. " , ".$row1['Postal']. ", ".$row1['City']. " , ".$row1['Brgy']?> </b>  </label>
<input type= "hidden" name = "address" id = "address" value="<?php echo $row1['Region']. " , ".$row1['Province']. " , ".$row1['Postal']. ", ".$row1['City']. " , ".$row1['Brgy']?> " readonly></br>
<label> Email Address: <?php echo $row1['email'];?></label></br>
<input type= "hidden" name = "email"  value="<?php echo $row1['email'];?>"readonly>
<label style="color:red">Mode of Payment:<b> <?php echo $row1['payment']; ?> </b></br></label>
<input type= "hidden" name = "payment"  value="<?php echo $row1['payment']; ?>"readonly>
<label> Status: <?php echo $row1['Status']?></label> </br>

<?php if($row1['payment'] == 'GCASH') {
 ?>
<label>Reference Number:<b> <?php echo $row1['reference']; ?> </label>
<input type= "hidden" name = "reference"  value="<?php echo $row1['reference']; ?>"readonly></br></b>
<label>Proof Of Payment:<b> <a href="img/payments/<?php echo $row1['image']; ?> ">   <img style="width:80px;vertical-align:center" src="./img/payments/<?php echo $row1['image']; ?>"> </a> </label>
<input type= "hidden" name = "image"  value="<?php echo $row1['image']; ?>"readonly>
<?php }?>
<h3> <b> Amount To Pay: <?php echo $row1['amount']; ?> </b></h3></label>
<input type= "hidden" name = "amount"  value="<?php echo $row1['total']; ?>"readonly>
<hr>
<h4 style="color:black"> Orders </h4> <hr>

<?php do{ 

    if(isset($_POST['update']))
{

    $status=  $_POST['Status'];

    $sql = "UPDATE orders SET Status = '$status'  WHERE order_id = '$id'";
     $con->query($sql) or die ($con->error);
    
     echo header("Location: orders.php");

    if($status == 'Delivered')
 {
    
    
    $email = $row1['email'];
    $id2=  $row1['order_id'];
    $prod_id=  $row1['product_id'];
    $name=  $row1['product_name'];
    $quan=  $row1['quantity'];
    $total=  $row1['total'];
    $payment=  $row1['payment'];
    $date = $row1['date'];
    $ref = $row1['reference'];
    $pic = $row1['image'];
    // $status= "Delivered";


$sql = "INSERT INTO `completed_orders`(`date_ordered`, `order_id`, `email`, `product_id`, `product_name`, `quantity`, `total`,  `payment`,`reference`,  `status`, `image`) VALUES ('$date',$id2,'$email','$prod_id', '$name ', ' $quan', '$total', ' $payment',' $ref', 'Delivered', '$pic' )";
$con->query($sql) or die ($con->error);
     
$query = "DELETE FROM orders WHERE order_id = '$id'";
$con->query($query) or die ($con->error);
echo header("Location: completed.php");
} }  ?>



<input type= "hidden" name = "id"  value="<?php echo $row1['order_id']; ?>"readonly>
<label> Product ID: <?php echo $row1['product_id']; ?></br></label>
<input type= "hidden" name = "prod_id"  value="<?php echo $row1['product_id']; ?>"readonly>
<label> Product Name: <?php echo $row1['product_name']; ?></br> </label>
<input type= "hidden" name = "prod_name" style = "font-size:13px"  value="<?php echo $row1['product_name']; ?>"readonly>


<label> Price: <?php echo $row1['product_price']; ?></label>
<input type= "hidden" name = "price"  value="<?php echo $row1['product_price']; ?>"readonly></br>
<label> Quantity: <?php echo $row1['quantity']; ?> </br></label>
<input type= "hidden" name = "quantity"  value="<?php echo $row1['quantity']; ?>"readonly>
<label> Amount: <?php echo $row1['total']; ?></br></label>
<input type= "hidden" name = "amount"  value="<?php echo $row1['total']; ?>"readonly>
<hr>
<?php } while ($row1 = $orders->fetch_assoc()) ?>

<label style="margin-left:350px"> Status: </label></br>
<select style="margin-left:270px" name="Status" id="Status" > <option value="Processing">Processing</option>
<option value="To be Delivered">To be Delivered</option> <option value="Delivered"> Delivered</option> </select></br></br></br>

<button type="submit"  name= "update">Save </button>
<button type="submit"  name= "receipt" style="margin-left:35%"> Generate Receipt </button>
</div>
</form>

<?php } else{
   echo header("Location:admin.php");
} ?>

</body>
</html>

