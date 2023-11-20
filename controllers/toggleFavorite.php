<?php
session_start();
require_once 'accessdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pokemonName'])) {
    $pokemonName = $_POST['pokemonName'];
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare('SELECT Favorites FROM users WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    if ($user && !empty($user['Favorites'])) {
        $favorites = json_decode($user['Favorites'], true);

        if (in_array($pokemonName, $favorites)) {
            // The Pokemon is in the favorites, remove it
            $favorites = array_diff($favorites, [$pokemonName]);
        } else {
            // The Pokemon is not in the favorites, add it
            $favorites[] = $pokemonName;
        }

        $stmt = $pdo->prepare('UPDATE users SET Favorites = ? WHERE id = ?');
        $stmt->execute([json_encode($favorites), $userId]);
    }

    // Redirect back to the page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>