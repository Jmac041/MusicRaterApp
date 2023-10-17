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

    $sql = "SELECT * FROM ratings_table WHERE id = $rating_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Rating</title>
</head>
<body>
    <h2>View Rating</h2>
    <p><strong>Artist:</strong> <?php echo $row['artist']; ?></p>
    <p><strong>Song:</strong> <?php echo $row['song']; ?></p>
    <p><strong>Rating:</strong> <?php echo $row['rating']; ?> out of 5</p>

    <a href="index.php">Back to List</a>
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
