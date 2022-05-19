<?php

$user_id=$_POST['user_id'];
$first_name=$_POST['first_name'];

// building the configaration settings
//$con= new mysqli("localhost","root","","landsale");

$result1=$con->connect_error;

if($result1){
    die("failed".$result1);
}

echo "connected!!!!!!!!!!";

$sql2="INSERT INTO complaint VALUES ('$user_id', '$first_name','$la')";

$result2=$con->query($sql2);

if($result2){
    echo "added!!!!!!!!";
}else {
    echo "failed!!!!!!!!!".$con->error;
}

$con->close();

?>