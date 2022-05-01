<?php
    include("controllers/register-ctrl.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
</head>
<body>
    <?php
        include("templates/header.php");
    ?>

    <!body
        register form [nimeth]
    >
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

    </form>

    <?php
        include("templates/footer.php");
    ?>
</body>
</html>
<!------------------------------------------------------------------------------------>

<!DOCTYPE html>
<html>
<head>
   <title> Registration-Golden Lands</title>
</head>
<body>
    <h2>Registration Form</h2>

<form method="post">

<fieldset>

    <p>First Name: <input type="text" id="fname"  name="fname" required></p>
    <p>Last Name: <input type="text" id="lname" name="lname" required></p>
    <p>Email : <input type="email" id="email" name="email" required></p>
    <p>Password : <input type="password" id="pswd" name="pswd" minlength="8" 
        pattern="(?=.*[a-z])(?=.*[A-Z]).{6,}" title="There must be one lowercase letter and one uppercase letter, and at leat 6 or more characters " required> </p>

    <p>Password : <input type="password"></p><!--NEED JS-->
    
    <p>Phone : <input type="tel" id="phone" name="phone" required ></p><!--not sure about patterns-->

    <p>Addres : <br><textarea type="text" name="address" id="adress"    rows="3" cols="80" required></textarea></p>
    <p>About me : <br><textarea type="text" name="aboutme" id="aboutme"       rows="7" cols="100" required></textarea></p>

    <p>Upload profile photo : <input type="file" name="prphoto" id="prphoto" > </p> <!--Limit file size ? and only image style files ?-->
    <p> <input type="checkbox" id="agreeT&C" name="agreeT&C" value="agreedT&C"> Agree to Terms and Conditions</p>

</fieldset>

<br>
<input type="submit" value="Submit" >


</form>
</body>
</html>