<?php

require '../includes/dbcon.php';


$userId=$_GET["user_id"];

echo $userId;

     $sql = "delete from saved_request where request_id in (select request_id from request where user_id = $userId) or user_id = $userId;".
            "delete from saved_sale where sale_id in (select sale_id from sale where user_id = $userId) or user_id = $userId;".
            "delete from request_complaints where request_id in (select request_id from request where user_id = $userId) or user_id = $userId;".
            "delete from sale_complaints where sale_id in (select sale_id from sale where user_id = $userId) or user_id = $userId;".
            "delete from request_phone where request_id in (select request_id from request where user_id = $userId);".
            "delete from sale_phone where sale_id in (select sale_id from sale where user_id = $userId);".
            "delete from sale_media where sale_id in (select sale_id from sale where user_id = $userId);".
            "delete from sale where user_id = $userId;".
            "delete from request where user_id = $userId;".
            "delete from users_phone where user_id = $userId;".
            "delete from users_warnings where user_id = $userId;".
            "delete from users where user_id = $userId;";


        $resul=$con->multi_query($sql);

if ($resul) {
    echo '<script type="text/javascript">alert("Recode was deleted!!!");</script>';

} else {
    // goes to the error page
    echo "Error deleting record: " . mysqli_error($con);
}

$con->close();

?>
