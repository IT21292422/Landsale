<?php
    require_once('php\includes\dbFunctions.php');
    if(isset($_GET['search']))
    {
        $results = searchRequest($_GET['search']);
    }
    else
    {
        $results = searchRequest();
    }

?>