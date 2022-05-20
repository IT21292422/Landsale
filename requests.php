<?php
    session_start();
    require_once('php\controllers\requests-ctrl.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Requests</title>
    <link rel="stylesheet" href="styles/headerfooter.css"/>
    <link rel="stylesheet" href="styles\index.css">
</head>
<body>
    <?php
        include("php/templates/header.php");
    ?>

    <!--body-->
    <form class="search-form" action="requests.php">
        <input type="search" name="search" id="search">
        <input type="submit" value="Search">
    </form>


    <div class="card-container">
    <?php 
        if ($results)
        {
            foreach ($results as $cardData)
            {
                include('php\templates\request-card.php');
            }
        }
        else
        {
            echo "<h2>No results found</h2>";
        }
    ?>
    </div>


    <?php
        include("php/templates/footer.php");
    ?>
</body>
</html>