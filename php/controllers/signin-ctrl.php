<?php
require_once("php/includes/dbFunctions.php");
require_once("php/includes/signinFunctions.php");
require_once("php/includes/validateFunctions.php");
require_once 'vendor/autoload.php';
require_once 'config.php'; 

use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

$required = array(
    "email"=> True,
    "password"=>True
);

$values = array();
$errors = array();

foreach ($required as $fieldName=>$_) 
{
    $values[$fieldName] = '';
    $errors[$fieldName] = '';
}

$errors['form'] = ''; 

if (isset($_GET['code'])) {
    $provider = new Google([
        'clientId'     => $_ENV['GOOGLE_CLIENT_ID'],
        'clientSecret' => $_ENV['GOOGLE_CLIENT_SECRET'],
        'redirectUri'  => $_ENV['GOOGLE_REDIRECT_URI'],
    ]);

    try {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        $user = $provider->getResourceOwner($token);
        $googleEmail = $user->getEmail();

        $info = checkAccountByEmail($googleEmail);

        if ($info === NULL) {
            $userId = createAccountFromGoogle($user);
            signin($userId);
        } else {
            if ($info['account_status'] === 'valid') {
                signin($info['user_id']);
            } else {
                $errors['form'] = 'Your account is ' . $info['account_status'];
            }
        }

        if (empty($errors['form'])) {
            header('Location: index.php');
            exit;
        }

    } catch (IdentityProviderException $e) {
        $errors['form'] = 'Failed to get user details from Google: ' . $e->getMessage();
    }
}


if(isset($_POST["email"]))
{

    foreach ($required as $fieldName=>$_)
    {
        $values[$fieldName] = $_POST[$fieldName];
    }
    

    $values['email'] = strtolower($values['email']);

    if(areRequiredFieldsProvided($values, $required, $errors))
    {
        $info = checkAccount($values['email'], $values['password']); 

        if ($info === NULL) 
        {
            $errors['form'] = "Email and password do not match";
        }
        else  
        {
            if ($info['account_status'] === 'valid')
            {
                signin($info['user_id']);   
                if (isset($_POST['redirect']))
                {
                   header('Location: '.$_POST['redirect']);
                   exit;
                }
                else{
                   header('Location: index.php');
                   exit;
                }
            }
            else
            {
                $errors['form'] = 'Your account is ' . $info['account_status'];
            }
        }
    }
}
?>