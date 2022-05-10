<?php
    include("php/controllers/request-ctrl.php");
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
        view a request post
    -->
    <?php
        echo var_dump($values);
    ?>

    <?php
        include("php/templates/footer.php");
    ?>
</body>
</html>