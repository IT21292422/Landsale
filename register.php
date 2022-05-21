<?php require 'php/includes/dbcon.php';?>

<!DOCTYPE html>
<html>
	<head>
    <?php include_once('php/includes/common-css-js.php'); ?>
	</head>
	
	<body>
		<!-- adding a header (c)-->
        <?php
            include("php/templates/header.php");
        ?>
		<hr>

            <center><h1 id="cheader">Registration Form</h1></center>

            <form onsubmit="return checkPassword()" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <label for="fname">First Name<br></label>
				<input type="text" id="fname" name="fname" placeholder="First Name" required><br><br>
				
				<label for="lName">Last Name<br></label>
				<input type="text" id="lName" name="lname" placeholder="Last Name" required><br><br>

                <label for="email">Email<br></label>
				<input type="text" id="email" name="email" placeholder="abc@xyz.com" pattern="[a-z0-9._%+-]+@[a-z0-9]+\.[a-z]{2,3}" required><br><br>
				
                <label for="about">Add a small description about yourself<br></label>
				<textarea id="aabout" rows="4" cols="25" name="about"></textarea><br><br>

                <label for="photo">Upload a profile picture</label>
                <input type="file" name="pPhoto" id="photo" ><br><br>

                <label for="pass">Password</label><br>
                <input type="password" name="pass" id="pass" pattern="(?=.+\d)(?=.+[a-z])(?=.+[A-Z]).{5,10}" required><br><br>

                <label for="repass">Re-Enter Password</label><br>
                <input type="password" name="pass" id="repass"><br><br>

                <label for="ToS">Accept Privacy Policy and Terms & Conditions</label><br>
                <input type="checkbox" class="tos" name="tos" onclick="enableButton()"><br><br>

                <center>
                    <input type="submit" value="submit" id="submitbtn">
                </center>
            </form>
        
		<hr>
		<!-- adding footer (g)-->
        <?php
            include("php/templates/footer.php");

            include("link.php");

            //connecting to the DB
            require 'php/includes/dbcon.php';
            
                $uID = $_POST[""];
                $fName = $_POST["fname"];
                $lName = $_POST["lname"];
                $email = $_POST["email"];
                $pNumber = $_POST["phone"];
                $pass = $_POST["pass"];
                $photo = $_POST["pPhoto"];
            
            
                $query="INSERT INTO users(user_id, pass, first_name, last_name, email, account_status, account_type, 
                profile_photo, about) VALUES (1, '$pass', '$fName', '$lName', '$email', 'Valid', 'User', '$photo', '$about' )";
                
                if($con->query($sql))
                {
                    echo "<script> alert ('Data added Successfully')</script>";
                }
                else
                {
                    echo "<script> alert ('Error: query was not Successful')</script>";
                    echo sql;
                }
        ?>
	</body>
</html>
