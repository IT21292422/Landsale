<?php
    require_once("includes/dbcon.php");

    function matchUserPassword($email, $pwd)
    {   
        global $con;
        $email = strtolower($email);
        $sql = "select user_id from users where email= '$email' and password= '$pwd'";
        $results = $con->query($sql);

        if ($results->num_rows < 1) return NULL;

        return $results->fetch_assoc()['user_id'];
    }

    function getBasicUserDetails($userId)
    {
        global $con;

        $sql = "select user_id, first_name, last_name, profile_photo, account_type from users where user_id = $userId";

        $results = $con->query($sql);

        if ($results->num_rows < 1) return NULL;

        return $results->fetch_array(MYSQLI_ASSOC);
    }

    function addUser($values)
    {
        //todo
        return NULL;
    }

    function doesEmailExist($email)
    {
        //todo
        return False;
    }
?>