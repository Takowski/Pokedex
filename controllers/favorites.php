<?php
function favorites()
{
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
    $stmt = $pdo->prepare('SELECT Favorites FROM users WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    // Check if the user exists and has favorites
    if ($user && !empty($user['Favorites'])) {
        // The user exists and has favorites, get the favorites
        $favorites = json_decode($user['Favorites'], true);

        // Prepare the query to get the favorite Pokemon
        $placeholders = str_repeat('?,', count($favorites) - 1) . '?';
        $query = "SELECT * FROM Pokemon WHERE name IN ($placeholders)";
        $fetch = $pdo->prepare($query);
        $fetch->execute($favorites);
        $fetch = $fetch->fetchAll(PDO::FETCH_ASSOC);

        // Display the favorite Pokemon
        foreach ($fetch as $infos) {
            $name = str_replace([".", " "], "", strtolower($infos["name"]));
            $id = $infos["id"];
            $type1 = $infos["type1"];
            $type2 = $infos["type2"];
            echo <<<EOD
            <a href="/pokemon?name=$name">
            <div class="pokemonDiv">
                <img src="../public/img/pokemon/$name.png" alt="$name Img" width="50px"><br />
                <span>#$id</span><br />
            EOD;
            $name = str_replace([".", " "], "", strtolower($infos["name"]));
            $name = ucfirst($name);
            if ($type2 != "NULL") {
                echo <<<EOD
                <span class="name">$name</span><br />
                <div class="types">
                    <span class=$type1>$type1</span>
                    <span class=$type2>$type2</span>
                </div>
                EOD;
            } else {
                echo <<<EOD
                <span class="name">$name</span><br />
                <div class="types">
                    <span class=$type1>$type1</span>
                </div>
                
                EOD;
            }
            echo <<<EOD
            </div>
            </a>
            EOD;
        }
    } else {
        // The user does not exist or has no favorites, display a message
        echo 'You have no favorites, start your journey,and cath them :).';
    }
}
