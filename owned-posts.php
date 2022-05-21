<html>
<head>
    <title>Owned-posts</title>
    <link rel="stylesheet" href="styles/reqownForm.css">
</head>
<body style="background:linear-gradient(135deg, #71b7e6, #9b59b6);">

<?php
require 'php/includes/dbcon.php';
echo "<h2 class=\"ownTitle\">Owned Request Post</h2>";
$userId=$_GET['id'];
$sql="SELECT * FROM request where user_id=$userId";
$result=$con->query($sql);

if($result=$con->query($sql)){
    if($result->num_rows>0){
        //read form-data
        while($row=$result->fetch_assoc()){
            //read and utilize form-data
             $img=$row['cover_photo'];
             if($row['max_price']==-1)
             {
                 $row['max_price']="Not Negotiable";
             }
             echo "<div id=\"ownedCard\">";
             echo "<img src=\"$img\" alt=\"Picture of a land\" height=\"150\" width=\"150\" id=\"ownedImg\">";
             echo "<h2>".$row['title']."</h2>";
             echo "<p>".$row['description']."</p>";
             echo "<br>";
             echo "<br>";
             echo "<br>";
             echo "<button class=\"ownBtn\">"."<a href=\"\">"."View"."</a>"."</button>";  
             echo "<button class=\"ownBtn\">"."<a href=\"edit-request.html\">"."Edit"."</a>"."</button>";    
             echo "<button class=\"ownBtn\">"."<a href=\"delete.php\">"."Delete"."</a>"."</button>";
             echo "<span id=\"ownedPrice\">". $row['max_price'] . "</span>";
             echo "</div>";
        }
    } else {
        echo "<center><b>No results</b></center>";
    }
}

echo "<h2 class=\"ownTitle\">Owned Sale Post</h2>";
$sql="SELECT * FROM sale where user_id=$userId";
$result=$con->query($sql);

if($result=$con->query($sql)){
    if($result->num_rows>0){
        //read form-data
        while($row=$result->fetch_assoc()){
            //read and utilize form-data
             $img=$row['cover_photo'];
             echo "<div id=\"ownedCard\">";
             echo "<img src=\"$img\" alt=\"Picture of a land\" height=\"150\" width=\"150\" id=\"ownedImg\">";
             echo "<h2>".$row['title']."</h2>";
             echo "<p>".$row['description']."</p>";
             echo "<br>";
             echo "<br>";
             echo "<br>";
             echo "<button class=\"ownBtn\">"."<a href=\"\">"."View"."</a>"."</button>";  
             echo "<button class=\"ownBtn\">"."<a href=\"edit-request.html\">"."Edit"."</a>"."</button>";    
             echo "<button class=\"ownBtn\">"."<a href=\"delete.php\">"."Delete"."</a>"."</button>";
             echo "<span id=\"ownedPrice\">". $row['min_price']."-".$row['max_price'] . "</span>";
             echo "</div>";
        }
    } else {
        echo "No results";
    }
}

?>


</body>
</html>