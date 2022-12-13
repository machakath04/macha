<?php 

include_once("connections/connection.php");

$con = connection();


    $id = $_GET['id'];
    
    $sql = "INSERT INTO archive SELECT * FROM products WHERE product_id='$id'";
    $con->query($sql) or die($con->error);


    $sql = "DELETE FROM products WHERE product_id = '$id'";
      $con->query($sql) or die ($con->error);

    echo header("Location: product_manage.php");
    
    
?>