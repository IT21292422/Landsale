<!--//Name: K.R.M.R.T. Karunarathna 
//IT Number: it21294198
//Center: Malabe
//Group: MLB_05.02_09
-->
<?php

include_once '../includes/dbcon.php';

    if (isset($_POST["Update"])) {

        // form data
        $user_id = $_POST['user_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $account_status = $_POST['status1'];
        $account_type = $_POST['status2'];
        $about = $_POST['about'];

        // SQL injection fixed by using prepared statement
        $sql2 = "UPDATE users SET first_name=?, last_name=?, email=?, account_status=?, account_type=?, about=? WHERE user_id=?";

        $stmt = $con->prepare($sql2);
        
        $stmt->bind_param('ssssssi', $first_name, $last_name, $email, $account_status, $account_type, $about, $user_id);

        if ($stmt->execute()) {
            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
        } else {
            // fixed sending the default error (prev: echo "Error: ".$con->error)
            echo "Failed: something went wrong with the update";
        }
    }

$con->close();

?>
