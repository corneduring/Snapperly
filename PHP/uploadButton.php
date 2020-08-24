<?php
    require '../SQL/databaseConnection.php';

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    try {
        if (!(empty($_FILES['uploadInput']["name"]))){
            $caption = $_POST["caption"];

            $user_dir = '../feedUploads/User-'.$_SESSION['user_id'].'/';
            //mkdir creates the directory
            mkdir($user_dir);
            $target_file = $user_dir . basename($_FILES["uploadInput"]["name"]);
            $uploadOk = 1;
            //Translate the file's extension to lower case
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["uploadInput"]["tmp_name"]);
            if($check == false) {
                echo "File is not an image.<br>";
            }else if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".<br>";
                $uploadOk = 1;
            }

            // Check file size
            if ($_FILES["uploadInput"]["size"] > 500000) {
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
                if (basename($_FILES["uploadInput"]["name"])) {
                    //Moves the uploaded file to its directory
                    move_uploaded_file($_FILES["uploadInput"]["tmp_name"], $target_file);
                    
                    try {
                        $stmt = $conn->prepare("INSERT INTO feed (image_name, user_id, caption) VALUES (:image, :user_id, :caption)"); 
                        $stmt->execute([":image" => basename($_FILES["uploadInput"]["name"]), ":user_id" => $_SESSION['user_id'], ":caption" => $caption]);
                        unlink($profilePictureDir.$_SESSION['pfp']);
                        $_SESSION["pfp"] =  basename($_FILES["uploadInput"]["name"]);
                    } catch(PDOException $e) {
                        echo "Error uploading image";
                    }
                } else {
                    echo "Error No Profile Picture";
                }
                header("Location: ../user.php");
            }
        }else{
            header("Location: ../user.php");
        }
    } catch (PDOException $e){
        echo "Error: SQL didnt execute";
    }
?>