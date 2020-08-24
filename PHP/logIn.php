<?php
    require "../SQL/databaseConnection.php";

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);

    if (isset($_POST["submitLI"])){
        try{
            //Ensuring the user doesnt leave any fields empty
            if (empty($email) || empty($password)){
                echo "Please fill in all the fields.";
            }else {
                //Validating the email the user entered
                if (!(filter_var($email, FILTER_VALIDATE_EMAIL))){
                    echo "The email you entered is not valid.";
                }else {
                    //Grabbing all records with an email equal to the user's input
                    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
                    $stmt->execute([":email" => $email]);

                    if ($stmt->rowcount() > 0){
                        //Grabs the record with the email equal to the user's input
                        //and puts in in an associative array
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        if (password_verify($password, $result["password"])){
                            //Assigning the data in the results array into session variablles
                            $_SESSION["user_id"] = $result["user_id"];
                            $_SESSION["firstName"] = $result["firstName"];
                            $_SESSION["lastName"] = $result["lastName"];
                            $_SESSION["email"] = $result["email"];
                            $_SESSION["username"] = $result["username"];
                            $_SESSION["profilePicture"] = $result["profilePicture"];
                            $_SESSION["bio"] = $result["bio"];
                            header("Location: ../user.php");
                        }else {
                            echo "<script>errorM('The password you entered is incorrect.')</script>";
                        }
                    }else {
                        echo "The email you entered is not linked to an existing account, try signing up first.";
                    }
                }
            }
        }catch(PDOException $e) {
            echo "Error: SQL didnt execute";
        }
    }
?>