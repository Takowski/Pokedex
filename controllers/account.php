<?php
function account(){

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die('You are not logged in.');
}

// Get the user ID from the session
$userId = $_SESSION['user_id'];

$dbHost = 'localhost';
$dbName = 'pokemon';
$dbUser = 'root';
$dbPassword = 'root';

// Require PDO instance
require 'controllers/accessdb.php';

// Query the database for the user
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$userId]);
$user = $stmt->fetch();

// Check if the user exists
if (!$user) {
    die('User not found.');
}

// Display the user's information
echo "User ID: " . $user['id'] . "<br>";
echo "Email: " . $user['email'] . "<br>";
echo "FirstName: " . $user['FirstName'] . "<br>";
echo "LastName: " . $user['LastName'] . "<br>";
echo "Password: " . $user['password'] . "<br>";
}