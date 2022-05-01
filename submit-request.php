<?php include('controllers/submit-request-ctrl.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Submit request</title>
</head>
<body>
    <?php
        include("templates/header.php");
    ?>

    <fieldset>
        <legend>Submit Request Form</legend>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label>Title</label> <br>
            <input type="text" name="title" ><br><br> 
            <label>Cover Photo : </label>
            <input type="file" name="cover_photo" accept="image/png, image/jpeg"><br><br> 
            <label>Location</label> <br>
            <input type="text" name="location" ><br><br> 
            <label>Description</label> <br>
            <textarea name="description" rows="10" cols="50" ></textarea><br><br> 
            <label>City</label> <br>
            <input type="text" name="city" ><br><br> 
            <label>District</label> <br>
            <select name="district">
                <option value="Anuradhapura">Anuradhapura</option>
                <option value="Colombo">Colombo</option>
                <option value="Gampaha">Gampaha</option>
                <option value="Kaluthara">Kaluthara</option>
                <option value="Kandy">Kandy</option>
                <option value="Mathale">Mathale</option>
                <option value="Nuwara-Eliya">Nuwara-Eliya</option>
                <option value="Kegalla">Kegalla</option>
                <option value="Rathnapura">Rathnapura</option>
                <option value="Badulla">Badulla</option>
                <option value="Monaragala">Monaragala</option>
                <option value="Galle">Galle</option>
                <option value="Matara">Matara</option>
                <option value="Hambanthota">Hambanthota</option>
                <option value="Trincomalee">Trincomalee</option>
                <option value="Batticaloa">Batticaloa</option>
                <option value="Ampara">Ampara</option>
                <option value="Puttalam">Puttalam</option>
                <option value="Kurunegala">Kurunegala</option>
                <option value="Jaffna">Jaffna</option>
                <option value="Killinochchi">Killinochchi</option>
                <option value="Mannar">Mannar</option>
                <option value="Mullaitivu">Mullaitivu</option>
                <option value="Polonnaruwa">Polonnaruwa</option>                    
                <option value="Vavuniya">Vavuniya</option>
            </select><br><br>
            <label>Province</label> <br>
            <select name="province">
                <option value="Western">Western Province</option>
                <option value="North-Western">North-Western</option>
                <option value="Nothern">Northern Province</option>
                <option value="North-Central">North-Central Province</option>
                <option value="Central">Central Province</option>
                <option value="Sabaragamuwa">Sabaragamuwa Province</option>
                <option value="Eastern">Eastern Province</option>
                <option value="Uva">Uva Province</option>
                <option value="Southern">Southern Province</option>
            </select> <br><br>
            <label>Maximum Price</label> <br>
            <input type="text" name="max_price" pattern="[0-9]{10}" ><br><br> 
            <label>Minimum Price</label> <br>
            <input type="text" name="min_price" pattern="[0-9]{10}" ><br><br> 
            <label>Maximum Area</label> <br>
            <input type="text" name="max_area" pattern="[0-9]{10}" ><br><br> 
            <label>Minimum Area</label> <br>
            <input type="text" name="min_area" pattern="[0-9]{10}" ><br><br> 
            <label>Distance</label> <br>
            <input type="text" name="distance" pattern="[0-9]{10}" ><br><br> 
            <input type="reset" name ="reset" value="Reset">
            <input type="submit" name ="submit" value="Submit">
        </form>
    </fieldset>

    <?php
        include("templates/footer.php");
    ?>
</body>
</html>