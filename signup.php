<?php
// Error and session handling setup
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Redirect if user is already logged in
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

// Database connection
require 'config.php';

$error = "";

// Signup logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password1 = trim($_POST['password1']);
    $password2 = trim($_POST['password2']);

    if ($password1 !== $password2) {
        $error = "Passwords do not match!";
    } else {
        // Check for existing username
        $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username already taken. Please choose another.";
        } else {
            $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashedPassword);
            
            if ($stmt->execute()) {
                $_SESSION['username'] = $username;
                header('Location: index.php');
                exit;
            } else {
                $error = "Error during signup. Please try again.";
            }
        }
    }
}
?>
<!--HTML CODE-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - FaveTune</title>
</head>
<body>
<h2>FaveTune SignUp</h2>

<form action="signup.php" method="post">
    <div>
        <p>Please fill this form to create an account:</p>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="password1">Password:</label>
        <input type="password" name="password1" id="password1" minlength="10" required>
    </div>
    <div>
        <label for="password2">Confirm Password:</label>
        <input type="password" name="password2" id="password2" minlength="10" required>
    </div>
    <div>
        <input type="submit" value="Signup">
        <input type="reset" value="reset">
    </div>
    <p>Already have an account? <a href="Login.php">Login here</a></p>
</form>

<?php if ($error): ?>
    <p style='color:red;'><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

</body>
</html>
