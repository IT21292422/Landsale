<?php
    require_once 'vendor/autoload.php';
    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $server = $_ENV['DB_HOST'];
    $dbUname = $_ENV['DB_USER'];
    $dbPassword = $_ENV['DB_PASS'];
    $dbName = $_ENV['DB_NAME'];

    $con = new mysqli($server, $dbUname, $dbPassword, $dbName);

    if($con->connect_error)
    {
        die("Connection to the database failed. Please try again later.");
    }
?>
