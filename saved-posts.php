<?php
      //connecting to the DB
      require 'php/includes/dbcon.php';
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

  //retrieving saved post data from the DB
  $sql1="SELECT sale_id, user_id FROM saved_sale";
  $sql2="SELECT request_id, user_id FROM saved_request";

  $sData=$con->query($sql1);
  $rData=$con->query($sql2);


  ?>

  <div class="reviewPage" >
    <center>
        <table class="table">
          <tr> <!--ading -->
            <?php 

            if($sData->num_rows > 0)
            {
                //printing table frow qureied data
                echo "<th class=\"heading1\">Reported User ID</th>";
                echo "<th class=\"heading1\">Reported Post ID</th>";
                echo "</tr>";

                while($sRows = $sData->fetch_assoc())
                {
                    $sID=$sRows['sale_id'];

                    echo "<tr>";
                    echo "<td  class=\"rows\">".$sRows["user_id"]."</td>";

                    echo "<td  class=\"rows\">".$sRows["sale_id"];  
                            //echo "<a href='sale.php?id=1'>view</a>";
                            //echo "<a href='sale.php?id=.$sID>view</a>";
                            echo "<a href='sale.php?id={$sID}'>view</a>";
                            "</td>";

                    echo "<br/>";
                    echo "</tr>";
                }
                    echo "<td colspan=\"2\">";
                while($rRows = $rData->fetch_assoc())
                {
                    $rID=$rRows['request_id'];

                    echo "<tr>";
                    echo "<td  class=\"rows\">".$rRows["user_id"]."</td>";
                    echo "<td  class=\"rows\">".$rRows["request_id"];
                            echo "<a href='request.php?id={$rID}'>view</a>";
                            "</td>";

                    echo "<br/>";
                    echo "</tr>";
                }
            }
              else
              {
                echo "<br/>This table is currently empty<br/>";
              }
            
          ?>
        </table>
    </center>  
  
  </div>

</body>

</html>

