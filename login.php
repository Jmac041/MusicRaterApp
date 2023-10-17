
<?php
session_start();

// database connection file
include 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Using prepared statement to fetch the user's hashed password
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // If user exists and password is correct
        $_SESSION['username'] = $username; // Store username in session
    header('Location: index.php'); // Redirect to index.php after a successful login
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h1>Welcome to FaveTune </h1>
<h2>Login</h2>
<form action="login.php" method="post">
    <div>
        <p>Please fill in your credentials to login</p>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" minlength="10" required>
    </div>
    <div>
        <input type="submit" value="Login">
    </div>
    <p>Dont have an account? <a href="SignUp.php">Sign Up Here</a> </p>
</form>
<?php
if ($error) {
    echo "<p style='color:red;'>$error</p>";
}
?>
</body>
</html>
