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
        
        <form method="post" action="admin-ctrl.php">
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
                <option value="admin">Admin</option>
            </select><br><br>
            <label>About:</label>
            <input type="text" name="about"><br><br>
            <input type="button" value="Create">
            <input type="button" value="Update">

        </form>
    </div>


<?php

include_once 'php\includes\dbcon.php';

$sql1="SELECT user_id,first_name,last_name,email,account_status,account_type,about FROM users";

$result2=$con->query($sql1);

//Shows the Request table details
if ($result2->num_rows > 0) {

    echo("<h1 style='text-align:center;'>All Users</h1>");
    ?>
    <style>
        .table1 th{
            padding: 10px;
            background-color: rosybrown;
        }
        .table1 tr{
            inline-size: auto;
            overflow-wrap: break-all;
        }
        .table1 td{
            padding: 10px;
        }
        .delete{
            background-color:rgba(221, 0, 0, 0.7) ;
        }
        .delete:hover{
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

    <div >
    <?php
    
    echo("<table border='5' class='table1'>");

    echo("<th>User ID</th>");
    echo("<th>First Name</th>");
    echo("<th>Last Name</th>");
    echo("<th>E-mail</th>");
    echo("<th>Account Status</th>");
    echo("<th>Account Type</th>");
    echo("<th>About</th>");
    echo("<th>Action</th>");

    while($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["user_id"]."</td>";
        echo "<td>".$row["first_name"]."</td>";
        echo "<td>".$row["last_name"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["account_status"]."</td>";
        echo "<td>".$row["account_type"]."</td>";
        echo "<td>".$row["about"]."</td>";
        ?>
        <td class="delete"><a style="text-decoration: none;" href="php\controllers\admin-del-ctrl.php?id=<?php echo $row["user_id"]; ?>">Delete</a></td>
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