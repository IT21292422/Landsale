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
       <input type="text" name="email" value="<?php echo "$email"?>">
       <br>
       <label for="pwd">Password</label>
       <input type="password" name="password" value="<?php echo "$pwd"?>">
       <br>
       <?php    if (!empty($submitError)) echo "<label>$submitError</label><br>";    ?>
       <input type="submit" name="submit" value="Submit">
   </form> 
</body>
</html>