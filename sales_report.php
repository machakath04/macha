<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['access']) && $_SESSION['access'] == "admin"){
   
 

include_once("connections/connection.php");

connection();

$con = connection();



$sql ="SELECT Year(date_delivered) AS 'year', MONTHNAME(date_delivered) AS 'month', sum(total) AS 'sum', sum(quantity) AS 'count'
          FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '2022'
GROUP BY Year(date_delivered), Month(date_delivered) ORDER BY Year(date_delivered), Month(date_delivered) ";
$orders = $con->query($sql) or die ($con->error);
$row1 = $orders->fetch_assoc();


if(isset($_POST['select'])){
if(!empty($_POST['select'])) {
$selected = $_POST['select'];


if (!$con) {
# code...
echo "Problem in database connection! Contact administrator!" . mysqli_error();
}else{
    
     
        $sql ="SELECT Year(date_delivered) AS 'year', MONTHNAME(date_delivered) AS 'month', sum(total) AS 'total', 
           sum(quantity) AS 'count' FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '$selected'
         GROUP BY Year(date_delivered), Month(date_delivered) ORDER BY Year(date_delivered), Month(date_delivered) ";
                    $result = mysqli_query($con,$sql);
    $chart_data="";
    while ($row1 = mysqli_fetch_array($result)) { 

       $productname[]  = $row1['month']  ;
       $sales[] = $row1['total'];
   }
    }

} else {
echo 'Please select the value.';

}

}


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

          <style>
             table {
                border: 1px solid black;
                border-collapse: collapse;
                width: 100%;
                
            }

            th {
                padding: 8px;
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
            h1{
  color: white;
  text-align:center;
  margin-left: 5%;
}
#sales{
  background-color:#f2edd7ff;
}
.graph{
  width:70%;
  height:500px;
  text-align:center;
  margin-top:5%;
  margin-left: 15%;
  padding: 2px;
}
.sales-container{
  background-color:#dfbe90a2 ; 
border-radius:3px;
height: auto;
padding: 2rem;
margin-left: 3%;
margin-right: 5%;
width: 90%;
}
.popup {
        display: none;
        position:fixed;
        top:50%;
        left:50%;
        transform:translate(-50%, -50%);
        bottom: 0;
        /* margin-right: 30px; */
        border: 1px solid brown;
        z-index: 1;
        background-color: white;
        padding: 8px;
        width:390px;
        text-align:center;
        box-shadow:5px 8px 7px 5px;
        height:310px;
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
.print{
  display:none;
}


            </style>
            
</head>

<body id = "sales"> </br></br>

 <h1 style="color:black"> SALES REPORT </h1> 
 <input type="button" value="Print" style="float:right;margin-right:10%;width:10%;height:5%" onclick="printDiv()">
</br></br> 
 
 <div class="sales-container" id="report">

        <label class="lead">Please Type or Choose Year: </label>

<form method="post">
<input type = "text" list = "select" name="select" >
<datalist id ="select" >
 <option class="active">Choose one...</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
         </datalist>
        
<input type="submit" value="submit"> 
</form>  </br>
 <form method="post">
        
  <?php
      if(isset($_POST['select'])){
        if(!empty($_POST['select'])) {
          $selected = $_POST['select'];
          echo 'You have chosen: ' . $selected;
          $sql ="SELECT Year(date_delivered) AS 'year', MONTHNAME(date_delivered) AS 'month', sum(total) AS 'sum', sum(quantity) AS 'count'
         FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '$selected'
      GROUP BY Year(date_delivered), Month(date_delivered) ORDER BY Year(date_delivered), Month(date_delivered) ";
  $orders = $con->query($sql) or die ($con->error);
  $row1 = $orders->fetch_assoc();
        } else {
          echo 'Please select the value.';
          
        }
      }
      
    ?>
    </form>
<p id="show"> 
<table>
     
<tr>
        
        <th> Year </th>
            <th> Month</th>
            <th> Number of Orders </th>
            <th> Sales</th>
            
           
            
   </tr>
   
   <tr>
   <?php do{ ?>
   <td> <?php echo $row1['year']?> </td>
   <td> <?php echo $row1['month']?>   </td>
   <td> <?php echo $row1['count']?> </td>
   <td>  <?php echo $row1['sum']?> </td>
  
   </tr>
<?php } while ($row1 = $orders->fetch_assoc()) ?>


</table>
   </br> </br>
 </form> </br> </br>

  </div></div> 
<!-- <a style="float:right; color:blue" href="product_reports.php"> Product Analytics Report </a> </br> </br> -->

<div class="print" id="print">

<?php $sql ="SELECT Year(date_delivered) AS 'year', MONTHNAME(date_delivered) AS 'month', sum(total) AS 'sum', sum(quantity) AS 'count'
          FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '2022'
GROUP BY Year(date_delivered), Month(date_delivered) ORDER BY Year(date_delivered), Month(date_delivered) ";
$orders = $con->query($sql) or die ($con->error);
$row1 = $orders->fetch_assoc(); ?>

<img style="width:50px;height:50px;"src ="img/logo2.png"> 

<h1 style="color:black"> MACHAKATH: HOMEMADE PEANUT BUTTER SHOP </br> SALES REPORT </h1>  

<form method="post">
<datalist id ="select" >
 <option class="active">Choose one...</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
         </datalist>
        
</form> 
  <?php
      if(isset($_POST['select'])){
        if(!empty($_POST['select'])) {
          $selected = $_POST['select'];
          $sql ="SELECT Year(date_delivered) AS 'year', MONTHNAME(date_delivered) AS 'month', sum(total) AS 'sum', sum(quantity) AS 'count'
         FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '$selected'
      GROUP BY Year(date_delivered), Month(date_delivered) ORDER BY Year(date_delivered), Month(date_delivered) ";
  $orders = $con->query($sql) or die ($con->error);
  $row1 = $orders->fetch_assoc();
        } else {
          echo 'Please select the value.';
          
        }
      }
      
    ?>
<table>
     
<tr>
        
        <th> Year </th>
            <th> Month</th>
            <th> Number of Orders </th>
            <th> Sales</th>
            
           
            
   </tr>
   
   <tr>
   <?php do{ ?>
   <td> <?php echo $row1['year']?> </td>
   <td> <?php echo $row1['month']?>   </td>
   <td> <?php echo $row1['count']?> </td>
   <td>  <?php echo $row1['sum']?> </td>
  
   </tr>
<?php } while ($row1 = $orders->fetch_assoc()) ?>

<?php $sql2 ="SELECT Year(date_delivered) AS 'year', MONTHNAME(date_delivered) AS 'month', sum(total) AS 'sales', sum(quantity) AS 'count'
         FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '$selected'
      GROUP BY Year(date_delivered), Month(date_delivered) ORDER BY Year(date_delivered), sales DESC
      LIMIT 0 , 5";
  $orders2 = $con->query($sql2) or die ($con->error);
  $rows2 = $orders2->fetch_assoc();
?>
<p id="interp">
THIS IS THE MONTHLY SALES RECORD THIS YEAR(<b><?php echo $selected?></b>), THE MONTH WITH THE HIGHEST SALES IS THE MONTH OF
<b><?php echo $rows2['month'] ?></b> WITH <b><?php echo NUMBER_FORMAT($rows2['sales']) ?></b> PESOS </p><br>

</table></br></br>
Printed by: Machakath Shop

   </div>


<hr>
<div class="graph">
            <h1 style="color:black">Analytics Reports </h1>
            <!-- <label>Monthly Sales Graph </label> -->
            <canvas  id="chartjs_bar"></canvas> 
        </div>    

   </div> 
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                                "#ff407b",
                               "#5969ff",
                                "#ff0000",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e",
                                "#ff8d85",
                                "#96c3eb",
                                "#6accbc",
                                "#eb96eb"
                            ],
                            data:<?php echo json_encode($sales); ?>,
                            label: 'Monthly Sales Graph',
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                       position: 'bottom',
 
                        labels: {
                            fontColor: 'black',
                            fontFamily: 'Poppins',
                            fontSize: 18,
                        }
                    },
 
 
                }
                });
    </script>

<script>

function message() {
      event.preventDefault()                                                                           
    document.getElementById("form").style.display = "block";
    
  }
  function close() {
    document.getElementById("form").style.display = "none";
  }
  </script>

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
<?php $sql2 ="SELECT Year(date_delivered) AS 'year', MONTHNAME(date_delivered) AS 'month', sum(total) AS 'sales', sum(quantity) AS 'count'
         FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '$selected'
      GROUP BY Year(date_delivered), Month(date_delivered) ORDER BY Year(date_delivered), sales DESC
      LIMIT 0 , 5";
  $orders2 = $con->query($sql2) or die ($con->error);
  $rows2 = $orders2->fetch_assoc();
?>
<p id="interp">
THIS IS THE MONTHLY SALES RECORD THIS YEAR(<b><?php echo $selected?></b>), THE MONTH WITH THE HIGHEST SALES IS THE MONTH OF
<b><?php echo $rows2['month'] ?></b> WITH <b><?php echo NUMBER_FORMAT($rows2['sales']) ?></b> PESOS </p><br>

</body>
</html>       

<?php } else{
   echo header("Location:admin.php");
} ?>