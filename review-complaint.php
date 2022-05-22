<?php
      //connecting to the DB
      require 'php/includes/dbcon.php';

      //checking for data availability
      if(isset($_GET['id']))
      {
        {
          $cID = $_GET["id"];

          //making sql query
          $sql = "SELECT * FROM request_complaints WHERE complaint_id=$cID";

          //getting sql results
          $result = $con->query($sql);

          //results in array
          $row= $result->fetch_assoc();
          
          //closing connection
          //$con->close();
          //echo var_dump($row);
        }
      }
      else{
        echo "Error loading Complaint!";
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
      <div class="reviewContainer ">

        <div class="cInfo"> Complaint ID: <?php echo $row["complaint_id"]?></div>
        <div class="cInfo"> Reported By: <?php echo $row["user_id"]?></div>
        <div class="cInfo"> Date of Complaint: <?php echo $row["create_date"]?></div>
        <hr>
        <div class="complaint"> Post ID: <?php echo $row["request_id"]?></div>
        <div class="complaint"> Complaint Type: <?php echo $row["complaint_type"]?></div>
        <div class="desc"> Description: <?php echo $row["description"]?></div>
        <hr>

        <label for="action">Select Action</label>
        <select name="action" id="mAction" title="Please Select an Action" required >
          <option value="warn">Warn User</option>
          <option value="suspend">Suspend User</option>
          <option value="ban">Ban User</option>
          <option value="noAction">Ignore</option>
        </select>

        <label for="reviewed"></label>
        <input type="button" id="reviewed" value="Mark as Reviewed">


      </div>
  </center> 
</body>

</html>
