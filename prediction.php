<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['access']) && $_SESSION['access'] == "admin"){
   
 

include_once("connections/connection.php");

connection();

$con = connection();


?>
<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> Predictiong Sales </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <script src="//code.jquery.com/jquery-1.9.1.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
  <style>
 .graph{
  width:70%;
  height:auto;
  text-align:center;
  margin-top:5%;
  margin-left: 15%;
  padding: 2px;
}
#sales{
  background-color:#f2edd7ff;
}
    </style>

</head>
<body id = "sales"> </br></br>

<h1 style="color:black"> Sales Prediction </h1> 
    <div class="sales-container">

<label class="lead">Choose type of Prediction: </label>

 <form method="post">
 <input type = "text" list = "select" name="select" >
<datalist id ="select">
  <option class="active">Choose...</option>
<option value="Monthly">Monthly Prediction</option>
<option value="Annual">Annual Prediction </option>

          </datalist>

<input type="submit" value="submit">
  </form><br>


<?php
   if(isset($_POST['select'])){
    $selected = $_POST['select'];

  if($selected == 'Monthly') {
    

    $qry = "SELECT MONTH(CURRENT_TIMESTAMP)-1 AS 'month', sum(total) AS 'sales' from completed_orders 
    WHERE MONTH(date_delivered) = MONTH(current_timestamp)-1 GROUP BY YEAR(date_delivered)";
         $orders = $con->query($qry) or die ($con->error);
          $row1 = $orders->fetch_assoc();

          $qry = "SELECT MONTHNAME(CURRENT_TIMESTAMP) AS 'month', sum(total) AS 'sales' from completed_orders 
          WHERE MONTHNAME(current_timestamp) = MONTHNAME(date_delivered) ";
          //  GROUP BY MONTH(CURRENT_TIMESTAMP)";
 $orders = $con->query($qry) or die ($con->error);
  $row2 = $orders->fetch_assoc();

  $curr_month = $row2['sales'];
  $prev_month = $row1['sales'];

  $a3 = $curr_month - $prev_month;
  $growth = $a3 / $prev_month;
  $forecast1 = $curr_month * (1 + $growth);

$a4 = $forecast1 - $curr_month;
$growth2 = $a4 / $curr_month;
$forecast2 = $forecast1 * (1 + $growth2);

$a5 = $forecast2 - $forecast1;
$growth3 = $a5 / $forecast1;
$forecast3 = $forecast2 * (1 + $growth3);

  $data = array("Forecast 1", "Forecast 2", "Forecast 3");
  $sales = array("$forecast1", "$forecast2", "$forecast3");

?>
 <h3> Current Month Sales: <?php echo $curr_month; ?> </h3>
 <h3> Previous Month Sales: <?php echo $prev_month; ?> </h3>
  <h3> Monthly Sales Growth: <?php echo $growth; ?> </h3>
  <h3> Predicted Sales for Next Month: <?php echo $forecast1; ?> </h3>

  <hr>
<div class="graph">
        <h1 style="color:black">Analytics Reports </h1>
        <canvas  id="chartjs_bar"></canvas> 
    </div>    

    <script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels:<?php echo json_encode($data); ?>,
                        datasets: [{
                            backgroundColor: [
                                "#14aaf5"
                            
                            ],
                            data:<?php echo json_encode($sales); ?>,
                            label: 'Sales Forecast for the Next 3 Months',
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'top',
 
                        labels: {
                           
                            fontColor: 'black',
                            fontFamily: 'Poppins',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>


  <?php  } 

  }
  
?>

 <?php if(isset($_POST['select'])){
  $selected = $_POST['select'];

if($selected == 'Annual') {

  $qry = "SELECT year(CURRENT_TIMESTAMP)-1 AS 'year', sum(total) AS 'sales' from completed_orders 
  WHERE year(date_delivered) = year(CURRENT_TIMESTAMP)-1";
  $orders = $con->query($qry) or die ($con->error);
$row4 = $orders->fetch_assoc();

  $qry = "SELECT year(CURRENT_TIMESTAMP) AS 'year', sum(total) AS 'sales' from completed_orders 
                  WHERE year(date_delivered) = year(CURRENT_TIMESTAMP)";

       $orders = $con->query($qry) or die ($con->error);
        $row3 = $orders->fetch_assoc();

          $curr_year = $row3['sales'];
          $prev_year = $row4['sales'];

          $a3 = $curr_year - $prev_year;
          $growth = $a3 / $prev_year;
          $forecast1 =$curr_year * (1 + $growth);
        
        $a4 = $forecast1 - $curr_year;
        $growth2 = $a4 / $curr_year;
        $forecast2 = $forecast1 * (1 + $growth2);
        
        $a5 = $forecast2 - $forecast1;
        $growth3 = $a5 / $forecast1;
        $forecast3 = $forecast2 * (1 + $growth3);
        
          $data = array("Forecast 1", "Forecast 2", "Forecast 3");
          $sales = array("$forecast1", "$forecast2", "$forecast3");
        
        ?>
        <h3> Current Annual Sales: <?php echo $curr_year; ?> </h3>
        <h3> Previous Annual Sales: <?php echo $prev_year; ?> </h3>
          <h3> Annual Sales Growth: <?php echo $growth; ?> </h3>
          <h3> Predicted Sales for Next Year: <?php echo $forecast1; ?> </h3>
        
          <hr>
        <div class="graph">
                <h1 style="color:black">Analytics Reports </h1>
                <canvas  id="chartjs_bar"></canvas> 
            </div>    
        
            <script type="text/javascript">
              var ctx = document.getElementById("chartjs_bar").getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels:<?php echo json_encode($data); ?>,
                                datasets: [{
                                    backgroundColor: [
                                        "#14aaf5"
                                    
                                    ],
                                    data:<?php echo json_encode($sales); ?>,
                                    label: 'Sales Forecast for the Next 3 Years',
                                }]
                            },
                            options: {
                                   legend: {
                                display: true,
                                position: 'top',
         
                                labels: {
                                   
                                    fontColor: 'black',
                                    fontFamily: 'Poppins',
                                    fontSize: 14,
                                }
                            },
         
         
                        }
                        });
            </script>
        
        
          <?php  } 
        
          }
          
        ?>
          
          
<p id="interp">
THIS IS THE <b><?php echo $selected?></b> SALES FORECAST, THE POSSIBLE SALES GROWTH IS <b><?php echo round(($growth),2) ?></b> 
AND THE NEXT PREDICTED SALES IS <b><?php echo number_format(($forecast1),2) ?></b> </p><br>






<?php } else{
  echo header("Location:admin.php");
}?>
</body>
</html>