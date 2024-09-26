<?php
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

        $userDetails = getBasicUserDetails($userId);
        $_SESSION['user_id'] = $userDetails['user_id'];     
        $_SESSION['first_name'] = $userDetails['first_name'];
        $_SESSION['last_name'] = $userDetails['last_name'];
        $_SESSION['account_type'] = $userDetails['account_type'];
        $_SESSION['profile_photo'] = $userDetails['profile_photo'];
        $_SESSION['is_oauth'] = $isOAuth;
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

    function signinWithOAuth($userInfo)
    {
    $userId = getUserIdByEmail($userInfo['email']);
    if (!$userId) {
        // User doesn't exist, create a new account
        $userId = createUserFromOAuth($userInfo);
    }
    signin($userId, true);
    }

    function checkAccountByEmail($email) {
        global $conn;
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return NULL;
    }
    
    function createAccountFromGoogle($user) {
        global $conn;
        $email = $user->getEmail();
        $name = $user->getName();
        $password = bin2hex(random_bytes(16)); // Generate a random password
        
        $sql = "INSERT INTO users (email, name, password, account_status) VALUES (?, ?, ?, 'valid')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $name, $password);
        $stmt->execute();
        
        return $conn->insert_id;
    }
?>