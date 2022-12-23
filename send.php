<?php
// $email = "shavi12345789@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi User, Click the given link to activate your email.. http://localhost/mail-xkcd/activate.php?token=$token";
$headers = "From: phpassignmail@gmail.com";

if (mail($email, $subject, $body, $headers)) {
    echo " Email successfully sent to $email...";
} 
else  
{
    echo "Email sending failed...";
}
?>