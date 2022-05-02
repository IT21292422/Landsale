<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
</head>
<body>
    <?php
        include("php/templates/header.php");
    ?>

    <!--body-->

    <?php 
        session_start();
        echo var_dump($_SESSION);
     ?>

    <?php
        include("php/templates/footer.php");
    ?>
</body>
</html>