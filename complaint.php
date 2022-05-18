<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" >
    <link rel="stylesheet" href="styles/headerfooter.css"/>
    <title>Document</title>
</head>
<body>
    
    <?php

        include("php/templates/header.php");

include_once 'php\includes\dbcon.php';

//Request table
$sql1="SELECT id,user_id,date,type,review,description FROM complaint";

$result2=$con->query($sql1);

//Shows the Request table details
if ($result2->num_rows > 0) {

    echo("<h1>Request Complaints</h1>");
    
    echo("<table border='1'>");

    echo("<th>ID</th>");
    echo("<th>User ID</th>");
    echo("<th>Created date</th>");
    echo("<th>Type</th>");
    echo("<th>Review</th>");
    echo("<th>Description</th>");
    echo("<th>Action</th>");

    while($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["user_id"]."</td>";
        echo "<td>".$row["date"]."</td>";
        echo "<td>".$row["type"]."</td>";
        echo "<th>".$row["review"]."</th>";
        echo "<th>".$row["description"]."</th>";
        ?>
        <td><a href="php\controllers\complaint-ctrl.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
        <?php
        echo "</tr>";
    }
    echo ("</table>");

    }else{
        echo ('<h1 class="warnings">The Request complaint table is empty</h1>');
    }
////////////////////////////////////////////////////////////
    //Sales table
    $sql1="SELECT id,user_id,date,type,review,description FROM complaint";

$result2=$con->query($sql1);

//Shows the Request table details
if ($result2->num_rows > 0) {

    echo("<h1>Sale Complaints</h1>");
    
    echo("<table border='1'>");

    echo("<th>ID</th>");
    echo("<th>User ID</th>");
    echo("<th>Created date</th>");
    echo("<th>Type</th>");
    echo("<th>Review</th>");
    echo("<th>Description</th>");
    echo("<th>Action</th>");

    while($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["user_id"]."</td>";
        echo "<td>".$row["date"]."</td>";
        echo "<td>".$row["type"]."</td>";
        echo "<th>".$row["review"]."</th>";
        echo "<th>".$row["description"]."</th>";
        ?>
        <td><a href="php\controllers\complaint-ctrl.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
        <?php
        echo "</tr>";
    }
    echo ("</table>");

    }else{
        echo ('<h1 class="warnings">The Request complaint table is empty</h1>');
    }

$con->close();
        include("php/templates/footer.php");
    ?>

</body>
</html>