<?php 

function modAction(action)
{
    switch(action)
    {
        case "Warn":
            ///
            break;
        case: "Suspend"
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