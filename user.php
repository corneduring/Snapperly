<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "Partials/meta.php"; ?>
    <?php require "SQL/databaseConnection.php"; ?>
    <?php require "Partials/sessionStart.php"; ?>
</head>
<body>
    <?php require "Partials/navBar.php"; ?>
    <div id="userPageField">
    <!--User's Profile Card-->
        <!--Profile Picture Area-->
        <div id="profilePictureArea">
            <?php
                if($_SESSION["profilePicture"] == NULL){
                    echo "<img class='profilePicture' src='Graphics/defaultProfilePicture.jpg' alt='default_pfp'><br>";
                } else {
                    echo "<img class='profilePicture' src='profilePictures/User-".$_SESSION['user_id']."/".$_SESSION["profilePicture"]."'><br>";
                }
            ?>
            <br>
            <p id="username"><?php echo $_SESSION["username"]; ?></p>
            <form method="POST" action="PHP/uploadButton.php" enctype="multipart/form-data">
                <!--Upload Button-->
                <input style="display: none;" onchange="openCaptionModal(<?php echo $_SESSION['user_id']; ?>)" type="file" name="uploadInput" id="uploadInput">
                <label id="uploadLabel" for="uploadInput"><img id="uploadButton" src="Graphics/uploadIcon.png"><img id="uploadButtonHover" src="Graphics/uploadIconHover.png"></label>
                <!--Caption Modal-->
                <div id="<?php echo $_SESSION['user_id']; ?>" class="modal">
                    <div id="captionModalContent">
                        <img id="output">
                        <div>
                            <input type="text" name="caption">
                            <button type="submit">Post</button>
                            <button onclick="closeCaptionModal(<?php echo $_SESSION['user_id']; ?>)">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!----------------------->
        <!--Profile Details-->
        <div id="profileDetails">
            <p id="flName"><?php echo $_SESSION["firstName"] . " " . $_SESSION["lastName"]?></p>
            <form method="POST" action="editProfile.php" style="margin-bottom: 16px;"><button type="submit">Edit Profile</button></form>
            <p style="overflow-wrap: normal; font-size: 15px">
                <span># Followers</span>
                <span># Following</span>
                <span># Posts</span>
            </p>
            <p id="bio"><?php echo $_SESSION["bio"]; ?></p>
        </div>
        <!------------------->
    <!----------------------->
        <div id="toggleBar"></div>
        <?php require "PHP/displayFeedImages.php"; ?>
    </div>
    <script src="Javascript/user.js"></script>
</body>
</html>