<?php

require '../includes/dbcon.php';
//echo $_GET["id"];

$sql2 = "DELETE FROM users WHERE user_id=". $_GET["id"]."";

if ($con->query($sql2)) {
    //echo "Record deleted successfully";
    echo '<script type="text/javascript">alert("Recode was deleted!!!");</script>';

} else {
    // goes to the error page
    echo "Error deleting record: " . mysqli_error($con);
}

$con->close();

?>
