<?php
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
            <h1>Land for Sale in Maharagama</h1>
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
        <input class='btn-simple' type='button' value='Save' id='btn-save' onclick='save()'>
        <input class='btn-simple hide' type='button' value='Saved' id='btn-unsave' onclick='unsave()'>

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
                <img class="avatar" src="images\profile\1.jfif">
                <p> Seller Name</p>
            </div>
            <div class="field-container">
                <div class="info-field">
                    <p>Contacts</p>
                    <p>032-8987873</p>
                </div>
                <div class="info-field">
                    <p>E-mail</p>
                    <p>something@gmail.com</p>
                </div>
                <div class="info-field">
                    <p>About</p>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi maiores non odit! Qui porro dolor sunt aperiam at sint libero earum? Ad unde a quam voluptates error accusamus facilis dolorum animi laboriosam libero nesciunt officia fugit incidunt, deleniti ea tenetur exercitationem, hic magnam dolores eaque ut doloremque iusto. Necessitatibus nam quo deleniti beatae consequatur temporibus molestias praesentium dicta aliquam veniam, iusto tenetur ad saepe laudantium recusandae soluta est, maxime dignissimos dolores sapiente excepturi minus! Facilis accusantium eaque maxime temporibus aut hic ratione iure ipsa quibusdam veritatis distinctio facere dolore quam, dignissimos repellendus vel consectetur praesentium quae recusandae eligendi nobis! Iste.</p>
                </div>
            </div>
            
        </div>
    </div>
    





    <?php
        include("php/templates/footer.php");
    ?>
</body>
</html>