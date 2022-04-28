<?php
    require_once("includes/dbFunctions.php");
    require_once("includes/utilFunctions.php");
    require_once("includes/signinFunctions.php");
    require_once("includes/validateFunctions.php");
    require_once("includes/Field.php");

    //array with field names and corresponding field
    $fields = array(
        "email"=> new Field(True),
        "first_name"=>new Field(True),
        "last_name"=>new Field(True),
        "password"=>new Field(True),
        "confirm_password"=>new Field(True),
        "about"=>new Field(False),
        "profile_photo"=>new Field(False),
    );

    $formError = '';

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
            

            //check if email exists
            if (doesEmailExist($fields['email']->value))
            {
                $fields['email']->error = 'This E-mail is already registered';
            }
            else
            {
                //variable to store if the data is valid
                $isvalid = True;

                //validate password strength
                $isvalid = $isvalid and validatePassword($fields['password']->value, $fields['password']->error);
                            
                //check for matching passwords
                if ($fields['password']->value !== $fields['confirm_password']->value)
                {
                    $fields['confirm_password']->error = 'Passwords do not match';
                    $isvalid = False;
                }

                //check if email is valid
                if (!filter_var($fields['email']->value, FILTER_VALIDATE_EMAIL))
                {
                    $fields['email']->error = "invalid email";
                    $isvalid = False;
                }

                //if data is validated
                if ($isvalid)
                {
                    $userId = addUser($fields); //add user to the database

                    if ($userId) signin($userId);   //sign in the user
                    else $formError = 'Registering failed'; //error if failed to add to the database
                }
            }

            


        }

    }
   




?>