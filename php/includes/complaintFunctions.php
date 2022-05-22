<?php 

function modAction($action, $uID)
{
    switch(action)
    {
        case "warn":
            warnUser($uID);
            echo "Successfully warned user";
            break;

        case "suspend":
            suspendUser($uID);
            echo "Successfully suspended user";
            break;

        case "ban":
            banUser($uID);
            echo "Successfully suspended user";
            break;

        case "noAction":
            echo "No action taken";
            break;

        default: 
            echo "No action selected";
    }
}


function suspendUser($uID)
{
    $sql = "UPDATE users SET account_status=\"Suspended\" WHERE user_id=$uID";
                
        if($con->query($query))
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
        $sql = "UPDATE users SET account_status=\"Banned\" WHERE user_id=$uID";
                
        if($con->query($query))
        {
            echo "<script> alert ('Successfully Banned User')</script>";
        }
        else
        {
            echo "<script> alert ('Oops! Something went wrong')</script>";
        }
    }
?>