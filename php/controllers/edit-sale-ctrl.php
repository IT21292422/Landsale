<!--IT21292668
Nimeth Herath
Center: Malabe
Group: MLB_05.02_09-->
<?php
require_once('../includes/dbcon.php');

//id must be valid and not null 
if(isset($_GET['id']) ){

    $id = $_GET['id'];
    $stitle = $_POST['stitle'];
    $sloc = $_POST["slocation"];
    $sdesc = $_POST["sdescript"];
    $scity = $_POST["scity"];
    $sdist = $_POST["sdistrict"];
    $sprovince = $_POST["sprovince"];
    $sprice = $_POST["sprice"];
    $sarea = $_POST["slandarea"];
    $saddress = $_POST["saddress"];
    $sphoto = $_POST["sphoto"];

    // SQL injection fixed by using prepared statement
    $sql = "UPDATE `sale` SET `title`=?, `location`=?, `description`=?, 
    `city`=?, `district`=?, `province`=?, `price`=?, `land_area`=?, 
    `address`=?, `cover_photo`=? WHERE sale_id=?";

    if ($stmt = $con->prepare($sql)) {
        // SQL injection fixed by using prepared statement
        $stmt->bind_param("ssssssssssi", $stitle, $sloc, $sdesc, $scity, $sdist, $sprovince, $sprice, $sarea, $saddress, $sphoto, $id);

        if ($stmt->execute()) {
            echo "<script> alert('Updated Successfully')</script>";
        } else {
            echo "<script> alert('Error: query was not Successful')</script>";
        }
        $stmt->close();

    } else {
        echo "<script> alert('Error: could not prepare query')</script>";
    }
} else {
    echo "Invalid";
}
?>