<?php
    // refactored the whole file to fix SQL injections issues
    require 'dbcon.php';
    $request_id = $_GET['id'];

    $sql1 = "DELETE FROM request_phone WHERE request_id=?";
    $sql2 = "DELETE FROM saved_request WHERE request_id=?";
    $sql3 = "DELETE FROM request WHERE request_id=?";

    $stmt1 = $con->prepare($sql1);
    $stmt1->bind_param('i', $request_id);
    $stmt1->execute();

    $stmt2 = $con->prepare($sql2);
    $stmt2->bind_param('i', $request_id);
    $stmt2->execute();

    $stmt3 = $con->prepare($sql3);
    $stmt3->bind_param('i', $request_id);
    $stmt3->execute();

    if ($stmt1->affected_rows > 0 || $stmt2->affected_rows > 0 || $stmt3->affected_rows > 0) {
        echo "Deleted successfully<br>";
    } else {
        // also fixed sending the default error (prev: echo "Error: ".$con->error)
        echo "No records found to delete.<br>";
}
?>
