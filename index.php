<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
</head>
<body>
    <?php
        include("templates/header.php");
    ?>

    <!--body-->

    <?php 
        session_start();
        echo var_dump($_SESSION);
     ?>

    <?php
        include("templates/footer.php");
    ?>
</body>
</html>