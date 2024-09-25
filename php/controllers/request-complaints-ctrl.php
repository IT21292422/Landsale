<!--//Name: K.R.M.R.T. Karunarathna 
//IT Number: it21294198
//Center: Malabe
//Group: MLB_05.02_09
-->
<?php
require '../includes/dbcon.php';

echo $_GET["complaint_id"];
$sql1 = "DELETE FROM request_complaints WHERE complaint_id = ?";

// SQL injection fixed by using prepared statement
if ($stmt = $con->prepare($sql1)) {
    $stmt->bind_param("i", $_GET["complaint_id"]);
    
    if ($stmt->execute()) {
        
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }

    } else {
        echo '<script type="text/javascript">alert("Record was not deleted!!!");</script>';
        echo "Error deleting record: "; // fixed application error disclosure ( . mysqli_error($con))
    }
} else {
    
    echo '<script type="text/javascript">alert("Error preparing the query!!!");</script>';
}

?>