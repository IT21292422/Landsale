<header>

<style>
.head1{
        /*background-color: rgb(11, 6, 0);*/
        background-image: url('images/headerfooter/lands/land7.jpg');
        margin: -15px;
        display: flex;
}
</style>

        <div class="head1">
        <!--Company logo-->
        <img class="logo" src="images/headerfooter/logo.png" alt="Golden Lands">
        </div>

        <!--Main Menu or Navigation Bar-->
        <div class="navbar">
            <a href="index.php" onclick="breadCrumbFunctio('home')">Home</a>
            <a href="requests.php" onclick="breadCrumbFunctio('request')">Land Requests</a>
            <a href="submit-sale.php" onclick="breadCrumbFunctio('sell')">Sell Your Land</a>
            <a href="submit-request.php" onclick="breadCrumbFunctio('submit')">Submit a Request</a>
        
            <!--User's image-->
            <a href="account.php" class="right"><img class="profilepic" src="images/headerfooter/profile.png" alt="UserImg"></img></a>
            <a href="signin.php" class="right">Login</a>
            <a href="register.php" class="right">Register</a>
             
        </ul>
        </div>
            
        <div><p id="breadcumbs">
        </p>
        </div>
       
        </header>