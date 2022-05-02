<?php
    require_once("includes/dbcon.php");

    //generate an sql statement for the given values and table
    function generateInsertString($tableName, $values)
    {
        $sql = "insert into $tableName ({fieldNames}) values ({values});";

        $fieldNames = array_keys($values);  //get keys from array
        $fieldValues = array_values($values);   //get values from array

        $str_fieldNames = '';
        $str_values = '';

        for ($i = 0; $i < count($fieldNames); $i++)
        {
            $sep = ',';
            if ($i === 0) $sep = '';

            $str_fieldNames .= $sep.$fieldNames[$i];    //add field name to the fieldnames string
            
            if (is_null($fieldValues[$i]))  //if value is null add 'NULL' to the values string
            {
                $str_values .= $sep.'NULL';
            }
            elseif (gettype($fieldValues[$i]) == "integer") //if value is an int add the value to the values string
            {
                $str_values .= $sep.(int)$fieldValues[$i];
            }
            elseif (gettype($fieldValues[$i]) == "double")  //if value is an double add the value to the values string
            {
                $str_values .= $sep.(double)$fieldValues[$i];
            }
            else    //if value is an string add the string to the values string with quotes
            {
                $str_values .= $sep."'".$fieldValues[$i]."'";
            }

        }
        //add field names and values to the sql statement
        $sql = str_replace('{fieldNames}', $str_fieldNames, $sql);
        $sql = str_replace('{values}', $str_values, $sql);

        echo $sql;

        return $sql;
        
    }

    //generate an sql statement for the given table, values and conditions
    function generateUpdateString($tableName, $values, $condition)
    {
        $sql = "update $tableName set {values} where $condition;";

        $fieldNames = array_keys($values);  //get keys from array
        $fieldValues = array_values($values);   //get values from array

        $str_values = '';

        for ($i = 0; $i < count($fieldNames); $i++)
        {
            $sep = ',';
            if ($i === 0) $sep = '';

            $str_values .= $sep.$fieldNames[$i].'=';    //add field name to the values string
            
            if (is_null($fieldValues[$i]))  //if value is null add 'NULL' to the values string
            {
                $str_values .= 'NULL';
            }
            elseif (gettype($fieldValues[$i]) == "integer") //if value is an int add the value to the values string
            {
                $str_values .= (int)$fieldValues[$i];
            }
            elseif (gettype($fieldValues[$i]) == "double")  //if value is an double add the value to the values string
            {
                $str_values .= (double)$fieldValues[$i];
            }
            else    //if value is an string add the string to the values string with quotes
            {
                $str_values .= "'".$fieldValues[$i]."'";
            }

        }
        //add field names and values to the sql statement
        $sql = str_replace('{values}', $str_values, $sql);

        echo $sql;

        return $sql;
        
    }

    function matchUserPassword($email, $pwd)
    {   
        global $con;
        $email = strtolower($email);
        $sql = "select user_id from users where email= '$email' and password= '$pwd'";
        $results = $con->query($sql);

        if ($results->num_rows < 1) return NULL;

        return $results->fetch_assoc()['user_id'];
    }

    function getBasicUserDetails($userId)
    {
        global $con;

        $sql = "select user_id, first_name, last_name, profile_photo, account_type from users where user_id = $userId";

        $results = $con->query($sql);

        if ($results->num_rows < 1) return NULL;

        return $results->fetch_assoc();
    }

    function addUser($values)   //todo profile photo
    {
        global $con;

        $sql = generateInsertString('users', $values);

        if($con->query($sql))
        {
            return $con->insert_id;
        }

        return NULL;
    }

    function doesEmailExist($email)
    {
        global $con;
        $email = strtolower($email);
        $sql = "select user_id from users where email = '$email'";
        $results = $con->query($sql);

        if ($results->num_rows < 1) return False;

        return True;
    }

    function addRequest($values, $userId)
    {
        global $con;

        $values['user_id'] = (int)$userId;

        $sql = generateInsertString('request', $values);

        if($con->query($sql))
        {
            return True;
        }

        return False;
    }

    function addSale($values)
    {
        global $con;

        $values['user_id'] = (int)$userId;

        $sql = generateInsertString('sale', $values);

        if($con->query($sql))
        {
            return True;
        }

        return False;
    }

   

    function getSale($id)   //get sale details from db
    {
        global $con;
        $sql = "select * from sale where sale_id = $id";
        $results = $con->query($sql);

        if ($results and $results->num_rows < 1) return False;

        return $results->fetch_assoc();
    }

    function getRequest($id)    //get request details from db
    {
        global $con;
        $sql = "select * from request where sale_id = $id";
        $results = $con->query($sql);

        if ($results and $results->num_rows < 1) return False;

        return $results->fetch_assoc();
    }

    function getSales($startFrom) //get list of sales from db
    {
        global $con;
        $sql = "select (sale_id, price, province, district, city, title, land_area) from sale limit $startFrom, 10";
        $results = $con->query($sql);

        if ($results and $results->num_rows < 1) return False;

        return $results->fetch_array(MYSQLI_ASSOC);
    }

    function getRequests($startFrom)  //get list of requests from db
    {
        global $con;
        $sql = "select (sale_id, max_price, min_price, province, district, city, title, max_area, min_area) from request limit $startFrom,10";
        $results = $con->query($sql);

        if ($results and $results->num_rows < 1) return False;

        return $results->fetch_array(MYSQLI_ASSOC);
    }

?>