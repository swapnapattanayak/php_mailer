<?php
// session_start();
include '_dbconnect.php';
require("vendor/autoload.php");
require_once("mailerphp/PHPMailer.php");
require_once("mailerphp/SMTP.php");
require_once("mailerphp/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
?>

<?php

$sql = "SELECT * FROM `shavi` WHERE active = '1'";
$sss = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($sss)) {

    $email = $row['email'];
    $token = $row['token'];
    $indexPage = "https://shavi1111.herokuapp.com/index.php";
    // $email = $_SESSION['email'];
    $rand_comic = rand(0, 1000);
    $api_url    = 'http://xkcd.com/' . $rand_comic . '/info.0.json';
    $json_data = file_get_contents($api_url);
    $comic = json_decode($json_data);
    $title = 'Your New Comic : ' . $comic->safe_title;
    $name = $comic->title;
    $img = $comic->img;
    $subject = "$comic->title";
    $urlun = "https://shavi1111.herokuapp.com/hogyabaarbaar.php?email=$email&token=$token";
    $mailersend = new PHPMailer(true);
    $mailersend->isSMTP();
    $mailersend->SMTPAuth = true;
    $mailersend->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mailersend->Host = "smtp.gmail.com";
    $mailersend->Port = "587";
    $mailersend->Username = "phpassignmail@gmail.com";
    $mailersend->Password = "php1123!!";
    $mailersend->setFrom("phpassignmail@gmail.com");
    $mailersend->addAddress($email);
    $mailersend->isHTML(true);
    $mailersend->Subject = "New Comic Arrived...";
    $mailersend->Body = '
    <p>Hello User!</p>
    The comic you have subscribed is here.
    Enjoy :)
    <h3>' . $comic->safe_title . "</h3>
    <img src='" . $comic->img . "' alt='some comic hehe'/>
<br />
Click here to read - <a target='_blank' href='https://xkcd.com/" . $comic->num . "'>Click here</a><br /> 
Click here to unsubscribe - <a target='_blank' href='" . $urlun . "'>Click here</a><br />";
    $mailersend->addStringAttachment(file_get_contents($img), "$subject.jpg");
    $mailersend->send();
}

?>