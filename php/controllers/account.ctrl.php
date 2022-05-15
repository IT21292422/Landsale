
<?php
    session_start();
    require_once('php/includes/dbFunctions.php');

    $values = getUser($_SESSION['user_id']);

    if ($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        $editMode = False;
    }
    elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $editMode = True;
        echo var_dump($_POST);
        require_once("php/includes/validateFunctions.php");

        //array to store mandatoriness of each field of form
        $required = array(
            "first_name"=> True,
            "last_name"=>True,
            "email"=>True,
            "about"=>False,
            "phone"=>True
        );

       // $values = array();  //array to store values from form
        $errors = array();  //array to store errors relevent to each field

        foreach ($required as $fieldName=>$_)   //initialize arrays with empty values
        {
            $values[$fieldName] = '';
            $errors[$fieldName] = '';
        }

        $errors['form'] = ''; // variable to store form errors

        if(isset($_POST["email"])) //check for a post method
        {
            //get values from user
            foreach ($required as $fieldName=>$_) 
            {
                $values[$fieldName] = $_POST[$fieldName];
            }
            
            //alter fields
            $values['email'] = strtolower($values['email']);

            //validate data
            if(areRequiredFieldsProvided($values, $required, $errors))
            {
                $isValid = True;

                //todo validate phone
                if(!filter_var($values['email'], FILTER_VALIDATE_EMAIL))
                {
                    $errors['email'] = 'invalid email address';
                    $isValid = False;
                }

                if(strlen($values['about']) > 500)
                {
                    $errors['about'] = 'maximum length for about is 500 characters';
                    $isValid = False;
                }

                if($isValid)
                {
                    $valuesToDB = $values;

                    //todo photo validation
                    //todo remove old photo
                    if(isset($_FILES['profile_photo']))  //if profile photo is changed save the file
                    {

                        echo var_dump($_FILES);
                        $tmpPath = $_FILES['profile_photo']['tmp_name'];
                        
                        if (empty($tmpPath))
                        {
                            $valuesToDB['profile_photo'] = NULL;
                        }
                        else
                        {
                            $ext = strtolower(pathinfo($_FILES['profile_photo']['name'],PATHINFO_EXTENSION));
                            $path = 'images/profile/'.$_SESSION['user_id'].".$ext";
                            move_uploaded_file($tmpPath, $path);
                            $valuesToDB['profile_photo'] = $path;
                        }

                    }

                    if (updateUser($valuesToDB, $_SESSION['user_id']))
                    {
                        header('Location: account.php');  //redirect to account page
                    }
                    else
                    {
                        $errors['form'] = 'could not update the user details';
                    }
                }
            }
            else
            {

            }

        
        }
    }
?>