<?php
    require_once("includes/dbFunctions.php");
    require_once("includes/utilFunctions.php");
    require_once("includes/signinFunctions.php");

    $email = "";
    $pwd = "";

    //variables to pass error messages
    $submitError = "";

    if(isset($_POST["email"])) //check for a post method
    {
        //get values from user
        $name = $_POST["email"];
        $pwd = $_POST["password"];

        //check for empty fields
        if (checkEmpty($name, $pwd))
        {
            $submitError = "Fill required fields";
        }
        else
        {   
            $userId = matchUserPassword($name, $pwd); //check for matching email password pair

            if ($userId === NULL)    // if user is not valid
            {
                $submitError = "Email and password do not match";
            }
            else    //if user is valid
            {
                signin($userId);    //signin user
                header('Location: /');  //redirrect to homepage
            }
        }


    }
   




?>