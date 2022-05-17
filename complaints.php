// Data base name is "register" and table name is "user" and colunms are id and name
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    require_once("php/includes/dbcon.php");

    $sql1="SELECT user_id,first_name FROM users";

    $result2=$con->query($sql1);

    //Shows the Request table details 
    if ($result2->num_rows > 0) {

        echo("<h1>Request Complaints</h1>");

        echo("<table border='1'>");
        echo("<th>id</th>");
        echo("<th>name</th>");
        echo("<th></th>");
        while($row = $result2->fetch_assoc()) {
            echo ("<tr>");
            echo ("<td>".$row["id"]."</td>");
            echo ("<td>".$row["name"]."</td>");

            echo '<td><form action="" method="POST"><button name="submit" value='.$row['id'].'>Delete</button></form></td>';
            echo ("</tr>");
        }
        echo ("</table>");

        }else{
            echo ('<h1 class="warnings">The Request complaint table is empty</h1>');
        }

        if(isset($_POST['submit'])){
            $sql2='DELETE FROM user WHERE id='.$_POST['submit'].';';
        }
        $con->query($sql2);
        
        echo '<script type="text/javascript">alert("Recode was deleted!!!");</script>';
    $con->close();
?>
</body>
</html>
