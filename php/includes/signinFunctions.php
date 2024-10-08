<?php
    //Name: H.A.R.S. Hapuarachchi
    //IT Number: it21296246
    //Center: Malabe
    //Group: MLB_05.02_09
    require_once('php/includes/dbFunctions.php');

    function signin($userId)
    {
        if (session_status() === PHP_SESSION_NONE) {    //start a new session if not started already
            session_start([
                'cookie_lifetime' => 0, // Session lasts until browser is closed
                'cookie_httponly' => true, // Prevents JavaScript access to the session cookie
                'cookie_secure' => true,  // Ensures the cookie is only sent over HTTPS
                'cookie_samesite' => 'Lax', // Helps mitigate CSRF attacks
            ]);
        }

        $userDetails = getBasicUserDetails($userId);   //get user details


        //assign user details to session variables
        $_SESSION['user_id'] = $userDetails['user_id'];     
        $_SESSION['first_name'] = $userDetails['first_name'];
        $_SESSION['last_name'] = $userDetails['last_name'];
        $_SESSION['account_type'] = $userDetails['account_type'];
        $_SESSION['profile_photo'] = $userDetails['profile_photo'];
    }

    function signout()
    {
        if (!(session_status() === PHP_SESSION_NONE)) {     //remove all session variables
            session_destroy();
        }
    }

    function accessLevel($type)
    {
        switch ($_SESSION['account_type']) {
            case 'admin':
                if ($type == 'admin') return;
            case 'mod':
                if ($type == 'mod') return;
            case 'user':
                if ($type == 'user') return;
            default:
                if ($type == 'any') return;
            break;
        }

        header('Location: signin.php?redirect='. htmlspecialchars($_SERVER['PHP_SELF']));  
        die();

    }
?>