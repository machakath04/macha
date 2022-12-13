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

$sql="SELECT YEAR(date_delivered) AS 'year', SUM(total) AS revenue FROM completed_orders 
         GROUP BY YEAR(date_delivered) ORDER BY YEAR(date_delivered)";
         $orders = $con->query($sql) or die ($con->error);
         $row1 = $orders->fetch_assoc();

//  $qry="SELECT year(date_delivered) AS 'year',
//          Month(date_delivered) AS 'month',
//          total  `,
//          max(year(date_delivered)) +1 forecast_year,
//          REGR_SLOPE(total, year(date_delivered))
//            * (max(year(date_delivered)) + 1)
//            + regr_intercept(total, year(date_delievered)) forecasted_revenue
//   from   completed_orders
//   group by
//          month(date_delivered),
//          sum(total)";


         $fore= $con->query($qry) or die ($con->error);
         $row = $fore->fetch_assoc();

?>
<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> Sales Generation Report</title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <script src="//code.jquery.com/jquery-1.9.1.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</head>
<body>
<table>
     
     <tr>
             
             <th> Year </th>
                 <th> Sales </th>

                 
        </tr>
        
        <tr>
        <?php do{ ?>
        <td> <?php echo $row['year']?> </td>
        <td> <?php echo $row['revenue']?>   </td>
          
        </tr>
     <?php } while ($row1 = $orders->fetch_assoc()) ?>
     
     
     </table>

     <table>
        <tr>
            <th> Year</th>
            <th> Month </th>
            <th> Sales </th>
            <th> Forecasted Year </th>
            <th> Forecasted Sales </th>
        </tr>
        
        <tr>
            <th> <?php echo $row2['year']?></th>
            <th> <?php echo $row2['month']?></th>
            <th> <?php echo $row2['sum']?></th>
            <th> <?php echo $row2['forecast_year']?></th>
            <th> <?php echo $row2['forecasted_revenue']?></th>
        </body>
        </html>