<?php
    require_once('includes/dbFunctions.php');

    function signin($userId)
    {
        if (session_status() === PHP_SESSION_NONE) {    //start a new session if not started already
            session_start();
        }

        $userDetails = getBasicUserDetails();   //get user details

        //assign user details to session variables
        $_SESSION['userId'] == $userDetails['user_id'];     
        $_SESSION['firstName'] == $userDetails['first_name'];
        $_SESSION['lastName'] == $userDetails['last_name'];
        $_SESSION['accountType'] == $userDetails['account_type'];
        $_SESSION['profile'] == $userDetails['profile_photo'];
    }

    function signout()
    {
        if (!(session_status() === PHP_SESSION_NONE)) {     //remove all session variables
            session_destroy();
        }
    }
?>