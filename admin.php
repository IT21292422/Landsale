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
    
    <div>
        <style>
    form{
        width: auto;
        padding: 10px;
        background-color:rgba(221, 115, 28, 0.5);
        border-radius: 10px
            }
        </style>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label>User ID :</label>
            <input type="text" name="user_id" ><br>
            <label>Firest Name :</label>
            <input type="text" name="first_name" ><br>
            <label>Last Name :</label>
            <input type="text" name="last_name" ><br>
            <label>E-mail :</label>
            <input type="text" name="email" ><br>
            <label>Account Status:</label>
            <select name="status">
                <option value="valid">valid</option>
                <option value="suspend">Suspended</option>
                <option value="banned">Banned</option>
            </select><br>
            <label>Account Type:</label>
            <select name="status">
                <option value="user">User</option>
                <option value="mod">Mod</option>
                <option value="Admin">Admin</option>
            </select><br>
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

    echo("<h1>All Users</h1>");
    ?>
    <style>
        table{
            left: 50%;

        }
    </style>
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
        echo "<th>".$row["review"]."</th>";
        echo "<th>".$row["description"]."</th>";
        ?>
        <td><a href="php\controllers\complaint-ctrl.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
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
</body>
</html>