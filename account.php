<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();


$id = $_SESSION['email'];

$sql = "SELECT user.email, user.Fname, user.username, user.Lname, details.Phone, details.Region, details.Province, details.City, details.Brgy, details.Postal, details.House, details.filename FROM user INNER JOIN details ON user.email = details.email WHERE user.email = '$id' ";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();

if(isset($_POST['edit']))
{
 
    $num=  $_POST['Phone'];
    $region=  $_POST['Region'];
    $prov=  $_POST['Province'];
    $city=  $_POST['City'];
    $brgy=  $_POST['Brgy'];
    $postal=  $_POST['Postal'];
    $home=  $_POST['House'];
  

$sql = "UPDATE details SET Phone = '$num', Region = '$region', Province = '$prov', City = '$city', Brgy ='$brgy', Postal = '$postal' , House = '$home'  WHERE email = '$id'";
$con->query($sql) or die ($con->error);

   echo header("Location: account.php?email=".$id);  
 }


?>
<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0">
        <title> Your Account </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
          <style>
  #imageUpload
{
    display: none;
}

#profileImage
{
    cursor: pointer;
}

#profile-container {
    width: 150px;
    height: 150px;
    overflow: hidden;
    border: 1px solid black;
    border-radius:50%;
    margin-left:40%;
}

#profile-container img {
    width: 150px;
    height: 150px;
    max-width:150px;
    max-height:150px;
    overflow:hidden;
    
}
#account{
            /* background-color: #8C7663; */
            background-color: beige;
            box-sizing: border-box;
        }
            .account-container{
           
                background-color: #bd9a7a;
            /* background-color: #d7c29b; */
            
            border-radius:20px;
            height: auto;
            padding: 3rem;
            margin-left: 15%;
            margin-right: 20%;
            margin-top: 5%;
            width: 60%;
            text-align: center;
        }
        .column input{
            font-size:15px;
            width: 60%;
            height: 40px;
            border-radius: 10px;
            border: 1px solid black;
           
            float:left;
            background-color:#feedaa;
        
        }
        .row input{
            font-size:15px;
            width: 30%;
            height: 40px;
            border-radius: 10px;
            border: 1px solid black;
            
            float:left;
            /* color: black; */
            background-color:#feedaa ;
        }
        input:hover {
  opacity:1;
  background-color: yellow;
 
}
h1{
 color:black;
}
a:hover{
 margin-top:  -10px;
box-shadow:5px 8px 8px 5px;
            }
            #account button{
                width: 20%;
                height: 50px;
                font-family: 'Poppins';
                background-color: brown;
                font-size: 15px;
                border-radius: 10px ;
                color: white;
        }
        a{
  text-decoration:none;
    font-size:15px;
   
}
.header {
  overflow: hidden;
  background-color: #352315;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 15px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;

}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;

  }
}
  </style>
</head>
<body id =account>
<div class="header">
  <a href="#default" class="logo"><img src="./img/logo2.png" style="width:50px">  </a>
  <div class="header-right">
    <a class="active" href="shop.php">Shop</a>
     <a href="account.php">Account</a>
    <a href="cart.php">Cart</a>
    <a href="purchases.php">Orders</a>
    <a href="about.php">About</a>
    <a href="logout.php">Log-out</a>
  </div>
</div>


  <form action =" " method = "post" enctype="multipart/form-data"> 

<div class="account-container"> 
  
         <div id="profile-container">
         <!-- <image src="./img/profile/" />  -->
         <img style="width:150px" src="./img/profile/<?php echo $row['filename']; ?>">  
</div>
<a href="change_pic.php"> Change </a>
<h1> <?php echo $row['Fname']. "  ".$row['Lname']?> </h2>
<label style="margin-left:40%"> Username: <?php echo " ".$row['username'];?> </label> </br>
<label style="margin-left:40%"><?php echo $row['email'];?> </label><br><br></br>
<div class = "column">

<label>Contact Number :</label></br>
<input type= "text" name = "Phone" id = "Phone" value="<?php echo $row['Phone'];?>"></br></br>

<label> Region: </label></br>
<input type= "text" name = "Region" id = "Region" value="<?php echo $row['Region'];?>"></br></br>
<label> Province:</label></br>
<input type= "text" name = "Province" id = "Province" value="<?php echo $row['Province'];?>"></br></br>
<label> City:</label></br>
<input type= "text" name = "City" id = "City" value="<?php echo $row['City'];?>"></br></br>

</div>

<div class = "row">

<label> Postal Code:</label></br>
<input type= "text" name = "Postal" id = "Postal" value="<?php echo $row['Postal'];?>"></br></br>

<label> Brgy:</label></br>
<input type= "text" name = "Brgy" id = "Brgy" value="<?php echo $row['Brgy'];?>"> </br></br>

<label> Street/Building/ House No. </label></br>
<input type= "text" name = "House" id = "House" value="<?php echo $row['House'];?>"></br>
</div>
</br>

<button type="submit"  name= "edit"> Update </button>



</div>
</form>


</body>
</html>
