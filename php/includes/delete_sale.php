<?php
require 'dbcon.php';
$sale_id=$_GET['id'];
$sql="DELETE FROM sale_phone WHERE sale_id='$sale_id';". 
"DELETE FROM sale_complaints WHERE sale_id='$sale_id';".
"DELETE FROM saved_sale WHERE sale_id='$sale_id';".
"DELETE FROM sale_phone WHERE sale_id='$sale_id';".
"DELETE FROM sale_media WHERE sale_id='$sale_id';";
"DELETE FROM sale WHERE sale_id='$sale_id';";
if($con->multi_query($sql)){
    echo "Deleted successfully<br>";
}else{
    echo "Error: ".$con->error;
}

?>
