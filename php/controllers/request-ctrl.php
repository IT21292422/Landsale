<?php 
    require_once("php/includes/dbFunctions.php");

    $values = array(); //to store post details

    if (isset($_GET['id']) and is_numeric($_GET['id'])) //check if page is accessed with correct parameters
    {
        $id = $_GET['id'];  //get post id

        $values = getRequest((int)$id); //get details from the database
    }
    else
    {
        //todo error page
        echo "could not find that post";
        die();
    }
?>