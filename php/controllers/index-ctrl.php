<?php
    require_once('php\includes\dbFunctions.php');
    if(isset($_GET['search']))
    {
        $results = searchSale($_GET['search']);
    }
    else
    {
        $results = searchSale();
    }

?>