<?php

if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['access']) && $_SESSION['access'] == "admin"){



include_once("connections/connection.php");

connection();
$con = connection();

$id =  $_GET ['id'];

$sql = " SELECT * FROM products WHERE product_id = '$id'" ;
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();

$msg=" ";
if(isset($_POST['edit']))
{

    $name=  $_POST['name'];
    $price=  $_POST['price'];
    $size=  $_POST['size'];
    $desc= $_POST['description'];
   

   $sql = "UPDATE products SET  product_name = '$name', product_price = '$price', product_size = '$size' , 'description' = '$desc' WHERE product_id = '$id'";
   $con->query($sql) or die ($con->error);

echo header("Location: product_manage.php");

   
}
if(isset($_POST['delete']))
{
    echo header("Location: product_remove.php?ID=".$row['product_id']);

   
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
             h1{
  color: black;
  
}
.details-container{
    background-color:#dfbe90a2 ;
    border:solid 1px black;
    height: auto;
    padding: 2rem;
    margin-left: 20%;
    margin-right: 20%;
    margin-top: 5%;
    width: 55%;
    border-radius:5px;
    box-shadow:8px 5px 5px 8px;
    }
            button{
            width: 30%;
            height: 50px;
            
            background-color: brown;
            font-size: 15px;
            /* letter-spacing: 20px; */
            border-radius: 10px ;
            color: white;
            margin-top: 5%;
           text-align:center;
    }
    input{
            font-size:15px;
            width: 60%;
            height: 50px;
            border-radius: 10px;
            border: 1px solid black;
            
            float:left;
            /* color: black; */
            background-color:#E1C16E ;
            margin-left: 20%;
        }
        textarea{
            font-size:15px;
            width: 60%;
            border-radius: 10px;
            border: 1px solid black;
            
            float:left;
            /* color: black; */
            background-color:#E1C16E ;
            margin-left: 20%;
        }
        label{
            margin-left: 20%;
        }
        body{
            background-color:#f2edd7ff;
        }
            </style>
</head>
<body>
    <div class = "details-container">
        <form method = "post" action = " " enctype="multipart/form-data" >
<h1> EDIT PRODUCT DETAILS </h1> </br>
<h3> Product ID:</label> <?php echo $row['product_id']?> </h3></br>
<label>Product Name:</label></br>
<input type= "text" name = "name"  value="<?php echo $row['product_name'];?>"></br></br>
<label> Product Price:</label></br>
<input type= "text" name = "price" value="<?php echo $row['product_price'];?>" ></br></br>
<label> Product Size</br></label>
<input type= "text" name = "size" value="<?php echo $row['product_size'];?>"></br></br>
<label> Product Description: </label> </br>
<textarea rows = "5" cols = "40" style="font-family:Poppins" name = "description" > <?php echo $row['description'];?> </textarea></br></br></br></br>

<button style="margin-left:10%" type="submit"  name= "edit"> Update </button>
        </div>
        </form>

 <?php } else{
   echo header("Location:admin.php");
} ?>

</body>
</html>