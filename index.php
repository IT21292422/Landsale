<?php
    session_start();
    require_once('php\controllers\index-ctrl.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="styles/headerfooter.css"/>
    <link rel="stylesheet" href="styles\index.css">
</head>
<body>
    <?php
        include("php/templates/header.php");
    ?>

    <!--body-->
    <form class="search-form" action="index.php">
        <input type="search" name="search" id="search">
        <input type="submit" value="Search">
    </form>


    <div class="card-container">
    <?php 
        if ($results)
        {
            foreach ($results as $cardData)
            {
                include('php\templates\sale-card.php');
            }
        }
        else
        {
            echo "<h2>No results found</h2>";
        }
    ?>
    </div>
<!--
<div><a href="admin.php">Admin</a></div>
<div><a href="complaints.php">complaint</a></div>
    -->
    <?php
        include("php/templates/footer.php");
    ?>
</body>
</html>