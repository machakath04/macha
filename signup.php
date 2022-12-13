<?php
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

connection();

$con = connection();
// $id = $_SESSION['email'];
if(isset($_POST['add']))
{
  $mail = new PHPMailer(true);


  try{
      //$mail->SMTPDebug = 0;

      $mail->isSMTP();

      $mail->Host = 'smtp.gmail.com';

      $mail->SMTPAuth = true;

      $mail->Username = 'machakath04@gmail.com';

      $mail->Password = 'aueeifgjeyatozvq';

      $mail->SMTPSecure = 'tls';

      $mail->Port = 587;

      $mail->setFrom('machakath04@gmail.com');

      $mail->addAddress($_POST["email"]);

      $mail->isHTML(true);

      $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );

      $verification_code = substr(number_format(time() * rand(), 0, '', '',), 0, 6);

      $mail->Subject = 'Email verification';
      $mail->Body = '<p>Your verification code is:  <b style="font-size: 30px;">' .
          $verification_code.'</b></p>';
      $mail->send();


    $email = $_POST ['email'];
    $num=  $_POST['Phone'];
    $region=  $_POST['Region'];
    $prov=  $_POST['Province'];
    $city=  $_POST['City'];
    $brgy=  $_POST['Brgy'];
    $postal=  $_POST['Postal'];
    $home=  $_POST['House'];

    $user = $_POST['username'];
    $Lname=  $_POST['Lname'];
    $Fname=  $_POST['Fname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['email'];
    
    $data = $_POST;
    
        if (empty($data['password']) ||
        empty($data['email']) ||
        empty($data['password_confirm'])) {
        
        die('Please fill all required fields!');
        }
    
        if ($data['password'] !== $data['password_confirm']) {
        die('Password and Confirm password should match!');   
        }else {
  
        

$sql = "INSERT INTO `details`(`email`,`Phone`, `Region`, `Province`, `City`, `Brgy`, `Postal`, `House`) VALUES ('$email','$num',' $region', ' $prov', '$city', ' $brgy', ' $postal', ' $home' )";

   $con->query($sql) or die ($con->error);

   
$qry = "INSERT INTO `user`( `email`,`password`,`username`,`Fname`,`Lname`,`verification_code`) VALUES ('$email', '$password ','$user',' $Fname',' $Lname','$verification_code')";
   $con->query($qry) or die($con->error);

  //  echo header("Location:agreement.php?email=".$id);
  echo header("Location:agreement.php");
   exit();
        }
  }catch (Exception $e){
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
?>
<html>
    <head>
    <meta name="viewport" content="width=900, initial-scale=1.0">
        <title> MACHAKATH: HOMEMADE PEANUT BUTTER ONLINE SHOP </title>
          <link rel="stylesheet" href="css/style.css">
          <link rel="icon" type="png" href="img/logo2.png"/>
          <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <style>
           .column input{
            font-size:15px;
            width: 60%;
            height: 40px;
            border-radius: 10px;
            border: 1px solid black;
           
            float:left;
            background-color: #fcf7a6;
        
        }
        .row input{
            font-size:15px;
            width: 30%;
            height: 40px;
            border-radius: 10px;
            border: 1px solid black;
            
            float:left;
            /* color: black; */
            background-color: #fcf7a6;
        }
        h1{
  color: white;
  border: 1px solid brown;
  background-color: #814918;
  border-radius:20px;
  width: 60%;
  margin-left: 20%;
}
#edit{
        image-rendering: auto;
        background-image: url('img/logo.jpg');
        /* background-size: cover; */
        background-repeat:no-repeat;
        background-size: 100% 100%;
        /* background-attachment: fixed; */
        }
       
.edit-container{
        background-color: #dfbe90a2 ;
        border-radius:20px;
        height: auto;
        padding: 1rem;
        margin-left: 20%;
        margin-right: 10%;
        margin-top: 3%;
        width: 60%;
        text-align: center;
    }
    #edit button{
            width: 20%;
            height: 50px;
            background-color: brown;
            font-size: 15px;
            border-radius: 10px ;
            color: white;
            margin-top: 5%;
            
    }
select{
  height:40px;
  background-color: #fcf7a6;
}


          </style>

</head>
<body id = edit>
  <!-- <img src = "img/logo2.png" width = "140" height= "90" > -->
<div class = edit-container>
  <form action =" " method = "post"> 
<h1> CREATE ACCOUNT  </h1> </br></br>

<div class="column">
<label> Username: </label> </br>
<input type= "text" name= "username" id = "username"  required> </br> </br>
<label> First Name: </label> </br> 
<input type= "text" name= "Fname" id = "Fname" required> </br> </br>
<label> Last Name: </label> </br>
<input type= "text" name= "Lname" id = "Lname" required> </br></br></br>
<label> Email:</label> </br>
<input type= "email" name = "email" id = "email"  required ></br></br>

<label> Contact Number:</label></br>
<input type="tel" name = "Phone" id = "Phone"  placeholder="0939-411-6678" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" required ></br></br></br>

<label> Password: </label> </br>
<input type="password" name="password" minlength="10" id="password"  required>
 </br> </br>

