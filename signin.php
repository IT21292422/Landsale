<?php
        include("php/templates/header.php");
    ?>

<?php
    include("php/controllers/signin-ctrl.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign in</title>
    <link rel="stylesheet" href="styles/headerfooter.css"/>

</head>
<body>
   <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
       <label for="email">E-mail</label>
       <input type="email" name="email" value="<?php echo $values['email'] ?>">
       <br>
       <?php    if (!empty($errors['email'])) echo "<label>*".$errors['email']."</label><br>";    ?>
       <label for="pwd">Password</label>
       <input type="password" name="password" value="<?php echo $values['password'] ?>">
       <br>
       <?php    if (!empty($errors['password'])) echo "<label>*".$errors['password']."</label><br>";    ?>
       <?php    if (!empty($errors['form'])) echo "<label>*".$errors['form']."</label><br>";    ?>
       <?php    if (!empty($_GET['redirect'])) echo "<input type='hidden' name='redirect' value='".$_GET['redirect']."'>";    ?>
       <input type="submit" name="submit" value="Submit">
   </form> 
<?php
        include("php/templates/footer.php");
    ?>
</body>
</html>