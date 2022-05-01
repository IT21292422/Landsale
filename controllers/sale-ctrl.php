<?php 
    require_once("includes/dbFunctions.php");
    require_once("includes/utilFunctions.php");

    $values = array(); //to store post details

    if (isset($_GET['id'])) //check if page is accessed with correct parameters
    {
        $id = $_GET['id'];  //get post id
        if (is_numeric($id)) //validate id
        {
            $values = getSale((int)$id); //get details from the database
        }
    }
    else
    {
        //todo error page
        echo "could not find that post";
        die();
    }
?>