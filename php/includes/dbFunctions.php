<?php
    //Name: H.A.R.S. Hapuarachchi
    //IT Number: it21296246
    //Center: Malabe
    //Group: MLB_05.02_09
    require_once("php/includes/dbcon.php");

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

        return $sql;
        
    }

    //check validity of email and password
    // SQL injection fixed by using prepared statements
    function checkAccount($email, $pwd)
    {   
        global $con;

        $email = strtolower($email);
        $sql = "SELECT user_id, account_status FROM users WHERE email = ? AND password = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $email, $pwd);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) return NULL;

        return $result->fetch_assoc();
    }

    //get basic user details for signin
    // SQL injection fixed by using prepared statements
    function getBasicUserDetails($userId)
    {
        global $con;

        $sql = "SELECT user_id, first_name, last_name, profile_photo, account_type FROM users WHERE user_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) return NULL;

        return $result->fetch_assoc();
    }
    
    //check if an email is alredy registered
    // SQL injection fixed by using prepared statements
    function doesEmailExist($email, $userId=NULL)
    {
        global $con;
        $email = strtolower($email);
        
        if ($userId === NULL) {
            $sql = "SELECT user_id FROM users WHERE email = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $email);
        } else {
            $sql = "SELECT user_id FROM users WHERE email = ? AND user_id <> ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("si", $email, $userId);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    //get sale details
    // SQL injection fixed by using prepared statement
    function getSale($id, $userId=NULL)   //get sale details from db
    {
        global $con;

        $sql = "SELECT * FROM sale WHERE sale_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) return False;

        $sale = $result->fetch_assoc();

        // Get sale phone numbers
        $sql = "SELECT phone FROM sale_phone WHERE sale_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $phone = array();
        while ($row = $result->fetch_array()) {
            $phone[] = $row[0];
        }
        $sale['phone'] = $phone;

        // Get sale images
        $sql = "SELECT media FROM sale_media WHERE sale_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $images = array();
        while ($row = $result->fetch_array()) {
            $images[] = $row[0];
        }
        $sale['images'] = $images;

        // Get seller details
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $sale['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $sale['seller'] = NULL;
        if ($result->num_rows > 0) {
            $sale['seller'] = $result->fetch_assoc();
        }

        // Check if the sale is saved
        $sale['saved'] = False;
        if ($userId !== NULL) {
            $sql = "SELECT * FROM saved_sale WHERE user_id = ? AND sale_id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ii", $userId, $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $sale['saved'] = True;
            }
        }

        // Get seller contacts
        $sql = "SELECT phone FROM users_phone WHERE user_id = ? LIMIT 1";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $sale['seller']['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $sale['seller']['contact'] = $result->fetch_array()[0];
        } else {
            $sale['seller']['contact'] = NULL;
        }

        return $sale;
    }

    //get request details
    // SQL injection fixed by using prepared statement
    function getRequest($id, $userId=NULL)   //get request details from db
    {
        global $con;

        $sql = "SELECT * FROM request WHERE request_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) return False;

        $request = $result->fetch_assoc();

        // Get request phone numbers
        $sql = "SELECT phone FROM request_phone WHERE request_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $phone = array();
        while ($row = $result->fetch_array()) {
            $phone[] = $row[0];
        }
        $request['phone'] = $phone;

        // Get requester details
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $request['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $request['seller'] = NULL;
        if ($result->num_rows > 0) {
            $request['seller'] = $result->fetch_assoc();
        }

        // Check if the request is saved
        $request['saved'] = False;
        if ($userId !== NULL) {
            $sql = "SELECT * FROM saved_request WHERE user_id = ? AND request_id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ii", $userId, $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $request['saved'] = True;
            }
        }

        // Get seller contacts
        $sql = "SELECT phone FROM users_phone WHERE user_id = ? LIMIT 1";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $request['seller']['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $request['seller']['contact'] = $result->fetch_array()[0];
        } else {
            $request['seller']['contact'] = NULL;
        }

        return $request;
    }

    function addSaleComplaint($values, $userId)
    {
        global $con;

        $values['user_id'] = (int)$userId;

        $sql = generateInsertString('sale_complaints', $values);

        if($con->query($sql))
        {
            return True;
        }

        return False;
    }

    //save a request complaint
    function addRequestComplaint($values, $userId)
    {
        global $con;

        $values['user_id'] = (int)$userId;

        $sql = generateInsertString('request_complaints', $values);

        if($con->query($sql))
        {
            return True;
        }

        return False;
    }

    //save a sale
    // SQL injection fixed by using prepared statement
    function saveSale($values)
    {
        global $con;

        $action = $values['action'];
        unset($values['action']);

        switch ($action) {
            case 'save':
                $sql = generateInsertString('saved_sale', $values);
                break;

            case 'unsave':
                // Using prepared statements to prevent SQL injection
                $stmt = $con->prepare('DELETE FROM saved_sale WHERE user_id = ? AND sale_id = ?');
                $stmt->bind_param('ii', $values['user_id'], $values['sale_id']);
                $stmt->execute();
                return $stmt->affected_rows > 0; // Check if rows were deleted
                break;

            default:
                return False;
        }

        if($con->query($sql)) //todo crashes on duplicate error
        {
            return True;
        }

        return True; //todo check error
    }

    //save a request
    // SQL injection fixed by using prepared statement
    function saveRequest($values)
    {
        global $con;

        $action = $values['action'];
        unset($values['action']);

        switch ($action) {
            case 'save':
                $sql = generateInsertString('saved_request', $values);
                break;

            case 'unsave':
                // Using prepared statements to prevent SQL injection
                $stmt = $con->prepare('DELETE FROM saved_request WHERE user_id = ? AND request_id = ?');
                $stmt->bind_param('ii', $values['user_id'], $values['request_id']);
                $stmt->execute();
                return $stmt->affected_rows > 0; // Check if rows were deleted
                break;

            default:
                return False;
        }

        if($con->query($sql)) //todo crashes on duplicate error
        {
            return True;
        }

        return True; //todo check error
    }

    //get details of a user
    // SQL injection fixed by using prepared statement
    function getUser($userId)
    {
        global $con;

        //get data from database
        $stmt = $con->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $results = $stmt->get_result();

        //if user is not found
        if ($results && $results->num_rows < 1) return NULL;

        //get assoc array
        $user = $results->fetch_assoc();

        //get contacts from database
        $stmt = $con->prepare("SELECT phone FROM users_phone WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $results = $stmt->get_result();
        $phone = array();
        if ($results && $results->num_rows > 0)
        {
            $table = $results->fetch_all(MYSQLI_NUM);
            foreach ($table as $row)
            {
                $phone[] = $row[0];
            }
        }
        $user['phone'] = $phone;

        //get warnings from database
        $stmt = $con->prepare("SELECT warning FROM users_warnings WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $results = $stmt->get_result();
        $warnings = array();
        if ($results && $results->num_rows > 0)
        {
            $table = $results->fetch_all(MYSQLI_NUM);
            foreach ($table as $row)
            {
                $warnings[] = $row[0];
            }
        }
        $user['warnings'] = $warnings;

        return $user;
    }

    //update user details
    // SQL injection fixed by using prepared statement
    function updateUser($values, $userId)
    {
        global $con;

        $stmt = $con->prepare("DELETE FROM users_phone WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        if ($values['phone'] && count($values['phone']) > 0)
        {
            foreach($values['phone'] as $phone)
            {
                $stmt = $con->prepare("INSERT INTO users_phone (user_id, phone) VALUES (?, ?)");
                $stmt->bind_param("is", $userId, $phone);
                $stmt->execute();
            }
        }

        unset($values['phone']);

        $sql = generateUpdateString('users', $values, "user_id = ?");
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $userId);
        if ($stmt->execute())
        {
            return True;
        }

        return False;
    }

    //delete a user and all the related information
    function deleteUser($userId)
    {
        global $con;

        $sql = "delete from saved_request where request_id in (select request_id from request where user_id = $userId) or user_id = $userId;".
            "delete from saved_sale where sale_id in (select sale_id from sale where user_id = $userId) or user_id = $userId;".
            "delete from request_complaints where request_id in (select request_id from request where user_id = $userId) or user_id = $userId;".
            "delete from sale_complaints where sale_id in (select sale_id from sale where user_id = $userId) or user_id = $userId;".
            "delete from request_phone where request_id in (select request_id from request where user_id = $userId);".
            "delete from sale_phone where sale_id in (select sale_id from sale where user_id = $userId);".
            "delete from sale_media where sale_id in (select sale_id from sale where user_id = $userId);".
            "delete from sale where user_id = $userId;".
            "delete from request where user_id = $userId;".
            "delete from users_phone where user_id = $userId;".
            "delete from users_warnings where user_id = $userId;".
            "delete from users where user_id = $userId;";


        if($con->multi_query($sql)) return True;
        else return False;

    }

    //search for sales
    function searchSale($searchString='', $startFrom=0)
    {
        global $con;

        $toReturn = array();

        if (empty($searchString))
        {
            $sql = "select count(*) as num from sale;";
            $results = $con->query($sql);
            $toReturn['count'] = (int) (ceil($results->fetch_assoc()['num'] / 30));

            $sql = "select sale_id, price, district, city, title, land_area, create_date, cover_photo from sale limit $startFrom, 30;";
            $results = $con->query($sql);
            $toReturn['results'] = $results->fetch_all(MYSQLI_ASSOC);
        }
        else
        {
            $sql = "select count(*) as num from sale where match(title, city, district, province) against ('$searchString');";
            $results = $con->query($sql);
            $toReturn['count'] = (int) (ceil($results->fetch_assoc()['num'] / 30));

            $sql = "select sale_id, price, district, city, title, land_area, create_date, cover_photo from sale where match(title, city, district, province) against ('$searchString') limit $startFrom, 30;";
            $results = $con->query($sql);
            $toReturn['results'] = $results->fetch_all(MYSQLI_ASSOC);
        }

        return $toReturn;
    }

    //search for requests
    function searchRequest($searchString='', $startFrom=0)
    {
        global $con;

        $toReturn = array();

        if (empty($searchString))
        {
            $sql = "select count(*) as num from request;";
            $results = $con->query($sql);
            $toReturn['count'] = (int) (ceil($results->fetch_assoc()['num'] / 30));

            $sql = "select request_id, max_price, min_price, max_area, min_area, district, city, title, create_date, cover_photo from request limit $startFrom, 30;";
            $results = $con->query($sql);
            $toReturn['results'] = $results->fetch_all(MYSQLI_ASSOC);

        }
        else
        {
            $sql = "select count(*) as num from request where match(title, city, district, province) against ('$searchString');";
            $results = $con->query($sql);
            $toReturn['count'] = (int) (ceil($results->fetch_assoc()['num'] / 30));

            $sql = "select request_id, max_price, min_price, max_area, min_area, district, city, title, create_date, cover_photo from request where match(title, city, district, province) against ('$searchString') limit $startFrom, 30;";
            $results = $con->query($sql);
            $toReturn['results'] = $results->fetch_all(MYSQLI_ASSOC);
        }
        
        return $toReturn;
        
    }

    //get a list of sales
    function getSales($startFrom=0)
    {
        global $con;

        $toReturn = array();

        $sql = "select count(*) as num from sale;";     
        $results = $con->query($sql);
        $toReturn['count'] = (int) (ceil($results->fetch_assoc()['num'] / 30));

        $sql = "select sale_id, price, district, city, title, land_area, create_date, cover_photo from sale where type_id = 1 limit $startFrom, 15;";     
        $results = $con->query($sql);
        $toReturn['top'] = $results->fetch_all(MYSQLI_ASSOC);

        $sql = "select sale_id, price, district, city, title, land_area, create_date, cover_photo from sale where type_id <> 1 limit $startFrom, 15;";     
        $results = $con->query($sql);
        $toReturn['posts'] = $results->fetch_all(MYSQLI_ASSOC);

        return $toReturn;
        
    }

    //get a list of requests
    function getRequests($startFrom=0)
    {
        global $con;

        $toReturn = array();

        $sql = "select count(*) as num from request;";     
        $results = $con->query($sql);
        $toReturn['count'] = (int) (ceil($results->fetch_assoc()['num'] / 30));

        $sql = "select request_id, max_price, min_price, max_area, min_area, district, city, title, create_date, cover_photo from request where type_id = 1 limit $startFrom, 15;";
        $results = $con->query($sql);
        $toReturn['top'] = $results->fetch_all(MYSQLI_ASSOC);

        $sql = "select request_id, max_price, min_price, max_area, min_area, district, city, title, create_date, cover_photo from request where type_id <> 1 limit $startFrom, 15;";
        $results = $con->query($sql);
        $toReturn['posts'] = $results->fetch_all(MYSQLI_ASSOC);

        return $toReturn;
        
    }
    

    //advanced search for sales
    function advancedSearchSale($values, $startFrom = 0)
    {
        global $con;

        $sql = "select sale_id, price, district, city, title, land_area, create_date, cover_photo from sale where ";

        if (isset($values['min_price']) and !empty($values['min_price'])) $sql .= 'price > ' . $values['min_price'] . ' and ';
        if (isset($values['max_price']) and !empty($values['max_price'])) $sql .= 'price < ' . $values['max_price'] . ' and ';
        if (isset($values['min_area']) and !empty($values['min_area'])) $sql .= 'area > ' . $values['min_area'] . ' and ';
        if (isset($values['max_area']) and !empty($values['max_area'])) $sql .= 'area < ' . $values['max_area'] . ' and ';
        if (isset($values['min_date']) and !empty($values['min_date'])) $sql .= 'create_date > ' . $values['min_date'] . ' and ';
        if (isset($values['max_date']) and !empty($values['max_date'])) $sql .= 'create_date < ' . $values['max_date'] . ' and ';
        if (isset($values['city']) and !empty($values['city'])) $sql .= 'city = \'' . $values['city'] . '\' and ';
        if (isset($values['district']) and !empty($values['district'])) $sql .= 'district = \'' . $values['district'] . '\' and ';
        if (isset($values['province']) and !empty($values['province'])) $sql .= 'province = \'' . $values['province'] . '\' and ';
        if (isset($values['search']) and !empty($values['search'])) $sql .= " match(title, city, district, province) against ('". $values['search']."') and ";

        $sql .= "true LIMIT $startFrom, 30;";
        $results = $con->query($sql);
        $toReturn['results'] = $results->fetch_all(MYSQLI_ASSOC);
        $toReturn['count'] = 0;
        return $toReturn;

    }

    //advanced search for requests
    function advancedSearchRequest($values, $startFrom = 0)
    {
        global $con;

        $sql = "select request_id, max_price, min_price, max_area, min_area, district, city, title, create_date, cover_photo from request where ";

        if (isset($values['min_price']) and !empty($values['min_price'])) $sql .= 'min_price > ' . $values['min_price'] . ' and ';
        if (isset($values['max_price']) and !empty($values['max_price'])) $sql .= 'max_price < ' . $values['max_price'] . ' and ';
        if (isset($values['min_area']) and !empty($values['min_area'])) $sql .= 'min_area > ' . $values['min_area'] . ' and ';
        if (isset($values['max_area']) and !empty($values['max_area'])) $sql .= 'max_area < ' . $values['max_area'] . ' and ';
        if (isset($values['min_date']) and !empty($values['min_date'])) $sql .= 'create_date > ' . $values['min_date'] . ' and ';
        if (isset($values['max_date']) and !empty($values['max_date'])) $sql .= 'create_date < ' . $values['max_date'] . ' and ';
        if (isset($values['city']) and !empty($values['city'])) $sql .= 'city = \'' . $values['city'] . '\' and ';
        if (isset($values['district']) and !empty($values['district'])) $sql .= 'district = \'' . $values['district'] . '\' and ';
        if (isset($values['province']) and !empty($values['province'])) $sql .= 'province = \'' . $values['province'] . '\' and ';
        if (isset($values['search']) and !empty($values['search'])) $sql .= " match(title, city, district, province) against ('". $values['search']."') and ";
        $sql .= "true LIMIT $startFrom, 30;";
        $results = $con->query($sql);
        $toReturn['results'] = $results->fetch_all(MYSQLI_ASSOC);
        $toReturn['count'] = 0;
        return $toReturn;

    }

    //delete warnings of a user
    function deleteWarning($userId)
    {
        global $con;

        $sql = "delete from users_warnings where user_id = $userId;";

        $con->query($sql);
    }
?>