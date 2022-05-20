
<?php
    require_once('php/includes/dbFunctions.php');

    //get user details from db
    $values = getUser($_SESSION['user_id']);

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
        $errors[$fieldName] = '';
    }

    $errors['form'] = ''; // variable to store form errors
    $errors['profile_photo'] = ''; //variable to store profile photo errors

    if ($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        $editMode = False;
    }
    elseif ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $editMode = True;
        require_once("php/includes/validateFunctions.php");

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

                //validate phone
                if(count($values['phone']) > 5)
                {
                    $errors['phone'] = 'maximum number of contacts is 5';
                    
                    $isValid = False;
                }
                
                //validate phone numbers
                if ($isValid)
                {
                    foreach ($values['phone'] as $phone)
                    {
                        if (!preg_match("/[0-9]{10}/", $phone))
                        {
                            $errors['phone'] = 'incorrect phone number(s)';
                            $isValid = False;
                            break;
                        }
                    }

                }

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

                $valuesToDB = $values;

                //photo validation
                if(isset($_FILES['profile_photo']))  //if profile photo is changed save the file
                {
                    $tmpPath = $_FILES['profile_photo']['tmp_name'];
                    
                    if (!empty($tmpPath))
                    {
                        $ext = strtolower(pathinfo($_FILES['profile_photo']['name'],PATHINFO_EXTENSION));
                        $allowed = array('png', 'jpg', 'jpeg', 'jfif');
                        
                        //check file type
                        if(!in_array($ext, $allowed))
                        {
                            $errors['profile_photo'] = 'invalid format for profile picture';
                            $isValid = False;
                        }
                    }

                    //move file if form is valid
                    if($isValid)
                    {
                        //remove old profile photo
                        unlink($values['profile_photo']);

                        //add new profile photo
                        if (!empty($tmpPath))
                        {
                            $path = 'images/profile/'.$_SESSION['user_id'].".$ext";
                            move_uploaded_file($tmpPath, $path);
                            $valuesToDB['profile_photo'] = $path;
                        }
                        else
                        {
                            $valuesToDB['profile_photo'] = NULL;
                        }
                        
                    }

                }

                if($isValid)
                {
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