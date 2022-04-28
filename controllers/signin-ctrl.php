<?php
    require_once("includes/dbFunctions.php");
    require_once("includes/utilFunctions.php");
    require_once("includes/signinFunctions.php");
    require_once("includes/validateFunctions.php");

    require_once("includes/Field.php");

    //array with field names and corresponding field
    $fields = array(
        "email"=> new Field(True),
        "password"=>new Field(True)
    );

    if(isset($_POST["email"])) //check for a post method
    {
        //get values from user
        foreach ($fields as $fieldName=>$field)
        {
            $fields[$fieldName]->value = $_POST[$fieldName];
        }

        //check for empty fields
        if (!checkEmpty($fields))
        {
            //check for matching email password pair
            $userId = matchUserPassword($fields['email']->value, $fields['password']->value); 

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