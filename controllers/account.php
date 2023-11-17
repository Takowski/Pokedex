<?php
// Start a new session or resume the existing one
session_start();

// Include the database connection file
require_once 'connect.php';

function displayMyAccountPage()
{
    global $pdo;

    // Check if the form data is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the email and password from the form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query the database for the user with the submitted email
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Check if the user exists and the submitted password is correct
        if ($user && password_verify($password, $user['password'])) {
            // If the user exists and the password is correct, set the user ID in the session
            $_SESSION['user_id'] = $user['id'];

            // Display the user information
            echo "<h1>My Account</h1>";
            echo "Username: " . htmlspecialchars($user['username']) . "<br>";
            echo "Email: " . htmlspecialchars($user['email']) . "<br>";
            // ... display other user information ...
        } else {
            // If the user does not exist or the password is incorrect, show an error message
            echo 'Invalid email or password';
        }
    } else {
        // If the form data is not submitted, display the login form
        echo '
        <form method="post" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Log in">
        </form>
        ';
    }
}

displayMyAccountPage();
?>