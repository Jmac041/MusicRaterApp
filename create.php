<?php
    session_start();

    //Connect to database
    include 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get data from the POST request
        $username = $_SESSION['username'];
        $artist = $_POST['artist'];
        $song = $_POST['song'];
        $rating = $_POST['rating'];

        // Check if the user has already rated this song
        $check_query = "SELECT id FROM ratings_table WHERE username = '$username' AND artist = '$artist' AND song = '$song'";
        $result = $conn->query($check_query);
        
        //Preventing user from rating the same song twice
        if ($result->num_rows > 0) {
            echo "You have already rated this song. Please try again.";
        } else {
            // Insert the new rating into the ratings_table
            $insert_query = "INSERT INTO ratings_table (username, artist, song, rating) VALUES ('$username', '$artist', '$song', $rating)";
    
            if ($conn->query($insert_query) === TRUE) {
                // Rating successfully added
                header('Location: index.php');
                exit;
            } else {
                //Error message
                echo "Error: " . $conn->error;
            }
        }
    }

    $conn->close();
?>
<!--Html code to display create page-->
<!DOCTYPE html>
<html>
<head>
    <title>Rate a Song</title>
</head>
<body>
    <h2>Rate a Song</h2>
    <form method="POST" action="create.php">
        <label for="artist">Artist:</label>
        <input type="text" name="artist" required><br>
    
        <label for="song">Song:</label>
        <input type="text" name="song" required><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required><br>
    
        <input type="submit" value="Submit Rating">
    </form>
        </body>
        </html>
