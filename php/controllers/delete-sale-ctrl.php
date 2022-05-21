<!--NRH-->
<?php
require_once('../includes/dbcon.php');
//checking  if id is set or not then executing the given commands

if(isset($_GET['id'])){

    $id=$_GET['id'];
    $sql= "DELETE FROM sale WHERE sale_id = $id";
    if($con->query($sql)){
        echo "<script> alert ('Deleted Successfully')</script>";
        
    }
    else{
        echo "<script> alert ('Error: query was not Successful')</script>";
        echo sql;
    }
}
else{
    die('id is not provided correctly');
}

?>