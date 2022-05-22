<?php
      //connecting to the DB
      require 'php/includes/dbcon.php';

      //checking for data availability
      if(isset($_GET['id']))
      {
        {
          echo  "success";
          $_GET['id'];

          $cID = $GET["id"];

          //making sql query
          $sql = "SELECT * FROM request_complaints WHERE complaint_id=$cID";

          //getting sql results
          $result = $con->query($sql);

          //results in array
          $row= $result->fetch_assoc();
          
          //closing connection
          //$con->close();
          echo $row['complaint_id'];
        }
      }
      else{
        echo "error!";
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

        echo "<h4><?php echo" . $row['complaint_id'] . "</h4>";
        
?>
      </div>
  </center> 
</body>

</html>
