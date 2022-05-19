<?php
    session_start();
    require_once('php\includes\signinFunctions.php');
    accessLevel('user');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {   
        require_once('php\includes\dbFunctions.php');
        if(deleteUser($_SESSION['user_id']))
        {
            header('location: signout.php');
            die();
        }
    }

?>

<form action="delete-account.php" method="post">
    <h1>Delete your account?</h1>
    <input type="button" value="Decline" onclick="location.href = 'index.php'">
    <input type="submit" value="Accept">
</form>