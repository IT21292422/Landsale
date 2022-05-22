<?php
require 'dbcon.php';
$request_id=$_GET['id'];
$sql="DELETE FROM request_phone WHERE request_id='$request_id';". "DELETE FROM request WHERE request_id='$request_id';";
if($con->multi_query($sql)){
    echo "Deleted successfully<br>";
    header("Location:owned-posts.php");
}else{
    echo "Error: ".$con->error;
}


?>
