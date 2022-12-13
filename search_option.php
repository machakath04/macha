<?php

$search = $_POST['search'];
$column = $_POST['column'];

	$host = "localhost";
    $username = "root";
    $password = "";
    $database = "db_machakath";

$con = new mysqli( $host,$username,$password, $database);

if ($conn->connect_error){
	die("Connection failed: ". $con->connect_error);
}

$sql = "SELECT * from products where product_name like '%$search%'";

$result = $con->query($sql);

if ($result->num_rows > 0){
while($row = $result->fetch_assoc() ){
	echo $row["product_id"]."  ".$row["product_name"]."  ".$row["product_price"]." ".$row["product_name"]."<br> ";
}
} else {
	echo "0 records";
}

$con->close();

?>
<html>
<body>

<form action="search_option.php" method="post">
Search <input type="text" name="search"><br>

Column: <select name="column">
	<option value="product_name">Name</option>
	<option value="product_price">Price</option>
	<option value="product_id">ID</option>
	</select><br>
<input type ="submit">
</form>

</body>
</html>