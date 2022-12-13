<?php
session_start();
if(isset($_SESSION['access']) && $_SESSION['access'] == "admin"){
  



include_once("connections/connection.php");

connection();

$con = connection();


$sql = "SELECT user.email, user.Fname, user.username, user.Lname, details.Phone, details.Region, details.Province, details.City, details.Brgy, details.Postal, details.House, details.filename FROM user INNER JOIN details ON user.email = details.email
         ORDER BY details.email DESC LIMIT 5 ";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();

$sub = "SELECT COUNT(*) AS 'orders' FROM orders ";
$res2 = $con->query($sub) or die ($con->error);
$rec2 = $res2->fetch_assoc();

$qry = "SELECT SUM(total) AS 'sum' FROM completed_orders ";
$res = $con->query($qry) or die ($con->error);
$rec = $res->fetch_assoc();
?>
<html>
    <head>
<meta name="viewport" content="width=900, initial-scale=1.0">
        <title> MACHAKATH: HOMEMADE PEANUT BUTTER ONLINE SHOP </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    *{
      /* background-color: #E1C16E ; */
      box-sizing: border-box;
}
#dashboard{
  background-color:#f2edd7ff;
    /* background-color:#d4f4ec57; */

 
}

.column3 {
  float: left;
  width: 33.33%;
  padding: 5px 5px 0px 5px;
  height: 50%;
}

/* Clearfix (clear floats) */
.row3::after {
  content: "";
  clear: both;
  display: table;
  padding:5px;
 
}
.aa{
  /* background-color: #814918; */
  background-color:#dfbe90a2 ; 
  text-align:center;
  padding: 5px;
  height: 200px;
  box-shadow: 5px 10px 8px #888888;
  border-radius: 10px;
  border:1px solid black;
}
h1{
  color: black;

}
  #profile-container {
    width: 50px;
    height: 50px;
    overflow: hidden;
    border: 1px solid black;
    border-radius:50%;
    margin-left:40%;
}

#profile-container img {
    width: 50px;
    height: 50px;
    
}
table {
                border: 1px solid black;
                border-collapse: collapse;
                width: 100%;
                background-color: white;
            }

            th {
                padding: 8px;
                /* background-color: #E1C16E; */
                background-color: #fcf7a6;
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
            .aa:hover{
             margin-top:  -10px;
            
            }
            .aa1{
  /* background-color: #814918; */
  background-color:#dfbe90a2 ; 
  text-align:center;
  padding: 5px;
  height: 550px;
  box-shadow: 5px 10px 8px #888888;
  border-radius: 10px;
  border:1px solid black;
  margin-left:20%;

}    
a{
    text-decoration:none;
  }
    </style>
          </head>
<body id="dashboard">
</br>
    <h1 style="float:left;margin-left:10px"> Dashboard </h1> </br> </br> </br> </br> </br>
     <!-- <a href = "logout.php"> Log-Out </a> -->
<div class="row3">
  <div class="column3">
    <div class = "aa" onclick = "location.href = 'sales_report.php';" style = "cursor: pointer;"></br>
    <h1> SALES REPORT </h1> </br>
    <!-- <i class="fa fa-area-chart" style="color:green;font-size:100px"></i> -->
  </br></br>
    
    </div> </div>
  
<div class="row3">
  <div class="column3">
    <div class = "aa" onclick = "location.href = 'product_reports.php';" style = "cursor: pointer;"></br>
    <h1> PRODUCT SALES COUNT</h1>
   </br></br></div> </div>

<div class="row3">
  <div class="column3">
    <div class = "aa" onclick = "location.href = 'orders.php';" style = "cursor: pointer;"></br>
    <h1> ORDERS </h1>
 <h3 style="color:red"> Number of Orders: <?php echo $rec2['orders'] ?> </h3> </br></div> </div>
    
 </div>
</div> 

<div class="row3">
  <div style="height:800px;width:80%" class="column3">
    <div class = "aa1" onclick = "location.href = 'customers.php';" style = "cursor: pointer;"></br>
    <h2 style="color:black"> CUSTOMERS</h2>
    <table>
      <tr>
        <th> </th>
        <th> First Name </th>
        <th> Last Name</th>
        
</tr>
<?php do{ ?>
  <td>    <div id="profile-container">
         <!-- <image src="./img/profile/" />  -->
         <img src="./img/profile/<?php echo $row['filename']; ?>"> </div></td>

  <td> <?php echo $row['Fname']?></td>
  <td> <?php echo $row['Lname'] ?></td>
</tr>
<?php } while ($row = $tao->fetch_assoc()) ?>
</table>
<h3> <a href="customers.php"> View All </a> </h3>
  </div> </div>
    
 </div> </br> </br>
</div> 

<?php } else{
   echo header("Location:admin.php");
} ?>

</body>
</html>
