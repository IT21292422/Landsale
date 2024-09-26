<!--IT21292668
Nimeth Herath
Center: Malabe
Group: MLB_05.02_09-->
<?php
require_once('../includes/dbcon.php');
//checking  if id is set or not then executing the given commands

if(isset($_GET['id'])){ // SQL injection fixed by using prepared statements

    $id = $_GET['id'];
    
    $sql = "DELETE FROM saved_sale WHERE sale_id = ?;";
    $sql .= "DELETE FROM sale_phone WHERE sale_id = ?;";
    $sql .= "DELETE FROM sale_media WHERE sale_id = ?;";
    $sql .= "DELETE FROM sale_complaints WHERE sale_id = ?;";
    $sql .= "DELETE FROM sale WHERE sale_id = ?;";
    
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param('iiiii', $id, $id, $id, $id, $id);
        
        if ($stmt->execute()) {
            echo "<script> alert('Deleted Successfully')</script>";
        } else {
            echo "<script> alert('Error: query was not Successful')</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script> alert('Error: could not prepare the query')</script>";
    }
} else {
    die('id is not provided correctly');
}

?>