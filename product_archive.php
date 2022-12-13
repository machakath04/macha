<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['access']) && $_SESSION['access'] == "admin"){
   

include_once("connections/connection.php");

connection();

$con = connection();



$sql = "SELECT * FROM archive";
$orders = $con->query($sql) or die ($con->error);
$row1 = $orders->fetch_assoc();

$msg=" ";
if(isset($_GET['archive']))
    {
        $prod_name= $_GET['product_name'];
        $prod_size= $_GET['product_size'];
        $prod_price= $_GET['product_price'];
        $pic = $_GET['picture'];
        //$filename= $_POST['picture'];

        $filename = $_FILES["picture"]["name"];
        $tempname = $_FILES["picture"]["tmp_name"];
        $folder = "./img/". $filename;


        $sql ="INSERT INTO products( `product_name`, `product_size`, `product_price`, `picture`) VALUES ('$prod_name','$prod_size','$prod_price','$filename')";
        $con->query($sql) or die($con->error);

        if (move_uploaded_file($tempname, $folder)) {
            echo "<h3> Image uploaded successfully!</h3>";
        } else {
            echo "<h3> Failed to upload image!</h3>";
        }
    
      
       echo header("Location: product_manage.php");
    }



?>

<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  /* border: 1px solid brown;
  background-color: #814918;
  width: 50%;
margin-left: 25%;
border-radius: 20px; */
}
button{
            width: 150px;
            height: 40px;
            font-family: 'Poppins';
            background-color:yellow;
            font-size: 15px;
            /* letter-spacing: 20px; */
            border-radius: 10px ;
            color: black;
            float:right;
            right: 10px;
            
    }
    
        
        .form-container input{
        width: 300px;
        padding: 15px;
        border: 1px solid black;
        background: white;
        border-radius: 10px;
        color: black;
       
      }
      .form-container input:focus {
        background-color: yellow;
        outline: none;
      }
    .form-container label{
        float: center;
       
       
      }
    .popup {
        display: none;
        position:fixed;
        top:50%;
        left:50%;
        transform:translate(-50%, -50%);
        bottom: 0;
        margin-right:50px;
        border: 2px solid brown;
        z-index: 1;
        padding: 8px;
        text-align:center;
        box-shadow:5px 8px 7px 5px;
        background-color:white;
        width: 500px;
        height:500px;
      }
      .form-container button{
            width: 100px;
            height: 40px;
            font-family: 'Poppins';
            font-size: 15px;
            border-radius: 10px ;
            color: white;
            /* float: right;    */
           
      }
      .cart-all{
    /* background-color: #ffd8c597;  */
    background-color:#dfbe90a2 ;
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
        <h1> DELETED PRODUCTS </h1> </br></br>
       
<table>
<tr>
        <th> Image </th>
        <th> Product ID </th>
            <th> Product Name </th>
            <th> Size</th>
            <th> Price  </th>
            <th> Action </th>
          
           
            
   </tr>
   
   <tr>
   <?php do{ ?>
    <form method = "post">
    <td><img src="./img/<?php echo $row1['picture']; ?>" style="width:100px"></td>
   <td> <?php echo $row1['product_id'] ?>  </td>
   <td> <?php echo $row1['product_name'] ?>  </td>
   <td>  <?php echo $row1['product_size'] ?> </td>
   <td>  <?php echo $row1['product_price'] ?> </td>
   <td>  <a style="color:red" href = "restore.php?id=<?php echo $row1['product_id'];?>"> restore </a> </td>
  
   </tr>
<?php } while ($row1 = $orders->fetch_assoc()) ?>
</table>
   </br> </br>
   </form>
</div>



<?php } else{
   echo header("Location:admin.php");
} ?>

</body>
</html>       