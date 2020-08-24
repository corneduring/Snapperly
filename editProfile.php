<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "Partials/meta.php"; ?>
    <?php require "SQL/databaseConnection.php"; ?>
    <?php require "Partials/sessionStart.php"; ?>
</head>
<body>
    <?php require "Partials/navBar.php"; ?>
    <div id="editProfileArea">
        <form method="post" action="PHP/editProfile.php" enctype="multipart/form-data">
            <div id="profilePictureContainer">
                <div class="image">
                    <?php
                        echo "<img style='display: none' class='profilePicture' id='selectedProfilePicture'>";
                        if($_SESSION["profilePicture"] == NULL){
                            echo "<img id='profilePicture' class='profilePicture' src='Graphics/defaultProfilePicture.jpg' alt='default_pfp'><br>";
                        } else {
                            echo "<img id='profilePicture' class='profilePicture' src='profilePictures/User-".$_SESSION["user_id"]."/".$_SESSION["profilePicture"]."'><br>";
                        }
                    ?>
                </div>
                <div id="profilePictureOverlay"></div>
                <label id="profilePictureLabel" for="profilePictureUpload">Change profile picture</label>
            </div>
            <input style="display: block;" type="file" id="profilePictureUpload" name="profilePictureUpload">
            <br>
            <button type="button" id="removeProfilePicture" name="removeProfilePicture">Remove profile picture</button>
            <br><br>
            <label for="bio">Update Bio:</label>
            <br>
            <textarea name="bio" id="bio" id="bio"><?php echo $_SESSION["bio"]; ?></textarea>
            <br><br>
            <label>Update Username:</label>
            <br>
            <input type="text" name="username" value="<?php echo $_SESSION["username"]; ?>">
            <br><br>
            <label>Update Password:</label>
            <br>
            <input type="password" name="password" placeholder="New password ...">
            <br><br>
            <input type="password" name="passwordConfirm" placeholder="Confirm new password ...">
            <br><br>
            <p>Email: <?php echo $_SESSION["email"]; ?></p>
            <button name="save" type="submit">Update & Save</button>
        </form>
    </div>
    <script src="Javascript/editProfile.js"></script>
</body>
</html>