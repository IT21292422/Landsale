<?php
    //check for empty values in the array, assign null and add errors
    function checkEmpty(&$values, $required, &$errors) 
    {
        $foundEmpty = False;

        foreach ($required as $fieldName=>$isRequired)
        {
            if (($values[$fieldName] === "" or $values[$fieldName] === NULL or $values[$fieldName] === array()))
            {
                $values[$fieldName] = NULL; //assign null to empty values

                //check if any mandatory field is missing and add errors
                if ($isRequired) 
                {
                    $foundEmpty = True;

                    $errors[$fieldName] = 'This field is required';
                }
            }
            
        }
        return $foundEmpty;  
    }

    //check if the password is strong enough
    function validatePassword($pwd, &$error)    
    {
        if (strlen($pwd) < 8)
        {
            $error = "Password should be minimum 8 characters long";
            return false;
        }

        if (!(preg_match('*[A-Z]*', $pwd) and preg_match('*[a-z]*', $pwd) and preg_match('*[0-9]*', $pwd) and preg_match('*[^a-zA-Z0-9]*', $pwd)))
        {
            $error = "Password should contain one uppercase letter, one number and one special character";
            return false;
        }

        return true;
    }

    //check if provided numerica values are valid and if valid convert data type to numeric types
    function checkNumericValues(&$values, &$errors, $fieldNames)    
    {
        $isValid = True;
        foreach($fieldNames as $fieldName)
        {
            if (!is_null($values[$fieldName]))
            {
                if (!is_numeric($values[$fieldName]))
                {
                    $isValid = False;
                    $errors[$fieldName] = 'invalid numeric value';
                }
                else
                {
                    $values[$fieldName] = $values[$fieldName] + 0; //convert to int or float data type
                }
            }
        }

        return $isValid;
    }
?>