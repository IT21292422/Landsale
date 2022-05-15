<?php
    require_once('php\controllers\account.ctrl.php');
?>

<!DOCTYPE html>
<!-- saved from url=(0044)http://localhost:8080/landsale/sale.php?id=1 -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Account Settings</title>
    <link rel="stylesheet" href="styles/page-container.css">
    <link rel="stylesheet" href="styles/account.css">

    <script>
        let originalImage = "<?php echo $values['profile_photo']  ?>";
    </script>
    <script src="js/account.js"></script>

</head>
<body>

    <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="edit-profile-form">
        <input id="photo-input" class="hide" type="file" name="profile_photo" onchange="photoSelected()" disabled>

        <div class="container" id="report-post">

            <div class="title">
                <h1>Account Settings</h1>
            </div>

            <div class="user-details">
                <div class="profile-container">
                    <img id="profile-img" class='profile-img' src="<?php echo $values['profile_photo']  ?>" alt="">
                    <h2 class="display"><?php echo $values['first_name'] . ' ' . $values['last_name']  ?></h2>
                    <div class="edit hide">
                        <input type="text" name="first_name" class="edit hide" value="<?php echo $values['first_name']  ?>">
                        <input type="text" name="last_name" class="edit hide" value="<?php echo $values['last_name']  ?>">
                    </div>
                    <input onclick="chooseFile()" type="button" class="edit picture-edit hide"  value="Change profile picture">
                    <input id="remove-pic" onclick="removeProfilePicture()" type="button" class="edit picture-edit hide"  value="Remove profile picture">
                </div>

                <div class="field-container">
                    <div class="info-field">
                        <p>Email</p>
                        <input type="text" name="email" class="edit hide" value="<?php echo $values['email']  ?>">
                        <p class="display"><?php echo $values['email']  ?></p>

                    </div>
                    <div class="info-field">
                        <p>About</p>
                        <textarea type="text" name="about" class="edit hide"><?php echo $values['about']  ?></textarea>
                        <p class="display"><?php echo $values['about']  ?></p>

                    </div>
                </div>
            </div>

            <div class="contacts">
                <div class="h-with-button">
                    <h3>Contacts</h3>
                    <input type="button" class="edit btn-image plus-background hide">
                </div>
                <div class="field-container">
                    <?php
                        foreach ($values['phone'] as $phone)
                        {
                            echo "<div class='phone'>
                            <p class='display'>$phone</p>
                            <input type='text' name='phone[]' class='edit hide' value='$phone'>
                            <input type='button' class='edit btn-image delete-background hide'>
                            </div>";
                        }
                    ?>
                </div>
            </div>

            <div class="btn-container-ralign hide edit">            
                <input type="submit" value="Save changes">

            </div>

            <div class="options">
                <h3>Options</h3>
                <div class="field-container">
                    <div onclick="editMode()">
                        <p>Edit account</p>
                    </div>
                    <div>
                        <p>Saved posts</p>
                    </div>
                    <div>
                        <p>My posts</p>
                    </div>
                    <div>
                        <p>Delete Account</p>
                    </div>
                </div>
            </div>



        </div>
    </form>

    <?php if ($editMode) echo "<script> editMode(); </script>"?>
</body>
</html>