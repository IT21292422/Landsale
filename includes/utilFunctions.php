<?php
    function checkEmpty() //check for empty values in the array DO NOT USE FOR NUMERIC VALUES
    {
        $values = func_get_args();//get parameters of the function

        foreach ($values as $value) //check if the value is empty for each value
        {
            if (empty($value))
            {
                return true; //if there is an empty value return true
            }
        }
        return false;   //else false
    }
?>