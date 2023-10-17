<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include 'config.php';

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
    ?>

    <form action="delete.php?id=<?php echo $rating_id; ?>" method="post">
        Are you sure you want to delete this rating?
        <input type="submit" name="confirm" value="Yes">
        <input type="submit" name="confirm" value="No">
    </form>

    <?php
} else {
    echo "Rating ID not provided.";
    exit;
}

$conn->close();
?>
