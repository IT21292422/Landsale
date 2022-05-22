<?php
    //Name: H.A.R.S. Hapuarachchi
    //IT Number: it21296246
    //Center: Malabe
    //Group: MLB_05.02_09
    session_start();
    require_once('php\controllers\index-ctrl.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="styles\index.css">
    <link rel="stylesheet" href="styles\page-container.css">    
    <?php include_once('php/includes/common-css-js.php'); ?>
</head>
<body>
    <?php
        include("php/templates/header.php");
    ?>

    <!--body-->
    <form class="search-form" action="index.php">
        <input type="search" name="search" id="search">
        <input type="submit" value="Search">
    </form>

    <div class="container">

        <?php if (isset($results)) : ?>
            <div class="first">
                <h3>Results</h3>
                <div class="card-container">
                    <?php 
                        if ($results)
                        {
                            foreach ($results as $cardData)
                            {
                                include('php\templates\sale-card.php');
                            }
                        }
                        else
                        {
                            echo "<h2>No results found</h2>";
                        }
                    ?>
                </div>
            </div>
        <?php else : ?>
            <div class="first">
                <h3>Top-Sales</h3>
                <div class="card-container">
                    <?php 
                        if ($topPosts)
                        {
                            foreach ($topPosts as $cardData)
                            {
                                include('php\templates\sale-card.php');
                            }
                        }
                        else
                        {
                            echo "<h2>No results found</h2>";
                        }
                    ?>
                </div>
            </div>
            <div class="second">
                <h3>Sales</h3>
                <div class="card-container">
                    <?php 
                        if ($posts)
                        {
                            foreach ($posts as $cardData)
                            {
                                include('php\templates\sale-card.php');
                            }
                        }
                        else
                        {
                            echo "<h2>No results found</h2>";
                        }
                    ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="btn-container-ralign">
            <?php
                $uri =  $_SERVER['REQUEST_URI'];
                if (preg_match("/page=/", $uri))
                {
                    $page = (int)$_GET['page'];
                    if ($page > 1)
                    {
                        echo "<input type='button' value='Prev Page' onclick=\"window.location.href = '".preg_replace("/page=\d+/", 'page='.$page - 1, $uri)."' \">";
                    }
                    echo "<input type='button' value='Next Page' onclick=\"window.location.href = '".preg_replace("/page=\d+/", 'page='.$page + 1, $uri)."' \">";
                }
                else{
                    echo "<input type='button' value='Next Page' onclick=\"window.location.href = '".preg_replace("/php.?/",'php?page=2&', $uri)."' \">";
                    
                }
            ?>
        </div>
    </div>


    

<div><a href="admin.php">Admin</a></div>
<div><a href="complaint.php">complaint</a></div>
<div><a href="saved-posts.php">saved posts page</a></div>
<div><a href="review-complaint.php">review complaint</a></div>

    <?php
        include("php/templates/footer.php");
    ?>
</body>
</html>