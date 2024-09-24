<!--IT21292668
Nimeth Herath
Center: Malabe
Group: MLB_05.02_09-->
<?php
    // refactored the whole file to fix SQL injections issues
    require 'dbcon.php';
    $id = $_GET['id'];

    $sql1 = "DELETE FROM saved_sale WHERE sale_id=?";
    $stmt1 = $con->prepare($sql1);
    $stmt1->bind_param('i', $id);
    $stmt1->execute();

    $sql2 = "DELETE FROM sale_phone WHERE sale_id=?";
    $stmt2 = $con->prepare($sql2);
    $stmt2->bind_param('i', $id);
    $stmt2->execute();

    $sql3 = "DELETE FROM sale_media WHERE sale_id=?";
    $stmt3 = $con->prepare($sql3);
    $stmt3->bind_param('i', $id);
    $stmt3->execute();

    $sql4 = "DELETE FROM sale_complaints WHERE sale_id=?";
    $stmt4 = $con->prepare($sql4);
    $stmt4->bind_param('i', $id);
    $stmt4->execute();

    $sql5 = "DELETE FROM sale WHERE sale_id=?";
    $stmt5 = $con->prepare($sql5);
    $stmt5->bind_param('i', $id);
    $stmt5->execute();

    if ($stmt1->affected_rows > 0 || $stmt2->affected_rows > 0 || $stmt3->affected_rows > 0 || $stmt4->affected_rows > 0 || $stmt5->affected_rows > 0) {
        echo "Deleted successfully<br>";
    } else {
        // also fixed sending the default error (prev: echo "Error: ".$con->error)
        echo "No records found to delete.<br>";
    }
?>
