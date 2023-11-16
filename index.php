<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        try {
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
            $DB = new PDO("mysql:host=localhost;dbname=testJSON;charset=utf8", "root", "root");

            $json = file_get_contents("./data/pokemon.json");
            $json_decode = json_decode($json, true);
            $pokemon = $json_decode["pokemon"];

            foreach($pokemon as $infos) {
                $num = $infos["num"];
                $name = $infos["name"];
                $img = $infos["img"];
                $types = $infos["type"];
                $hp = $infos["hp"];
                $attack = $infos["attack"];
                $defense = $infos["defense"];
                $spattack = $infos["spattack"];
                $spdefense = $infos["spdefense"];
                $speed = $infos["speed"];

                $query = "INSERT INTO `pokemon` (`id`, `name`, `type 1`, `type 2`, `hp`, `attack`, `defense`, `spattack`, `spdefense`, `speed`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                $prep = $DB->prepare($query);

                $prep->bindValue(1, $num, PDO::PARAM_INT);
                $prep->bindValue(2, $name, PDO::PARAM_STR);
                if (count($types) < 2) {
                    $prep->bindValue(3, $types[0], PDO::PARAM_STR);
                    $prep->bindValue(4, "NULL", PDO::PARAM_STR);
                } else {
                    $prep->bindValue(3, $types[0], PDO::PARAM_STR);
                    $prep->bindValue(4, $types[1], PDO::PARAM_STR);
                }
                $prep->bindValue(5, $hp, PDO::PARAM_INT);
                $prep->bindValue(6, $attack, PDO::PARAM_INT);
                $prep->bindValue(7, $defense, PDO::PARAM_INT);
                $prep->bindValue(8, $spattack, PDO::PARAM_INT);
                $prep->bindValue(9, $spdefense, PDO::PARAM_INT);
                $prep->bindValue(10, $speed, PDO::PARAM_INT);
                
                $prep->execute();

                $prep->closeCursor();
                $prep = NULL;
        }
        } 
        catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
			die('Erreur : '.$e->getMessage());
		}
    ?>
</body>
</html><?php
// Simple Router

// Include the helper file for handling requests
require_once __DIR__.'/helpers/request.php';

// Switch statement to handle different routes based on the path from the URL
switch($url['path'])
{
    // Case: Root path '/'
    case '/':
        // Check if the HTTP method is GET
        if($method == 'GET') {
            // Include the 'views/index.php' file for the root path
            require 'controllers/PokedexController.php';
            index();
        }
        break;

    // Case: Handle other paths
    case '/pokemon':
        // Check if the HTTP method is GET
        if($method == 'GET') {
            // Parse the query string of the URL and store the result in the 'result' array
            parse_str($url['query'], $result);
            // Check if the 'pokemon' parameter is set in the query string
            if(isset($result['name']) && !empty($result['name'])) {
                
                // If 'pokemon' parameter is set, include the 'views/show.php' file
                require 'views/show.php';
            } else {
                // If 'pokemon' parameter is not set, include the 'views/errors/404.php' file
                require 'views/errors/404.php';
                // Set HTTP response code to 404 Not Found
                http_response_code(404);
            }
        }
        break;

    // Default case: Handle all other paths
    default:
        // Include the 'views/errors/404.php' file for unknown paths
        require 'views/errors/404.php';
        // Set HTTP response code to 404 Not Found
        http_response_code(404);
        break;
}
