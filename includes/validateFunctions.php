<?php
    function checkEmpty($arr) 
    {
        foreach ($arr as $var)
        {
            if (empty($var))
            {
                return true;
            }
        }
        return false;
    }
?>