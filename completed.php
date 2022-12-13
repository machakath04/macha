<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['access']) && $_SESSION['access'] == "admin"){


include_once("connections/connection.php");

connection();

$con = connection();

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM completed_orders";
$result = $con->query($total_pages_sql) or die ($con->error);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);


$sql = "SELECT * FROM completed_orders LIMIT $offset, $no_of_records_per_page";
$orders = $con->query($sql) or die ($con->error);
$row1 = $orders->fetch_assoc();

$qry = "SELECT SUM(total) AS 'sum' FROM completed_orders ";
$res = $con->query($qry) or die ($con->error);
$rec = $res->fetch_assoc();

if(isset($_POST['submit'])){

    $email = $_POST ['email'];
    $prod_id=  $_POST['product_id'];
    $name=  $_POST['product_name'];
    $quan=  $_POST['quantity'];
    $total=  $_POST['total'];
    
$sql = "INSERT INTO `completed_orders`( `email`, `product_id`, `product_name`, `quantity`, `total`,  `payment`, `status`) 
VALUES ('Walk-in Client','$prod_id', '$name ', ' $quan', '$total', ' Walk-in', 'Completed' )";
  

     $con->query($sql) or die ($con->error);
  
   echo header("Location: completed.php");
      }

?>

<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> ORDERS </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" media="all">
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <style>
             table {
                border: 1px solid black;
                border-collapse: collapse;
                width: 100%;
                
            }

            th {
                padding: 8px;
                background-color: #E1C16E;
                color: black;
                text-align: center;
            }
            td {
                text-align: center;
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
  border: 1px solid brown;
  background-color: #814918;
  width: 50%;
margin-left: 25%;
border-radius: 20px;
}

.form-container input{
        width: 300px;
        padding: 15px;
        border: 1px solid black;
        background: white;
        border-radius: 10px;
        color: black;
       
      }
      .form-container input:focus {
        background-color: yellow;
        outline: none;
      }
    .form-container label{
        float: center;
       
       
      }
      .close{
  position:absolute;
  right:32px; top:12px;width:22px;height:22px;opacity:0.3;
}.close:hover{
  opacity: 1;
}
.close:before, .close:after{
position:absolute; left:15px;content: " ";height:32px;width:2px;background-color:#333;
}
.close:before{
  transform:rotate(45deg);
}
.close:after{
  transform:rotate(-45deg);
}
      button[type="add"] {
 float: center;
 width: 100px;
 padding: 10px;
 margin-left: 40%;
 height:50px;

 
}
/* button[type="submit"] {
 float: left;
 width: 100px;
 padding: 10px;
 background-color: red;
 margin-left: 5%;
} */
button{
 float: left;
 width: 150px;
 padding: 10px;
 background-color: brown;
 margin-left: 30px;
 color:white;
 height:50px;
 border-radius:10px;
}
.popup {
        display: none;
        position:fixed;
        top:50%;
        left:50%;
        transform:translate(-50%, -50%);
        bottom: 0;
        margin-right:50px;
        border: 2px solid brown;
        z-index: 1;
        padding: 8px;
        text-align:center;
        box-shadow:5px 8px 7px 5px;
        background-color:white;
        width: 500px;
        height:530px;
      }
      .cart-all{
    background-color:#dfbe90a2 ; 
    /* background-color:#dfbe90a2 ; */
border-radius:3px;
height: auto;
padding: 2rem;
margin-left: 3%;
margin-right: 5%;
margin-top: 5%;
width: 90%;
box-shadow: 5px 8px 8px 5px;
}
            </style>
</head>
<body id = "cart"> </br></br>
<!-- <a href = "orders.php"> ORDERS </a> -->
    <div class = "cart-all">
        <h1>COMPLETED ORDERS </h1> 
        
        <ul style="float:right" class="pagination">
        <li> <a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>



    </ul>
    </br></br>
<table>
     
<tr>
        
        <th> Order ID </th>
            <th> Email Adress</th>
             <th> Product ID</th>
            <th> Product Name </th>
            <th> Quantity  </th>
            <th> Total Amount</th>
            <th> Status</th>
            <th> Date Delivered </th>
           
            
   </tr>
   
   <tr>
   <?php do{ ?>
   <td> <?php echo $row1['order_id'] ?>  </td>
   <td>  <?php echo $row1['email'] ?> </td>
   <td><?php echo $row1['product_id'] ?> </td>
   <td>  <?php echo $row1['product_name'] ?> </td>
   <td>  <?php echo $row1['quantity'] ?> </td>
   <td>  <?php echo $row1['total'] ?> </td>
   <td>  <?php echo $row1['status'] ?> </td>
   <td> <?php echo $row1['date_delivered'] ?>  </td>
   </tr>
<?php } while ($row1 = $orders->fetch_assoc()) ?>
</table></br></br>
TOTAL SALES: <?php echo $rec['sum'] ?> 
</br></br>

<button type ="button" name = "open" onclick="openForm()"> ADD ORDER </button> </br> </br>
<div class = "popup" id = "myForm">
         <form action =" "  class = "form-container" method ="post" >  
         <a href=" " class="close" onclick="close()"> </a> </br>  
        <h2 style="color:black"> Add Orders </h2> </br>
        <label> Product ID: </label></br>
        <input type= "text" name = "product_id" id = "product_id" required></br>
        <label> Product Name: </label></br>
        <input type= "text" name = "product_name" id = "product_name" required ></br>
        <label> Quantity: </label></br>
        <input type= "text" name = "quantity" id = "quantity" required></br>
        <label> Total: </label></br>
        <input type= "text" name = "total" id = "total" required></br> </br></br>
        
        <button type = "add" name = "submit" > ADD </button> 

</form>
           
           </div>
<!-- <INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);" style="background-color:brown;color:white;float:right;width:70px;height:25px;"> -->

</div>
<script>
  function openForm() {
      event.preventDefault()                                                                           
    document.getElementById("myForm").style.display = "block";
  }
  
$(document).ready( function () {
    $('completed_orders').DataTable();
} );
</script>
  
<?php } else{
   echo header("Location:admin.php");
} ?>
</body>
</html>       