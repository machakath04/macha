<?php 

include_once("connections/connection.php");

$con = connection();



    $id = $_GET['ID'];
    $sql = "DELETE FROM cart WHERE id = '$id'";
    $con->query($sql) or die ($con->error);

    
    echo header("Location: cart.php");
    
    
?>