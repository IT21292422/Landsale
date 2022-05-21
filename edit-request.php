<?php
require 'php/includes/dbcon.php';
$target_dir = "images/request/";
$target_file = $target_dir . basename($_FILES["coverphoto"]["name"]);
if (isset($_FILES["coverphoto"])){
    if (move_uploaded_file($_FILES["coverphoto"]["tmp_name"], $target_file)){
       // echo "The file ".basename($_FILES["coverphoto"]["name"])." is uploaded";
    }
    else {
        echo "Error while uploading your file.";
    }
}
else {
    echo "File not available";
}

$title=$_POST["title"];
$location=$_POST["location"];
$description=$_POST["description"];
$city=$_POST["city"];
$district=$_POST["district"];
$province=$_POST["province"];
$max_price=$_POST["max_price"];
$min_price=$_POST["min_price"];
$max_area=$_POST["max_area"];
$min_area=$_POST["min_area"];
$distance=$_POST["distance"];
$type_id=1;
$user_id=$_GET['id'];
$create_date="5-4-2022";

$sql="UPDATE request SET title='$title',location='$location',description='$description',city='$city',district='$district',province='$province',max_price='$max_price',min_price='$min_price',max_area='max_area',min_area='$min_area',distance='$distance',cover_photo='$target_file' WHERE user_id='$user_id'";
if($con->query($sql))
{
    echo "Form Updated Successfully";
    header("Location:owned-posts.php");
}
else 
{
    echo "Error: ".$con->error;
}

?>