<label> Confirm Password: </label> </br>
<input type="password" name="password_confirm" required> 
</br> </br></br>

</div>

<div class="row">
<label style="text-align:center"> Region</label></br>
<select name="Region" id="Region" style="background-color: #fcf7a6"> <option value=" " selected = "selected"> Region
</option></select></br></br></br>

<label style="text-align:center"> Province</label></br>
<select name="Province" id="Province" style="background-color: #fcf7a6"> <option value=" " selected = "selected"> Province
</option></select></br></br></br>

<label> City</label></br>
<select name="City" id="City" style="background-color: #fcf7a6"> <option value=" " selected = "selected"> City
</option></select></br></br></br>


<label> Brgy</label></br>
<input type= "text" name = "Brgy" id = "Brgy" required ></br></br></br>
<label> Postal Code:</label></br>
<input type= "text" name = "Postal" id = "postal"></br></br></br>
<label> Street/Building/House No. </label></br>
<input type= "text" name = "House" id = "house"  required ></br></br></br>

</div>
  
<button type="submit" name= "add" > CREATE </button>

</form>
</div>
<script>
var subjectObject = {
  "Central Luzon": {
    "Aurora": ["Baler", "Casiguran", "Dilasag", "Dinalungan", "Dingalan", "Dipaculao", "Maria Aurora", "San Luis"],
    "Bataan":["Abucay", "Bagac", "Balanga", "Dinalupihan", "Hermosa", "Limay", "Mariveles", "Morong", "Orani", "Orion", "Pilar", "Samal"],
    "Bulacan": ["Angat", "Balagtas", "Baliuag", "Bocaue", "Bulakan", "Bustos", "Calumpit", "Dona Remedios Trinidad", "Guiguinto", "Hagonoy", "Malolos", 
                 "Marilao", "Meycauayan", "Norzagaray","Obando", "Pandi", "Paombong", "Plaridel", "Pulilan", "San Ildefonso", "San Jose Del Monte",
                "San Miguel", "San Rafael", "Sta. Maria"],
    "Nueva Ecija": ["Aliaga", "Bongabon", "Cabanatuan", "Cabiao", "Carangalan", "Cuyapo", "Gabaldon", "Gapan", "General Mamerto Natividad", "General Tinio", "Guimba"],
    "Pampanga": ["Angeles City", "Apalit", "Arayat", "Bacolor", "Basa airbase", "Candaba", "Florida blanca", "Guagua", "Lubao", "Mabalacat", "Macabebe", "Magalang", "Masantol", "Mexico", "Minalin", "Porac", "San Fernando", "San Luis", "San simon", "Sexmoan", "Sta. Ana", "Sta. Rita", "Sto. Tomas"],
    "Tarlac": ["Anao", "Bamban", "Camiling", "Capas", "Gerona", "Concepcion", "La Paz", "Mayantoc", "Moncada", "Paniqui", "Pura", "Ramos", "San Clemente", "San Jose", "San Miguel", "San Manuel", "Sta. Ignacia", "Tarlac", "Victoria"],
    "Zambales": ["Botolan", "Cabangan", "Candelaria", "Castillejos", "Iba", "Masinloc","Palauig","San Antonio","San Felipe","San Marcelino","San Naraciso","Sta. Cruz","Subic"],
         
  },

  "Metro Manila": {
    "Metro Manila": ["Binondo", "Caloocan City", "Ermita", "Intramuros", "Las Pinas City", "Makati City", "Malabon City",
                     "Malate", "Manadaluyong City", "Marikina City", "Muntinlupa City", "Navotas City", "Paco", "Pandacan",
                     "Paranaque City", "Pasay City", "Pasig City", "Pateros", "Port Area", "Quezon City", "Quiapo", "Sampaloc",
                     "San Juan City", "San Miguel", "San Nicolas", "Santa Ana", "Santa Cruz", "Taguig City", "Tondo", "Valenzuela City"],
    
  }
}
window.onload = function() {
  var region = document.getElementById("Region");
  var province= document.getElementById("Province");
  var city= document.getElementById("City");
  var brgy = document.getElementById("Brgy");
  for (var x in subjectObject) {
    region.options[region.options.length] = new Option(x, x);
  }
  region.onchange = function() {
    //empty Chapters- and Topics- dropdowns
    province.length = 1;
    city.length = 1;
    brgy.length = 1;
    //display correct values
    for (var y in subjectObject[this.value]) {
      province.options[province.options.length] = new Option(y, y);
    }
  }
  province.onchange = function() {
    //empty Chapters dropdown
    city.length = 1;
    brgy.length = 1;
    //display correct values
    var z = subjectObject[region.value][this.value];
    for (var i = 0; i < z.length; i++) {
      city.options[city.options.length] = new Option(z[i], z[i]);
    }
  }
  city.onchange = function() {
    //empty Chapters dropdown
    brgy.length = 1;
    //display correct values
    var a = subjectObject[region.value][this.value];
    for (var i = 0; i < a.length; i++) {
      brgy.options[brgy.options.length] = new Option(a[i], a[i]);
    }
  }
}
const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>

</body>
</html>
