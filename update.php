<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include 'config.php';

// Check if the rating ID is provided in the URL
if (isset($_GET['id'])) {
    $rating_id = $_GET['id'];

    // If update form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $artist = $_POST['artist'];
        $song = $_POST['song'];
        $rating = $_POST['rating'];

        $sql = "UPDATE ratings_table SET artist='$artist', song='$song', rating=$rating WHERE id=$rating_id";
        if ($conn->query($sql) === TRUE) {
            header('Location: index.php');
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $sql = "SELECT * FROM ratings_table WHERE id = $rating_id";
    $result = $conn->query($sql);

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
    <form method="POST" action="update.php?id=<?php echo $rating_id; ?>">
        <label for="artist">Artist:</label>
        <input type="text" name="artist" value="<?php echo $row['artist']; ?>" required><br>

        <label for="song">Song:</label>
        <input type="text" name="song" value="<?php echo $row['song']; ?>" required><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" value="<?php echo $row['rating']; ?>" min="1" max="5" required><br>

        <input type="submit" value="Update Rating">
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

