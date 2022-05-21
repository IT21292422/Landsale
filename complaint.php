<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" >
    <?php include_once('php/includes/common-css-js.php'); ?>
    <title>Complaints</title>
</head>
<body>
   
<style>
        .texts{
            text-align: center;
        }
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

//Sale table
$sql1="SELECT complaint_id,description,reviewed,complaint_type,request_id,user_id,create_date FROM request_complaints ";

$result2=$con->query($sql1);

//Shows the Sale table details
if ($result2->num_rows > 0) {

    echo("<h1 class='texts'>Sale Complaints</h1>");
    
    echo("<table class='table1'>");

    echo("<th>Complaint ID</th>");
    echo("<th>Complaint Type</th>");
    echo("<th>Sale ID</th>");
   // echo("<th>Created date</th>");
    echo("<th>User ID</th>");
    echo("<th>Description</th>");
    echo("<th>Reviewed</th>");
    echo("<th>Action</th>");

    while($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["complaint_id"]."</td>";
        echo "<td>".$row["complaint_type"]."</td>";
        echo "<td>".$row["request_id"]."</td>";
       // echo "<td>".$row["create date"]."</td>";
        echo "<td>".$row["user_id"]."</td>";
        echo "<td>".$row["description"]."</td>";
        echo "<td>".$row["reviewed"]."</td>";
        echo "<th>delete</th>";
        echo "</tr>";
    }
    echo ("</table>");

    }else{
        echo ('<h1 class="warnings">The Sale complaint table is empty</h1>');
    }

//$con->close();

echo "<hr>";

/////////////////////////////////////////////////////////////////////////////
include_once 'php\includes\dbcon.php';

//Request table
$sql1="SELECT complaint_id,description,reviewed,complaint_type,sale_id,user_id,create_date FROM sale_complaints ";

$result2=$con->query($sql1);

//Shows the Request table details
if ($result2->num_rows > 0) {

    echo("<h1 class='texts'>Request Complaints</h1>");
    
    echo("<table class='table1'>");

    echo("<th>Complaint ID</th>");
    echo("<th>Complaint Type</th>");
    echo("<th>Sale ID</th>");
   // echo("<th>Created date</th>");
    echo("<th>User ID</th>");
    echo("<th>Description</th>");
    echo("<th>Reviewed</th>");
    echo("<th>Action</th>");

    while($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["complaint_id"]."</td>";
        echo "<td>".$row["complaint_type"]."</td>";
        echo "<td>".$row["sale_id"]."</td>";
       // echo "<td>".$row["create date"]."</td>";
        echo "<td>".$row["user_id"]."</td>";
        echo "<td>".$row["description"]."</td>";
        echo "<td>".$row["reviewed"]."</td>";
        echo "<th>delete</th>";
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