<?php session_start(); ?>
<!--NRH-->
<?php
require 'php/includes/dbcon.php';//connecting to the database

//getting the values typed in the form to variables 
$stitle =$_POST["stitle"];
$sloc =$_POST["slocation"];
$sdesc =$_POST["sdescript"];
$scity =$_POST["scity"];
$sdist =$_POST["sdistrict"];
$sprovince =$_POST["sprovince"];
$sprice =$_POST["sprice"];
$sarea =$_POST["slandarea"];
$saddress =$_POST["saddress"];
$sphoto =$_POST["sphoto"];
$fk1="1";
$fk2="2";
//inserting data into table in order of columns 
$sql = "INSERT INTO sale (title,location,description,city,district,province,price,land_area,address,cover_photo,type_id,user_id)   VALUES ('$stitle' ,'$sloc' ,'$sdesc' ,'$scity' ,'$sdist','$sprovince','$sprice','$sarea','$saddress' ,'$sphoto','$fk1','$fk2')";
//checking if query excuted or not
if($con->query($sql)){
    echo "<script> alert ('Added Successfully')</script>";
}
else{
    echo "<script> alert ('Error: query was not Successful')</script>";
    echo sql;
}

?>