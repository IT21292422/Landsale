<?php 

function modAction($action, $uID)
{
    switch($action)
    {
        case "warn":
            warnUser($uID);
            alert ("Successfully warned user");
            <script>
            echo "window.location = '../../complaint.php'";
            </script>            
            break;

        case "suspend":
            suspendUser($uID);
            alert ("Successfully suspended user");
            <script>
            echo "window.location = '../../complaint.php'";
            </script>
            
            break;

        case "ban":
            banUser($uID);
            alert ("Successfully suspended user");
            <script>
            echo "window.location = '../../complaint.php'";
            </script>            break;

        case "noAction":
            alert ("No action taken");
            <script>
            echo "window.location = '../../complaint.php'";
            </script>            break;

        default: 
        alert ("No action selected");
        <script>
        echo "window.location = '../../complaint.php'";
        </script>    }
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