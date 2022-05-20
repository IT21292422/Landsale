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
   
<style>
        .table1 th{
            padding: 10px;
            background-color: rosybrown;
        }
        .table1 tr{
            inline-size: auto;
            overflow-wrap: break-all;
        }
        .delete1{
            background-color:rgba(221, 0, 0, 0.7) ;
        }
        .delete1:hover{
            background-color:rgba(0, 0, 200, 0.9) ;
        }
        .table1{
            padding: 20px;
            margin-bottom: 20px;
            width:auto;
            border:solid 5px #F1F1F1;
            margin-right: auto;
            margin-left: auto;
            text-align: center;
            background-color:rgba(220, 220, 220, 0.7);
            border-collapse: collapse;
        }
        .table1 tr:nth-child(even){
            background-color: beige;
        }
    </style>

    <?php

        include("php/templates/header.php");

include_once 'php\includes\dbcon.php';

//Request table
$sql1="SELECT complaint_id,description,reviewed,complaint_type,sale_id,user_id,create_date FROM sale_complaints";

$result2=$con->query($sql1);

//Shows the Request table details
if ($result2->num_rows > 0) {

    echo("<h1>Request Complaints</h1>");
    
    echo("<table class='table1'>");

    echo("<th>Complaint ID</th>");
    echo("<th>Reviewed</th>");
    echo("<th>Created date</th>");
    echo("<th>Complaint Type</th>");
    echo("<th></th>");
    echo("<th>Description</th>");
    echo("<th>Action</th>");

    while($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["complaint_id"]."</td>";
        echo "<td>".$row["user_id"]."</td>";
        echo "<td>".$row["date"]."</td>";
        echo "<td>".$row["type"]."</td>";
        echo "<td>".$row["review"]."</td>";
        echo "<td>".$row["description"]."</td>";
        ?>
        <td><a class="delete1" href="php\controllers\complaint-ctrl.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
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
    
    echo("<table class='table1'>");

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
        echo "<td>".$row["review"]."</td>";
        echo "<td>".$row["description"]."</td>";
        ?>
        <td><a class="delete1" href="php\controllers\complaint-ctrl.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
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