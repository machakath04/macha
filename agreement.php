<?php
session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();
// $id = $_SESSION['email'];
// $sql="SELECT * FROM user WHERE email ='$id'";
// $tao = $con->query($sql) or die ($con->error);
// $row = $tao->fetch_assoc();
if(isset($_POST['submit']))
{
        
// echo header("Location: verify_email.php?email=".$id);
echo header("Location: verify_email.php");


}
?>
<html>
    <head>
    <meta charset="utf-8" name="viewport" content= "width=768px">
    <!-- <meta charset="utf-8" name="viewport" content= "width=900, initial-scale=1.0"> -->
        <title> MACHAKATH TERMS AND AGREEMENT</title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <script src="./agreement/js/jquery.min.js"></script>
         
<style>
            body{
                font-family: 'Poppins';
               
            }
.container{
    width:60%;
    margin-left:auto;
    margin-right:auto;
    margin-top:40px;
    padding:5px;
    border:solid 1px;
    border-radius:4px;
    font-size: 15px;
    text-align: justify;

}
.license{
    border:1px solid brown;
    height:auto;
    margin-bottom:40px;
    padding: 2rem;
}
h2{
    text-align: center;
}
button{
    width:100%;
    height:7%;
    background-color: blue;
    color:white;
}
h1{
    color: black;
}#agre{
          background-color:#f2edd7ff;
        }
</style>
</head>

<body id="agre">
<div class="container">
<h1 align="center">Terms and Condition</h1><hr>
<div class="license">

<h3>2. Purchases </h3> 
If you wish to purchase any product or service made available through the website
(“Purchase”), you may be asked to supply certain information relevant to your Purchase
including but not limited to, your full name, contact number, and your shipping
information. </br>

<h3>3. Refunds </h3>
For customers who wishes to settle their payment online, they may do so. We will issue
refunds for unsuccessful transactions after 15 days of the original purchase. </br> 

<h3>12. Termination </h3>
We may terminate or suspend your account and bar access to the website immediately,
without prior notice or liability, under our sole discretion, for any reason whatsoever and
without limitation, including but not limited to a breach of Terms.
If you wish to terminate your account, you may simply discontinue using the website.
All provisions of Terms which by their nature should survive termination shall survive
termination, including, without limitation, ownership provisions, warranty disclaimers,
indemnity and limitations of liability. </br>

<h3>15. Acknowledgement </h3>
By using the website or other services provided by us, you acknowledge that you have
read these terms of service and agree to be bound by them. </br>

<h3>16. Contact Us </h3>
Please send your feedback, comments, requests for technical support by email:
<b>machakath@gmail.com<b> </br> </br>
<a style="text-align:center" href="./agreement/terms.php"> View Full Copy </a>

</div>

<table>
        <tr>
            <td><input type="radio" name="terms" value="agree" id="agree"></td>
            <td>I Agree With The Terms And Condition.</td>
        </tr>
        <tr>
            <td><input type="radio" name="terms" value="not_agree" id="not_agree" checked></td>
            <td>I Do Not Agree With The Terms And Condition.</td>
        </tr>
        <tr>
        <td><br/></td>
        </tr>
        <tr>
            <form action-" " method="post">
            <td><input type="submit" name="submit" value="Submit" id="submit"> </td>
</form>
        </tr>
    </table>
</div>
<script type="text/javascript">
	$(function(){
		var btnSubmit = $('#submit');
		btnSubmit.attr('disabled', 'disabled');
		$('input[name=terms]').change(function(e){
			if($(this).val() == 'agree'){
				btnSubmit.removeAttr('disabled');
			}else{
				btnSubmit.attr('disabled', 'disabled');
			}
		});	
	});
</script>
</body>
</html>