<?php
    session_start();
    include("php/controllers/sale-ctrl.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sale Post</title>
    <link rel="stylesheet" href="styles/sale.css">
    <script src="js/sale.js"></script>
</head>
<body>
    <?php
        include("php/templates/header.php");
    ?>

    <form class='hide' id="save-form">
        <input type="text" name="sale_id" value="<?php echo $values['sale_id'] ?>">
        <input type="text" name="action" value="save">
    </form>

    <form class='hide' id="unsave-form">
        <input type="text" name="sale_id" value="<?php echo $values['sale_id'] ?>">
        <input type="text" name="action" value="unsave">
    </form>

    <div class="popup-container" id="report-post">
        <h2>Report Post</h2>
        <form class="simple-form" id="report-form">
            <label for="complaint_type">Reason</label>
            <select name='complaint_type' id="complaint_type">
                <option value="false advertisement">False advertisement</option>
                <option value="spam and abuse">Spam and abuse</option>
                <option value="false information">False information</option>
                <option value="transaction denial">Transaction denial</option>
            </select>
            <label for="description">Description</label>
            <textarea type="text" name='description' id="description" rows="7"></textarea>
            <input type="hidden" name='sale_id' value="1">
        </form>
        <input class="btn-report" type="button" value="Submit" onclick="submitReport()">
        <input class="btn-report" type="button" value="Cancel" id="cancel-report" onclick="hideReportForm()">
    </div>       

    <div class="popup-container" id="report-success">
        <h2>Report Successful!</h2>
        <h3>Thank you for the support</h3>
        <input class="btn-report" type="button" value="Close" id="close-success" onclick="hideReportSuccess()">
    </div>

    <div class="container" id="container">
        <div class="title">
            <h1><?php echo $values['title'] ?></h1>
        </div>

        <div class="images">
            <div class="slide-show">
            <input class="btn-image btn-left" type="button" id="left" value="❮">

            <img class="image" src="images/sale/1.jpg">
            <img class="image" src="./Sale Post_files/1(1).jpg"><img class="image" src="./Sale Post_files/2.jpg"><img class="image" src="./Sale Post_files/3.jpg"><img class="image" src="./Sale Post_files/4.jpg">           
            <input class="btn-image btn-right" type="button" id="left" value="❯">

            </div>
        </div>

                    
        <div class="btn-container">
        <input class='btn-simple' type='button' value='Report' onclick='showReportForm()'>

        <?php 
            if ($values['saved'])
            {
                echo "<input class='btn-simple' type='button' value='Saved' id='btn-unsave' onclick='unsave()'>";
                echo "<input class='btn-simple hide' type='button' value='Save' id='btn-save' onclick='save()'>";
            }
            else
            {
                echo "<input class='btn-simple ' type='button' value='Saved' id='btn-unsave' onclick='unsave()'>";
                echo "<input class='btn-simple hide' type='button' value='Save' id='btn-save' onclick='save()'>";
            }
        ?>

        </div>
    
        <div class="info">
            <h3>Details</h3>
            <div class="field-container">
                <div class="info-field">
                    <p>Land Area</p>
                    <p><?php echo $values['land_area']?> Perches</p>
                </div>
                <div class="info-field">
                    <p>Price</p>
                    <p>Rs. <?php echo $values['price']?></p>
                </div>
                <div class="info-field">
                    <p>City</p>
                    <p><?php echo $values['city']?></p>
                </div>
                <div class="info-field">
                    <p>District</p>
                    <p><?php echo $values['district']?></p>
                </div>
                <div class="info-field">
                    <p>Province</p>
                    <p><?php echo $values['province']?></p>
                </div>
                <div class="info-field">
                    <p>Address</p>
                    <p><?php echo $values['address']?></p>
                </div>
            </div>
        </div>

        <div class="description">
            <h3>Description</h3>
            <p><?php echo $values['description']?> </p>
        </div>

        <div class="contacts">
            <h3>Contacts</h3>
            <div class="field-container">
            <?php 
                foreach ($values['phone'] as $contact)
                {
                    echo "<div><p>$contact</p></div>";
                }
            ?> 
            </div>
        </div>

        <div class="user">
            <h3>Seller</h3>
            <div class="profile">
                <img class="avatar" src="<?php echo $values['seller']['profile_photo'] ?>">
                <p> <?php echo $values['seller']['first_name'] . $values['seller']['last_name'] ?></p>
            </div>
            <div class="field-container">
                <div class="info-field">
                    <p>Contacts</p>
                    <p><?php echo $values['seller']['contact'] ?></p>
                </div>
                <div class="info-field">
                    <p>E-mail</p>
                    <p><?php echo $values['seller']['email'] ?></p>
                </div>
                <div class="info-field">
                    <p>About</p>
                    <p><?php echo $values['seller']['about'] ?></p>
                </div>
            </div>
            
        </div>
    </div>

    <?php
        echo var_dump($values);
        include("php/templates/footer.php");
    ?>
</body>
</html>