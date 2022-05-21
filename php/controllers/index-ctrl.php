<?php
    require_once('php\includes\dbFunctions.php');
    if(isset($_GET['search']))
    {
        $results = searchSale($_GET['search']);
    }
    else
    {
        $data = getSales();
        $topPosts = $data['top'];
        $posts = $data['posts'];
    }

?>