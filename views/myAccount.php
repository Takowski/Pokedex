<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'accessdb.php';
require_once 'loginform.php';
require_once 'account.php';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // The user is logged in, display their account information
    account($_SESSION['user_id']);
} else {
    // The user is not logged in, display the login form
    loginform();
}