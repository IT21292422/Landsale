<?php   //TODO --just copy of register-ctrl
    require_once("includes/dbFunctions.php");
    require_once("includes/utilFunctions.php");
    require_once("includes/signinFunctions.php");
    require_once("includes/validateFunctions.php");
    
    //array to store mandatoriness of each field of form
    $required = array(
        "title"=> True,
        "location"=>False,
        "description"=>False,
        "city"=>True,
        "district"=>True,
        "province"=>True,
        "price"=>False,
        "area"=>True,
        "address"=>False
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

        //alter fields
        $values['city'] = strtolower($values['city']);
        $values['district'] = strtolower($values['district']);
        $values['province'] = strtolower($values['province']);

        //check for empty fields in required fields
        if (!checkEmpty($values, $required, $errors))
        {
            //check if numeric values are valid
            if(checkNumericValues($values, $errors, array('price', 'area')))
            {
                //assign current user as the owner of the post
                $values['user_id'] = $_SESSION['user_id'];
            
                if (addSale($values))    //add request to the db
                {
                    //todo success
                }
                else
                {
                    $errors['form'] = 'submission failed';
                }
            }


            

            

            


        }

    }
   




?>