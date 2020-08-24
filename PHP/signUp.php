<?php
    require "../SQL/databaseConnection.php";
    
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = strtolower(trim($_POST['username']));
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);
    $passwordConfirm = trim($_POST['passwordConfirm']);
    
    if (isset($_POST["submitSU"])){
        try{
            //Grabbing all records with an username equal to the username entered
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute([":username"=>$username]);
    
            // echo $stmt->rowcount();
    
            //Testing whether or not the user left any fields empty
            if (empty($firstName) || empty($lastName) || empty($username) || empty($email) || empty($password) || empty($passwordConfirm)){
                echo "Please enter all the fields."; 
            //Testing whether the username entered is equal to an already existing username in the database
            }else{
                if ($stmt->rowcount() > 0) {
                    echo "<script>errorM('The username you entered is already taken, try another one.');</script>";
                    // echo "username taken";
                }else{
                    if (strlen($username) > 30) {
                        echo "<script>errorM('Your username cannot be longer than 30 characters.');</script>";
                    //Checking wheter the email entered is valid
                    }else {
                        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
                            // echo "<script>errorM('".$email." is not a valid email address');</script>";
                            echo $email . " is not a valid email address";
                        }else{
                            //Grabing all records with an email equal to the email entered
                            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
                            $stmt->execute([":email"=>$email]);
    
                            if ($stmt->rowcount() > 0) {
                                echo "<script>errorM('This email is already linked to an account, try logging in.');</script>";
                            //Checking if the password entered is valid
                            }else {
                                if (!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{6,20}$/',$password)){
                                    echo "Your password must contain at least one special character, one numeric character, one capital letter and must be between 6 and 20 characters long.";
                                }elseif ($password != $passwordConfirm){
                                        // echo "123";
                                        echo "<script>errorM(`Your passwords don't match.`);</script>";
                                }else {
                                    //Hashing the password entered
                                    $password = password_hash($password, PASSWORD_DEFAULT);
                        
                                    //Inserting the new record into the 'users' table
                                    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, username, email, password) VALUES (:firstName, :lastName, :username, :email, :password)");
                                    $stmt->execute([":firstName"=>$firstName, ":lastName"=>$lastName, ":username"=>$username, ":email"=>$email, ":password"=>$password]);
                                    header("Location: ../index.php");
                                }
                            }
                        }
                    }
                }
            }
        }catch(PDOException $e){
            echo "Error: SQL didnt execute";
        }
    }
?>