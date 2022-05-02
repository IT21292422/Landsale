<?php
    include("php/controllers/sale-ctrl.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Request Post</title>
</head>
<body>
    <?php
        include("php/templates/header.php");
    ?>

    <!--body
        view a sale post
    -->
    <?php
        echo var_dump($values);
    ?>

    <?php
        include("php/templates/footer.php");
    ?>
</body>
</html>