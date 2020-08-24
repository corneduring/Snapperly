<?php
    require 'SQL/databaseConnection.php';

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    try{
        //Select all the date from the feed table
        $stmt = $conn->prepare("SELECT * FROM feed WHERE user_id = :user_id ORDER BY creation_date DESC");
        //Assign the "user_id" column to user's id
        $stmt->execute([":user_id" => $_SESSION['user_id']]);
        //Define $result as an array
        $result = array();

        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
        }

        echo "<div class='feedImagesContainer'>";

        // print_r($result);

        for ($i = 0; $i < $stmt->rowcount(); $i++) {
            if ($i > 0 && $i%3 == 0) {
                echo "</div>";
                echo "<div class='feedImagesContainer'>";
            }

            $feed = <<<FEED

            <img class='feedImage' alt='image not found' src='feedUploads/User-{$_SESSION['user_id']}/{$result[$i]['image_name']}'>
            
FEED;

            echo $feed;
        }
        echo "</div>";
    } catch(PDOException $e) {
        echo "Error display";
    }

?>