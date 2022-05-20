<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/headerfooter.css"/>
    <link rel="stylesheet" href="styles/admintable.css"/>
    <title>Document</title>
</head>
<body>

  <?php
        include("php/templates/header.php");
        ?> 
    <style>

        </style>
    <div class="hcenter">
        
        <form method="post" action="admin-ctrl.php">
            <label class="admin">User ID :</label>
            <input class="admins" type="text" name="user_id" ><br><br>
            <label class="admin">Firest Name :</label>
            <input class="admins" type="text" name="first_name" ><br><br>
            <label class="admin">Last Name :</label>
            <input class="admins" type="text" name="last_name" ><br><br>
            <label class="admin">E-mail :</label>
            <input class="admins" type="text" name="email" ><br><br>
            <label class="admin">Account Status:</label>
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
            <label class="admin">About:</label>
            <input class="admins" type="text" name="about"><br><br>
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
        <td class="delete"><a style="text-decoration: none;" <?php $userId=$row["user_id"]; ?>>Delete</a></td>
        <?php
        echo "</tr>";
    }
    echo ("</table>");

    }else{
        echo ('<h1 class="warnings">The User table is empty</h1>');
    }
/*
     $sql = "delete from saved_request where request_id in (select request_id from request where user_id = $userId) or user_id = $userId;".
            "delete from saved_sale where sale_id in (select sale_id from sale where user_id = $userId) or user_id = $userId;".
            "delete from request_complaints where request_id in (select request_id from request where user_id = $userId) or user_id = $userId;".
            "delete from sale_complaints where sale_id in (select sale_id from sale where user_id = $userId) or user_id = $userId;".
            "delete from request_phone where request_id in (select request_id from request where user_id = $userId);".
            "delete from sale_phone where sale_id in (select sale_id from sale where user_id = $userId);".
            "delete from sale_media where sale_id in (select sale_id from sale where user_id = $userId);".
            "delete from sale where user_id = $userId;".
            "delete from request where user_id = $userId;".
            "delete from users_phone where user_id = $userId;".
            "delete from users_warnings where user_id = $userId;".
            "delete from users where user_id = $userId;";


        $resul=$con->multi_query($sql);

        if ($resul) {
            echo '<script type="text/javascript">alert("Recode was deleted!!!");</script>';
        } else {
            echo "Error deleting record: " . mysqli_error($con);
        }
*/
$con->close();

        include("php/templates/footer.php");
    ?>
    </div>
</body>
</html>