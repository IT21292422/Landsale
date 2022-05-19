<?php
    require_once('php\controllers\account.ctrl.php');
?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Account Settings</title>
    <link rel="stylesheet" href="styles/page-container.css">
    <link rel="stylesheet" href="styles/account.css">
    <link rel="stylesheet" href="styles/forms.css">
    <link rel="stylesheet" href="styles/headerfooter.css"/>

    <script>
        let originalImage = "<?php echo $values['profile_photo']  ?>";
    </script>
    <script src="js/account.js"></script>

</head>
<body>

    <form class="simple-form" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="edit-profile-form">
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
                        <div class="form-field">
                            <input type="text" name="first_name" value="<?php echo $values['first_name']  ?>">
                            <label class="error"></label>
                        </div>
                        <div class="form-field">
                            <input type="text" name="last_name" class="edit hide" value="<?php echo $values['last_name']  ?>">
                            <label class="error"></label>
                        </div>
                    </div>
                    <input onclick="chooseFile()" type="button" class="edit picture-edit hide"  value="Change profile picture">
                    <input id="remove-pic" onclick="removeProfilePicture()" type="button" class="edit picture-edit hide"  value="Remove profile picture">
                </div>

                <div class="field-container">
                    <div class="info-field">
                        <p>Email</p>
                        <div class="form-field edit hide">
                            <input type="text" name="email" value="<?php echo $values['email']  ?>">
                            <label class="error"></label>
                        </div>
                        <a class="display" href="mailto:<?php echo $values['email']  ?>">
                            <p ><?php echo $values['email']  ?></p>
                        </a>
                    </div>
                    <div class="info-field">
                        <p>About</p>
                        <div class="form-field edit hide">
                            <textarea type="text" name="about"><?php echo $values['about']  ?></textarea>
                            <label class="error"></label>
                        </div>
                        <p class="display"><?php echo $values['about']  ?></p>
                    </div>
                </div>
            </div>

            <div class="contacts">
                <div class="h-with-button">
                    <h3>Contacts</h3>
                    <input type="button" class="edit btn-image plus-background hide" onclick="addPhone()">
                </div>
                <div class="field-container" id="phone-container">
                    <?php
                        foreach ($values['phone'] as $phone)
                        {
                            echo "
                                <div class='phone' id='$phone'>
                                    <a class='display' href='tel:$phone'>
                                        <p >$phone</p>
                                    </a>
                                    <div class='form-field edit hide'>
                                        <input type='text' name='phone[]' value='$phone'>
                                     </div>
                                    <input type='button' class='edit btn-image delete-background hide' onclick=\"deletePhone('$phone')\">
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
                    <a onclick="editMode()">
                        <div >
                            <p>Edit account</p>
                        </div>
                    </a>
                    <a href="saved.php">
                        <div>
                            <p>Saved posts</p>
                        </div>
                    </a>
                    <a href="myposts.php">
                        <div>
                            <p>My posts</p>
                        </div>
                    </a>
                    <a>
                        <div>
                            <p>Delete Account</p>
                        </div>
                    </a>
                    
                </div>
            </div>



        </div>
    </form>

    <?php if ($editMode) echo "<script> editMode(); </script>"?>
</body>
</html>