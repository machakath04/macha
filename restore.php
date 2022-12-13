<?php

if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['access']) && $_SESSION['access'] == "admin"){
   

include_once("connections/connection.php");

connection();

$con = connection();

$id =  $_GET ['id'];

$sql = " SELECT * FROM archive WHERE product_id = '$id'" ;
$tao = $con->query($sql) or die ($con->error);
$row = $tao->fetch_assoc();


$prod_name= $row['product_name'];
$prod_size= $row['product_size'];
$prod_price= $row['product_price'];
$pic = $row['picture'];

$sql ="INSERT INTO products( `product_name`, `product_size`, `product_price`, `picture`) VALUES ('$prod_name','$prod_size','$prod_price','$pic')";
        $con->query($sql) or die($con->error);
        
$qry ="DELETE FROM archive WHERE product_id = '$id'";
        $con->query($qry) or die($con->error);

      echo header("Location:product_archive.php");
}else{
    echo header("Location:admin.php");
}
?>