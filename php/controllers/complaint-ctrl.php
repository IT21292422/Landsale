<?php
require_once("php/includes/dbcon.php");

echo $_GET["id"];

$sql1 = "DELETE FROM  WHERE id='". $_GET["id"]."'";

if ($con->query($sql1)) {
    
    if (isset($_SERVER["HTTP_REFERER"])){
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

} else {
    
    echo '<script type="text/javascript">alert("Recode was not deleted!!!");</script>';
    echo "Error deleting record: " . mysqli_error($con);
}

?>
