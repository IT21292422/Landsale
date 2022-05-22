<?php
      //connecting to the DB
      require 'php/includes/dbcon.php';

      //checking for data availability
      if(isset($_POST['complaint_id']))
      {
        {
          echo  "success";
          
          $cID = $_POST["complaint_id"];
          $desc = $_POST["description"];
          $pReviewed = $_POST["reviewed"];
          $type = $_POST["complaint_type"];
          $rPostID = $_POST["request_id "];
          $uID = $_POST["user_id"];
          $date = $_POST["create_date"];

          //making sql query
          $sql = "SELECT * FROM request_complaints WHERE complaint_id=$comlainr_id";

          //getting sql results
          $result = $con->query($sql);

          //results in array
          $row= $result->fetch_assoc();
          
          //closing connection
          //$con->close();
        }
      }
      else{
        echo "error!";
        echo $row['complaint_id'];
      }
?>

<!DOCTYPE html>
<html>

    <head>
        <?php include_once('php/includes/common-css-js.php'); ?>
    </head>
  
<body>

<style>

  table
  { 
    border-style: groove;
    border: 5px solid black;
  }

  tr{
  border: 5px solid black;
  border-right: 5px solid black;
}
</style>
  <?php

  //linking header
    include("php/templates/header.php");

  ?>

  <div>
    
  <center>
      <div class="reviewPage">
      <?php

        //echo "<h4><?php echo" . $row['complaint_id'] . "</h4>";
        
?>
      </div>
  </center> 
</body>

</html>
