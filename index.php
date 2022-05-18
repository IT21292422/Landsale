<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="styles/headerfooter.css"/>
</head>
<body>
    <?php
        include("php/templates/header.php");
    ?>

    <!--body-->
    <div class="mainpage">
    <p>
        <a href="about.php" style="color: red; padding:10px;">about</a><br>
        <a href="account.php" style="color: red; padding:10px;">account</a><br>
        <a href="admin.php" style="color: red; padding:10px;">admin</a><br>
        <a href="complaint.php" style="color: red; padding:10px;">complaint</a><br>
        <a href="complaints.php" style="color: red; padding:10px;">complaints</a><br>
        <a href="register.php" style="color: red; padding:10px;">register</a><br>
        <a href="request.php" style="color: red; padding:10px;">request</a><br>
        <a href="requests.php" style="color: red; padding:10px;">requests</a><br>
        <a href="sale.php" style="color: red; padding:10px;">sale</a><br>
        <a href="save-request.php" style="color: red; padding:10px;">save-request</a><br>
        <a href="save-sale.php" style="color: red; padding:10px;">save-sale</a><br>
        <a href="signin.php" style="color: red; padding:10px;">signin</a><br>
        <a href="submit-request-complaint.php" style="color: red; padding:10px;">submit-request-comp</a><br>
        <a href="submit-request.php" style="color: red; padding:10px;">submit-request</a><br>
        <a href="submit-sale-complaint.php" style="color: red; padding:10px;">submit-sale-comp</a><br>
        <a href="submit-sale.php" style="color: red; padding:10px;">submit-sale</a><br>
    </p>
    </div>

    <?php 
        session_start();
        echo var_dump($_SESSION);
     ?>

    <?php
        include("php/templates/footer.php");
    ?>
</body>
</html>