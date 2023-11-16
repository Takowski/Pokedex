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

            $json = file_get_contents("./pokemon.json");
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

                echo '<pre>';
                print_r($types);
                echo '<pre>';

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
                



                echo "<br />", $name;
                echo "<br />", "#", $num;
                /* echo "<br />", $img; */
                        

                $prep->execute();

                $prep->closeCursor();
                $prep = NULL;

                echo "<br />", "HP : ", $hp;
                echo "<br />", "Attack : ", $attack;
                echo "<br />", "Defense : ", $defense;
                echo "<br />", "Special Attack : ", $spattack;
                echo "<br />", "Special Defense : ", $spdefense;
                echo "<br />", "Speed : ", $speed, "<br />";
        }
        } 
        catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
			die('Erreur : '.$e->getMessage());
		}
    ?>
</body>
</html>