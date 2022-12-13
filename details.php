<?php

if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['access']) && $_SESSION['access'] == "admin")
{



include_once("connections/connection.php");
$con = connection();

$id = $_GET ['email'];

$sql = "SELECT user.email, user.Fname, user.Lname, details.Phone, details.Region, details.Province, details.City, details.Brgy, details.Postal, details.House, details.filename FROM user INNER JOIN details ON user.email = details.email WHERE user.email = '$id' ";
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();



?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> SHOP USERS/CUSTOMERS </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
         
         <style>
            h1{
  color: white;
  border: 1px solid brown;
  background-color: #814918;
  width: 50%;
margin-left: 25%;
/* border-radius: 20px; */
}
            #details{
    background-color: #8C7663;
    box-sizing: border-box;
}
.details-container{
    /* background-color: #e1c06e96; */
    background-color:#dfbe90a2 ; 
    border-radius:3px;
    height: auto;
    padding: 2rem;
    margin-left: 20%;
    margin-right: 20%;
    margin-top: 5%;
    width: 60%;
    box-shadow:8px 5px 5px 8px;
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
    
}
   
            </style>
</head>
<body id = "dashboard">
<div class="details-container">

<h1> CUSTOMER DETAILS </h1></br>

         <div id="profile-container">
         <!-- <image src="./img/profile/" />  -->
         <img src="./img/profile/<?php echo $row['filename']; ?>"> </div></br>
<label> Email Address:<b> <?php echo $row["email"]; ?> </b></label> <br/><br/>
<label> First Name: <b><?php echo $row['Fname']; ?> </b></label><br/><br/>
<label> Last Name: <b><?php echo $row['Lname']; ?></b> </label> <br/><br/>
<label> Contact Number:<b> <?php echo $row['Phone']; ?></b></label><br/><br/>
<label> Address: <b><?php echo $row['Region']. " , ".$row['Province']. " , ".$row['City']. " , ".$row['Brgy'] ?></b></label><br/><br/>
<label> Postal Code:<b> <?php echo $row['Postal']; ?></b></label><br/><br/>


</div>

<?php } else{
   echo header("Location:admin.php");
} ?>

</body>
</html>

