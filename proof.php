<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['access']) && $_SESSION['access'] == "admin"){
    echo "Welcome Admin";
 }

include_once("connections/connection.php");

connection();

$con = connection();

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
  color: white;
  border: 1px solid brown;
  background-color: #814918;
  width: 50%;
margin-left: 25%;
border-radius: 20px;
}
            </style>
</head>
<body id = "cart"> </br></br>
<!-- <a href = "orders.php"> ORDERS </a> -->
    <div class = "cart-container">
        <h1> MONTHLY SALES INVENTORY </h1> </br></br>
       
<table>
     
<tr>
        
        <th> Year </th>
            <th> Months</th>
             <th> Sales</th>
            <th> Product Name </th>
            <th> Total Orders  </th>
            <th> Sales Revenue</th>
            
           
            
   </tr>
   
   <tr>
   <?php do{ ?>
   <td>      </td>
   <td>      </td>
   <td>      </td>
   <td>      </td>
   <td>      </td>
   <td>      </td>
   </tr>
<?php } while ($row1 = $orders->fetch_assoc()) ?>
</table></br></br>
TOTAL SALES: <?php echo $rec['sum'] ?> 
</div>
</body>
</html>       