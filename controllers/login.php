<?php


function loginUser($pdo, $email, $password)
{
    require_once 'accessdb.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Query the database for the user with the submitted email
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Check if the user exists and the password is correct
    if ($user && $password === $user['password']) {
        // If the user exists and the password is correct, set the user ID in the session
        $_SESSION['user_id'] = $user['id'];
        // Redirect to Myaccount.php
        header('Location: ./views/myAccount.php');
        exit;
    } else {
        // If the user does not exist or the password is incorrect, show an error message
        return 'Invalid email or password';
    }
}

// Check if the form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form data has been submitted, process it

    // Get the email and password from the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginResult = loginUser($pdo, $email, $password);
    if ($loginResult) {
        echo $loginResult;
    }
}
