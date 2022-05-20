<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles/headerfooter.css"/>
</head>
    <body>
        <?php
            include("php/templates/header.php");
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <fieldset>

                <p>First Name: <input type="text" id="fname"  name="first_name" ></p>
                <p>Last Name: <input type="text" id="lname" name="last_name" ></p>
                <p>Email : <input type="email" id="email" name="email" ></p>
                <p>Password : <input type="password" id="pswd" name="password"
                    title="There must be one lowercase letter and one uppercase letter, and at leat 6 or more characters " > </p>

                <p>Confirm Password : <input type="password" name="confirm_password"></p><!--NEED JS-->

                <p>Phone : <input type="tel" id="phone" name="phone" required ></p><!--not sure about patterns-->

                <p>About me : <br><textarea type="text" name="about" id="aboutme" rows="7" cols="100" ></textarea></p>

                <p>Upload profile photo : <input type="file" name="profile_photo" id="prphoto" > </p> <!--Limit file size ? and only image style files ?-->
                <p> <input type="checkbox" id="agreeT&C" name="agreeT&C" value="agreedT&C"> Agree to Terms and Conditions</p>

            </fieldset>
            <br>
            <input type="submit" value="Submit" name="submit" >
        </form>

        <?php
            include("php/templates/footer.php");
        ?>
    </body>
</html>

