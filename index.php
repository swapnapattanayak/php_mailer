<?php
// session_start();
include '_dbconnect.php';
require("vendor/autoload.php");
require_once("mailerphp/PHPMailer.php");
require_once("mailerphp/SMTP.php");
require_once("mailerphp/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';
?>

<?php

require "_dbconnect.php";


$showAlert = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
$email = $_POST["email"];

//Generate a random string.
$token = openssl_random_pseudo_bytes(16);
//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);

$existsql = "SELECT * FROM `shavi` WHERE email = '$email' AND active = '1'";
$result = mysqli_query($conn, $existsql);
$numExistRows = mysqli_num_rows($result);
if($numExistRows>0)
{
 $showError = "Email is already present<br>";
}
else
{

$sql = "INSERT INTO `shavi` (`sno`, `email`, `token`, `tstamp`, `active`) VALUES (NULL, '$email', '$token', current_timestamp(), '0');";
$result = mysqli_query($conn, $sql);

$showAlert = true;



if($result){
    $phpmailer = new PHPMailer(true);

    // $_SESSION['tokken'] = $token;
    // $_SESSION['email'] = $email;

    try {
       
        $phpmailer->isSMTP();
        $phpmailer->SMTPAuth = true;
        $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $phpmailer->Host = "smtp.gmail.com";
        $phpmailer->Port = "587";
        $phpmailer->Username = "phpassignmail@gmail.com";
        $phpmailer->Password = "php1123!!";
        $phpmailer->setFrom("phpassignmail@gmail.com");
        $phpmailer->addAddress($email);
        $phpmailer->isHTML(true);
        $phpmailer->Subject = "Verify email";
        $phpmailer->Body    = "You will be subscribed to XKCD challenge after verifying!
        https://shavi1111.herokuapp.com/activate.php?email=$email&token=$token\n";
        if ($phpmailer->send()) {
            
        } else {
            echo '<div class="alert">
        <p> Something Went Wrong</p>
       </div>';
        }
    } catch (Exception $e) {
        echo '<div class="alert">
        <p> Something Went Wrong</p>
       </div>';
    }
} else {
    echo '<div class="alert">
    <p> You have already Subscribed to XKCD</p>
   </div>';
}
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <title>Subscribe Form</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 520px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.container {
  color:white;
}
    </style>
  </head>
  <body>
    
  <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="index.php" method ="POST">
        <h3>The Comic Mailer</h3>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" required name="email" class="form-control" id="email"  placeholder="Enter email" required>
            <small id="email" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
        <button type="submit" class="btn btn-primary">Subscribe</button>
       
<?php
if($showAlert)
 {
 echo " <div class='container'>
 <b>You Email is Sent. Please Verify your Email Address...</b>
</div>";
}

if($showError)
{
 echo " <div class='container'>
 <b>You Email is Not Sent. Enter your correct Email Address...</b>
</div>";
}
?>
    </form>
  
    <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
    </script>
  </body>
</html>