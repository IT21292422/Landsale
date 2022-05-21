<?php
    require_once('php\includes\dbFunctions.php');
    if(isset($_GET['search']))
    {
        if (isset($_GET['page'])) $results = searchSale($_GET['search'], $_GET['page']);
        else $results = searchSale($_GET['search']);

    }
    else
    {
        if (isset($_GET['page'])) $data = getSales($_GET['page']);
        else $data = getSales();

        $topPosts = $data['top'];
        $posts = $data['posts'];
    }

?>