<?php
//consulted chat gpt on how to check for errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// If user is already logged in they will be redirected to index page when they want to aceess the registration page
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

// Database connection file
include 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    // Check if passwords match
    if ($password1 != $password2) {
        $error = "Passwords do not match!";
    } else {
        // Check if username already exists
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
                // Logs in the user after signup
                $_SESSION['username'] = $username;

                // Takes the user to index.html if theysignup successfully
                header('Location: index.php');
                exit;
            } else {
                $error = "There was a problem with the signup. Please try again.";
            }
        }
    }
}
?>

<!--HTML code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
<h2>FaveTune SignUp</h2>
<!--SignUp form-->
<form action="signup.php" method="post">
    <div>
        <p>Please fill this form to create an account</p>
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
    <p>Already have an account? <a href="Login.php">Login here</a> </p>
</form>

<?php
if ($error) {
    echo "<p style='color:red;'>$error</p>";
}
?>

</body>
</html>
