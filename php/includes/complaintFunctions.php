<!--
Name: M.D.M.C.L Wickramarathne
IT Number: IT21294648
Center: Malabe
Group: MLB_05.02_09-->

<?php 

    function modAction($action, $uID)
    {
        switch($action)
        {
            case "warn":
                warnUser($uID);
                echo "<script>";
                echo "alert (\"Successfully warned user\");";
                echo "window.location.href = 'complaint.php';";
                echo "</script>";     
                break;

            case "suspend":
                suspendUser($uID);
                echo "<script>";
                echo "alert (\"Successfully suspended user\");";
                echo "window.location.href = 'complaint.php';";
                echo "</script>";         
                
                break;

            case "ban":
                banUser($uID);
                echo "<script>";
                echo "alert (\"Successfully banned user\");";
                echo "window.location.href = 'complaint.php';";
                echo "</script>";
                break;

            case "noAction":
                echo "<script>";
                echo "alert (\"No action taken\");";
                echo "window.location.href = 'complaint.php';";
                echo "</script>";
                break;

            default: 
            echo "<script>";
            echo "alert (\"No action taken\");";
            echo "window.location.href = 'complaint.php';";
            echo "</script>";
        }
    }

    function suspendUser($uID) // SQL injection fixed by using prepared statement
    {
        global $con;
        
        $sql = "UPDATE users SET account_status='suspended' WHERE user_id=?";
        $stmt = $con->prepare($sql);
        
        $stmt->bind_param('i', $uID);

        if ($stmt->execute()) {
            echo "<script> alert ('Successfully Suspended User')</script>";
        } else {
            echo "<script> alert ('Oops! Something went wrong')</script>";
        }
    }
            
    function banUser($uID) // SQL injection fixed by using prepared statement
    {
        global $con;

        $sql = "UPDATE users SET account_status='banned' WHERE user_id=?";
        $stmt = $con->prepare($sql);
        
        $stmt->bind_param('i', $uID);
        
        if ($stmt->execute()) {
            echo "<script> alert ('Successfully Banned User')</script>";
        } else {
            echo "<script> alert ('Oops! Something went wrong')</script>";
        }
    }

    function warnUser($uID) // SQL injection fixed by using prepared statement
        {
            global $con;

            $sql = "UPDATE users_warnings SET warning='Warned' WHERE user_id=?";
            $stmt = $con->prepare($sql);
            
            $stmt->bind_param('i', $uID);
            
            $stmt->execute();
        }

    function reviewed() // SQL injection fixed by using prepared statement
    {
        global $con;

        $sql = "UPDATE users SET account_status='banned' WHERE user_id=?";
        $stmt = $con->prepare($sql);
        
        $stmt->bind_param('i', $uID);
        
        if ($stmt->execute()) {
            echo "<script> alert ('User account status updated to banned.')</script>";
        } else {
            echo "<script> alert ('Oops! Something went wrong')</script>";
        }
    }
?>