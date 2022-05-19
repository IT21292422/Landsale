<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/headerfooter.css"/>
    <title>Document</title>
</head>
<body>

  <?php
        include("php/templates/header.php");
        ?> 
    <style>
       .hcenter{
           width:550px;
            padding: 2em 0 2em 0;
            border:solid 5px #F1F1F1;
            margin-top: 10px;
            margin-right: auto;
            margin-bottom: 0;
            margin-left: auto;
            background-color:rgba(220, 220, 220, 0.7);
       } 
       label{
            padding: 20px;
            margin-top: 100px;
            margin-bottom: 0;
       }
       input{
            padding: 0px;
            margin: 0px 0px 0px 10px;
       }
        </style>
    <div class="hcenter">
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label>User ID :</label>
            <input type="text" name="user_id" ><br><br>
            <label>Firest Name :</label>
            <input type="text" name="first_name" ><br><br>
            <label>Last Name :</label>
            <input type="text" name="last_name" ><br><br>
            <label>E-mail :</label>
            <input type="text" name="email" ><br><br>
            <label>Account Status:</label>
            <select name="status">
                <option value="valid">Valid</option>
                <option value="suspend">Suspended</option>
                <option value="banned">Banned</option>
            </select><br><br>
            <label>Account Type:</label>
            <select name="status">
                <option value="user">User</option>
                <option value="mod">Mod</option>
                <option value="Admin">Admin</option>
            </select><br><br>
            <input type="button" value="Create">
            <input type="button" value="Update">

        </form>
    </div>


<?php

include_once 'php\includes\dbcon.php';

$sql1="SELECT id,user_id,date,type,review,description FROM complaint";

$result2=$con->query($sql1);

//Shows the Request table details
if ($result2->num_rows > 0) {

    echo("<h1 style='text-align:center;'>All Users</h1>");
    ?>
    <style>
       table{
            padding: 2px;
        }
        th{
            padding: 5px;
        }
        tr{
            text-align: center;
        }
        .delete{
            background-color:rgba(221, 0, 0, 0.7) ;
        }
        .delete:hover{
            background-color:rgba(0, 0, 200, 0.9) ;
        }
        .table1{
            width:470px;
            border:solid 5px #F1F1F1;
            margin-right: auto;
            margin-left: auto;
            background-color:rgba(220, 220, 220, 0.7);
        }
    </style>

    <div class="table1">
    <?php
    
    echo("<table border='5'>");

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
        <td class="delete"><a style="text-decoration: none;" href="php\controllers\complaint-ctrl.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
        <?php
        echo "</tr>";
    }
    echo ("</table>");

    }else{
        echo ('<h1 class="warnings">The User table is empty</h1>');
    }

$con->close();

        include("php/templates/footer.php");
    ?>
    </div>
</body>
</html>