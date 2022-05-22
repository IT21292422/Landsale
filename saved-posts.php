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


            //retrieving complaint data for sale posts
            $sql1="SELECT s.sale_id, title, location, c.description, city, district, province, price, land_area, address,
            cover_photo, type_id, s.user_id, c.create_date 
            FROM sale s, sale_complaints c 
            WHERE s.sale_id=c.sale_id;";


            //retrieving complaint data for request posts
            $sql2="SELECT r.request_id, title, location, c.description, city, district, province, max_price, min_price, max_area, min_area, distance,
            cover_photo, type_id, r.user_id, c.create_date 
            FROM request r, request_complaints c 
            WHERE r.request_id=c.request_id;";

            //executing query and storing data
            $sData=$con->query($sql1);
            $rData=$con->query($sql2);

            //getting results in array
            //$row= $rData->fetch_assoc();
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

            
            //if($rData->num_rows > 0 AND $row['r.user_id']=$_SESSION['user_id'])
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