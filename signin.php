<?php
    include("controllers/signin-ctrl.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign in</title>
</head>
<body>
   <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
       <label for="email">E-mail</label>
       <input type="text" name="email" value="<?php echo $fields['email']->value ?>">
       <br>
       <?php    if (!empty($fields['email']->error)) echo "<label>".$fields['email']->error."</label><br>";    ?>
       <label for="pwd">Password</label>
       <input type="password" name="password" value="<?php echo $fields['password']->value ?>">
       <br>
       <?php    if (!empty($fields['password']->error)) echo "<label>".$fields['password']->error."</label><br>";    ?>
       <input type="submit" name="submit" value="Submit">
   </form> 
</body>
</html>