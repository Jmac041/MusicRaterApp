<?php
    session_start();

    //Connect to database
    include 'config.php';

    //Displays message telling user if they are logged in and providing them a link to log out
    if (isset($_SESSION['username'])) {
        echo "You are now logged in as " . $_SESSION['username'] . ". <a href='?logout=1'>Log Out</a><br>";
    }
    //Sends user to login page if not logged in
    else {
        header('Location: login.php');
        exit;
    }

    // Check if the rating ID is provided in the URL
    if (isset($_GET['id'])) {
        $rating_id = $_GET['id'];

    // Fetch the rating information based on the ID
    $sql = "SELECT * FROM ratings_table WHERE id = $rating_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $artist = $row['artist'];
        $song = $row['song'];
        $rating = $row['rating'];
?>
        <!--Display the rating information-->
        <!DOCTYPE html>
        <html>
        <head>
            <title>View Rating</title>
        </head>
        <body>
            <div class='rating-container'>
                <h2>View Rating</h2>
                <table class='rating-table'>
                    <tr>
                        <td><strong>Username:</strong></td>
                        <td><?php echo $username ?></td>
                    </tr>
                    <tr>
                        <td><strong>Artist:</strong></td>
                        <td><?php echo $artist ?></td>
                    </tr>
                    <tr>
                        <td><strong>Song:</strong></td>
                        <td><?php echo $song ?></td>
                    </tr>
                    <tr>
                        <td><strong>Rating:</strong></td>
                        <td><?php echo $rating ?></td>
                    </tr>
                </table>
                <a href='index.php'>Back to Ratings</a>
            </div>
        </body>
        </html>
<?php
    } else {
        echo "Rating not found.";
    }
} else {
    echo "Rating ID not provided.";
}

// Close the database connection
$conn->close();
?>

