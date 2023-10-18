
<?php
session_start();

// Connect to the database
include 'config.php';

// If 'logout' is clicked
if (isset($_GET['logout'])) {
    // Unset and destroy the session to log the user out
    session_unset();
    session_destroy();
    
    // Redirect back to the login page
    header('Location: login.php');
    exit;
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Check if the user has confirmed the deletion
if (isset($_POST['confirm'])) {
    if ($_POST['confirm'] == "Yes" && isset($_GET['id'])) {
        $rating_id = $_GET['id'];

        $sql = "DELETE FROM ratings_table WHERE id = $rating_id";
        if ($conn->query($sql) === TRUE) {
            header('Location: index.php');
            exit;
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        // If "No" is clicked or any other condition, redirect to index.php
        header('Location: index.php');
        exit;
    }
} elseif (isset($_GET['id'])) {
    // Display the confirmation form if the deletion is not yet confirmed
    $rating_id = $_GET['id'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Rating</title>
</head>
<body>

<!-- Display the logged in message at the top -->
<?php
if (isset($_SESSION['username'])) {
    echo "You are now logged in as " . $_SESSION['username'] . ". <a href='?logout=1'>Log Out</a><br><br>";
}
?>

<h2>Delete Rating</h2>
<?php if (isset($rating_id)): ?>
    <form action="delete.php?id=<?php echo $rating_id; ?>" method="post">
        Are you sure you want to delete this rating?
        <input type="submit" name="confirm" value="Yes">
        <input type="submit" name="confirm" value="No">
    </form>
<?php else: ?>
    <p>Rating ID not provided.</p>
<?php endif; ?>

</body>
</html>
