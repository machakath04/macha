<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['access']) && $_SESSION['access'] == "admin"){
 
 

include_once("connections/connection.php");

connection();

$con = connection();

$sql ="SELECT Year(date_delivered) AS 'year', sum(quantity) AS 'sum', 
         product_name, product_id FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = 2022
      GROUP BY  product_id ORDER BY 'sum' ASC ";
       $orders = $con->query($sql) or die ($con->error);
       $row1 = $orders->fetch_assoc();


if(isset($_POST['select'])){
    if(!empty($_POST['select'])) {
      $selected = $_POST['select'];
     
      
      if (!$con) {
        # code...\
       echo "Problem in database connection! Contact administrator!" . mysqli_error();
        }else{
            
          // $quantity = $_POST['quantity'];
                $sql ="SELECT Year(date_delivered) AS 'year', sum(quantity) AS 'total',
                    product_name, product_id FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '$selected'
                 GROUP BY product_id ORDER BY  total ASC ";
                            $result = mysqli_query($con,$sql);

                $sql2 ="SELECT Year(date_delivered) AS 'year', sum(quantity) AS 'total',
                    product_name, product_id FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '$selected'
                 GROUP BY year(date_delivered) ORDER BY  total ASC ";
                 $orders1 = $con->query($sql2) or die ($con->error);
                 $row2 = $orders1->fetch_assoc();

            $chart_data="";
            while ($row1 = mysqli_fetch_array($result)) { 
    
               $productname[]  = $row1['product_name']  ;
              
                $percent =round((($row1['total']/$row2['total'])*100),1); 
               
                $per =
               $sales[] =$percent;
           }
            }

    } else {
      echo 'Please select the value.';
      
    }
  }
  



?>

<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <!-- <title> ORDERS </title>
          <link rel="stylesheet" href="css/style.css"> -->
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <style>
            *{
              font-family: Poppins;
            }
            body{
              /* background-color:#e1c06e96; */
              /* background-color:#d4f4ec; */
              background-color:#f2edd7ff;
            }
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
                background-color: #daf4ec;
            }
            tr:nth-child(odd) {
                background-color:  #f3a88977;
            }
            h1{
  color: black;
text-align: center;
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
.graph{
  width:50%;
  height: 10%;
  text-align:center;
  margin-top:5%;
  margin-left: 25%;
  padding: 2px;
  
}
.print{
  display:none;
}


         </style>
</head>

    <body>
  
<body id = "cart"> </br></br>
<h1> Product Sales Report</h1>

<input type="button" value="Print" style="float:right;margin-right:10%;width:10%;height:5%" onclick="printDiv()"> </br>
</br>
<div class="sales-container">
  <label class="lead">Please Choose Year: </label> 

 <form method="post">
 <input type = "text" list = "select" name="select" >
<datalist id ="select" >
  <option class="active">Choose one...</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
          </datalist>

<input type="submit" value="submit">

  </form><br>
 
  <?php
      if(isset($_POST['select'])){
        if(!empty($_POST['select'])) {
          $selected = $_POST['select'];
          echo 'You have chosen: ' . $selected;
          
        $sql ="SELECT Year(date_delivered) AS 'year', sum(quantity) AS 'sum', 
       product_name, product_id FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '$selected'
      GROUP BY  product_id ORDER BY Year(date_delivered) ";
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
   
            <th> Year </th>
            <th> Product Id </th>
            <th> Product Name</th>
            <th> Order Quantity </th>
   </tr>
   
   <tr>
   <?php do{ ?>

    <td> <?php echo $row1['year'] ?>  </td>
   <td>  <?php echo $row1['product_id'] ?> </td>
   <td>  <?php echo $row1['product_name'] ?> </td>
   <td>  <?php echo $row1['sum'] ?> </td>

   </tr>
<?php } while ($row1 = $orders->fetch_assoc()) ?>
</table></br></br> 

</div> </br>
<hr style="background-color:black">

<div class="graph">
            <h1 >Analytics Reports </h1><br>
            <label>Product Sales Count </label>
            <canvas  id="chartjs_bar"></canvas> 
        </div>    
    


<div class="print" id="print">

  <?php 
  $sql ="SELECT Year(date_delivered) AS 'year', sum(quantity) AS 'sum', 
  product_name, product_id FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = 2022
GROUP BY  product_id ORDER BY 'sum' ASC ";
$orders = $con->query($sql) or die ($con->error);
$row1 = $orders->fetch_assoc();  ?>

<img style="width:50px;height:50px;"src ="img/logo2.png"> 

<h1 style="color:black"> MACHAKATH: HOMEMADE PEANUT BUTTER SHOP </br></br>
PRODUCT SALES REPORT </h1>  

<form method="post">

<datalist id ="select" >
  <option class="active">Choose one...</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
   </datalist>
</form><br>
  <?php
      if(isset($_POST['select'])){
        if(!empty($_POST['select'])) {
          $selected = $_POST['select'];
          // echo 'You have chosen: ' . $selected;
          
        $sql ="SELECT Year(date_delivered) AS 'year', sum(quantity) AS 'sum', 
       product_name, product_id FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '$selected'
      GROUP BY  product_id ORDER BY Year(date_delivered) ";
  $orders = $con->query($sql) or die ($con->error);
  $row1 = $orders->fetch_assoc();
        } else {
          echo 'Please select the value.';
          
        }
      }
      
    ?>
    <!-- </form> -->
<!-- <p id="show">  -->

<table>
  <tr>
   
            <th> Year </th>
            <th> Product Id </th>
            <th> Product Name</th>
            <th> Order Quantity </th>
   </tr>
   
   <tr>
   <?php do{ ?>

    <td> <?php echo $row1['year'] ?>  </td>
   <td>  <?php echo $row1['product_id'] ?> </td>
   <td>  <?php echo $row1['product_name'] ?> </td>
   <td>  <?php echo $row1['sum'] ?> </td>

   </tr>
<?php } while ($row1 = $orders->fetch_assoc()) ?>
</table></br></br>
<?php $sql2 ="SELECT product_id, product_name, sum(quantity) AS 'quantity'
         FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '$selected'
      GROUP BY  product_id ORDER BY Year(date_delivered), quantity DESC
      LIMIT 0 , 5";
  $orders2 = $con->query($sql2) or die ($con->error);
  $rows2 = $orders2->fetch_assoc();
?>
THIS YEAR'S (<b><?php echo $selected?></b>) BEST SELLING PRODUCT IS 
<b><?php echo $rows2['product_name'] ?></b> WITH A QUANTITY OF <b><?php echo NUMBER_FORMAT($rows2['quantity']) ?></b>
OR <b><?php echo $percent ?></b>% OF SALES</p><br>

Printed by: Machakath Shop
</div>
      



  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
      var ctx =  document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                                "#ff407b",
                               "#5969ff",
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
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'right',
 
                        labels: {
                            fontColor: 'black',
                            fontFamily: 'Poppins',
                            fontSize: 12,
                            
                        }
                    },
 
 
                }
                });
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
    

    <?php $sql2 ="SELECT product_id, product_name, sum(quantity) AS 'quantity'
         FROM completed_orders WHERE EXTRACT(YEAR FROM date_delivered) = '$selected'
      GROUP BY  product_id ORDER BY Year(date_delivered), quantity DESC
      LIMIT 0 , 5";
  $orders2 = $con->query($sql2) or die ($con->error);
  $rows2 = $orders2->fetch_assoc();
?>
<p id="interp">
THIS YEAR'S (<b><?php echo $selected?></b>) BEST SELLING PRODUCT IS 
<b><?php echo $rows2['product_name'] ?></b> WITH A QUANTITY OF <b><?php echo $rows2['quantity'] ?></b>
OR <b><?php echo $percent ?></b>% OF SALES</p><br>

</body>
      
</html>       
<?php } else{
  echo header("Location:admin.php");
}