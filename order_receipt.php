<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

$id = $_GET ['ID'];
$sql=" SELECT user.Lname, user.Fname, user.email, details.Province, details.Region, details.City, details.Brgy,
        details.House, details.Postal, orders.order_id, orders.product_name, orders.product_id, orders.date,
        orders.product_price, orders.quantity, orders.reference, orders.image, orders.total, orders.payment FROM user INNER JOIN details ON user.email = details.email
        INNER JOIN orders ON details.email = orders.email WHERE orders.order_id = '$id'";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();

$qry="SELECT SUM(total) as 'sum' FROM orders WHERE order_id = '$id'";
$tao = $con->query($qry) or die ($con->error);
$row1 = $tao->fetch_assoc();
?>
<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> RECEIPT </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
    .receipt{
        width: 50%;
        border: 1px solid black;
        height: auto;
        padding: 2rem;
        margin-left: 25%;
        margin-right: 30%;
        margin-top: 5%;
        font-size:13px;

    }
    h4{
        color: black;
    }
    .print{
        display:none;
        width:50%;
    }
    </style>

        </head>
<body>

<div class ="receipt" id ="receipt">
    
<h4> Customer Details </h4>
<hr>
<label> Name: <?php echo $row['Fname']." " . $row['Lname'] ?> </label> </br>
<label>Address: <?php echo $row['Region']."  ". $row['Province']. ", " . $row['City']. ", " . $row['Brgy']. " ," . $row['House']. ", " . $row['Postal'] ?>  </br> </br>
<hr>
<h4> Order details </h4>
<hr>
<label> Order Id: <?php echo $row['order_id'] ?> </br>
<label> Mode of Payment: <?php echo $row['payment'] ?> </br>
<label>Reference Number: <?php echo $row['reference']?></label> </br>
<h4> Total Amount: <?php echo $row1['sum']; ?> </h4> 
<hr>
<h4> Items </h4> <hr>

<?php do{  ?>
<label> Product Id: <?php echo $row['product_id'] ?> </br>
<label> Product Name: <?php echo $row['product_name'] ?> </br>
<label> Quantity: <?php echo $row['quantity'] ?> </br>
<label> Amount: <?php echo $row['total'] ?> </br>

<hr>
<?php } while($row = $tao->fetch_assoc()) ?>
<input type="button" value="Print" style="float:left;margin-right:10%;width:10%;height:5%" onclick="printDiv()">
</div>


<div class="print" id="print">

<?php $id = $_GET ['ID'];
$sql=" SELECT user.Lname, user.Fname, user.email, details.Province, details.Region, details.City, details.Brgy,
        details.House, details.Postal, orders.order_id, orders.product_name, orders.product_id, orders.date,
        orders.product_price, orders.quantity, orders.reference, orders.image, orders.total, orders.payment FROM user INNER JOIN details ON user.email = details.email
        INNER JOIN orders ON details.email = orders.email WHERE orders.order_id = '$id'";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();

$qry="SELECT SUM(total) as 'sum' FROM orders WHERE order_id = '$id'";
$tao = $con->query($qry) or die ($con->error);
$row1 = $tao->fetch_assoc(); ?>

<img style="width:50px;height:50px;"src ="img/logo2.png"> 
<h2 style="color:black"> MACHAKATH HOMEMADE PEANUT BUTTER SHOP  </h2> 
<h5 style="color:black"> Printed by: MACHAKATH HOMEMADE PEANUT BUTTER SHOP  </h5> 
<h3 style="color:black"> SALES TRANSACTION </h3> </br> <hr>
<label> Name: <?php echo $row['Fname']." " . $row['Lname'] ?> </label> </br>
<label>Address: <?php echo $row['Region']."  ". $row['Province']. ", " . $row['City']. ", " . $row['Brgy']. " ," . $row['House']. ", " . $row['Postal'] ?>  </br> </br>
<hr>
<label> Order Id: <?php echo $row['order_id'] ?> </br>
<label> Mode of Payment: <?php echo $row['payment'] ?> </br>
<label>Reference Number: <?php echo $row['reference']?></label> </br>
<h4> Total Amount: <?php echo $row1['sum'] ?> </h4> 
<hr>
<?php do{  ?>
<label> Product Id: <?php echo $row['product_id'] ?> </br>
<label> Product Name: <?php echo $row['product_name'] ?> </br>
<label> Quantity: <?php echo $row['quantity'] ?> </br>
<label> Amount: <?php echo $row['total'] ?> </br>

<hr>
<?php } while ($row = $tao->fetch_assoc()) ?>



</div>
<script>
        function printDiv() {
            var divContents = document.getElementById("print").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.write('<link rel="stylesheet" href="css/style.css">');
            a.document.close();
            a.print();
        }
    </script> 
</body>
</html>