<?php 
    session_start([
        'cookie_lifetime' => 0, // Session lasts until browser is closed
        'cookie_httponly' => true, // Prevents JavaScript access to the session cookie
        'cookie_secure' => true,  // Ensures the cookie is only sent over HTTPS
        'cookie_samesite' => 'Lax', // Helps mitigate CSRF attacks
    ]);
?>

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

    <div class="mainpage">
        <h2>About Us</h2>
        <p>Our approach gives our users a better
experience when they intend to find or sell
their land without having another
third party person or company.</p>
    </div>

    <div class="mainpage">
        <h2>Contact Us</h2>
        <p>
        <span>E-mail : goldenlands@gmil.com</span><br>
        <span>Phone (Admin): 077-6543784</span><br>
        <span>Phone (Moderator): 077-2369878</span><br>
        <span>Social media (Whatsapp or Telegram): 076-4365879</span>
    </P>
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