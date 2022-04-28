<?php
    function checkEmpty(&$fields) //check for empty values in the array DO NOT USE FOR NUMERIC VALUES
    {
        $foundEmpty = False;

        foreach ($fields as $fieldName=>$field)
        {
            //check if any mandatory field is missing and add errors
            if ($field->required and ($field->value === "" or $field->value === NULL or $field->value === array())) 
            {
                $foundEmpty = True;

                $fields[$fieldName]->error = 'This field is required';
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