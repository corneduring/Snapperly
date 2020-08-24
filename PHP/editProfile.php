<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    require "../SQL/databaseConnection.php";
    
    $removeProfilePicture = $_POST["removeProfilePicture"];
    $bio = $_POST["bio"];
    $username = strtolower(trim($_POST["username"]));
    $password = trim($_POST["password"]);
    $passwordConfirm = trim($_POST["passwordConfirm"]);

    if (!isset($_POST["save"])){
        header("Location: ../user.php");
    }elseif (isset($_POST["save"]) && empty($_FILES['profilePictureUpload']["name"]) && $bio == $_SESSION["bio"] && $username == $_SESSION["username"] && empty($password) && empty($passwordConfirm)){
        header("Location: ../user.php");
    }elseif (isset($_POST["save"])){
        try {
            if (isset($_POST["removeProfilePicture"])){
                // $stmt = $conn->prepare("UPDATE `users` SET `profilePicture`=:profilePicture WHERE user_id = '$_SESSION[user_id]'"); 
                // $stmt->execute([":profilePicture" => NULL]);
                // $profilePictureDir = '../profilePictures/User-'.$_SESSION['user_id'].'/'.$_SESSION['profilePicture'];
                // unlink($profilePictureDir);
                // $_SESSION["profilePicture"] =  NULL;
                echo "dsfasdfsadf";
            }elseif (!(empty($_FILES['profilePictureUpload']["name"]))){
                $profilePictureDir = '../profilePictures/User-'.$_SESSION['user_id'].'/';
                //mkdir creates the directory
                mkdir($profilePictureDir);
                $target_file = $profilePictureDir . basename($_FILES["profilePictureUpload"]["name"]);
                $uploadOk = 1;
                //Translate the file's extension to lower case
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["profilePictureUpload"]["tmp_name"]);
                if($check == false) {
                    echo "File is not an image.<br>";
                }else if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".<br>";
                    $uploadOk = 1;
                }
    
                // Check file size
                if ($_FILES["profilePictureUpload"]["size"] > 500000) {
                    echo "Sorry, your file is too large.<br>";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not unsucessful, something was wrong with the file you tried to upload.<br>";
                // if everything is ok, try to upload file
                } else {
                    if (basename($_FILES["profilePictureUpload"]["name"])) {
                        //Moves the uploaded file to its directory
                        move_uploaded_file($_FILES["profilePictureUpload"]["tmp_name"], $target_file);
                        
                        try {
                            $stmt = $conn->prepare("UPDATE users SET profilePicture = :profilePicture WHERE user_id = '$_SESSION[user_id]'"); 
                            $stmt->execute([":profilePicture" => basename($_FILES["profilePictureUpload"]["name"])]);

                            unlink($profilePictureDir.$_SESSION["profilePicture"]);
                            $_SESSION["profilePicture"] =  basename($_FILES["profilePictureUpload"]["name"]);
                            
                            header("Location: ../user.php");
                        } catch(PDOException $e) {
                            echo "Error uploading image";
                        }
                    }else {
                        echo "Error No Profile Picture";
                    }
                }
            }

            if (strlen($bio) > 150){
                echo "Your bio can't be over 150 characters long.";
            }else{
                //Grabbing all records with an username equal to the username entered
                $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
                $stmt->execute([":username"=>$username]);

                if ($username == $_SESSION["username"]){
                    $username = null;
                }elseif (strlen($username) > 30) {
                    echo "The username you entered can't be longer than 30 characters.";
                }elseif ($stmt->rowcount() > 0) {
                    echo "The username you entered is already taken.";
                }else {
                    // else {
                    if(!empty($password)){
                        if (!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{6,20}$/',$password)){
                            echo "Your password must contain at least one special character, one numeric character, one capital letter and must be between 6 and 20 characters long.";
                        }elseif ($passwordConfirm != $password){
                            echo "<script>errorM(`Your passwords don't match.`);</script>";
                        }
                        $password = password_hash($password, PASSWORD_DEFAULT);
            
                        // mysql query to Update password
                        
                        $stmt = $conn->prepare("UPDATE users SET username = :username, bio = :bio, password = :password WHERE user_id = '$_SESSION[user_id]'");
                        $stmt->execute([":username"=>$username, ":bio"=>$bio, ":password"=>$password]);
                    }else{
                        //Hashing the password entered
                        $password = password_hash($password, PASSWORD_DEFAULT);
            
                        //Inserting the new record into the 'users' table
                        $stmt = $conn->prepare("UPDATE users SET username = :username, bio = :bio WHERE user_id = '$_SESSION[user_id]'");
                        $stmt->execute([":username"=>$username, ":bio"=>$bio]);
                        
                        $_SESSION['bio'] = $bio;
                        $_SESSION['username'] = $username;
                        
                        header("Location: ../user.php");
                    }
                }
            }
        } catch (PDOException $e){
            echo "Error: SQL didnt execute";
        }
    }
?>