<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php include_once('php/includes/common-css-js.php'); ?>
    
</head>
<body>
    <?php
        include("php/templates/header.php");
    ?>

    <style>
        .bread{

        }
    </style>
    <div class="bread"><a style="text-decoration: none;" href="index.php">Home</a> => About</div>

    <div class="mainpage">
        <h2>About Us</h2>
        <p>Our approach gives our users a better
experience when they intend to find or sell
their land without having another
third party person or company.</p>
    </div>

    <div class="mainpage">
        <h2>Contact Us</h2>
        <span>E-mail :</span>
        <span>Phone :</span>
        <span>Social media :</span>
    </div>

    <div class="mainpage">
        <h2>Terms and Conditions</h2>
        <p>Illegal activities are prohibited and if someone have commited those will be penalized under the civil law.</p>
    </div>

    <?php
        include("php/templates/footer.php");
    ?>
</body>
</html>