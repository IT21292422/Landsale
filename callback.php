<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'php/includes/signinFunctions.php';

use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$provider = new Google([
    'clientId'     => $_ENV['GOOGLE_CLIENT_ID'],
    'clientSecret' => $_ENV['GOOGLE_CLIENT_SECRET'],
    'redirectUri'  => $_ENV['GOOGLE_REDIRECT_URI'],
]);

if (!isset($_GET['code'])) {
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state detected. Please try again.');
} else {
    try {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        $user = $provider->getResourceOwner($token);

        $userInfo = [
            'email' => $user->getEmail(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'profile_photo' => $user->getAvatar()
        ];

        signinWithOAuth($userInfo);

        session_regenerate_id(true);

        header('Location: index.php');
        exit;

    } catch (IdentityProviderException $e) {
        exit('OAuth2 error: ' . $e->getMessage());
    } catch (Exception $e) {
        exit('An unexpected error occurred: ' . $e->getMessage());
    }
}
?>