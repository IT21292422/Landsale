<?php
    require_once("includes/dbFunctions.php");
    require_once("includes/utilFunctions.php");
    require_once("includes/signinFunctions.php");
    require_once("includes/validateFunctions.php");

    //array to store mandatoriness of each field of form
    $required = array(
        "email"=> True,
        "first_name"=>True,
        "last_name"=>True,
        "password"=>True,
        "confirm_password"=>True,
        "about"=>False,
        "profile_photo"=>False,
    );

    $values = array();  //array to store values from form
    $errors = array();  //array to store errors relevent to each field

    foreach ($required as $fieldName=>$_)   //initialize arrays with empty values
    {
        $values[$fieldName] = '';
        $errors[$fieldName] = '';
    }

    $errors['form'] = ''; // variable to store form errors
    
    if(isset($_POST["email"])) //check for a post method
    {
        //get values from form
        foreach ($values as $fieldName=>$value)
        {
            $values[$fieldName] = $_POST[$fieldName];
        }

        //check for empty fields in required fields
        if (!checkEmpty($values, $required, $errors))
        {
            //check if email exists
            if (doesEmailExist($values['email']))
            {
                $errors['email'] = 'This E-mail is already registered';
            }
            else
            {
                //variable to store if the data is valid
                $isvalid = True;

                //validate password strength
                $isvalid = $isvalid and validatePassword($values['password'], $errors['password']);
                            
                //check for matching passwords
                if ($values['password'] !== $values['confirm_password'])
                {
                    $errors['confirm_password']= 'Passwords do not match';
                    $isvalid = False;
                }

                //check if email is valid
                if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL))
                {
                    $errors['email'] = "invalid email";
                    $isvalid = False;
                }

                //if data is validated
                if ($isvalid)
                {
                    $userId = addUser($values); //add user to the database

                    if ($userId) signin($userId);   //sign in the user
                    else $formError = 'Registering failed'; //error if failed to add to the database
                }
            }

            


        }

    }
   




?>