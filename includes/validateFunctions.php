<?php
    function checkEmpty($values, $required, &$errors) //check for empty values in the array
    {
        $foundEmpty = False;

        foreach ($required as $fieldName=>$isRequired)
        {
            //check if any mandatory field is missing and add errors
            if ($isRequired and ($values[$fieldName] === "" or $values[$fieldName] === NULL or $values[$fieldName] === array())) 
            {
                $foundEmpty = True;

                $errors[$fieldName] = 'This field is required';
            }
        }
        return $foundEmpty;  
    }

    function validatePassword($pwd, &$error)
    {
        if (strlen($pwd) < 8)
        {
            $error = "Password should be minimum 8 characters long";
            return false;
        }

        if (!(preg_match('*[A-Z]*', $pwd) and preg_match('*[a-z]*', $pwd) and preg_match('*[0-9]*', $pwd) and preg_match('*[^a-zA-Z0-9]*', $pwd)))
        {
            $error = "Password should contain one uppercase letter one number and one special character";
            return false;
        }

        return true;
    }
?>