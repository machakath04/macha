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
  $no_of_records_per_page = 5;
  $offset = ($pageno-1) * $no_of_records_per_page;
  
  $total_pages_sql = "SELECT COUNT(*) FROM orders";
  $result = $con->query($total_pages_sql) or die ($con->error);
  $total_rows = mysqli_fetch_array($result)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_page);
  

  $sql = "SELECT * FROM orders WHERE Status= 'To be Delivered' GROUP BY order_id";
  $orders = $con->query($sql) or die ($con->error);
  $row1 = $orders->fetch_assoc();
// $sql = "SELECT * FROM orders WHERE Status= 'To be Delivered' GROUP BY order_id LIMIT $offset, $no_of_records_per_page";
// $orders = $con->query($sql) or die ($con->error);
// $row1 = $orders->fetch_assoc();

$sql1 = "SELECT * FROM orders WHERE Status= 'Processing' GROUP BY order_id LIMIT $offset, $no_of_records_per_page";
$orders1 = $con->query($sql1) or die ($con->error);
$row2 = $orders1->fetch_assoc();


?>

<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> ORDERS </title>
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
  color: black;
 
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
<body id = "dashboard"> </br></br>
<!-- <a href = "orders.php"> ORDERS </a> -->
    <div class = "cart-all">
        <h1> LIST OF ORDERS </h1> </br></br>
        <h2 style="color:black;position:center">To be Delivered<h2>
<!-- <div>
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
</div> -->
<table>
     
<tr>
        
        <th> Order ID </th>
            <th> Date and Time </th>
            <th> Email Adress</th>
            <th> Status</th>
            <th> Details </th>
           
            
   </tr>
   
   <tr>
   <?php do{ ?>
   <td> <?php echo $row1['order_id'] ?>  </td>
   <td> <?php echo $row1['date'] ?>  </td>
   <td>  <?php echo $row1['email'] ?> </td>
   <td>  <?php echo $row1['Status'] ?> </td>
   <td> <a href = "order_details.php?ID=<?php echo $row1['order_id'];?>">View </a>
   </tr>
<?php } while ($row1 = $orders->fetch_assoc()) ?>
</table>
<br>
<div>
<h2 style="color:black;position:center">Processing<h2>
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
   </div>
<table 2>
     
<tr>
        
        <th> Order ID </th>
            <th> Date and Time </th>
            <th> Email Adress</th>
            <th> Status</th>
            <th> Details </th>
           
            
   </tr>
   
   <tr>
   <?php do{ ?>
   <td> <?php echo $row2['order_id'] ?>  </td>
   <td> <?php echo $row2['date'] ?>  </td>
   <td>  <?php echo $row2['email'] ?> </td>
   <td>  <?php echo $row2['Status'] ?> </td>
   <td> <a href = "order_details.php?ID=<?php echo $row2['order_id'];?>">View </a>
   </tr>
<?php } while ($row2 = $orders1->fetch_assoc()) ?>
</table 2>
</div>
<script>
$(document).ready( function () {
    $('orders').DataTable();
} );
</script>
<?php } else{
   echo header("Location:admin.php");
} ?>

</body>
</html>       