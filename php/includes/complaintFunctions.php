<?php 

function modAction($action, $uID)
{
    switch($action)
    {
        case "warn":
            warnUser($uID);
            alert ("Successfully warned user");
            echo "<script>";
            echo "window.location = '../../complaint.php'";
            echo "</script>";     
            break;

        case "suspend":
            suspendUser($uID);
            echo "<script>";
            echo "alert (\"Successfully suspended user\")";
            echo "window.location = '../../complaint.php'";
            echo "</script>";         
            
            break;

        case "ban":
            banUser($uID);
            echo "<script>";
            echo "alert (\"Successfully banned user\")";
            echo "window.location = '../../complaint.php'";
            echo "</script>";
            break;

        case "noAction":
            echo "<script>";
            echo "alert (\"No action taken\")";
            echo "window.location = '../../complaint.php'";
            echo "</script>";
            break;

        default: 
        echo "<script>";
        echo "alert (\"No action taken\")";
        echo "window.location = '../../complaint.php'";
        echo "</script>";
    }
}

function suspendUser($uID)
{
    global $con;
    $sql = "UPDATE users SET account_status='suspended' WHERE user_id=$uID";
    echo $sql;
    
        if($con->query($sql))
        {
             echo "<script> alert ('Successfully Suspended User')</script>";
        }
        else
        {
            echo "<script> alert ('Oops! Something went wrong')</script>";
        }
}
        
function banUser($uID)
    {
        global $con;

        $sql = "UPDATE users SET account_status='banned' WHERE user_id=$uID";
                
        if($con->query($sql))
        {
            echo "<script> alert ('Successfully Banned User')</script>";
        }
        else
        {
            echo "<script> alert ('Oops! Something went wrong')</script>";
        }
    }

function reviewed()
{
    global $con;

    $sql = "UPDATE users SET account_status='banned' WHERE user_id=$uID";
}
?>