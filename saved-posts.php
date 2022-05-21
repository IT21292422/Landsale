<?php session_start(); ?>
<?php
      //connecting to the DB
      require 'php/includes/dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('php/includes/common-css-js.php'); ?>
    <link rel="stylesheet" href="styles\index.css">
</head>

<body>
    <?php
            //linking header
            include("php/templates/header.php");

            //retrieving saved post data from the DB
            //$sql1="SELECT sale_id, user_id FROM saved_sale";


            //retrieving data from sale and request tables
            $sql1="SELECT sale_id, title, location, description, city, district, province, price, land_area, address,
            cover_photo, type_id, user_id, create_date FROM sale";

            $sql2="SELECT request_id, title, location, description, city, district, province, max_price,
            min_price, max_area, min_area, distance, cover_photo, type_id, user_id, create_date FROM request";

            //executing query
            $sData=$con->query($sql1);
            $rData=$con->query($sql2);
    ?>
    <div class="card-container">
        <?php 

            if($sData->num_rows > 0)
 
                //printing sale data as cards
                foreach ($sData as $cardData)
                {
                    include('php\templates\sale-card.php');
                }
            else
            {
                echo "No Data";
            }

            if($rData->num_rows > 0)

                //printing request data as cards
                foreach ($rData as $cardData)
                {
                    include('php\templates\request-card.php');
                }
            else
            {
                echo "No Data";
            }
        ?>

    </div>
</body>




</html>