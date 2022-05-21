<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Details</title>
    <?php include_once('php/includes/common-css-js.php'); ?>
    <link rel="stylesheet" href="styles/sale-request.css">
    
</head>
<body>
    <?php
        include("php/templates/header.php");
    ?>
<?Php
$id=$_GET['id'];
// Checking data it is a number or not
if(!is_numeric($id)){
echo "ID must be a integer";
exit;
}
// MySQL connection string
include 'php/includes/dbcon.php'; 

$path="SELECT*FROM users where user_id=?";

if($stmt = $con->prepare($path)){
  $stmt->bind_param('i',$id);
  $stmt->execute();

 $result = $stmt->get_result();
 $value=$result->fetch_object();

}else{
    echo $connection->error;
    }
 ?>
 

 <img  src="<?php echo $value->profile_photo ?>">

<h3>
  <p> Name :
    <?php  echo $value->first_name ?>
    <?php  echo " " ?>
    <?php  echo  $value->last_name ?>
  </p>
</h3>
<h3>
  <p> Email :
    <?php  echo $value->email?>
  </p>
</h3>
<h3>
  <p> About :
    <?php  echo $value->about?>
  </p>
</h3>


<?php
include 'php/includes/dbcon.php';
$path1="SELECT*FROM users_phone where user_id=?";
if($stmt = $con->prepare($path1)){
    $stmt->bind_param('i',$id);
     $stmt->execute();
     $result1 = $stmt->get_result();
     $value1=$result1->fetch_object();
  
  }else{
      echo $connection->error;
      }
      ?>
<p> Contact Number :
    <?php  echo $value1->phone ?>
 </p>

    <?php
        include("php/templates/footer.php");
    ?>
</body>
</html>