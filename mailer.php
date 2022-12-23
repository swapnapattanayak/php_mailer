<?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
    
  require 'vendor/autoload.php';
  require 'index.php';

    
  $mail = new PHPMailer(true);
  
  try {                                         
      $mail->Host       = 'smtp.gmail.com;';                    
      $mail->SMTPAuth   = true;                             
      $mail->Username   = 'phpassignmail@gmail.com';                 
      $mail->Password   = 'php1123!!';                        
      $mail->SMTPSecure = 'tls';                              
      $mail->Port       = 587;  
    
      $mail->setFrom('phpassignmail@gmail.com', 'Name');           
      $mail->addAddress('shavi12345789@gmail.com');
      $mail->addAddress('shavi12345789@gmail.com', 'Name');
         
      $url="https://imgs.xkcd.com/comics/woodpecker.png";
      $mail->isHTML(true);                                  
      $mail->Subject = 'Subject';
      $mail->Body    = 'Your <b>Images</b> are given below.. <br>
      <img src='. $url .' alt = "Comics are here"/>';
      $mail->AltBody = 'Body in plain text for non-HTML mail clients';

    //   $mail->AddEmbeddedImage('https://imgs.xkcd.com/comics/woodpecker.png', 'logo_2u');

  

      $photo_thumbnail_url = 'https://imgs.xkcd.com/comics/woodpecker.png';
$mail->addStringAttachment(file_get_contents($photo_thumbnail_url), 'selected.jpg');
      $mail->send();
      echo "Mail has been sent successfully!";
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
  ?>