<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './controllers/accessdb.php';
require_once './controllers/loginform.php';
require_once './controllers/account.php';
require_once './controllers/AddPokemonController.php';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // The user is logged in, display their account information
    account($_SESSION['user_id']);
    addPokemon();
} else {
    // The user is not logged in, display the login form
    loginform();
}