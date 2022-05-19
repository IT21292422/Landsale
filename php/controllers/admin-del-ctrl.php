<?php
   // require_once("php/includes/dbcon.php");

echo $_GET["id"];

$sql1 = "DELETE FROM complaint WHERE id='". $_GET["id"]."'";

if ($con->query($sql1)) {
    //echo "Record deleted successfully";
    echo '<script type="text/javascript">alert("Recode was deleted!!!");</script>';

} else {
    // goes to the error page
    echo "Error deleting record: " . mysqli_error($con);
}

?>