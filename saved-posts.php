<?php
      //connecting to the DB
      require 'php/includes/dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('php/includes/common-css-js.php'); ?>
    <link rel="stylesheet" href="styles\index.css">;
</head>
<!--incompleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeete-->
<body>
    <?php
            //linking header
            include("php/templates/header.php");

            //retrieving saved post data from the DB
            $sql1="SELECT sale_id, user_id FROM saved_sale";
            $sql2="SELECT request_id, user_id FROM saved_request";

            $sData=$con->query($sql1);
            $rData=$con->query($sql2);
    ?>
    <div class="card-container">
        <?php 

            if($sData->num_rows > 0)

                foreach ($sData as $cardData)
                {
                    include('php\templates\sale-card.php');
                }
            else
            {
                echo "No Data";
            }
        ?>

    </div>
</body>




</html>