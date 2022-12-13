<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

// $id1 = $_SESSION['email'];

$sql = "SELECT * FROM user";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();


?>

<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Customers </title>
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
  color: white;
  border: 1px solid brown;
  background-color: #814918;
  width: 50%;
margin-left: 25%;
border-radius: 20px;
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
        <h1> Customers</h1> </br></br>
       
<table>
     
     <tr>
        
     <th> Email Address </th>
         <th> First Name  </th>
         <th> Last Name </th>
         <th> Details </th>
        
         
</tr>

<tr>
<?php do{ ?>
<td> <?php echo $row['email'] ?>  </td>
<td> <?php echo $row['Fname'] ?>  </td>
<td>  <?php echo $row['Lname'] ?> </td>
<td> <a href = "details.php?email=<?php echo $row['email'];?>">View </a>
</tr>

<?php } while ($row = $tao->fetch_assoc()) ?>
</table>
</div>
</body>
</html>       