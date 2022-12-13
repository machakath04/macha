<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['access']) && $_SESSION['access'] == "admin"){
   

include_once("connections/connection.php");

connection();

$con = connection();



$sql = "SELECT * FROM products";
$orders = $con->query($sql) or die ($con->error);
$row1 = $orders->fetch_assoc();

$msg=" ";
if(isset($_POST['add']))
    {
        $prod_name= $_POST['product_name'];
        $prod_size= $_POST['product_size'];
        $prod_price= $_POST['product_price'];
        $desc= $_POST['description'];

        $filename = $_FILES["picture"]["name"];
        $tempname = $_FILES["picture"]["tmp_name"];
        $folder = "./img/". $filename;


        $sql ="INSERT INTO products( `product_name`, `product_size`, `product_price`, `picture`, `description`) VALUES ('$prod_name','$prod_size','$prod_price','$filename', '$desc')";
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
            width: 120px;
            height: 50px;
            font-family: 'Poppins';
            background-color:brown;
            font-size: 15px;
            /* letter-spacing: 20px; */
            border-radius: 10px ;
            color: white;
            float:right;
            right: 10px;
            
    }
    
        
        .form-container input{
        width: 300px;
        height: 40px;
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
        height:630px;
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

            </style>
</head>
<body id = "dashboard"> </br></br>
<!-- <a href = "orders.php"> ORDERS </a> -->
    <div class = "cart-all">
        <h1> PRODUCT MANAGEMENT </h1> </br></br>
       
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
    <td><img src="./img/<?php echo $row1['picture']; ?>" style="width:100px"></td>
   <td> <?php echo $row1['product_id'] ?>  </td>
   <td> <?php echo $row1['product_name'] ?>  </td>
   <td>  <?php echo $row1['product_size'] ?> </td>
   <td>  <?php echo $row1['product_price'] ?> </td>
   <td> <a href = "edit_product.php?id=<?php echo $row1['product_id'];?>"> edit </a> </br> <hr>
        <a style="color:red " href = "product_remove.php?id=<?php echo $row1['product_id'];?>"> delete </a> 
  </td>
  
   </tr>
<?php } while ($row1 = $orders->fetch_assoc()) ?>
</table>
   </br> </br>
<button type="submit"  name= "open" onclick="openForm()" > ADD </button> </br> </br>
</div>

<div class = "popup" id = "Form">
 <form action =" "  class = "form-container" method ="post" enctype="multipart/form-data">  
 <a href=" " class="close" onclick="close()"> </a> </br>
 <h2 style="color:black"> Add Product </h2>
<label> Product Name: </label> </br>
<input type= "text" name= "product_name" id = "product_name"  required> </br> </br>
<label> Product Size: </label> </br> 
<input type= "text" name= "product_size" id = "product_size" required> </br> </br>
<label> Product Price: </label> </br>
<input type= "text" name= "product_price" id = "product_price" required> </br></br>
<label> Product Description: </label> </br>
<textarea rows = "5" cols = "40" name = "description"> </textarea><br>
<label> Upload Image </label> </br>
<input type="file"  name="picture" style=" width:300px;height:9%"  value="" /> </br> </br>

<button style="width:100px;margin-right:40%" type="add"  name= "add" > SUBMIT </button> </br>

   </form>

   <script>

  function openForm() {
      event.preventDefault()                                                                           
    document.getElementById("Form").style.display = "block";
  }


  function closeForm() {
    document.getElementById("Form").style.display = "none";
  }

</script>

<?php } else{
   echo header("Location:admin.php");
} ?>

</body>
</html>       