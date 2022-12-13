<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['access']) && $_SESSION['access'] == "admin"){


include_once("connections/connection.php");

connection();

$con = connection();

$month1 = $_SESSION['month1']; //inputted prev

$prev = $_SESSION['prev'];
$growth = $_SESSION['growth'];//growth1
$forecast1 = $_SESSION['forecast']; //forecast1


$prev2 = $forecast1 - $prev;//prev1
$forecast2 = $forecast1 *(1 + $growth);//forecast2


$a3 = $forecast2 - $prev;//\
$growth2 = $a3 / $prev; //growth2 
$forecast3 = $forecast2 *(1 + $growth2); //forecast3


$data = array("Forecast 1", "Forecast 2", "Forecast 3");
$sales = array("$forecast1", "$forecast2", "$forecast3");

// $sql ="SELECT Year(date_delivered) AS 'year', MONTHNAME(date_delivered) AS 'month', sum(total) AS 'total', 
// sum(quantity) AS 'count' FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '2022'
// GROUP BY Year(date_delivered), Month(date_delivered) ORDER BY Year(date_delivered), Month(date_delivered) ";
//          $result = mysqli_query($con,$sql);
// $chart_data="";
// while ($row1 = mysqli_fetch_array($result)) { 

// $productname[]  = $row1['month']  ;
// $sales[] = $row1['total'];




 
?>



<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> Sales Prediction Result </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <script src="//code.jquery.com/jquery-1.9.1.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

   <style>
 .result{
    margin-left:300px;
    border: 1px solid black;
    width:600px;
    height:400px;
    text-align:center;
 }   
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
.column{
            float: left;
            width: 50%;
        
        }
        .row:after{
            content: "";
            display: table;
            clear: both;
            /* width:50% */
           
        }
   </style>

</head>
    <body id="sales">
</br> </br>
<h1 style="color:black"> Sales Prediction Analytics </h1> </br>



         <div class= "result">
<h3 style="color:black"> Inputted Data </h3>
<h3 style="color:black"> Previous Sales: <?php echo  $_SESSION['month1']; ?> </h3> 
<h3 style="color:black"> Current  Sales: <?php echo $_SESSION['prev']; ?> </h3> </br>


<h3 style="color:black"> PREDECTION RESULTS </h3>
<h3 style="color:black"> Predicted Sales Growth: <?php echo $growth; ?> </h3> 
<h3 style="color:black"> Predicted Sales Revenue: <?php echo $_SESSION['forecast']; ?> </h3> 

</div> </br>

<hr>

<div class="graph">
            <h1 style="color:black">Sales Prediction Analytics Graph </h1>
           
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
                            //    "#5969ff",
                               
                            //     "#25d5f2",
                            //     "#ffc750",
                            //     "#2ec551",
                            //     "#7040fa",
                            //     "#ff004e"
                            
                            ],
                            data:<?php echo json_encode($sales); ?>,
                            label: 'Sales Forecast for the Next 3 Months/ Years',
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                           
                            fontColor: 'black',
                            fontFamily: 'Poppins',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>

</html>
</body>

<?php } else{
   echo header("Location:admin.php");
} ?>