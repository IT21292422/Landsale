<!--//Name: K.R.M.R.T. Karunarathna 
//IT Number: it21294198
//Center: Malabe
//Group: MLB_05.02_09
-->
<?php

require '../includes/dbcon.php';

echo "Index of the Deleted recode is >>>> ";

$userId=$_GET["user_id"];

echo $userId;

    // deletes from whole data base
    // SQL injection fixed by using prepared statements
    $sql = "DELETE FROM saved_request WHERE request_id IN (SELECT request_id FROM request WHERE user_id = ?) OR user_id = ?;";
    $sql .= "DELETE FROM saved_sale WHERE sale_id IN (SELECT sale_id FROM sale WHERE user_id = ?) OR user_id = ?;";
    $sql .= "DELETE FROM request_complaints WHERE request_id IN (SELECT request_id FROM request WHERE user_id = ?) OR user_id = ?;";
    $sql .= "DELETE FROM sale_complaints WHERE sale_id IN (SELECT sale_id FROM sale WHERE user_id = ?) OR user_id = ?;";
    $sql .= "DELETE FROM request_phone WHERE request_id IN (SELECT request_id FROM request WHERE user_id = ?);";
    $sql .= "DELETE FROM sale_phone WHERE sale_id IN (SELECT sale_id FROM sale WHERE user_id = ?);";
    $sql .= "DELETE FROM sale_media WHERE sale_id IN (SELECT sale_id FROM sale WHERE user_id = ?);";
    $sql .= "DELETE FROM sale WHERE user_id = ?;";
    $sql .= "DELETE FROM request WHERE user_id = ?;";
    $sql .= "DELETE FROM users_phone WHERE user_id = ?;";
    $sql .= "DELETE FROM users_warnings WHERE user_id = ?;";
    $sql .= "DELETE FROM users WHERE user_id = ?;";
    
    $stmt = $con->prepare($sql);
    
    // binding
    $stmt->bind_param(
        "iiiiiiiiiiiiiii", 
        $userId, $userId, $userId, $userId, 
        $userId, $userId, $userId, $userId, 
        $userId, $userId, $userId, $userId, 
        $userId, $userId, $userId
    );
    
    if ($stmt->execute()) {
        echo "Deleted successfully<br>";
    } else {
        echo "Error in deleting"; // also fixed sending the default error (prev: echo "Error: ".$con->error)
    }
    
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

$con->close();

?>
