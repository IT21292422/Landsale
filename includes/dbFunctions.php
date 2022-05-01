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

        return $results->fetch_assoc();
    }

    function addUser($values)   //todo profile photo
    {
        global $con;

        $sql = "insert into users(email, first_name, last_name, password, about, profile_photo) values('{email}', '{first_name}', {'last_name}', '{password}', '{about}', '{profile_photo}')";
        
        foreach($values as $fieldName=>$value)
        {
            $sql = str_replace("{$fieldName}", $value, $sql);
        }

        if($con->query($sql))
        {
            return $con->insert_id;
        }

        return NULL;
    }

    function doesEmailExist($email)
    {
        global $con;
        $email = strtolower($email);
        $sql = "select user_id from users where email = '$email'";
        $results = $con->query($sql);

        if ($results->num_rows < 1) return False;

        return True;
    }

    function addRequest($values)
    {
        //todo
        return False;
    }

    function addSale($values)
    {
        //todo
        return False;
    }
?>