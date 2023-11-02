<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include 'config.php';

// If 'logout' is clicked
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    
    // Redirect back to the login page
    header('Location: login.php');
    exit;
}

// Check if the rating ID is provided in the URL
if (isset($_GET['id'])) {
    $rating_id = intval($_GET['id']);  // Ensure it's an integer

    // If update form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $artist = $_POST['artist'];
        $song = $_POST['song'];
        $rating = intval($_POST['rating']);  // Ensure it's an integer

        $stmt = $conn->prepare("UPDATE ratings_table SET artist=?, song=?, rating=? WHERE id=?");
        $stmt->bind_param("ssii", $artist, $song, $rating, $rating_id);
        if ($stmt->execute()) {
            header('Location: index.php');
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $stmt = $conn->prepare("SELECT * FROM ratings_table WHERE id = ?");
    $stmt->bind_param("i", $rating_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Rating</title>
</head>
<body>
    <h2>Update Rating</h2>
    <!-- Display the logged in message at the top -->
    <?php
    if (isset($_SESSION['username'])) {
        echo "You are now logged in as " . $_SESSION['username'] . ". <a href='?logout=1'>Log Out</a><br><br>";
    }
    ?>
    <form method="POST" action="update.php?id=<?php echo $rating_id; ?>">
        <label for="artist">Artist:</label>
        <input type="text" name="artist" value="<?php echo $row['artist']; ?>" required><br>

        <label for="song">Song:</label>
        <input type="text" name="song" value="<?php echo $row['song']; ?>" required><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" value="<?php echo $row['rating']; ?>" min="1" max="5" required><br>

        <input type="submit" value="Update Rating">
        <button onclick="location.href='index.php'; return false;">Cancel</button>
    </form>
</body>
</html>
<?php
    } else {
        echo "Rating not found.";
    }
} else {
    echo "Rating ID not provided.";
}

$conn->close();
?>
