<?php
    session_start();

    include "config.php";
    
    //Displays message telling user if they are logged in and providing them a link to log out
    if (isset($_SESSION['username'])) {
        echo "You are now logged in as " . $_SESSION['username'] . ". <a href='?logout=1'>Log Out</a><br>";
    }
    //Sends user to login page if not logged in
    else {
        header('Location: login.php');
        exit;
    }
    //If 'logout' is clicked
    if (isset($_GET['logout'])) {
        // Unset and destroy the session to log the user out
        session_unset();
        session_destroy();
        
        // Redirect back to login page
        header('Location: login.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>FaveTune: Music Rater App</title>
    </head>  
    <body>
        <h1>FaveTune Song Ratings</h1>
                <!--Link to add song rating-->
                <a href='create.php'>Add a New Rating</a><br>
                <div class='ratings-display'>
                <?php
                    // Fetch the ratings_table
                    $sql = "SELECT id, username, artist, song, rating FROM ratings_table";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        //Borders for displaying table
                        echo "<table border='1'>";
                        echo "<tr><th>Action</th><th>ID</th><th>Username</th><th>Artist</th><th>Song</th><th>Rating</th></tr>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>";

                            // Check if the rating belongs to the logged-in user
                            if (isset($_SESSION['username']) && $row['username'] === $_SESSION['username']) {
                                // Display links to view, update, and delete for user's own ratings
                                echo "<a href='read.php?id={$row['id']}'>View</a> ";
                                echo "<a href='update.php?id={$row['id']}'>Update</a> ";
                                echo "<a href='delete.php?id={$row['id']}'>Delete</a>";
                            } else {
                                // Display a link to view for ratings that don't belong to the user
                                echo "<a href='read.php?id={$row['id']}'>View</a>";
                            }
                            echo "</td>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['artist'] . "</td>";
                            echo "<td>" . $row['song'] . "</td>";
                            echo "<td>" . $row['rating'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        //Case for no ratings in the database
                        echo "No ratings found.";
                    }
                    // Close the database connection
                    $conn->close();
                    ?>
                </div>
    </body>
</html>
