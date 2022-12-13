<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();

$id = $_SESSION['email'];

$msg = "";

// If upload button is clicked ...
if (isset($_POST['edit'])) {


	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "./img/profile/". $filename;

	$sql ="UPDATE details SET filename ='$filename' WHERE email = '$id'";
    $con->query($sql) or die ($con->error);


	// Now let's move the uploaded image into the folder: image
	if (move_uploaded_file($tempname, $folder)) {
		echo "<h3> Image uploaded successfully!</h3>";
	} else {
		echo "<h3> Failed to upload image!</h3>";
	}
    echo header("Location: account.php?email=".$id);  
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Image Upload</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css" />
  <style>
    *{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

#content{
	width: 50%;
	justify-content: center;
	align-items: center;
	margin: 50px auto;
	border: 1px solid #cbcbcb;
	margin-top:10%;
	  background-color: #dfbe90a2 ;
	  border-radius:10px;
}
form{
	width: 50%;
	margin: 20px auto;
}

#display-image{
	width: 100%;
	justify-content: center;
	padding: 5px;
	margin: 15px;
}
img{
	margin: 5px;
	width: 350px;
	height: 250px;
}
h3{
	color: black;
}
button{
    width:25%;
    background-color: brown;
    color: white;
	height: 30px;
}
body{
        image-rendering: auto;
        background-image: url('img/logo.jpg');
        background-size: cover;
        background-repeat:no-repeat;
        /* background-size: 100% 100%; */
        /* background-attachment: fixed; */
        }

    </style>
</head>

<body>
	<div id="content">
		<form method="POST" action="" enctype="multipart/form-data">
			<div class="form-group">
                  <h2 style="color:black;"> UPLOAD IMAGE </h2> </br>
				 <input class="form-control" type="file" style="border:1px solid black;padding:5px"name="uploadfile" value="" /> </br>
			</div> </br> 
			<div class="form-group">
				<button type="submit" name="edit">UPLOAD</button>
			</div>
		</form>
	</div>
</body>

</html>
