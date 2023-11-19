<?php
// Database configuration
$dbHost = 'localhost';
$dbName = 'pokemon';
$dbUser = 'root';
$dbPassword = 'root';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}