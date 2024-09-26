<?php
    include("php/controllers/signin-ctrl.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign in</title>3
    <link rel="stylesheet" href="styles/signin.css">
    <link rel="stylesheet" href="styles/forms.css">
    <?php include_once('php/includes/common-css-js.php'); ?>


</head>
<body>
    <?php include('php\templates\header.php'); ?>

    <!-- Applied htmlspecialchars() to sanitize and escape user inputs 
         Makes any malware script treated as pain text instead of executing it-->
   <form class="simple-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-field">
            <div for="email">E-mail</div>
            <input type="email" name="email" value="<?php echo htmlspecialchars($values['email']); ?>">
            <?php if (!empty($errors['email'])) echo "<div class='error'>*" . htmlspecialchars($errors['email']) . "</div><br>"; ?>
        </div>

        <div class="form-field">
            <div for="pwd">Password</div>
            <input type="password" name="password" value="<?php echo htmlspecialchars($values['password']); ?>">

            <!-- Escaped output error messages to further prevent xss attacks. THis makes sure to display user generated content 
             as plain text and cannot inject any scripts here dynamically -->
            <?php if (!empty($errors['password'])) echo "<div class='error'>*" . htmlspecialchars($errors['password']) . "</div><br>"; ?>
        </div>

        <?php    if (!empty($errors['form'])) echo "<div class='form-field error'>*".$errors['form']."</div><br>";    ?>

        <!-- sanitised GET query parameters. This prevents xss attacks through url parameters by escaping dangerous characters -->
        <?php if (!empty($_GET['redirect'])) echo "<input type='hidden' name='redirect' value='" . htmlspecialchars($_GET['redirect']) . "'>"; ?>

        <div class="form-field">
            <a href="register.php">Create an account</a>
        </div>


        <div class="form-field">
        <input type="submit" name="submit" value="Submit">
        </div>

   </form>
   <?php include('php\templates\footer.php'); ?>

</body>
</html>