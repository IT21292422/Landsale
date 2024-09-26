<?php
   require_once 'vendor/autoload.php';
   require_once 'config.php';

   use League\OAuth2\Client\Provider\Google;
   $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
   $dotenv->load();

   $provider = new Google([
       'clientId'     => $_ENV['GOOGLE_CLIENT_ID'],
       'clientSecret' => $_ENV['GOOGLE_CLIENT_SECRET'],
       'redirectUri'  => $_ENV['GOOGLE_REDIRECT_URI'],
   ]);

   $authUrl = $provider->getAuthorizationUrl();
   $_SESSION['oauth2state'] = $provider->getState();

   header('Location: ' . $authUrl);
   exit;
   