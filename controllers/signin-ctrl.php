<?php
    include_once("../includes/dbcon.php");
    include_once("../includes/dbfunctions.php");
    include_once("../includes/validateFunctions.php");

    if(isset($_POST["username"])) //check for a post method
    {
        //start session
        session_start();

        //get values from user
        $name = $_POST["username"];
        $pwd = $_POST["pwd"];

        //check for empty fields
        if (checkEmpty(array($name, $pwd)))
        {
            
        }
    }




?>