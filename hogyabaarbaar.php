<?php
include '_dbconnect.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="index.css"> -->
    <script>
    </script>
<style media="screen">
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #080710;
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#1845ad,
                    #23a2f6);
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background: linear-gradient(to right,
                    #ff512f,
                    #f09819);
            right: -30px;
            bottom: -80px;
        }

        form {
            height: 520px;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        button {
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
            color: white;
        }
    </style>

    <title>Unsubscribed
    </title>
</head>

<body>
<?php

$mailbhej = $_GET['email'];
echo $mailbhej;
$tokenbhej = $_GET['token'];
echo $tokenbhej;

if ( $mailbhej) {
    
    $indexPage = "https://shavi1111.herokuapp.com/index.php";
    $sql = "UPDATE `shavi` SET `active` = '0' WHERE `shavi`.`email` = '$mailbhej' AND `shavi`. `token` = '$tokenbhej'";
    
    $sqldel = "DELETE FROM `shavi` WHERE `shavi`.`email` = '$mailbhej' AND `shavi` . `token` = '$tokenbhej'";
    
    $result = mysqli_query($conn, $sql);
    echo $result;
    $resultDel = mysqli_query($conn, $sqldel);
    echo $resultDel;
    // session_unset();
    // session_destroy();
    
    if ($result){
       echo '<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="index.php" method="POST">
        <h3>The Comic Mailer</h3>

        <div class="form-group">
            <h4> Ohhhh!! You have Unsubscribed Our Comic.</h4><br>
            <h4> Now you are not able to read it again....</h4><br>
            <h4> Subscribe it again if you want to read it!....</h4><br>
            <h3>Thank You!</h3>
        </div>
        <button type="submit" class="btn btn-primary">Subscribe</button>';

    }

}
?>


</form> 


</body>

</html>